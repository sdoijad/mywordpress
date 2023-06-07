# Howto create an action in your own extension.

In this tutorial I will explain how you could develop an action which does update an existing participant record.
And we will add this action to your own extension. We assume that you already have an extension called _myextension_.

## Contents

* [Required functionality](#required-functionality)
* [Create an action class](#create-an-action-class)
  * [Create the class](#create-the-class)
  * [Specify the configuration options](#specify-the-configuration-options)
  * [Specify the parameter options](#specify-the-parameter-options)
  * [Specify the output of the action](#specify-the-output-of-the-action)
  * [The actual action](#the-actual-action)
  * [Add a tag to this action](#add-a-tag-to-this-action)
* [Make it available to the action provider](#make-it-available-to-the-action-provider)

## Required functionality

The action should update an existing participant record.
Based on the provided event_id and contact_id the participant record is updated to the status configured by the site
administrator.

In _action-provider_ terminology this means we need _status_ as a _configuration option_ and _event_id_
and _contact_id_ as _parameter options_.

The action would not return anything.

![Configuration Screen](images/UpdateParticipantStatusAction.png)

## Create an action class

Start with a file in the directory _Civi\Myextension\Actions\UpdateParticipantStatus.php_
This file will contain the action class which is extended from the abstract action.

### Create the class

```php

  <?php

  namespace Civi\Myextension\Actions;

  use \Civi\ActionProvider\Action\AbstractAction;
  use \Civi\ActionProvider\Parameter\ParameterBagInterface;
  use \Civi\ActionProvider\Parameter\SpecificationBag;
  use \Civi\ActionProvider\Parameter\Specification;

  use CRM_Myextension_ExtensionUtil as E;

  class UpdateParticipantStatus extends AbstractAction {
  }

```

Above code will create the class, every action has to extend the _AbstractAction_ class. As you can see we use namespace
and use statements. The use statement are required for the next step and are a kind of _include_ or _require_ statement.

### Specify the configuration options

In this step we define the configuration option of the action. A configuration option is something which should be set
by the site administrator.

We do this by returning a _specification bag_ in which all configuration fields are specified.

In our case we have only one configuration option and that is the new status.

```php

  class UpdateParticipantStatus extends AbstractAction {

    //...

    /**
     * Returns the specification of the configuration options for the actual action.
     *
     * @return SpecificationBag
     */
    public function getConfigurationSpecification() {
      return new SpecificationBag(array(
        /**
         * The parameters given to the Specification object are:
         * @param string $name
         * @param string $dataType
         * @param string $title
         * @param bool $required
         * @param mixed $defaultValue
         * @param string|null $fkEntity
         * @param array $options
         * @param bool $multiple
         */
        new Specification('status', 'Integer', E::ts('Status'), true, null, 'ParticipantStatusType', null, FALSE),
      ));
    }

  }

```

In the code above we define a field which has the name _status_ an Integer Type, the human title is a translated string,
it is a required option, no default value, and the list of options are retrieved from the _ParticipantStatus_ entity.

### Specify the parameter options

In this step we specify which parameters the action has. This is similar to the configuration specification. The difference
between a parameter and a configuration is that a configuration is set by a site administrator whilst a parameter is coming
from an other action, an input etc. Depending on the situation in which the action is used e.g. when used in the
[form-processor](https://lab.civicrm.org/extensions/form-processor) a parameter could be mapped to an input of a
form processor or to an output of previous action.

In our specific example we have the event_id and the contact_id as parameters.

```php

  class UpdateParticipantStatus extends AbstractAction {

    //...

    /**
     * Returns the specification of the configuration options for the actual action.
     *
     * @return SpecificationBag
     */
    public function getParameterSpecification() {
      return new SpecificationBag(array(
        /**
         * The parameters given to the Specification object are:
         * @param string $name
         * @param string $dataType
         * @param string $title
         * @param bool $required
         * @param mixed $defaultValue
         * @param string|null $fkEntity
         * @param array $options
         * @param bool $multiple
         */
        new Specification('event_id', 'Integer', E::ts('Event ID'), true, null, null, null, FALSE),
        new Specification('contact_id', 'Integer', E::ts('Contact ID'), true, null, null, null, FALSE),
      ));
    }

  }

```

### Specify the output of the action

In this step we specify which fields an action outputs. This is similar to the specification of configuration and
parameters. In this particular example we dont output anything.

```php

  class UpdateParticipantStatus extends AbstractAction {

    //...

    /**
     * Returns the specification of the output parameters of this action.
     *
     * This function could be overridden by child classes.
     *
     * @return SpecificationBag
     */
    public function getOutputSpecification() {
      return new SpecificationBag();
    }

  }

```

### The actual action

In this step the actual action is developed. So what we have to do here is to look up a participant record for certain
event and contact and set the status to configured status.

The first thing which is important here is to note that the action-provider does validate the incoming parameters and
configuration options. So we can assume those are valid.

Also note that we throw an Exception when no participant record could be found.

```php

  class UpdateParticipantStatus extends AbstractAction {

    // ...

    /**
     * Run the action
     *
     * @param ParameterInterface $parameters
     *   The parameters to this action.
     * @param ParameterBagInterface $output
     *   The parameters this action can send back
     * @return void
     */
    protected function doAction(ParameterBagInterface $parameters, ParameterBagInterface $output) {
      // Get the contact and the event.
      $contact_id = $parameters->getParameter('contact_id');
      $event_id = $parameters->getParameter('event_id');

      // Find the participant record for this contact and event.
      // This assumes that the contact has already been registered for the event.
      $participant = civicrm_api3('Participant', 'get', array(
        'contact_id' => $contact_id,
        'event_id' => $event_id,
        'options' => array('limit' => 1),
      ));
      if ($participant['count'] < 1) {
        // No record is found.
        throw new \Civi\ActionProvider\Action\Exception\ExecutionException(E::ts('Could not find a participant record'));
      }

      // Get the participant record and the status id from the configuration.
      $participant = reset($participant['values']);
      $new_status_id = $this->configuration->getParameter('status');

      // Update the participant record through an API call.
      try {
        civicrm_api3('Participant', 'create', array(
          'id' => $participant['id'],
          'status_id' => $new_status_id,
        ));
      } catch (Exception $e) {
        throw new \Civi\ActionProvider\Action\Exception\ExecutionException(E::ts('Could not update participant status'));
      }
    }
  }

```

## Make it available to the action provider

Now we have defined our action class. The last thing we have to do is to make it known to the action provider.

### Check the info.xml

First we need to check whether the info.xml contains the class loader for files in the (sub)directory Civi.

Open your info.xml file and check whether the following lines are present. If they are not present add them just before `<civix>`.

```xml
  <classloader>
    <psr4 prefix="Civi\" path="Civi" />
  </classloader>
```

### Create a compiler pass class

Next step is to create a compiler pass class. You can use this class to add multiple actions.

!!! Note The compiler pass class is a class which is called just before the action provider is instantiated. Meaning that
we can easily add actions, alter existing actions etc. See [Symfony Documenation on how the Compiler Pass works](https://symfony.com/doc/3.4/components/dependency_injection/compilation.html#components-di-separate-compiler-passes)

Create a file in _Civi\Myextension\CompilerPass.php_ and add the following code:

```php
  <?php

  namespace Civi\Myextension;

  use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
  use Symfony\Component\DependencyInjection\ContainerBuilder;

  use CRM_Myextension_ExtensionUtil as E;

  class CompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
      if ($container->hasDefinition('action_provider')) {
        $actionProviderDefinition = $container->getDefinition('action_provider');
        $actionProviderDefinition->addMethodCall('addAction', array('MyExtensionUpdateParticipantStatus', 'Civi\Myextension\Actions\UpdateParticipantStatus', E::ts('Update participant status (My Extension)'), array()));
      }
    }
  }

```

The last step is to let CiviCRM know about the compiler pass class. We do this by using the [hook_civicrm_container](https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_container/)

In the file _myextension.php_ add the following function:

```php

use Symfony\Component\DependencyInjection\ContainerBuilder;

function myextension_civicrm_container(ContainerBuilder $container) {
  $container->addCompilerPass(new Civi\Myextension\CompilerPass());
}

```
