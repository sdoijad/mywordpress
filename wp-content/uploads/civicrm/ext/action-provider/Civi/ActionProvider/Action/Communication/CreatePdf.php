<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

namespace Civi\ActionProvider\Action\Communication;

use Civi\ActionProvider\Action\AbstractAction;
use Civi\ActionProvider\Parameter\OptionGroupByNameSpecification;
use \Civi\ActionProvider\Parameter\ParameterBagInterface;
use Civi\ActionProvider\Parameter\SpecificationBag;
use Civi\ActionProvider\Parameter\Specification;
use Civi\ActionProvider\Utils\Files;
use Civi\ActionProvider\Utils\Tokens;
use CRM_ActionProvider_ExtensionUtil as E;

class CreatePdf extends AbstractAction {

  /**
   * @var \ZipArchive
   */
  protected $zip;

  protected $messages = array();

  protected $pdfFormat;

  protected $pdfLetterActivityType;

  public function doAction(ParameterBagInterface $parameters, ParameterBagInterface $output) {
    $participantId = $parameters->getParameter('participant_id');
    $message = $parameters->getParameter('message');
    $contactId = $parameters->getParameter('contact_id');
    $filename = $this->configuration->getParameter('filename');
    $fileNameWithoutContactId = $filename . '.pdf';
    $filenameWithContactId = $filename . '_' . $contactId . '.pdf';
    $contact = [];
    if ($participantId) {
      $contact['extra_data']['participant']['id'] = $participantId;
    }
    if ($parameters->doesParameterExists('contribution_recur_id')) {
      $contact['extra_data']['contribution_recur']['id'] = $parameters->getParameter('contribution_recur_id');
    }
    if ($parameters->doesParameterExists('case_id')) {
      $contact['case_id'] = $parameters->getParameter('case_id');
    }
    if ($parameters->doesParameterExists('contribution_id')) {
      $contact['contribution_id'] = $parameters->getParameter('contribution_id');
    }
    if ($parameters->doesParameterExists('activity_id')) {
      $contact['activity_id'] = $parameters->getParameter('activity_id');
    }
    $this->pdfFormat = null;
    if ($parameters->doesParameterExists('page_format_id')) {
      $this->pdfFormat = $parameters->getParameter('page_format_id');
    }

    $processedMessage = Tokens::replaceTokens($contactId, $message, $contact, 'text/html');
    if ($processedMessage === false) {
      return;
    }
    //time being hack to strip '&nbsp;'
    //from particular letter line, CRM-6798
    \CRM_Contact_Form_Task_PDFLetterCommon::formatMessage($processedMessage);
    $this->messages[] = $processedMessage;
    $text = array($processedMessage);
    $pdfContents = \CRM_Utils_PDF_Utils::html2pdf($text, $fileNameWithoutContactId, TRUE, $this->pdfFormat);

    if ($this->currentBatch && $this->zip) {
      $this->zip->addFromString($filenameWithContactId, $pdfContents);
    }

    $file = $this->createActivity($contactId, $message, $pdfContents, $fileNameWithoutContactId, $parameters->getParameter('subject'));

    $output->setParameter('filename', $file['name']);
    $output->setParameter('url', $file['url']);
    $output->setParameter('path', $file['path']);
    $output->setParameter('file_id', $file['id']);
  }

  /**
   * @param $contactId
   * @param $message
   * @param $pdfContents
   * @param $filename
   * @param $subject
   * @return array
   *   Returns the file array
   */
  protected function createActivity($contactId, $message, $pdfContents, $filename, $subject='') {
    $activityTypeId = $this->getPdfLetterActivityTypeId();
    $activityParams = array(
      'activity_type_id' => $activityTypeId,
      'activity_date_time' => date('YmdHis'),
      'details' => $message,
      'source_contact_id' => $contactId,
      'subject' => $subject,
    );
    $result = civicrm_api3('Activity', 'create', $activityParams);

    $activityContacts = \CRM_Core_OptionGroup::values('activity_contacts', FALSE, FALSE, FALSE, NULL, 'name');
    $targetID = \CRM_Utils_Array::key('Activity Targets', $activityContacts);
    $activityTargetParams = array(
      'activity_id' => $result['id'],
      'contact_id' => $contactId,
      'record_type_id' => $targetID
    );
    \CRM_Activity_BAO_ActivityContact::create($activityTargetParams);

    $attachment = civicrm_api3('Attachment', 'create', array(
      'entity_table' => 'civicrm_activity',
      'entity_id' => $result['id'],
      'name' => $filename,
      'mime_type' => 'application/pdf',
      'content' => $pdfContents,
    ));

    return reset($attachment['values']);
  }

  /**
   * @return array
   * @throws \CiviCRM_API3_Exception
   */
  protected function getPdfLetterActivityTypeId() {
    if (!$this->pdfLetterActivityType) {
      $activityTypeName = $this->configuration->getParameter('activity_type_id');
      $this->pdfLetterActivityType = civicrm_api3('OptionValue', 'getvalue', [
        'option_group_id' => 'activity_type',
        'name' => $activityTypeName,
        'return' => 'value'
      ]);
    }
    return $this->pdfLetterActivityType;
  }

  /**
   * This function initialize a batch.
   *
   * @param $batchName
   */
  public function initializeBatch($batchName) {
    $outputMode = $this->configuration->getParameter('batch_output_mode');
    if ($outputMode == 'zip') {
      $subdir = Files::createRestrictedDirectory('createpdf');
      $outputName = \CRM_Core_Config::singleton()->templateCompileDir . $subdir . '/' . $batchName . '.zip';
      $this->zip = new \ZipArchive();
      if ($this->zip->open($outputName, \ZipArchive::CREATE) !== TRUE) {
        $this->zip = NULL;
      }
    }

    $this->currentBatch = $batchName;
  }

  /**
   * This function finishes a batch and is called when a batch with actions is finished.
   *
   * @param $batchName
   * @param bool
   *   Whether this was the last batch.
   */
  public function finishBatch($batchName, $isLastBatch=false) {
    // Child classes could override this function
    // E.g. merge files in a directorys
    if ($this->zip) {
      $this->zip->close();

      if ($isLastBatch) {
        $subdir = Files::createRestrictedDirectory('createpdf');
        $downloadName = $this->configuration->getParameter('filename').'.zip';
        $this->createDownloadStatusMessage($batchName.'.zip', $subdir, $downloadName);
      }
    } else {
      $subdir = Files::createRestrictedDirectory('createpdf');
      $basePath = \CRM_Core_Config::singleton()->templateCompileDir . $subdir;
      $htmlFile = $basePath .'/'.$batchName.'.html';
      $pdfFormatFile = $basePath .'/'.$batchName.'.pdfformat';
      if ($this->pdfFormat) {
        file_put_contents($pdfFormatFile, $this->pdfFormat);
      }
      if (count($this->messages)) {
        $this->addPagesToHtmlFile($this->messages, $htmlFile);
      }
      if ($isLastBatch) {
        if (!$this->pdfFormat && file_exists($pdfFormatFile)) {
          $this->pdfFormat = file_get_contents($pdfFormatFile);
          unlink($pdfFormatFile);
        }
        $pdfFile = $basePath .'/'.$batchName.'.pdf';
        $this->convertHtmlToPdf($htmlFile, $pdfFile);
        $downloadName = $this->configuration->getParameter('filename').'.pdf';
        $this->createDownloadStatusMessage($batchName.'.pdf', $subdir, $downloadName);
      }
    }
  }

  /**
   * Creates a status message with a download link.
   *
   * @param $filename
   * @param $subdir
   * @param $downloadName
   */
  protected function createDownloadStatusMessage($filename, $subdir, $downloadName) {
    $downloadUrl = \CRM_Utils_System::url('civicrm/actionprovider/downloadfile', [
      'filename' => $filename,
      'subdir' => $subdir,
      'downloadname' => $downloadName
    ]);
    \CRM_Core_Session::setStatus(E::ts('<a href="%1">Download document(s)<a/>', [1 => $downloadUrl]), E::ts('Created PDF'), 'success');
  }

  /**
   * Returns the specification of the parameters of the actual action.
   *
   * @return SpecificationBag
   */
  public function getParameterSpecification() {
    return new SpecificationBag(array(
      new Specification('contact_id', 'Integer', E::ts('Contact ID'), true),
      new Specification('message', 'String', E::ts('Message'), true),
      new Specification('activity_id', 'Integer', E::ts('Activity ID'), false),
      new Specification('contribution_id', 'Integer', E::ts('Contribution ID'), false),
      new Specification('contribution_recur_id', 'Integer', E::ts('Recurring Contribution ID'), false),
      new Specification('case_id', 'Integer', E::ts('Case ID'), false),
      new Specification('participant_id', 'Integer', E::ts('Participant ID'), false),
      new Specification('subject', 'String', E::ts('Subject (for the activity)'), false),
      new Specification('page_format_id', 'Integer', E::ts('Print Page (PDF) Format'), false),
    ));
  }

  public function getConfigurationSpecification() {
    $filename = new Specification('filename', 'String', E::ts('Filename'), true, E::ts('document'));
    $filename->setDescription(E::ts('Without the extension .pdf or .zip'));
    $batch_output_mode = new Specification('batch_output_mode', 'String', E::ts("Batch output mode"), true, 'pdf', null, array(
        'zip' => E::ts('All files in one zip'),
        'pdf' => E::ts('Merge all files into one PDF'),
      ));
    $batch_output_mode->setDescription(E::ts('When this action is executed in batch mode, meaning that it generates more than one pdf, in which way do you want to retrieve the generated PDFs'));
    $activity = new OptionGroupByNameSpecification('activity_type_id', 'activity_type', E::ts('PDF Letter Activity'), true, 'Print PDF Letter');

    return new SpecificationBag(array(
      $filename,
      $batch_output_mode,
      $activity
    ));
  }

  public function getOutputSpecification() {
    return new SpecificationBag(array(
      new Specification('filename', 'String', E::ts('Filename')),
      new Specification('url', 'String', E::ts('Download Url')),
      new Specification('path', 'String', E::ts('Path in filesystem')),
      new Specification('file_id', 'Integer', E::ts('File ID')),
    ));
  }

  /**
   * Returns a help text for this action.
   *
   * The help text is shown to the administrator who is configuring the action.
   * Override this function in a child class if your action has a help text.
   *
   * @return string|false
   */
  public function getHelpText() {
    return E::ts("
      This action generates PDF files for the contacts. <br />
      When this action is used in a batch you can define how you want to download the
      generated PDFs: either in one zip file or in one pdf. <br />
      <br />
      The input for this action is a contact ID and the message. You can use the <em>Find Message Template by name</em> action
      to retrieve the message.
    ");
  }

  /**
   * Initialize an HTML file. The HTML file is later on converted to a PDF.
   *
   * Function taken from CRM_Utils_PDF_Utils::html2pdf
   *
   * @return string
   */
  protected function initializeHtmlFile() {
    $format = \CRM_Core_BAO_PdfFormat::getDefaultValues();
    if ($this->pdfFormat) {
      $format = \CRM_Core_BAO_PdfFormat::getById($this->pdfFormat);
    }
    $metric = \CRM_Core_BAO_PdfFormat::getValue('metric', $format);
    $t = \CRM_Core_BAO_PdfFormat::getValue('margin_top', $format);
    $r = \CRM_Core_BAO_PdfFormat::getValue('margin_right', $format);
    $b = \CRM_Core_BAO_PdfFormat::getValue('margin_bottom', $format);
    $l = \CRM_Core_BAO_PdfFormat::getValue('margin_left', $format);

    // Add a special region for the HTML header of PDF files:
    $pdfHeaderRegion = \CRM_Core_Region::instance('export-document-header', FALSE);
    $htmlHeader = ($pdfHeaderRegion) ? $pdfHeaderRegion->render('', FALSE) : '';

    $html = "
<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
    <style>@page { margin: {$t}{$metric} {$r}{$metric} {$b}{$metric} {$l}{$metric}; }</style>
    <style type=\"text/css\">@import url(" . \CRM_Core_Config::singleton()->userFrameworkResourceURL . "css/print.css);</style>
    {$htmlHeader}
  </head>
  <body>
    <div id=\"crm-container\">\n";
    return $html;
  }

  /**
   * Convert an array of pages to html and append it to an already existing html file
   *
   * Function taken from CRM_Utils_PDF_Utils::html2pdf
   *
   * @param $pages
   * @param $html_file
   */
  protected function addPagesToHtmlFile($pages, $html_file) {
    $html = "";
    if (!file_exists($html_file)) {
      $html = $this->initializeHtmlFile();
    } else {
      // Append a line break to the file before adding the pages.
      $html = "\n<div style=\"page-break-after: always\"></div>\n";
    }
    // Strip <html>, <header>, and <body> tags from each page
    $htmlElementstoStrip = [
      '@<head[^>]*?>.*?</head>@siu',
      '@<script[^>]*?>.*?</script>@siu',
      '@<body>@siu',
      '@</body>@siu',
      '@<html[^>]*?>@siu',
      '@</html>@siu',
      '@<!DOCTYPE[^>]*?>@siu',
    ];
    $htmlElementsInstead = ['', '', '', '', '', ''];
    foreach ($pages as & $page) {
      $page = preg_replace($htmlElementstoStrip,
        $htmlElementsInstead,
        $page
      );
    }
    // Glue the pages together
    $html .= implode("\n<div style=\"page-break-after: always\"></div>\n", $pages);
    file_put_contents($html_file, $html, FILE_APPEND);
  }

  protected function convertHtmlToPdf($html_file, $output_file) {
    $html = "</div></body></html>";
    file_put_contents($html_file, $html, FILE_APPEND);

    $format = \CRM_Core_BAO_PdfFormat::getDefaultValues();
    if ($this->pdfFormat) {
      $format = \CRM_Core_BAO_PdfFormat::getById($this->pdfFormat);
    }
    $paperSize = \CRM_Core_BAO_PaperSize::getByName($format['paper_size']);
    $paper_width = \CRM_Utils_PDF_Utils::convertMetric($paperSize['width'], $paperSize['metric'], 'pt');
    $paper_height = \CRM_Utils_PDF_Utils::convertMetric($paperSize['height'], $paperSize['metric'], 'pt');
    // dompdf requires dimensions in points
    $paper_size = array(0, 0, $paper_width, $paper_height);
    $orientation = \CRM_Core_BAO_PdfFormat::getValue('orientation', $format);
    $metric = \CRM_Core_BAO_PdfFormat::getValue('metric', $format);
    $t = \CRM_Core_BAO_PdfFormat::getValue('margin_top', $format);
    $r = \CRM_Core_BAO_PdfFormat::getValue('margin_right', $format);
    $b = \CRM_Core_BAO_PdfFormat::getValue('margin_bottom', $format);
    $l = \CRM_Core_BAO_PdfFormat::getValue('margin_left', $format);

    $margins = array($metric, $t, $r, $b, $l);

    if (\CRM_Core_Config::singleton()->wkhtmltopdfPath) {
      $this->_html2pdf_wkhtmltopdf($paper_size, $orientation, $margins, $html_file, $output_file);
    }
    else {
      $this->_html2pdf_dompdf($paper_size, $orientation, $html_file, $output_file);
    }
    unlink($html_file);
  }

  /**
   * @param $paper_size
   * @param $orientation
   * @param $margins
   * @param $html_file
   * @param string $fileName
   */
  protected function _html2pdf_wkhtmltopdf($paper_size, $orientation, $margins, $html_file, $fileName) {
    if (!class_exists('Knp\Snappy\Pdf', FALSE)) {
      require_once 'packages/snappy/src/autoload.php';
    }
    $config = \CRM_Core_Config::singleton();
    $snappy = new \Knp\Snappy\Pdf($config->wkhtmltopdfPath);
    $snappy->setOption("page-width", $paper_size[2] . "pt");
    $snappy->setOption("page-height", $paper_size[3] . "pt");
    $snappy->setOption("orientation", $orientation);
    $snappy->setOption("margin-top", $margins[1] . $margins[0]);
    $snappy->setOption("margin-right", $margins[2] . $margins[0]);
    $snappy->setOption("margin-bottom", $margins[3] . $margins[0]);
    $snappy->setOption("margin-left", $margins[4] . $margins[0]);
    $pdf = $snappy->generate($html_file, $fileName);
  }

  /**
   * @param $paper_size
   * @param $orientation
   * @param $html_file
   * @param string $fileName
   *
   * @return string
   */
  protected function _html2pdf_dompdf($paper_size, $orientation, $html_file, $fileName) {
    // CRM-12165 - Remote file support required for image handling.
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', TRUE);
    $options->set('chroot', dirname($html_file));

    $dompdf = new \Dompdf\Dompdf($options);
    $dompdf->set_paper($paper_size, $orientation);
    $dompdf->loadHtmlFile($html_file);
    $dompdf->render();

    file_put_contents($fileName, $dompdf->output());
  }


}
