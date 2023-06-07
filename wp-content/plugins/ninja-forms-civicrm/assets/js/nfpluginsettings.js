jQuery(document).ready(function ($) {
  /* localized variables passed through params object
    params
      wpRestNonce
      showDiagnosticsOnStartup

    response  
      result
      markup

 
*/
  $(getSelectorForRow("nf_civicrm_show_diagnostics_on_startup")).hide();
  /*
   * Show / Hide diagnostics on startup
   */
  if ("1" !== params.showDiagnosticsOnStartup) {
    updateButtonText("nf_civicrm_toggle_diagnostics", "Show Diagnostics");
    $(getSelectorForRow("nf_civicrm_diagnostic_result")).hide();
  } else {
    updateButtonText("nf_civicrm_toggle_diagnostics", "Hide Diagnostics");
  }

  /*
   *
   * Button Clicks
   *
   *************** */

  // Toggle show/hide diagnostics
  $("#nf_civicrm_toggle_diagnostics").click(function (e) {
    $(getSelectorForRow("nf_civicrm_diagnostic_result")).toggle();

    if (
      $(getSelectorForRow("nf_civicrm_diagnostic_result")).css("display") ==
      "none"
    ) {
      showDiagnosticsValue = "0";
      updateCheckboxValue("nf_civicrm_show_diagnostics_on_startup", false);

      updatePluginSettingsMarkup("nf_civicrm_status", "Hiding diagnostics");
      updateButtonText("nf_civicrm_toggle_diagnostics", "Show Diagnostics");
    } else {
      showDiagnosticsValue = "1";
      updateCheckboxValue("nf_civicrm_show_diagnostics_on_startup", true);

      updatePluginSettingsMarkup("nf_civicrm_status", "Showing diagnostics");
      updateButtonText("nf_civicrm_toggle_diagnostics", "Hide Diagnostics");
    }

    $.post(
      ajaxurl,
      {
        action: "nf_civicrm_nfpluginsettings",
        wpRestNonce: params.wpRestNonce,
        context: "toggleShowDiagnostics",
        showDiagnostics: showDiagnosticsValue,
      },
      function (json) {
        response = JSON.parse(json);
        statusMarkup = response.markup;
      }
    );
  });

  // Click to verify DB connection
  $("#nf_civicrm_verify_db_connnection").click(function (e) {
    // Hit AJAX endpoint
    $.post(
      ajaxurl,
      {
        action: "nf_civicrm_nfpluginsettings",
        wpRestNonce: params.wpRestNonce,
        context: "verifyDbConnection",
      },
      function (json) {
        response = JSON.parse(json);
        result = response.result;
        if ("success" === result) {
          proof = response.proof;
          verificationDescription = response.verificationDescription;
          
          updatePluginSettingsMarkup(
            "nf_civicrm_status",
            verificationDescription
          );
          updatePluginSettingsMarkup("nf_civicrm_diagnostic_result", proof);
        } else {
          updatePluginSettingsMarkup(
            "nf_civicrm_status",
            "Could not verify connection to DB"
          );
        }
      }
    );
  });

  // Click to retrieve events
  $("#nf_civicrm_list_events").click(function (e) {
    // Hit AJAX endpoint
    $.post(
      ajaxurl,
      {
        action: "nf_civicrm_nfpluginsettings",
        wpRestNonce: params.wpRestNonce,
        context: "retrieveEvents",
      },
      function (json) {
        response = JSON.parse(json);
        result = response.result;
        if ("success" === result) {
          markup=response.markup
          updatePluginSettingsMarkup(
            "nf_civicrm_status",
            "Successfully retrieved events.  See Diagnostic Results for results."
          );
          updatePluginSettingsMarkup("nf_civicrm_diagnostic_result", markup);
        } else {
          updatePluginSettingsMarkup(
            "nf_civicrm_status",
            "Could not retrieve events"
          );
        }
      }
    );
  });

  // Click to retrieve tags
  $("#nf_civicrm_list_tags").click(function (e) {
    // Hit AJAX endpoint
    $.post(
      ajaxurl,
      {
        action: "nf_civicrm_nfpluginsettings",
        wpRestNonce: params.wpRestNonce,
        context: "retrieveTags",
      },
      function (json) {
        response = JSON.parse(json);
        result = response.result;
        if ("success" === result) {
          markup=response.markup
          updatePluginSettingsMarkup(
            "nf_civicrm_status",
            "Successfully retrieved tags.  See Diagnostic Results for results."
          );
          updatePluginSettingsMarkup("nf_civicrm_diagnostic_result", markup);
        } else {
          updatePluginSettingsMarkup(
            "nf_civicrm_status",
            "Could not retrieve tags"
          );
        }
      }
    );
  });

    // Click to retrieve groups
    $("#nf_civicrm_list_groups").click(function (e) {
      // Hit AJAX endpoint
      $.post(
        ajaxurl,
        {
          action: "nf_civicrm_nfpluginsettings",
          wpRestNonce: params.wpRestNonce,
          context: "retrieveGroups",
        },
        function (json) {
          response = JSON.parse(json);
          result = response.result;
          if ("success" === result) {
            markup=response.markup
            updatePluginSettingsMarkup(
              "nf_civicrm_status",
              "Successfully retrieved groups.  See Diagnostic Results for results."
            );
            updatePluginSettingsMarkup("nf_civicrm_diagnostic_result", markup);
          } else {
            updatePluginSettingsMarkup(
              "nf_civicrm_status",
              "Could not retrieve groups"
            );
          }
        }
      );
    });

    // Click to view log
    $("#nf_civicrm_view_log").click(function (e) {
      
      // Hit AJAX endpoint
      $.post(
        ajaxurl,
        {
          action: "nf_civicrm_nfpluginsettings",
          wpRestNonce: params.wpRestNonce,
          context: "viewLog",
        },
        function (json) {
          response = JSON.parse(json);
          result = response.result;
          if ("success" === result) {
            markup=response.markup
            updatePluginSettingsMarkup(
              "nf_civicrm_status",
              "Successfully loaded log.  See Diagnostic Results for results."
            );
            updatePluginSettingsMarkup("nf_civicrm_diagnostic_result", markup);
          } else {
            updatePluginSettingsMarkup(
              "nf_civicrm_status",
              "Could not retrieve log"
            );
          }
        }
      );
    });

    // Click to clear log
    $("#nf_civicrm_clear_log").click(function (e) {
      
      // Hit AJAX endpoint
      $.post(
        ajaxurl,
        {
          action: "nf_civicrm_nfpluginsettings",
          wpRestNonce: params.wpRestNonce,
          context: "clearLog",
        },
        function (json) {
          response = JSON.parse(json);
          result = response.result;
          if ("success" === result) {
            markup=response.markup
            updatePluginSettingsMarkup(
              "nf_civicrm_status",
              "Successfully loaded log.  See Diagnostic Results for results."
            );
            updatePluginSettingsMarkup("nf_civicrm_diagnostic_result", markup);
          } else {
            updatePluginSettingsMarkup(
              "nf_civicrm_status",
              "Could not retrieve log"
            );
          }
        }
      );
    });

  /*
   *
   * Helper functions
   *
   *************** */
  /*
    Given a button Id, uchanges the button text
  */
  function updateButtonText(buttonId, buttonText) {
    $("#" + buttonId).html(buttonText);
  }

  /*
   * Given a PluginSetting Id, updates the NF Setting output for that setting
   */
  function updatePluginSettingsMarkup(pluginSettingId, statusMarkup) {
    row = getSelectorForRow(pluginSettingId);
    $(row + " td").html(statusMarkup);
  }

  /*
   * Given a PluginSetting Id, updates the NF Setting output for that setting
   */
  function updateCheckboxValue(pluginSettingId, value) {
    selector = getInputSelector(pluginSettingId);
    $(selector).prop("checked", value);
  }
  /*
   * Given a PluginSetting Id, constructs jQ selector for the input box
   */
  function getInputSelector(pluginSettingId) {
    return "input#ninja_forms\\[" + pluginSettingId + "\\]";
  }

  // Given a PluginSetting Id, constructs a jQ selector for the entire row
  function getSelectorForRow(pluginSettingId) {
    return "#row_ninja_forms\\[" + pluginSettingId + "\\]";
  }
});
