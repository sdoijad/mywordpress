<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final
 */
class CachedCiviContainer_c320ef0516d95117b4d058fd9d07724d extends Container
{
    private $parameters = [];

    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services = $this->privates = [];
        $this->syntheticIds = [
            'cache.settings' => true,
            'dispatcher.boot' => true,
            'lockManager' => true,
            'paths' => true,
            'runtime' => true,
            'settings_manager' => true,
            'userPermissionClass' => true,
            'userSystem' => true,
        ];
        $this->methodMap = [
            'Civi\\AfformReCaptcha2' => 'getAfformReCaptcha2Service',
            'Civi\\Afform\\Behavior\\ContactAutofill' => 'getContactAutofillService',
            'Civi\\Afform\\Behavior\\ContactDedupe' => 'getContactDedupeService',
            'Civi\\Api4\\Event\\Subscriber\\AutocompleteFieldSubscriber' => 'getAutocompleteFieldSubscriberService',
            'Civi\\Api4\\Event\\Subscriber\\DefaultDisplaySubscriber' => 'getDefaultDisplaySubscriberService',
            'Civi\\Api4\\Service\\Autocomplete\\ActivityAutocompleteProvider' => 'getActivityAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\AddressAutocompleteProvider' => 'getAddressAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\CaseAutocompleteProvider' => 'getCaseAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\ContactAutocompleteProvider' => 'getContactAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\ContactTypeAutocompleteProvider' => 'getContactTypeAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\ContributionAutocompleteProvider' => 'getContributionAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\CountryAutocompleteProvider' => 'getCountryAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\EntityAutocompleteProvider' => 'getEntityAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\ParticipantAutocompleteProvider' => 'getParticipantAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\PledgeAutocompleteProvider' => 'getPledgeAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\RelationshipAutocompleteProvider' => 'getRelationshipAutocompleteProviderService',
            'Civi\\Api4\\Service\\Autocomplete\\StateProvinceAutocompleteProvider' => 'getStateProvinceAutocompleteProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ACLCreationSpecProvider' => 'getACLCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ACLEntityRoleCreationSpecProvider' => 'getACLEntityRoleCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ActionScheduleCreationSpecProvider' => 'getActionScheduleCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ActivitySpecProvider' => 'getActivitySpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\AddressCreationSpecProvider' => 'getAddressCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\AddressGetSpecProvider' => 'getAddressGetSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\BatchCreationSpecProvider' => 'getBatchCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\CampaignCreationSpecProvider' => 'getCampaignCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\CaseCreationSpecProvider' => 'getCaseCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\CaseTypeGetSpecProvider' => 'getCaseTypeGetSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ContactCreationSpecProvider' => 'getContactCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ContactGetSpecProvider' => 'getContactGetSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ContactTypeCreationSpecProvider' => 'getContactTypeCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ContributionCreationSpecProvider' => 'getContributionCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ContributionGetSpecProvider' => 'getContributionGetSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ContributionRecurCreationSpecProvider' => 'getContributionRecurCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\CustomFieldCreationSpecProvider' => 'getCustomFieldCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\CustomGroupSpecProvider' => 'getCustomGroupSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\CustomValueSpecProvider' => 'getCustomValueSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\DefaultLocationTypeProvider' => 'getDefaultLocationTypeProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\DomainCreationSpecProvider' => 'getDomainCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\DomainGetSpecProvider' => 'getDomainGetSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\EmailCreationSpecProvider' => 'getEmailCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\EntityBatchCreationSpecProvider' => 'getEntityBatchCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\EntityTagCreationSpecProvider' => 'getEntityTagCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\EntityTagFilterSpecProvider' => 'getEntityTagFilterSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\EventCreationSpecProvider' => 'getEventCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\FieldCurrencySpecProvider' => 'getFieldCurrencySpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\FieldDomainIdSpecProvider' => 'getFieldDomainIdSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\FinancialItemCreationSpecProvider' => 'getFinancialItemCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\FinancialTrxnCreationSpecProvider' => 'getFinancialTrxnCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\GetActionDefaultsProvider' => 'getGetActionDefaultsProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\GroupContactCreationSpecProvider' => 'getGroupContactCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\GroupCreationSpecProvider' => 'getGroupCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\IsCurrentFieldSpecProvider' => 'getIsCurrentFieldSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\ManagedEntitySpecProvider' => 'getManagedEntitySpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\MappingCreationSpecProvider' => 'getMappingCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\MembershipCreationSpecProvider' => 'getMembershipCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\MembershipTypeCreationSpecProvider' => 'getMembershipTypeCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\MessageTemplateGetSpecProvider' => 'getMessageTemplateGetSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\NavigationSpecProvider' => 'getNavigationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\NoteCreationSpecProvider' => 'getNoteCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\OptionValueCreationSpecProvider' => 'getOptionValueCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorCreationSpecProvider' => 'getPaymentProcessorCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorTypeCreationSpecProvider' => 'getPaymentProcessorTypeCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\PhoneCreationSpecProvider' => 'getPhoneCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\PriceFieldValueCreationSpecProvider' => 'getPriceFieldValueCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\RelationshipCacheSpecProvider' => 'getRelationshipCacheSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\RelationshipTypeCreationSpecProvider' => 'getRelationshipTypeCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\SearchDisplayCreationSpecProvider' => 'getSearchDisplayCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentExtraFieldProvider' => 'getSearchSegmentExtraFieldProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentSpecProvider' => 'getSearchSegmentSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\TagCreationSpecProvider' => 'getTagCreationSpecProviderService',
            'Civi\\Api4\\Service\\Spec\\Provider\\UFFieldCreationSpecProvider' => 'getUFFieldCreationSpecProviderService',
            'Civi\\Api4\\Subscriber\\AfformAutocompleteSubscriber' => 'getAfformAutocompleteSubscriberService',
            'action_object_provider' => 'getActionObjectProviderService',
            'action_provider' => 'getActionProviderService',
            'afform_scanner' => 'getAfformScannerService',
            'angular' => 'getAngularService',
            'angularjs.loader' => 'getAngularjs_LoaderService',
            'asset_builder' => 'getAssetBuilderService',
            'authx.authenticator' => 'getAuthx_AuthenticatorService',
            'authx.legacy_authenticator' => 'getAuthx_LegacyAuthenticatorService',
            'bundle.bootstrap3' => 'getBundle_Bootstrap3Service',
            'bundle.coreResources' => 'getBundle_CoreResourcesService',
            'bundle.coreStyles' => 'getBundle_CoreStylesService',
            'cache.checks' => 'getCache_ChecksService',
            'cache.community_messages' => 'getCache_CommunityMessagesService',
            'cache.contactTypes' => 'getCache_ContactTypesService',
            'cache.customData' => 'getCache_CustomDataService',
            'cache.default' => 'getCache_DefaultService',
            'cache.extension_browser' => 'getCache_ExtensionBrowserService',
            'cache.fields' => 'getCache_FieldsService',
            'cache.groups' => 'getCache_GroupsService',
            'cache.js_strings' => 'getCache_JsStringsService',
            'cache.long' => 'getCache_LongService',
            'cache.metadata' => 'getCache_MetadataService',
            'cache.navigation' => 'getCache_NavigationService',
            'cache.prevNextCache' => 'getCache_PrevNextCacheService',
            'cache.session' => 'getCache_SessionService',
            'cache_config' => 'getCacheConfigService',
            'civi.activity.triggers' => 'getCivi_Activity_TriggersService',
            'civi.api4.activitySchema' => 'getCivi_Api4_ActivitySchemaService',
            'civi.api4.contactSchema' => 'getCivi_Api4_ContactSchemaService',
            'civi.api4.isCurrent' => 'getCivi_Api4_IsCurrentService',
            'civi.api4.messagetemplateSchema' => 'getCivi_Api4_MessagetemplateSchemaService',
            'civi.api4.permissionCheck' => 'getCivi_Api4_PermissionCheckService',
            'civi.api4.searchKit' => 'getCivi_Api4_SearchKitService',
            'civi.api4.validateFields' => 'getCivi_Api4_ValidateFieldsService',
            'civi.case.staticTriggers' => 'getCivi_Case_StaticTriggersService',
            'civi.case.triggers' => 'getCivi_Case_TriggersService',
            'civi.pipe' => 'getCivi_PipeService',
            'civi_api_kernel' => 'getCiviApiKernelService',
            'civi_flexmailer_abdicator' => 'getCiviFlexmailerAbdicatorService',
            'civi_flexmailer_api_overrides' => 'getCiviFlexmailerApiOverridesService',
            'civi_flexmailer_attachments' => 'getCiviFlexmailerAttachmentsService',
            'civi_flexmailer_basic_headers' => 'getCiviFlexmailerBasicHeadersService',
            'civi_flexmailer_bounce_tracker' => 'getCiviFlexmailerBounceTrackerService',
            'civi_flexmailer_default_batcher' => 'getCiviFlexmailerDefaultBatcherService',
            'civi_flexmailer_default_composer' => 'getCiviFlexmailerDefaultComposerService',
            'civi_flexmailer_default_sender' => 'getCiviFlexmailerDefaultSenderService',
            'civi_flexmailer_hooks' => 'getCiviFlexmailerHooksService',
            'civi_flexmailer_html_click_tracker' => 'getCiviFlexmailerHtmlClickTrackerService',
            'civi_flexmailer_open_tracker' => 'getCiviFlexmailerOpenTrackerService',
            'civi_flexmailer_required_fields' => 'getCiviFlexmailerRequiredFieldsService',
            'civi_flexmailer_required_tokens' => 'getCiviFlexmailerRequiredTokensService',
            'civi_flexmailer_test_prefix' => 'getCiviFlexmailerTestPrefixService',
            'civi_flexmailer_text_click_tracker' => 'getCiviFlexmailerTextClickTrackerService',
            'civi_flexmailer_to_header' => 'getCiviFlexmailerToHeaderService',
            'civi_token_compat' => 'getCiviTokenCompatService',
            'civi_token_impliedcontext' => 'getCiviTokenImpliedcontextService',
            'crm_activity_tokens' => 'getCrmActivityTokensService',
            'crm_case_tokens' => 'getCrmCaseTokensService',
            'crm_contact_tokens' => 'getCrmContactTokensService',
            'crm_contribute_tokens' => 'getCrmContributeTokensService',
            'crm_contribution_recur_tokens' => 'getCrmContributionRecurTokensService',
            'crm_domain_tokens' => 'getCrmDomainTokensService',
            'crm_event_tokens' => 'getCrmEventTokensService',
            'crm_group_tokens' => 'getCrmGroupTokensService',
            'crm_mailing_action_tokens' => 'getCrmMailingActionTokensService',
            'crm_mailing_tokens' => 'getCrmMailingTokensService',
            'crm_member_tokens' => 'getCrmMemberTokensService',
            'crm_participant_tokens' => 'getCrmParticipantTokensService',
            'crm_token_tidy' => 'getCrmTokenTidyService',
            'crypto.jwt' => 'getCrypto_JwtService',
            'crypto.registry' => 'getCrypto_RegistryService',
            'crypto.token' => 'getCrypto_TokenService',
            'cxn_reg_client' => 'getCxnRegClientService',
            'dispatcher' => 'getDispatcherService',
            'format' => 'getFormatService',
            'httpClient' => 'getHttpClientService',
            'i18n' => 'getI18nService',
            'magic_function_provider' => 'getMagicFunctionProviderService',
            'pear_mail' => 'getPearMailService',
            'prevnext' => 'getPrevnextService',
            'prevnext.driver.redis' => 'getPrevnext_Driver_RedisService',
            'prevnext.driver.sql' => 'getPrevnext_Driver_SqlService',
            'psr_log' => 'getPsrLogService',
            'psr_log_manager' => 'getPsrLogManagerService',
            'resources' => 'getResourcesService',
            'resources.js_strings' => 'getResources_JsStringsService',
            'schema_map_builder' => 'getSchemaMapBuilderService',
            'spec_gatherer' => 'getSpecGathererService',
            'sql_triggers' => 'getSqlTriggersService',
            'themes' => 'getThemesService',
        ];
        $this->aliases = [
            'cache.short' => 'cache.default',
            'event_dispatcher' => 'dispatcher',
        ];
    }

    public function compile(): void
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled(): bool
    {
        return true;
    }

    public function getRemovedIds(): array
    {
        return [
            'Psr\\Container\\ContainerInterface' => true,
            'Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
            'civi_container_factory' => true,
        ];
    }

    /**
     * Gets the public 'Civi\AfformReCaptcha2' shared service.
     *
     * @return \Civi\AfformReCaptcha2
     */
    protected function getAfformReCaptcha2Service()
    {
        return $this->services['Civi\\AfformReCaptcha2'] = new \Civi\AfformReCaptcha2();
    }

    /**
     * Gets the public 'Civi\Afform\Behavior\ContactAutofill' shared service.
     *
     * @return \Civi\Afform\Behavior\ContactAutofill
     */
    protected function getContactAutofillService()
    {
        return $this->services['Civi\\Afform\\Behavior\\ContactAutofill'] = new \Civi\Afform\Behavior\ContactAutofill();
    }

    /**
     * Gets the public 'Civi\Afform\Behavior\ContactDedupe' shared service.
     *
     * @return \Civi\Afform\Behavior\ContactDedupe
     */
    protected function getContactDedupeService()
    {
        return $this->services['Civi\\Afform\\Behavior\\ContactDedupe'] = new \Civi\Afform\Behavior\ContactDedupe();
    }

    /**
     * Gets the public 'Civi\Api4\Event\Subscriber\AutocompleteFieldSubscriber' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\AutocompleteFieldSubscriber
     */
    protected function getAutocompleteFieldSubscriberService()
    {
        return $this->services['Civi\\Api4\\Event\\Subscriber\\AutocompleteFieldSubscriber'] = new \Civi\Api4\Event\Subscriber\AutocompleteFieldSubscriber();
    }

    /**
     * Gets the public 'Civi\Api4\Event\Subscriber\DefaultDisplaySubscriber' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\DefaultDisplaySubscriber
     */
    protected function getDefaultDisplaySubscriberService()
    {
        return $this->services['Civi\\Api4\\Event\\Subscriber\\DefaultDisplaySubscriber'] = new \Civi\Api4\Event\Subscriber\DefaultDisplaySubscriber();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\ActivityAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\ActivityAutocompleteProvider
     */
    protected function getActivityAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\ActivityAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\ActivityAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\AddressAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\AddressAutocompleteProvider
     */
    protected function getAddressAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\AddressAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\AddressAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\CaseAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\CaseAutocompleteProvider
     */
    protected function getCaseAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\CaseAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\CaseAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\ContactAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\ContactAutocompleteProvider
     */
    protected function getContactAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\ContactAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\ContactAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\ContactTypeAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\ContactTypeAutocompleteProvider
     */
    protected function getContactTypeAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\ContactTypeAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\ContactTypeAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\ContributionAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\ContributionAutocompleteProvider
     */
    protected function getContributionAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\ContributionAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\ContributionAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\CountryAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\CountryAutocompleteProvider
     */
    protected function getCountryAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\CountryAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\CountryAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\EntityAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\EntityAutocompleteProvider
     */
    protected function getEntityAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\EntityAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\EntityAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\ParticipantAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\ParticipantAutocompleteProvider
     */
    protected function getParticipantAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\ParticipantAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\ParticipantAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\PledgeAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\PledgeAutocompleteProvider
     */
    protected function getPledgeAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\PledgeAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\PledgeAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\RelationshipAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\RelationshipAutocompleteProvider
     */
    protected function getRelationshipAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\RelationshipAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\RelationshipAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Autocomplete\StateProvinceAutocompleteProvider' shared service.
     *
     * @return \Civi\Api4\Service\Autocomplete\StateProvinceAutocompleteProvider
     */
    protected function getStateProvinceAutocompleteProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Autocomplete\\StateProvinceAutocompleteProvider'] = new \Civi\Api4\Service\Autocomplete\StateProvinceAutocompleteProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ACLCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ACLCreationSpecProvider
     */
    protected function getACLCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ACLCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ACLCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ACLEntityRoleCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ACLEntityRoleCreationSpecProvider
     */
    protected function getACLEntityRoleCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ACLEntityRoleCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ACLEntityRoleCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ActionScheduleCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ActionScheduleCreationSpecProvider
     */
    protected function getActionScheduleCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ActionScheduleCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ActionScheduleCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ActivitySpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ActivitySpecProvider
     */
    protected function getActivitySpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ActivitySpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ActivitySpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\AddressCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\AddressCreationSpecProvider
     */
    protected function getAddressCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\AddressCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\AddressCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\AddressGetSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\AddressGetSpecProvider
     */
    protected function getAddressGetSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\AddressGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\AddressGetSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\BatchCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\BatchCreationSpecProvider
     */
    protected function getBatchCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\BatchCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\BatchCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\CampaignCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\CampaignCreationSpecProvider
     */
    protected function getCampaignCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\CampaignCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CampaignCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\CaseCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\CaseCreationSpecProvider
     */
    protected function getCaseCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\CaseCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CaseCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\CaseTypeGetSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\CaseTypeGetSpecProvider
     */
    protected function getCaseTypeGetSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\CaseTypeGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CaseTypeGetSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ContactCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ContactCreationSpecProvider
     */
    protected function getContactCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContactCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ContactGetSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ContactGetSpecProvider
     */
    protected function getContactGetSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContactGetSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ContactTypeCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ContactTypeCreationSpecProvider
     */
    protected function getContactTypeCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContactTypeCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ContributionCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ContributionCreationSpecProvider
     */
    protected function getContributionCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContributionCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ContributionGetSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ContributionGetSpecProvider
     */
    protected function getContributionGetSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContributionGetSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ContributionRecurCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ContributionRecurCreationSpecProvider
     */
    protected function getContributionRecurCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionRecurCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContributionRecurCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\CustomFieldCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\CustomFieldCreationSpecProvider
     */
    protected function getCustomFieldCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomFieldCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CustomFieldCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\CustomGroupSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\CustomGroupSpecProvider
     */
    protected function getCustomGroupSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomGroupSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CustomGroupSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\CustomValueSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\CustomValueSpecProvider
     */
    protected function getCustomValueSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomValueSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CustomValueSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\DefaultLocationTypeProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\DefaultLocationTypeProvider
     */
    protected function getDefaultLocationTypeProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\DefaultLocationTypeProvider'] = new \Civi\Api4\Service\Spec\Provider\DefaultLocationTypeProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\DomainCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\DomainCreationSpecProvider
     */
    protected function getDomainCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\DomainCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\DomainCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\DomainGetSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\DomainGetSpecProvider
     */
    protected function getDomainGetSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\DomainGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\DomainGetSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\EmailCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\EmailCreationSpecProvider
     */
    protected function getEmailCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\EmailCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EmailCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\EntityBatchCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\EntityBatchCreationSpecProvider
     */
    protected function getEntityBatchCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityBatchCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EntityBatchCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\EntityTagCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\EntityTagCreationSpecProvider
     */
    protected function getEntityTagCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityTagCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EntityTagCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\EntityTagFilterSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\EntityTagFilterSpecProvider
     */
    protected function getEntityTagFilterSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityTagFilterSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EntityTagFilterSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\EventCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\EventCreationSpecProvider
     */
    protected function getEventCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\EventCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EventCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\FieldCurrencySpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\FieldCurrencySpecProvider
     */
    protected function getFieldCurrencySpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\FieldCurrencySpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FieldCurrencySpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\FieldDomainIdSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\FieldDomainIdSpecProvider
     */
    protected function getFieldDomainIdSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\FieldDomainIdSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FieldDomainIdSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\FinancialItemCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\FinancialItemCreationSpecProvider
     */
    protected function getFinancialItemCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\FinancialItemCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FinancialItemCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\FinancialTrxnCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\FinancialTrxnCreationSpecProvider
     */
    protected function getFinancialTrxnCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\FinancialTrxnCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FinancialTrxnCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\GetActionDefaultsProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\GetActionDefaultsProvider
     */
    protected function getGetActionDefaultsProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\GetActionDefaultsProvider'] = new \Civi\Api4\Service\Spec\Provider\GetActionDefaultsProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\GroupContactCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\GroupContactCreationSpecProvider
     */
    protected function getGroupContactCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\GroupContactCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\GroupContactCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\GroupCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\GroupCreationSpecProvider
     */
    protected function getGroupCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\GroupCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\GroupCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\IsCurrentFieldSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\IsCurrentFieldSpecProvider
     */
    protected function getIsCurrentFieldSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\IsCurrentFieldSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\IsCurrentFieldSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\ManagedEntitySpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\ManagedEntitySpecProvider
     */
    protected function getManagedEntitySpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\ManagedEntitySpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ManagedEntitySpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\MappingCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\MappingCreationSpecProvider
     */
    protected function getMappingCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\MappingCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MappingCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\MembershipCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\MembershipCreationSpecProvider
     */
    protected function getMembershipCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\MembershipCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MembershipCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\MembershipTypeCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\MembershipTypeCreationSpecProvider
     */
    protected function getMembershipTypeCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\MembershipTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MembershipTypeCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\MessageTemplateGetSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\MessageTemplateGetSpecProvider
     */
    protected function getMessageTemplateGetSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\MessageTemplateGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MessageTemplateGetSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\NavigationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\NavigationSpecProvider
     */
    protected function getNavigationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\NavigationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\NavigationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\NoteCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\NoteCreationSpecProvider
     */
    protected function getNoteCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\NoteCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\NoteCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\OptionValueCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\OptionValueCreationSpecProvider
     */
    protected function getOptionValueCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\OptionValueCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\OptionValueCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\PaymentProcessorCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\PaymentProcessorCreationSpecProvider
     */
    protected function getPaymentProcessorCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PaymentProcessorCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\PaymentProcessorTypeCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\PaymentProcessorTypeCreationSpecProvider
     */
    protected function getPaymentProcessorTypeCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PaymentProcessorTypeCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\PhoneCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\PhoneCreationSpecProvider
     */
    protected function getPhoneCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\PhoneCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PhoneCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\PriceFieldValueCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\PriceFieldValueCreationSpecProvider
     */
    protected function getPriceFieldValueCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\PriceFieldValueCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PriceFieldValueCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\RelationshipCacheSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\RelationshipCacheSpecProvider
     */
    protected function getRelationshipCacheSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\RelationshipCacheSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\RelationshipCacheSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\RelationshipTypeCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\RelationshipTypeCreationSpecProvider
     */
    protected function getRelationshipTypeCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\RelationshipTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\RelationshipTypeCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\SearchDisplayCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\SearchDisplayCreationSpecProvider
     */
    protected function getSearchDisplayCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchDisplayCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\SearchDisplayCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\SearchSegmentExtraFieldProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\SearchSegmentExtraFieldProvider
     */
    protected function getSearchSegmentExtraFieldProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentExtraFieldProvider'] = new \Civi\Api4\Service\Spec\Provider\SearchSegmentExtraFieldProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\SearchSegmentSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\SearchSegmentSpecProvider
     */
    protected function getSearchSegmentSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\SearchSegmentSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\TagCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\TagCreationSpecProvider
     */
    protected function getTagCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\TagCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\TagCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Service\Spec\Provider\UFFieldCreationSpecProvider' shared service.
     *
     * @return \Civi\Api4\Service\Spec\Provider\UFFieldCreationSpecProvider
     */
    protected function getUFFieldCreationSpecProviderService()
    {
        return $this->services['Civi\\Api4\\Service\\Spec\\Provider\\UFFieldCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\UFFieldCreationSpecProvider();
    }

    /**
     * Gets the public 'Civi\Api4\Subscriber\AfformAutocompleteSubscriber' shared service.
     *
     * @return \Civi\Api4\Subscriber\AfformAutocompleteSubscriber
     */
    protected function getAfformAutocompleteSubscriberService()
    {
        return $this->services['Civi\\Api4\\Subscriber\\AfformAutocompleteSubscriber'] = new \Civi\Api4\Subscriber\AfformAutocompleteSubscriber();
    }

    /**
     * Gets the public 'action_object_provider' shared service.
     *
     * @return \Civi\Api4\Provider\ActionObjectProvider
     */
    protected function getActionObjectProviderService()
    {
        return $this->services['action_object_provider'] = new \Civi\Api4\Provider\ActionObjectProvider();
    }

    /**
     * Gets the public 'action_provider' shared service.
     *
     * @return \Civi\ActionProvider\Container
     */
    protected function getActionProviderService()
    {
        return $this->services['action_provider'] = \Civi\ActionProvider\Container::getinstance();
    }

    /**
     * Gets the public 'afform_scanner' shared service.
     *
     * @return \CRM_Afform_AfformScanner
     */
    protected function getAfformScannerService()
    {
        return $this->services['afform_scanner'] = new \CRM_Afform_AfformScanner();
    }

    /**
     * Gets the public 'angular' shared service.
     *
     * @return \Civi\Angular\Manager
     */
    protected function getAngularService()
    {
        return $this->services['angular'] = ($this->privates['civi_container_factory'] ?? ($this->privates['civi_container_factory'] = new \Civi\Core\Container()))->createAngularManager();
    }

    /**
     * Gets the public 'angularjs.loader' shared service.
     *
     * @return \Civi\Angular\AngularLoader
     */
    protected function getAngularjs_LoaderService()
    {
        return $this->services['angularjs.loader'] = new \Civi\Angular\AngularLoader();
    }

    /**
     * Gets the public 'asset_builder' shared service.
     *
     * @return \Civi\Core\AssetBuilder
     */
    protected function getAssetBuilderService()
    {
        return $this->services['asset_builder'] = new \Civi\Core\AssetBuilder();
    }

    /**
     * Gets the public 'authx.authenticator' shared service.
     *
     * @return \Civi\Authx\Authenticator
     */
    protected function getAuthx_AuthenticatorService()
    {
        return $this->services['authx.authenticator'] = new \Civi\Authx\Authenticator();
    }

    /**
     * Gets the public 'authx.legacy_authenticator' shared service.
     *
     * @return \Civi\Authx\LegacyRestAuthenticator
     */
    protected function getAuthx_LegacyAuthenticatorService()
    {
        return $this->services['authx.legacy_authenticator'] = new \Civi\Authx\LegacyRestAuthenticator();
    }

    /**
     * Gets the public 'bundle.bootstrap3' shared service.
     *
     * @return \CRM_Core_Resources_Bundle
     */
    protected function getBundle_Bootstrap3Service()
    {
        return $this->services['bundle.bootstrap3'] = \CRM_Core_Resources_Common::createBootstrap3Bundle('bootstrap3');
    }

    /**
     * Gets the public 'bundle.coreResources' shared service.
     *
     * @return \CRM_Core_Resources_Bundle
     */
    protected function getBundle_CoreResourcesService()
    {
        return $this->services['bundle.coreResources'] = \CRM_Core_Resources_Common::createFullBundle('coreResources');
    }

    /**
     * Gets the public 'bundle.coreStyles' shared service.
     *
     * @return \CRM_Core_Resources_Bundle
     */
    protected function getBundle_CoreStylesService()
    {
        return $this->services['bundle.coreStyles'] = \CRM_Core_Resources_Common::createStyleBundle('coreStyles');
    }

    /**
     * Gets the public 'cache.checks' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_ChecksService()
    {
        return $this->services['cache.checks'] = \CRM_Utils_Cache::create(['name' => 'checks', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache']]);
    }

    /**
     * Gets the public 'cache.community_messages' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_CommunityMessagesService()
    {
        return $this->services['cache.community_messages'] = \CRM_Utils_Cache::create(['name' => 'community_messages', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache']]);
    }

    /**
     * Gets the public 'cache.contactTypes' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_ContactTypesService()
    {
        return $this->services['cache.contactTypes'] = \CRM_Utils_Cache::create(['name' => 'contactTypes', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache'], 'withArray' => 'fast']);
    }

    /**
     * Gets the public 'cache.customData' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_CustomDataService()
    {
        return $this->services['cache.customData'] = \CRM_Utils_Cache::create(['name' => 'custom data', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache'], 'withArray' => 'fast']);
    }

    /**
     * Gets the public 'cache.default' shared service.
     *
     * @return \CRM_Utils_Cache
     */
    protected function getCache_DefaultService()
    {
        return $this->services['cache.default'] = \CRM_Utils_Cache::singleton();
    }

    /**
     * Gets the public 'cache.extension_browser' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_ExtensionBrowserService()
    {
        return $this->services['cache.extension_browser'] = \CRM_Utils_Cache::create(['name' => 'extension_browser', 'type' => [0 => 'SqlGroup', 1 => 'ArrayCache']]);
    }

    /**
     * Gets the public 'cache.fields' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_FieldsService()
    {
        return $this->services['cache.fields'] = \CRM_Utils_Cache::create(['name' => 'contact fields', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache'], 'withArray' => 'fast']);
    }

    /**
     * Gets the public 'cache.groups' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_GroupsService()
    {
        return $this->services['cache.groups'] = \CRM_Utils_Cache::create(['name' => 'contact groups', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache'], 'withArray' => 'fast']);
    }

    /**
     * Gets the public 'cache.js_strings' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_JsStringsService()
    {
        return $this->services['cache.js_strings'] = \CRM_Utils_Cache::create(['name' => 'js_strings', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache'], 'withArray' => 'fast']);
    }

    /**
     * Gets the public 'cache.long' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_LongService()
    {
        return $this->services['cache.long'] = \CRM_Utils_Cache::create(['name' => 'long', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache']]);
    }

    /**
     * Gets the public 'cache.metadata' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_MetadataService()
    {
        return $this->services['cache.metadata'] = \CRM_Utils_Cache::create(['name' => 'metadata_5_59_1', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache'], 'withArray' => 'fast']);
    }

    /**
     * Gets the public 'cache.navigation' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_NavigationService()
    {
        return $this->services['cache.navigation'] = \CRM_Utils_Cache::create(['name' => 'navigation', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache'], 'withArray' => 'fast']);
    }

    /**
     * Gets the public 'cache.prevNextCache' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_PrevNextCacheService()
    {
        return $this->services['cache.prevNextCache'] = \CRM_Utils_Cache::create(['name' => 'CiviCRM Search PrevNextCache', 'type' => [0 => 'SqlGroup']]);
    }

    /**
     * Gets the public 'cache.session' shared service.
     *
     * @return \CRM_Utils_Cache_Interface
     */
    protected function getCache_SessionService()
    {
        return $this->services['cache.session'] = \CRM_Utils_Cache::create(['name' => 'CiviCRM Session', 'type' => [0 => '*memory*', 1 => 'SqlGroup', 2 => 'ArrayCache']]);
    }

    /**
     * Gets the public 'cache_config' shared service.
     *
     * @return \ArrayObject
     */
    protected function getCacheConfigService()
    {
        return $this->services['cache_config'] = ($this->privates['civi_container_factory'] ?? ($this->privates['civi_container_factory'] = new \Civi\Core\Container()))->createCacheConfig();
    }

    /**
     * Gets the public 'civi.activity.triggers' shared service.
     *
     * @return \Civi\Core\SqlTrigger\TimestampTriggers
     */
    protected function getCivi_Activity_TriggersService()
    {
        return $this->services['civi.activity.triggers'] = new \Civi\Core\SqlTrigger\TimestampTriggers('civicrm_activity', 'Activity');
    }

    /**
     * Gets the public 'civi.api4.activitySchema' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\ActivitySchemaMapSubscriber
     */
    protected function getCivi_Api4_ActivitySchemaService()
    {
        return $this->services['civi.api4.activitySchema'] = new \Civi\Api4\Event\Subscriber\ActivitySchemaMapSubscriber();
    }

    /**
     * Gets the public 'civi.api4.contactSchema' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\ContactSchemaMapSubscriber
     */
    protected function getCivi_Api4_ContactSchemaService()
    {
        return $this->services['civi.api4.contactSchema'] = new \Civi\Api4\Event\Subscriber\ContactSchemaMapSubscriber();
    }

    /**
     * Gets the public 'civi.api4.isCurrent' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\IsCurrentSubscriber
     */
    protected function getCivi_Api4_IsCurrentService()
    {
        return $this->services['civi.api4.isCurrent'] = new \Civi\Api4\Event\Subscriber\IsCurrentSubscriber();
    }

    /**
     * Gets the public 'civi.api4.messagetemplateSchema' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\MessageTemplateSchemaMapSubscriber
     */
    protected function getCivi_Api4_MessagetemplateSchemaService()
    {
        return $this->services['civi.api4.messagetemplateSchema'] = new \Civi\Api4\Event\Subscriber\MessageTemplateSchemaMapSubscriber();
    }

    /**
     * Gets the public 'civi.api4.permissionCheck' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\PermissionCheckSubscriber
     */
    protected function getCivi_Api4_PermissionCheckService()
    {
        return $this->services['civi.api4.permissionCheck'] = new \Civi\Api4\Event\Subscriber\PermissionCheckSubscriber();
    }

    /**
     * Gets the public 'civi.api4.searchKit' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\SearchKitSubscriber
     */
    protected function getCivi_Api4_SearchKitService()
    {
        return $this->services['civi.api4.searchKit'] = new \Civi\Api4\Event\Subscriber\SearchKitSubscriber();
    }

    /**
     * Gets the public 'civi.api4.validateFields' shared service.
     *
     * @return \Civi\Api4\Event\Subscriber\ValidateFieldsSubscriber
     */
    protected function getCivi_Api4_ValidateFieldsService()
    {
        return $this->services['civi.api4.validateFields'] = new \Civi\Api4\Event\Subscriber\ValidateFieldsSubscriber();
    }

    /**
     * Gets the public 'civi.case.staticTriggers' shared service.
     *
     * @return \Civi\Core\SqlTrigger\StaticTriggers
     */
    protected function getCivi_Case_StaticTriggersService()
    {
        return $this->services['civi.case.staticTriggers'] = new \Civi\Core\SqlTrigger\StaticTriggers([0 => ['upgrade_check' => ['table' => 'civicrm_case', 'column' => 'modified_date'], 'table' => 'civicrm_case_activity', 'when' => 'AFTER', 'event' => [0 => 'INSERT'], 'sql' => 'UPDATE civicrm_case SET modified_date = CURRENT_TIMESTAMP WHERE id = NEW.case_id;'], 1 => ['upgrade_check' => ['table' => 'civicrm_case', 'column' => 'modified_date'], 'table' => 'civicrm_activity', 'when' => 'BEFORE', 'event' => [0 => 'UPDATE', 1 => 'DELETE'], 'sql' => 'UPDATE civicrm_case SET modified_date = CURRENT_TIMESTAMP WHERE id IN (SELECT ca.case_id FROM civicrm_case_activity ca WHERE ca.activity_id = OLD.id);']]);
    }

    /**
     * Gets the public 'civi.case.triggers' shared service.
     *
     * @return \Civi\Core\SqlTrigger\TimestampTriggers
     */
    protected function getCivi_Case_TriggersService()
    {
        return $this->services['civi.case.triggers'] = new \Civi\Core\SqlTrigger\TimestampTriggers('civicrm_case', 'Case');
    }

    /**
     * Gets the public 'civi.pipe' service.
     *
     * @return \Civi\Pipe\PipeSession
     */
    protected function getCivi_PipeService()
    {
        return new \Civi\Pipe\PipeSession();
    }

    /**
     * Gets the public 'civi_api_kernel' shared service.
     *
     * @return \Civi\API\Kernel
     */
    protected function getCiviApiKernelService()
    {
        $this->services['civi_api_kernel'] = $instance = ($this->privates['civi_container_factory'] ?? ($this->privates['civi_container_factory'] = new \Civi\Core\Container()))->createApiKernel(($this->services['dispatcher'] ?? $this->getDispatcherService()), ($this->services['magic_function_provider'] ?? ($this->services['magic_function_provider'] = new \Civi\API\Provider\MagicFunctionProvider())));

        $instance->registerApiProvider(($this->services['action_object_provider'] ?? ($this->services['action_object_provider'] = new \Civi\Api4\Provider\ActionObjectProvider())));
        $instance->registerApiProvider(($this->services['civi_flexmailer_api_overrides'] ?? $this->getCiviFlexmailerApiOverridesService()));

        return $instance;
    }

    /**
     * Gets the public 'civi_flexmailer_abdicator' shared service.
     *
     * @return \Civi\FlexMailer\Listener\Abdicator
     */
    protected function getCiviFlexmailerAbdicatorService()
    {
        return $this->services['civi_flexmailer_abdicator'] = new \Civi\FlexMailer\Listener\Abdicator();
    }

    /**
     * Gets the public 'civi_flexmailer_api_overrides' shared service.
     *
     * @return \Civi\API\Provider\ProviderInterface
     */
    protected function getCiviFlexmailerApiOverridesService()
    {
        return $this->services['civi_flexmailer_api_overrides'] = \Civi\FlexMailer\Services::createApiOverrides();
    }

    /**
     * Gets the public 'civi_flexmailer_attachments' shared service.
     *
     * @return \Civi\FlexMailer\Listener\Attachments
     */
    protected function getCiviFlexmailerAttachmentsService()
    {
        return $this->services['civi_flexmailer_attachments'] = new \Civi\FlexMailer\Listener\Attachments();
    }

    /**
     * Gets the public 'civi_flexmailer_basic_headers' shared service.
     *
     * @return \Civi\FlexMailer\Listener\BasicHeaders
     */
    protected function getCiviFlexmailerBasicHeadersService()
    {
        return $this->services['civi_flexmailer_basic_headers'] = new \Civi\FlexMailer\Listener\BasicHeaders();
    }

    /**
     * Gets the public 'civi_flexmailer_bounce_tracker' shared service.
     *
     * @return \Civi\FlexMailer\Listener\BounceTracker
     */
    protected function getCiviFlexmailerBounceTrackerService()
    {
        return $this->services['civi_flexmailer_bounce_tracker'] = new \Civi\FlexMailer\Listener\BounceTracker();
    }

    /**
     * Gets the public 'civi_flexmailer_default_batcher' shared service.
     *
     * @return \Civi\FlexMailer\Listener\DefaultBatcher
     */
    protected function getCiviFlexmailerDefaultBatcherService()
    {
        return $this->services['civi_flexmailer_default_batcher'] = new \Civi\FlexMailer\Listener\DefaultBatcher();
    }

    /**
     * Gets the public 'civi_flexmailer_default_composer' shared service.
     *
     * @return \Civi\FlexMailer\Listener\DefaultComposer
     */
    protected function getCiviFlexmailerDefaultComposerService()
    {
        return $this->services['civi_flexmailer_default_composer'] = new \Civi\FlexMailer\Listener\DefaultComposer();
    }

    /**
     * Gets the public 'civi_flexmailer_default_sender' shared service.
     *
     * @return \Civi\FlexMailer\Listener\DefaultSender
     */
    protected function getCiviFlexmailerDefaultSenderService()
    {
        return $this->services['civi_flexmailer_default_sender'] = new \Civi\FlexMailer\Listener\DefaultSender();
    }

    /**
     * Gets the public 'civi_flexmailer_hooks' shared service.
     *
     * @return \Civi\FlexMailer\Listener\HookAdapter
     */
    protected function getCiviFlexmailerHooksService()
    {
        return $this->services['civi_flexmailer_hooks'] = new \Civi\FlexMailer\Listener\HookAdapter();
    }

    /**
     * Gets the public 'civi_flexmailer_html_click_tracker' shared service.
     *
     * @return \Civi\FlexMailer\ClickTracker\HtmlClickTracker
     */
    protected function getCiviFlexmailerHtmlClickTrackerService()
    {
        return $this->services['civi_flexmailer_html_click_tracker'] = new \Civi\FlexMailer\ClickTracker\HtmlClickTracker();
    }

    /**
     * Gets the public 'civi_flexmailer_open_tracker' shared service.
     *
     * @return \Civi\FlexMailer\Listener\OpenTracker
     */
    protected function getCiviFlexmailerOpenTrackerService()
    {
        return $this->services['civi_flexmailer_open_tracker'] = new \Civi\FlexMailer\Listener\OpenTracker();
    }

    /**
     * Gets the public 'civi_flexmailer_required_fields' shared service.
     *
     * @return \Civi\FlexMailer\Listener\RequiredFields
     */
    protected function getCiviFlexmailerRequiredFieldsService()
    {
        return $this->services['civi_flexmailer_required_fields'] = new \Civi\FlexMailer\Listener\RequiredFields([0 => 'subject', 1 => 'name', 2 => 'from_name', 3 => 'from_email', 4 => '(body_html|body_text)']);
    }

    /**
     * Gets the public 'civi_flexmailer_required_tokens' shared service.
     *
     * @return \Civi\FlexMailer\Listener\RequiredTokens
     */
    protected function getCiviFlexmailerRequiredTokensService()
    {
        return $this->services['civi_flexmailer_required_tokens'] = new \Civi\FlexMailer\Listener\RequiredTokens([0 => 'traditional'], ['domain.address' => 'Domain address - displays your organization\'s postal address.', 'action.optOutUrl or action.unsubscribeUrl' => ['action.optOut' => '\'Opt out via email\' - displays an email address for recipients to opt out of receiving emails from your organization.', 'action.optOutUrl' => '\'Opt out via web page\' - creates a link for recipients to click if they want to opt out of receiving emails from your organization. Alternatively, you can include the \'Opt out via email\' token.', 'action.unsubscribe' => '\'Unsubscribe via email\' - displays an email address for recipients to unsubscribe from the specific mailing list used to send this message.', 'action.unsubscribeUrl' => '\'Unsubscribe via web page\' - creates a link for recipients to unsubscribe from the specific mailing list used to send this message. Alternatively, you can include the \'Unsubscribe via email\' token or one of the Opt-out tokens.']]);
    }

    /**
     * Gets the public 'civi_flexmailer_test_prefix' shared service.
     *
     * @return \Civi\FlexMailer\Listener\TestPrefix
     */
    protected function getCiviFlexmailerTestPrefixService()
    {
        return $this->services['civi_flexmailer_test_prefix'] = new \Civi\FlexMailer\Listener\TestPrefix();
    }

    /**
     * Gets the public 'civi_flexmailer_text_click_tracker' shared service.
     *
     * @return \Civi\FlexMailer\ClickTracker\TextClickTracker
     */
    protected function getCiviFlexmailerTextClickTrackerService()
    {
        return $this->services['civi_flexmailer_text_click_tracker'] = new \Civi\FlexMailer\ClickTracker\TextClickTracker();
    }

    /**
     * Gets the public 'civi_flexmailer_to_header' shared service.
     *
     * @return \Civi\FlexMailer\Listener\ToHeader
     */
    protected function getCiviFlexmailerToHeaderService()
    {
        return $this->services['civi_flexmailer_to_header'] = new \Civi\FlexMailer\Listener\ToHeader();
    }

    /**
     * Gets the public 'civi_token_compat' shared service.
     *
     * @return \Civi\Token\TokenCompatSubscriber
     */
    protected function getCiviTokenCompatService()
    {
        return $this->services['civi_token_compat'] = new \Civi\Token\TokenCompatSubscriber();
    }

    /**
     * Gets the public 'civi_token_impliedcontext' shared service.
     *
     * @return \Civi\Token\ImpliedContextSubscriber
     */
    protected function getCiviTokenImpliedcontextService()
    {
        return $this->services['civi_token_impliedcontext'] = new \Civi\Token\ImpliedContextSubscriber();
    }

    /**
     * Gets the public 'crm_activity_tokens' shared service.
     *
     * @return \CRM_Activity_Tokens
     */
    protected function getCrmActivityTokensService()
    {
        return $this->services['crm_activity_tokens'] = new \CRM_Activity_Tokens();
    }

    /**
     * Gets the public 'crm_case_tokens' shared service.
     *
     * @return \CRM_Case_Tokens
     */
    protected function getCrmCaseTokensService()
    {
        return $this->services['crm_case_tokens'] = new \CRM_Case_Tokens();
    }

    /**
     * Gets the public 'crm_contact_tokens' shared service.
     *
     * @return \CRM_Contact_Tokens
     */
    protected function getCrmContactTokensService()
    {
        return $this->services['crm_contact_tokens'] = new \CRM_Contact_Tokens();
    }

    /**
     * Gets the public 'crm_contribute_tokens' shared service.
     *
     * @return \CRM_Contribute_Tokens
     */
    protected function getCrmContributeTokensService()
    {
        return $this->services['crm_contribute_tokens'] = new \CRM_Contribute_Tokens();
    }

    /**
     * Gets the public 'crm_contribution_recur_tokens' shared service.
     *
     * @return \CRM_Contribute_RecurTokens
     */
    protected function getCrmContributionRecurTokensService()
    {
        return $this->services['crm_contribution_recur_tokens'] = new \CRM_Contribute_RecurTokens();
    }

    /**
     * Gets the public 'crm_domain_tokens' shared service.
     *
     * @return \CRM_Core_DomainTokens
     */
    protected function getCrmDomainTokensService()
    {
        return $this->services['crm_domain_tokens'] = new \CRM_Core_DomainTokens();
    }

    /**
     * Gets the public 'crm_event_tokens' shared service.
     *
     * @return \CRM_Event_Tokens
     */
    protected function getCrmEventTokensService()
    {
        return $this->services['crm_event_tokens'] = new \CRM_Event_Tokens();
    }

    /**
     * Gets the public 'crm_group_tokens' shared service.
     *
     * @return \CRM_Core_GroupTokens
     */
    protected function getCrmGroupTokensService()
    {
        return $this->services['crm_group_tokens'] = new \CRM_Core_GroupTokens();
    }

    /**
     * Gets the public 'crm_mailing_action_tokens' shared service.
     *
     * @return \CRM_Mailing_ActionTokens
     */
    protected function getCrmMailingActionTokensService()
    {
        return $this->services['crm_mailing_action_tokens'] = new \CRM_Mailing_ActionTokens();
    }

    /**
     * Gets the public 'crm_mailing_tokens' shared service.
     *
     * @return \CRM_Mailing_Tokens
     */
    protected function getCrmMailingTokensService()
    {
        return $this->services['crm_mailing_tokens'] = new \CRM_Mailing_Tokens();
    }

    /**
     * Gets the public 'crm_member_tokens' shared service.
     *
     * @return \CRM_Member_Tokens
     */
    protected function getCrmMemberTokensService()
    {
        return $this->services['crm_member_tokens'] = new \CRM_Member_Tokens();
    }

    /**
     * Gets the public 'crm_participant_tokens' shared service.
     *
     * @return \CRM_Event_ParticipantTokens
     */
    protected function getCrmParticipantTokensService()
    {
        return $this->services['crm_participant_tokens'] = new \CRM_Event_ParticipantTokens();
    }

    /**
     * Gets the public 'crm_token_tidy' shared service.
     *
     * @return \Civi\Token\TidySubscriber
     */
    protected function getCrmTokenTidyService()
    {
        return $this->services['crm_token_tidy'] = new \Civi\Token\TidySubscriber();
    }

    /**
     * Gets the public 'crypto.jwt' shared service.
     *
     * @return \Civi\Crypto\CryptoJwt
     */
    protected function getCrypto_JwtService()
    {
        return $this->services['crypto.jwt'] = new \Civi\Crypto\CryptoJwt();
    }

    /**
     * Gets the public 'crypto.registry' shared service.
     *
     * @return \Civi\Crypto\CryptoRegistry
     */
    protected function getCrypto_RegistryService()
    {
        return $this->services['crypto.registry'] = \Civi\Crypto\CryptoRegistry::createDefaultRegistry();
    }

    /**
     * Gets the public 'crypto.token' shared service.
     *
     * @return \Civi\Crypto\CryptoToken
     */
    protected function getCrypto_TokenService()
    {
        return $this->services['crypto.token'] = new \Civi\Crypto\CryptoToken();
    }

    /**
     * Gets the public 'cxn_reg_client' shared service.
     *
     * @return \Civi\Cxn\Rpc\RegistrationClient
     */
    protected function getCxnRegClientService()
    {
        return $this->services['cxn_reg_client'] = \CRM_Cxn_BAO_Cxn::createRegistrationClient();
    }

    /**
     * Gets the public 'dispatcher' shared service.
     *
     * @return \Civi\Core\CiviEventDispatcher
     */
    protected function getDispatcherService()
    {
        $this->services['dispatcher'] = $instance = ($this->privates['civi_container_factory'] ?? ($this->privates['civi_container_factory'] = new \Civi\Core\Container()))->createEventDispatcher();

        $instance->addListenerMap('CRM_Core_BAO_LocationType', ['hook_civicrm_pre::LocationType' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_Managed', ['hook_civicrm_post' => [0 => [0 => 'on_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_Mapping', ['hook_civicrm_pre' => [0 => [0 => 'on_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_MessageTemplate', ['hook_civicrm_pre::MessageTemplate' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]], '&hook_civicrm_translateFields' => [0 => [0 => 'hook_civicrm_translateFields', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_OptionGroup', ['hook_civicrm_pre::OptionGroup' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_Translation', ['civi.api4.validate::Translation' => [0 => [0 => 'self_civi_api4_validate', 1 => 0]], 'hook_civicrm_post::Translation' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]], '&hook_civicrm_apiWrappers' => [0 => [0 => 'hook_civicrm_apiWrappers', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_RecurringEntity', ['civi.dao.postInsert' => [0 => [0 => 'triggerInsert']], 'civi.dao.postUpdate' => [0 => [0 => 'triggerUpdate']], 'civi.dao.postDelete' => [0 => [0 => 'triggerDelete']]]);
        $instance->addListenerMap('CRM_ACL_BAO_ACL', ['hook_civicrm_pre::ACL' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contact_BAO_Contact', ['hook_civicrm_post' => [0 => [0 => 'on_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contact_BAO_RelationshipType', ['hook_civicrm_pre::RelationshipType' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contact_BAO_ContactType', ['hook_civicrm_pre::ContactType' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]], 'hook_civicrm_post::ContactType' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Mailing_BAO_MailingAB', ['hook_civicrm_post::MailingAB' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Financial_BAO_FinancialAccount', ['hook_civicrm_pre::FinancialAccount' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]], 'hook_civicrm_post::FinancialAccount' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Financial_BAO_PaymentProcessorType', ['hook_civicrm_pre::PaymentProcessorType' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Financial_BAO_FinancialType', ['hook_civicrm_pre::FinancialType' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]], 'hook_civicrm_post::FinancialType' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Member_BAO_MembershipStatus', ['hook_civicrm_pre::MembershipStatus' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Campaign_BAO_Survey', ['hook_civicrm_pre::Survey' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Case_BAO_CaseType', ['hook_civicrm_pre::CaseType' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]], 'hook_civicrm_post::CaseType' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Queue_BAO_Queue', ['&hook_civicrm_queueRun_task' => [0 => [0 => 'hook_civicrm_queueRun_task', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_CustomGroup', ['hook_civicrm_post::CustomGroup' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_Email', ['hook_civicrm_post::Email' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_Note', ['hook_civicrm_pre::Note' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_OptionValue', ['hook_civicrm_pre::OptionValue' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_UserJob', ['civi.queue.check' => [0 => [0 => 'on_civi_queue_check', 1 => 0]], '&hook_civicrm_queueStatus' => [0 => [0 => 'hook_civicrm_queueStatus', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_WordReplacement', ['hook_civicrm_post::WordReplacement' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Financial_BAO_PaymentProcessor', ['hook_civicrm_post::PaymentProcessor' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Member_BAO_MembershipType', ['hook_civicrm_pre' => [0 => [0 => 'on_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Case_BAO_Case', ['hook_civicrm_post' => [0 => [0 => 'on_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Report_BAO_ReportInstance', ['hook_civicrm_pre::ReportInstance' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_County', ['hook_civicrm_post::County' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Core_BAO_UFGroup', ['hook_civicrm_pre::UFGroup' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contact_BAO_Relationship', ['hook_civicrm_pre::Relationship' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]], 'hook_civicrm_post::Relationship' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contact_BAO_RelationshipCache', ['hook_civicrm_triggerInfo' => [0 => [0 => 'on_hook_civicrm_triggerInfo', 1 => 0]]]);
        $instance->addListenerMap('CRM_Mailing_BAO_Mailing', ['hook_civicrm_pre::Mailing' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contribute_BAO_ContributionRecur', ['hook_civicrm_post::ContributionRecur' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contact_BAO_GroupContact', ['hook_civicrm_post::GroupContact' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Contribute_BAO_Contribution', ['hook_civicrm_post::Contribution' => [0 => [0 => 'self_hook_civicrm_post', 1 => 0]]]);
        $instance->addListenerMap('CRM_Event_BAO_Event', ['hook_civicrm_pre::Event' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Event_BAO_Participant', ['hook_civicrm_pre::Participant' => [0 => [0 => 'self_hook_civicrm_pre', 1 => 0]]]);
        $instance->addListenerMap('CRM_Pledge_BAO_PledgePayment', ['hook_civicrm_post' => [0 => [0 => 'on_hook_civicrm_post', 1 => 0]]]);
        $instance->addListener('civi.api4.authorizeRecord::Contribution', '_financialacls_civi_api4_authorizeContribution');
        $instance->addListenerService('civi.flexmailer.checkSendable', [0 => 'civi_flexmailer_abdicator', 1 => 'onCheckSendable'], 2000);
        $instance->addListenerService('civi.flexmailer.checkSendable', [0 => 'civi_flexmailer_required_fields', 1 => 'onCheckSendable'], 0);
        $instance->addListenerService('civi.flexmailer.checkSendable', [0 => 'civi_flexmailer_required_tokens', 1 => 'onCheckSendable'], 0);
        $instance->addListenerService('civi.flexmailer.run', [0 => 'civi_flexmailer_default_composer', 1 => 'onRun'], 0);
        $instance->addListenerService('civi.flexmailer.run', [0 => 'civi_flexmailer_abdicator', 1 => 'onRun'], -2000);
        $instance->addListenerService('civi.flexmailer.walk', [0 => 'civi_flexmailer_default_batcher', 1 => 'onWalk'], -2000);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_basic_headers', 1 => 'onCompose'], 1000);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_to_header', 1 => 'onCompose'], 1000);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_bounce_tracker', 1 => 'onCompose'], 1000);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_default_composer', 1 => 'onCompose'], -100);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_attachments', 1 => 'onCompose'], -1000);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_open_tracker', 1 => 'onCompose'], -1000);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_test_prefix', 1 => 'onCompose'], -1000);
        $instance->addListenerService('civi.flexmailer.compose', [0 => 'civi_flexmailer_hooks', 1 => 'onCompose'], -1100);
        $instance->addListenerService('civi.flexmailer.send', [0 => 'civi_flexmailer_default_sender', 1 => 'onSend'], -2000);
        $instance->addListener('civi.api4.authorizeRecord::SavedSearch', [0 => 'CRM_Search_BAO_SearchDisplay', 1 => 'savedSearchCheckAccessByDisplay']);
        $instance->addSubscriberServiceMap('action_object_provider', ['civi.api.resolve' => [0 => [0 => 'onApiResolve', 1 => 100]]]);
        $instance->addSubscriberServiceMap('civi.api4.activitySchema', ['api.schema_map.build' => [0 => [0 => 'onSchemaBuild']]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Event\\Subscriber\\AutocompleteFieldSubscriber', ['civi.api.prepare' => [0 => [0 => 'onApiPrepare', 1 => -50]]]);
        $instance->addSubscriberServiceMap('civi.api4.contactSchema', ['api.schema_map.build' => [0 => [0 => 'onSchemaBuild']]]);
        $instance->addSubscriberServiceMap('civi.api4.isCurrent', ['civi.api.prepare' => [0 => [0 => 'onApiPrepare']]]);
        $instance->addSubscriberServiceMap('civi.api4.messagetemplateSchema', ['api.schema_map.build' => [0 => [0 => 'onSchemaBuild']]]);
        $instance->addSubscriberServiceMap('civi.api4.permissionCheck', ['civi.api.authorize' => [0 => [0 => 'onApiAuthorize', 1 => -100]]]);
        $instance->addSubscriberServiceMap('civi.api4.validateFields', ['civi.api.prepare' => [0 => [0 => 'onApiPrepare', 1 => 50]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\ActivityAutocompleteProvider', ['civi.search.autocompleteDefault' => [0 => [0 => 'on_civi_search_autocompleteDefault', 1 => 0]], 'civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\AddressAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\CaseAutocompleteProvider', ['civi.search.autocompleteDefault' => [0 => [0 => 'on_civi_search_autocompleteDefault', 1 => 0]], 'civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\ContactAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\ContactTypeAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\ContributionAutocompleteProvider', ['civi.search.autocompleteDefault' => [0 => [0 => 'on_civi_search_autocompleteDefault', 1 => 0]], 'civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\CountryAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\EntityAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\ParticipantAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\PledgeAutocompleteProvider', ['civi.search.autocompleteDefault' => [0 => [0 => 'on_civi_search_autocompleteDefault', 1 => 0]], 'civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\RelationshipAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Service\\Autocomplete\\StateProvinceAutocompleteProvider', ['civi.search.defaultDisplay' => [0 => [0 => 'on_civi_search_defaultDisplay', 1 => 0]]]);
        $instance->addSubscriberServiceMap('authx.authenticator', ['civi.invoke.auth' => [0 => [0 => 'on_civi_invoke_auth', 1 => 0]]]);
        $instance->addSubscriberServiceMap('authx.legacy_authenticator', ['civi.invoke.auth' => [0 => [0 => 'on_civi_invoke_auth', 1 => 0]]]);
        $instance->addSubscriberServiceMap('Civi\\Afform\\Behavior\\ContactAutofill', ['civi.afform.sort.prefill' => [0 => [0 => 'onAfformSortPrefill']], 'civi.afform.prefill' => [0 => [0 => 'onAfformPrefill', 1 => 99]]]);
        $instance->addSubscriberServiceMap('Civi\\Afform\\Behavior\\ContactDedupe', ['civi.afform.submit' => [0 => [0 => 'onAfformSubmit', 1 => 101]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Subscriber\\AfformAutocompleteSubscriber', ['civi.api.prepare' => [0 => [0 => 'onApiPrepare', 1 => -20]]]);
        $instance->addSubscriberServiceMap('Civi\\Api4\\Event\\Subscriber\\DefaultDisplaySubscriber', ['civi.search.defaultDisplay' => [0 => [0 => 'autocompleteDefault', 1 => -10], 1 => [0 => 'fallbackDefault', 1 => -20]]]);
        $instance->addSubscriberServiceMap('civi.api4.searchKit', ['civi.api.authorize' => [0 => [0 => 'onApiAuthorize', 1 => -200]]]);
        $instance->addSubscriberServiceMap('Civi\\AfformReCaptcha2', ['civi.afform_admin.metadata' => [0 => [0 => 'onAfformGetMetadata']], 'hook_civicrm_alterAngular' => [0 => [0 => 'alterAngular']], 'civi.afform.validate' => [0 => [0 => 'onAfformValidate']]]);
        $instance->addListener('hook_civicrm_triggerInfo', [0 => function () {
            return ($this->services['civi.activity.triggers'] ?? ($this->services['civi.activity.triggers'] = new \Civi\Core\SqlTrigger\TimestampTriggers('civicrm_activity', 'Activity')));
        }, 1 => 'onTriggerInfo'], 0);
        $instance->addListener('hook_civicrm_triggerInfo', [0 => function () {
            return ($this->services['civi.case.triggers'] ?? ($this->services['civi.case.triggers'] = new \Civi\Core\SqlTrigger\TimestampTriggers('civicrm_case', 'Case')));
        }, 1 => 'onTriggerInfo'], 0);
        $instance->addListener('hook_civicrm_triggerInfo', [0 => function () {
            return ($this->services['civi.case.staticTriggers'] ?? $this->getCivi_Case_StaticTriggersService());
        }, 1 => 'onTriggerInfo'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['civi_token_compat'] ?? ($this->services['civi_token_compat'] = new \Civi\Token\TokenCompatSubscriber()));
        }, 1 => 'setupSmartyAliases'], 1000);
        $instance->addListener('civi.token.render', [0 => function () {
            return ($this->services['civi_token_compat'] ?? ($this->services['civi_token_compat'] = new \Civi\Token\TokenCompatSubscriber()));
        }, 1 => 'onRender'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_mailing_action_tokens'] ?? ($this->services['crm_mailing_action_tokens'] = new \CRM_Mailing_ActionTokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_mailing_action_tokens'] ?? ($this->services['crm_mailing_action_tokens'] = new \CRM_Mailing_ActionTokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_mailing_action_tokens'] ?? ($this->services['crm_mailing_action_tokens'] = new \CRM_Mailing_ActionTokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_activity_tokens'] ?? ($this->services['crm_activity_tokens'] = new \CRM_Activity_Tokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_activity_tokens'] ?? ($this->services['crm_activity_tokens'] = new \CRM_Activity_Tokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_activity_tokens'] ?? ($this->services['crm_activity_tokens'] = new \CRM_Activity_Tokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_contact_tokens'] ?? ($this->services['crm_contact_tokens'] = new \CRM_Contact_Tokens()));
        }, 1 => 'evaluateLegacyHookTokens'], 500);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_contact_tokens'] ?? ($this->services['crm_contact_tokens'] = new \CRM_Contact_Tokens()));
        }, 1 => 'onEvaluate'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_contact_tokens'] ?? ($this->services['crm_contact_tokens'] = new \CRM_Contact_Tokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_contribute_tokens'] ?? ($this->services['crm_contribute_tokens'] = new \CRM_Contribute_Tokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_contribute_tokens'] ?? ($this->services['crm_contribute_tokens'] = new \CRM_Contribute_Tokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_contribute_tokens'] ?? ($this->services['crm_contribute_tokens'] = new \CRM_Contribute_Tokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_event_tokens'] ?? ($this->services['crm_event_tokens'] = new \CRM_Event_Tokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_event_tokens'] ?? ($this->services['crm_event_tokens'] = new \CRM_Event_Tokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_event_tokens'] ?? ($this->services['crm_event_tokens'] = new \CRM_Event_Tokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_mailing_tokens'] ?? ($this->services['crm_mailing_tokens'] = new \CRM_Mailing_Tokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_mailing_tokens'] ?? ($this->services['crm_mailing_tokens'] = new \CRM_Mailing_Tokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_mailing_tokens'] ?? ($this->services['crm_mailing_tokens'] = new \CRM_Mailing_Tokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_member_tokens'] ?? ($this->services['crm_member_tokens'] = new \CRM_Member_Tokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_member_tokens'] ?? ($this->services['crm_member_tokens'] = new \CRM_Member_Tokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_member_tokens'] ?? ($this->services['crm_member_tokens'] = new \CRM_Member_Tokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_case_tokens'] ?? ($this->services['crm_case_tokens'] = new \CRM_Case_Tokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_case_tokens'] ?? ($this->services['crm_case_tokens'] = new \CRM_Case_Tokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_case_tokens'] ?? ($this->services['crm_case_tokens'] = new \CRM_Case_Tokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['civi_token_impliedcontext'] ?? ($this->services['civi_token_impliedcontext'] = new \Civi\Token\ImpliedContextSubscriber()));
        }, 1 => 'onRegisterTokens'], 1000);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['civi_token_impliedcontext'] ?? ($this->services['civi_token_impliedcontext'] = new \Civi\Token\ImpliedContextSubscriber()));
        }, 1 => 'onEvaluateTokens'], 1000);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_participant_tokens'] ?? ($this->services['crm_participant_tokens'] = new \CRM_Event_ParticipantTokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_participant_tokens'] ?? ($this->services['crm_participant_tokens'] = new \CRM_Event_ParticipantTokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_participant_tokens'] ?? ($this->services['crm_participant_tokens'] = new \CRM_Event_ParticipantTokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_contribution_recur_tokens'] ?? ($this->services['crm_contribution_recur_tokens'] = new \CRM_Contribute_RecurTokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_contribution_recur_tokens'] ?? ($this->services['crm_contribution_recur_tokens'] = new \CRM_Contribute_RecurTokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_contribution_recur_tokens'] ?? ($this->services['crm_contribution_recur_tokens'] = new \CRM_Contribute_RecurTokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_group_tokens'] ?? ($this->services['crm_group_tokens'] = new \CRM_Core_GroupTokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_group_tokens'] ?? ($this->services['crm_group_tokens'] = new \CRM_Core_GroupTokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_group_tokens'] ?? ($this->services['crm_group_tokens'] = new \CRM_Core_GroupTokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.list', [0 => function () {
            return ($this->services['crm_domain_tokens'] ?? ($this->services['crm_domain_tokens'] = new \CRM_Core_DomainTokens()));
        }, 1 => 'registerTokens'], 0);
        $instance->addListener('civi.token.eval', [0 => function () {
            return ($this->services['crm_domain_tokens'] ?? ($this->services['crm_domain_tokens'] = new \CRM_Core_DomainTokens()));
        }, 1 => 'evaluateTokens'], 0);
        $instance->addListener('civi.actionSchedule.prepareMailingQuery', [0 => function () {
            return ($this->services['crm_domain_tokens'] ?? ($this->services['crm_domain_tokens'] = new \CRM_Core_DomainTokens()));
        }, 1 => 'alterActionScheduleQuery'], 0);
        $instance->addListener('civi.token.render', [0 => function () {
            return ($this->services['crm_token_tidy'] ?? ($this->services['crm_token_tidy'] = new \Civi\Token\TidySubscriber()));
        }, 1 => 'tidyHtml'], 1000);

        return $instance;
    }

    /**
     * Gets the public 'format' shared service.
     *
     * @return \Civi\Core\Format
     */
    protected function getFormatService()
    {
        return $this->services['format'] = new \Civi\Core\Format();
    }

    /**
     * Gets the public 'httpClient' shared service.
     *
     * @return \CRM_Utils_HttpClient
     */
    protected function getHttpClientService()
    {
        return $this->services['httpClient'] = \CRM_Utils_HttpClient::singleton();
    }

    /**
     * Gets the public 'i18n' shared service.
     *
     * @return \CRM_Core_I18n
     */
    protected function getI18nService()
    {
        return $this->services['i18n'] = \CRM_Core_I18n::singleton();
    }

    /**
     * Gets the public 'magic_function_provider' shared service.
     *
     * @return \Civi\API\Provider\MagicFunctionProvider
     */
    protected function getMagicFunctionProviderService()
    {
        return $this->services['magic_function_provider'] = new \Civi\API\Provider\MagicFunctionProvider();
    }

    /**
     * Gets the public 'pear_mail' shared service.
     *
     * @return \Mail
     */
    protected function getPearMailService()
    {
        return $this->services['pear_mail'] = \CRM_Utils_Mail::createMailer();
    }

    /**
     * Gets the public 'prevnext' shared service.
     *
     * @return \CRM_Core_PrevNextCache_Interface
     */
    protected function getPrevnextService()
    {
        return $this->services['prevnext'] = ($this->privates['civi_container_factory'] ?? ($this->privates['civi_container_factory'] = new \Civi\Core\Container()))->createPrevNextCache($this);
    }

    /**
     * Gets the public 'prevnext.driver.redis' shared service.
     *
     * @return \CRM_Core_PrevNextCache_Redis
     */
    protected function getPrevnext_Driver_RedisService()
    {
        return $this->services['prevnext.driver.redis'] = new \CRM_Core_PrevNextCache_Redis(($this->services['cache_config'] ?? $this->getCacheConfigService()));
    }

    /**
     * Gets the public 'prevnext.driver.sql' shared service.
     *
     * @return \CRM_Core_PrevNextCache_Sql
     */
    protected function getPrevnext_Driver_SqlService()
    {
        return $this->services['prevnext.driver.sql'] = new \CRM_Core_PrevNextCache_Sql();
    }

    /**
     * Gets the public 'psr_log' shared service.
     *
     * @return \CRM_Core_Error_Log
     */
    protected function getPsrLogService()
    {
        return $this->services['psr_log'] = new \CRM_Core_Error_Log();
    }

    /**
     * Gets the public 'psr_log_manager' shared service.
     *
     * @return \Civi\Core\LogManager
     */
    protected function getPsrLogManagerService()
    {
        return $this->services['psr_log_manager'] = new \Civi\Core\LogManager();
    }

    /**
     * Gets the public 'resources' shared service.
     *
     * @return \CRM_Core_Resources
     */
    protected function getResourcesService()
    {
        return $this->services['resources'] = ($this->privates['civi_container_factory'] ?? ($this->privates['civi_container_factory'] = new \Civi\Core\Container()))->createResources($this);
    }

    /**
     * Gets the public 'resources.js_strings' shared service.
     *
     * @return \CRM_Core_Resources_Strings
     */
    protected function getResources_JsStringsService()
    {
        return $this->services['resources.js_strings'] = new \CRM_Core_Resources_Strings(($this->services['cache.js_strings'] ?? $this->getCache_JsStringsService()));
    }

    /**
     * Gets the public 'schema_map_builder' shared service.
     *
     * @return \Civi\Api4\Service\Schema\SchemaMapBuilder
     */
    protected function getSchemaMapBuilderService()
    {
        $a = ($this->services['dispatcher'] ?? $this->getDispatcherService());

        $this->services['schema_map_builder'] = $instance = new \Civi\Api4\Service\Schema\SchemaMapBuilder($a);

        $instance->__construct($a);

        return $instance;
    }

    /**
     * Gets the public 'spec_gatherer' shared service.
     *
     * @return \Civi\Api4\Service\Spec\SpecGatherer
     */
    protected function getSpecGathererService()
    {
        $this->services['spec_gatherer'] = $instance = new \Civi\Api4\Service\Spec\SpecGatherer();

        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentExtraFieldProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentExtraFieldProvider'] = new \Civi\Api4\Service\Spec\Provider\SearchSegmentExtraFieldProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ACLCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ACLCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ACLCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ACLEntityRoleCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ACLEntityRoleCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ACLEntityRoleCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ActionScheduleCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ActionScheduleCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ActionScheduleCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ActivitySpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ActivitySpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ActivitySpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\AddressCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\AddressCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\AddressCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\AddressGetSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\AddressGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\AddressGetSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\BatchCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\BatchCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\BatchCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CampaignCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CampaignCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CampaignCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CaseCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CaseCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CaseCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CaseTypeGetSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CaseTypeGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CaseTypeGetSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContactCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactGetSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContactGetSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactTypeCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContactTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContactTypeCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContributionCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionGetSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContributionGetSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionRecurCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ContributionRecurCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ContributionRecurCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomFieldCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomFieldCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CustomFieldCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomGroupSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomGroupSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CustomGroupSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomValueSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\CustomValueSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\CustomValueSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\DefaultLocationTypeProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\DefaultLocationTypeProvider'] = new \Civi\Api4\Service\Spec\Provider\DefaultLocationTypeProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\DomainCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\DomainCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\DomainCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\DomainGetSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\DomainGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\DomainGetSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EmailCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EmailCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EmailCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityBatchCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityBatchCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EntityBatchCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityTagCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityTagCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EntityTagCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityTagFilterSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EntityTagFilterSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EntityTagFilterSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EventCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\EventCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\EventCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FieldCurrencySpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FieldCurrencySpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FieldCurrencySpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FieldDomainIdSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FieldDomainIdSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FieldDomainIdSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FinancialItemCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FinancialItemCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FinancialItemCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FinancialTrxnCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\FinancialTrxnCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\FinancialTrxnCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\GetActionDefaultsProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\GetActionDefaultsProvider'] = new \Civi\Api4\Service\Spec\Provider\GetActionDefaultsProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\GroupContactCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\GroupContactCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\GroupContactCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\GroupCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\GroupCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\GroupCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\IsCurrentFieldSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\IsCurrentFieldSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\IsCurrentFieldSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ManagedEntitySpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\ManagedEntitySpecProvider'] = new \Civi\Api4\Service\Spec\Provider\ManagedEntitySpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MappingCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MappingCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MappingCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MembershipCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MembershipCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MembershipCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MembershipTypeCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MembershipTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MembershipTypeCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MessageTemplateGetSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\MessageTemplateGetSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\MessageTemplateGetSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\NavigationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\NavigationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\NavigationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\NoteCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\NoteCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\NoteCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\OptionValueCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\OptionValueCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\OptionValueCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PaymentProcessorCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorTypeCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PaymentProcessorTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PaymentProcessorTypeCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PhoneCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PhoneCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PhoneCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PriceFieldValueCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\PriceFieldValueCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\PriceFieldValueCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\RelationshipCacheSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\RelationshipCacheSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\RelationshipCacheSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\RelationshipTypeCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\RelationshipTypeCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\RelationshipTypeCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\TagCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\TagCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\TagCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\UFFieldCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\UFFieldCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\UFFieldCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchDisplayCreationSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchDisplayCreationSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\SearchDisplayCreationSpecProvider())));
        $instance->addSpecProvider(($this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentSpecProvider'] ?? ($this->services['Civi\\Api4\\Service\\Spec\\Provider\\SearchSegmentSpecProvider'] = new \Civi\Api4\Service\Spec\Provider\SearchSegmentSpecProvider())));

        return $instance;
    }

    /**
     * Gets the public 'sql_triggers' shared service.
     *
     * @return \Civi\Core\SqlTriggers
     */
    protected function getSqlTriggersService()
    {
        return $this->services['sql_triggers'] = new \Civi\Core\SqlTriggers();
    }

    /**
     * Gets the public 'themes' shared service.
     *
     * @return \Civi\Core\Themes
     */
    protected function getThemesService()
    {
        return $this->services['themes'] = new \Civi\Core\Themes();
    }

    /**
     * @return array|bool|float|int|string|\UnitEnum|null
     */
    public function getParameter($name)
    {
        $name = (string) $name;

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name): bool
    {
        $name = (string) $name;

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters);
    }

    public function setParameter($name, $value): void
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag(): ParameterBagInterface
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = [];
    private $dynamicParameters = [];

    private function getDynamicParameter(string $name)
    {
        throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
    }

    protected function getDefaultParameters(): array
    {
        return [
            'civicrm_base_path' => '/Applications/MAMP/htdocs/local.naua.com/wp-content/plugins/civicrm/civicrm',
        ];
    }
}
