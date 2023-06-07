<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

namespace Civi\ActionProvider\Utils;

class SendEmail {

  private $from_name;

  private $from_email;

  private $reply_to_email;

  private $sender_contact_id;

  private $case_id;

  private $participant_id;

  private $contribution_id;

  private $activity_id;

  private $attachments;

  private $alternative_recipient_email;

  private $location_type_id;

  private $campaign_id;

  public function __construct($from_email=null, $from_name=null) {
    $this->from_email = $from_email;
    $this->from_name = $from_name;
  }

  public function  setCaseId($case_id) {
    $this->case_id = $case_id;
  }

  public function setParticipantId($participant_id) {
    $this->participant_id = $participant_id;
  }

  public function setContributionId($contribution_id) {
    $this->contribution_id = $contribution_id;
  }

  public function setActivityId($activity_id) {
    $this->activity_id = $activity_id;
  }

  public function setAlternativeRecipientEmail($email) {
    $this->alternative_recipient_email = $email;
  }

  public function setFromName($name) {
    $this->from_name = $name;
  }

  public function setFromEmail($email) {
    $this->from_email = $email;
  }

  public function setLocationTypeId($locationTypeId) {
    $this->location_type_id = $locationTypeId;
  }

  /**
   * @param mixed $campaign_id
   */
  public function setCampaignId($campaign_id): void {
    $this->campaign_id = $campaign_id;
  }

  /**
   * Set the sender contact ID. The sender contact ID is used as the source contact ID
   * for the e-mail activity.
   * The e-mail address of the sender is used as ReplyTo
   * Alternatively you could also set From Header
   *
   *
   * @param int $senderContactId
   * @param bool $useAsReplyTo
   * @param bool $useAsFrom
   */
  public function setSenderContactId($senderContactId, $useAsReplyTo=true, $useAsFrom=false) {
    try {
      $senderContact = civicrm_api3('Contact', 'getsingle', ['id' => $senderContactId]);
      $this->sender_contact_id = $senderContactId;
      if ($senderContact['email']) {
        if ($useAsReplyTo) {
          $this->reply_to_email = $senderContact['email'];
          $this->from_name = $senderContact['display_name'];
        }
        if ($useAsFrom) {
          $this->from_email = $senderContact['email'];
          if ($senderContact['display_name'] != $senderContact['email']) {
            $this->from_name = $senderContact['display_name'];
          }
        }
      }
    } catch (\Exception $e) {
      // Do nothing
    }
  }

  /**
   * Send e-mail
   *
   * @param $contactIds
   * @param $subject
   * @param $body_text
   * @param $body_html
   * @param bool $extra_data
   * @param false|string $cc
   * @param false|string $bcc
   *
   * @return array
   * @throws \Exception
   */
  public function send($contactIds, $subject, $body_text, $body_html, $extra_data=false, $cc=false, $bcc=false) {
    $from = \CRM_Core_BAO_Domain::getNameAndEmail();
    if ($this->from_email && $this->from_name) {
      $from = $this->from_name."<".$this->from_email.">";
    } elseif ($this->from_email) {
      $from = $this->from_email;
    } elseif ($this->from_name) {
      $from = $this->from_name ." <".$from[1].">";
    } else {
      $from = "$from[0] <$from[1]>";
    }

    $result     = NULL;
    if (!$body_text) {
      $body_text = \CRM_Utils_String::htmlToText($body_html);
    }

    $returnValues = array();
    foreach($contactIds as $contactId) {
      $contact_params = array(array('contact_id', '=', $contactId, 0, 0));
      list($contact) = \CRM_Contact_BAO_Query::apiQuery($contact_params);
      $contact = reset($contact);
      if (!$contact || is_a($contact, 'CRM_Core_Error')) {
        throw new \Exception('Could not find contact with ID: ' . $contact_params['contact_id']);
      }

      $contactData = array();
      if ($this->case_id) {
        $contactData['case_id'] = $this->case_id;
      }
      if ($this->contribution_id) {
        $contactData['contribution_id'] = $this->contribution_id;
      }
      if ($this->activity_id) {
        $contactData['activity_id'] = $this->activity_id;
      }
      if ($extra_data) {
        $contactData['extra_data'] = $extra_data;
      }
      if ($this->participant_id) {
        $contactData['extra_data']['participant']['id'] = $this->participant_id;
      }

      if ($contact['do_not_email'] || (empty($contact['email']) && empty($this->alternative_recipient_email)) || \CRM_Utils_Array::value('is_deceased', $contact) || $contact['on_hold']) {
        /**
         * Contact is deceased or has opted out from mailings so do not send the e-mail
         */
        continue;
      } else {
        /**
         * Send e-mail to the contact
         */
        $email = $this->getContactEmail($contactId, $contact['email']);
        $toName = $contact['display_name'];
      }
      if ($this->alternative_recipient_email) {
        $email = $this->alternative_recipient_email;
      }
      $type = array('body_html', 'body_text', 'subject');
      $html = Tokens::replaceTokens($contactId, $body_html, $contactData, 'text/html');
      $text = Tokens::replaceTokens($contactId, $body_text, $contactData, 'text/plain');
      $subject = Tokens::replaceTokens($contactId, $subject, $contactData, 'text/plain');

      // set up the parameters for CRM_Utils_Mail::send
      $mailParams = array(
        'groupName' => 'E-mail from API',
        'from' => $from,
        'toName' => $toName,
        'toEmail' => $email,
        'subject' => $subject,
      );
      if ($cc) {
        $mailParams['cc'] = $cc;
      }
      if ($bcc) {
        $mailParams['bcc'] = $bcc;
      }

      // render the &amp; entities in text mode, so that the links work
      $mailParams['text'] = str_replace('&amp;', '&', $text);
      $mailParams['html'] = $html;
      if ($this->reply_to_email) {
        $mailParams['replyTo'] = $this->reply_to_email;
      }

      \CRM_Utils_Hook::alterMailContent($mailParams);
      if (is_array($this->attachments)) {
        $mailParams['attachments'] = $this->attachments;
      }
      $result = \CRM_Utils_Mail::send($mailParams);
      if (!$result) {
        throw new \Exception('Error sending e-mail to ' . $contact['display_name'] . ' <' . $email . '> ');
      }

      //create activity for sending e-mail.
      $activityTypeID = \CRM_Core_PseudoConstant::getKey('CRM_Activity_BAO_Activity', 'activity_type_id', 'Email');

      // CRM-6265: save both text and HTML parts in details (if present)
      if ($html and $text) {
        $details = "-ALTERNATIVE ITEM 0-\n$html\n-ALTERNATIVE ITEM 1-\n$text\n-ALTERNATIVE END-\n";
      }
      else {
        $details = $html ? $html : $text;
      }

      $activityParams = array(
        'source_contact_id' => $contactId,
        'activity_type_id' => $activityTypeID,
        'activity_date_time' => date('YmdHis'),
        'subject' => $subject,
        'details' => $details,
        'status_id' => 2, //Completed
      );
      if ($this->sender_contact_id) {
        $activityParams['source_contact_id'] = $this->sender_contact_id;
      }
      if ($this->campaign_id) {
        $activityParams['campaign_id'] = $this->campaign_id;
      }
      $activity = \CRM_Activity_BAO_Activity::create($activityParams);

      $activityContacts = \CRM_Core_OptionGroup::values('activity_contacts', FALSE, FALSE, FALSE, NULL, 'name');
      $targetID = \CRM_Utils_Array::key('Activity Targets', $activityContacts);

      $activityTargetParams = array(
        'activity_id' => $activity->id,
        'contact_id' => $contactId,
        'record_type_id' => $targetID
      );
      \CRM_Activity_BAO_ActivityContact::create($activityTargetParams);

      if (!empty($this->case_id)) {
        $caseActivity = array(
          'activity_id' => $activity->id,
          'case_id' => $this->case_id,
        );
        \CRM_Case_BAO_Case::processCaseActivity($caseActivity);
      }

      $this->processAttachments($activity->id);

      $returnValues[$contactId] = array(
        'contact_id' => $contactId,
        'send' => 1,
        'status_msg' => 'Succesfully send e-mail to ' . ' <' . $email . '> ',
      );
    }
    return $returnValues;
  }

  /**
   * Add an attachment
   *
   * @param $filename
   * @param $cleanName
   * @param $mimeType
   */
  public function addAttachment($fullPath, $cleanName, $mimeType) {
    $this->attachments[] = array(
      'fullPath' => $fullPath,
      'cleanName' => $cleanName,
      'name' => $cleanName,
      'mime_type' => $mimeType
    );
  }

  /**
   * Return the information of the attachment.
   * This information is changed after the e-mail is send and the attachments
   * are processed.
   *
   * @param $cleanName
   * @return mixed
   */
  public function getAttachment($cleanName) {
    foreach($this->attachments as $index => $attachment) {
      if ($attachment['name'] == $cleanName) {
        return $this->attachments[$index];
      } elseif ($attachment['cleanName'] == $cleanName) {
        return $this->attachments[$index];
      }
    }
  }

  /**
   * Add the attachments to the e-mail activity
   *
   * @param $activity_id
   */
  protected function processAttachments($activity_id) {
    if (is_array($this->attachments)) {
      foreach($this->attachments as $index => $attachment) {
        $config = \CRM_Core_Config::singleton();
        $tmpPath = $config->uploadDir . DIRECTORY_SEPARATOR . $attachment['cleanName'];
        copy($attachment['fullPath'], $tmpPath);
        try {
          $result = civicrm_api3('Attachment', 'create', array(
            'entity_table' => 'civicrm_activity',
            'entity_id' => $activity_id,
            'name' => $attachment['cleanName'],
            'mime_type' => $attachment['mime_type'],
            'options' => array('move-file' => $tmpPath),
          ));
          $this->attachments[$index] = reset($result['values']);
        } catch (\CiviCRM_API3_Exception $ex) {
          // Do nothing
        }
        unlink($tmpPath);
      }
    }
  }

  protected function getContactEmail($contactId, $fallbackEmail) {
    $email = $fallbackEmail;
    if ($this->location_type_id) {
      try {
        $email = civicrm_api3('Email', 'getvalue', [
          'return' => 'email',
          'location_type_id' => $this->location_type_id,
          'contact_id' => $contactId,
          'options' => ['limit' => 1]
        ]);
      } catch (\CiviCRM_API3_Exception $e) {
        // Do nothing
      }
    }
    return $email;
  }

}
