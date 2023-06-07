=== Ninja Forms - CiviCrm ===
Contributors: 
Tags: form
Stable tag: 3.0.0
License: GPLv2 or later

== Description ==

This extension integrates Ninja Forms with CiviCrm

= Features =

* Create a new Contact; optionally match an existing logged in user as a contact
* Create multiple emails, phones, IMs, websites linked to Contact using pre-defined 'location names'
* Create multiple address linked to Contact using pre-defined 'location names'
* Create a new Activity linked to Contact
* Subscribe contact to multiple groups
* Add multiple tags to contact
* Register the Contact to a pre-existing Event using a numerical Event Id
* Add multiple line items for contact to events and memberships
* Add a note to the contact
* Add multiple contacts, each with the previously listed contact features
* Create an order consolidating all line items on the form
* Option to disable storage of communication diagnostics data (not the actual submission data)

== Installation ==

This section describes how to install the plugin.

1. Upload the `ninja-forms-civicrm` directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==
= 3.0.1 (2023.01.31)
*Bug Fixes:*
- Ensure dedupe match runs on downstream created records
 
= 3.0.0 =
* Use dropdown select for Group Id in contact map
* Use dropdown select for Tag Id
* Add template for hidden field
* Make tag entity hidden, set to contact
* Make Address Location dropdown w/ updated label
* Add ContactType to the Civi internal SDK
* Add field map config for type/subtype
* Add type/subtype to createNewContact request
* Add Country to the Civi internal SDK
* Add country to Address processor
* Add activity status and type using lookups
* Add DedupeRule and DedupeRuleGroup to SDK
* Pass deduperule group as contact match instruction
* Set newly created contact as AddedBy and With
* Add dedupeContact by email
* Don't add new contact info if isDupe
* Prevent PHP notices and warnings ading check rules
* Remove line item from CreateContact
* UI updates to match Ninja Forms standards
* Update documentation process
* Refactor release process

= 3.0.0-beta.1
* Rename action names for clarity, esp. on short width display

