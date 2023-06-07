<?php

// =============================================================================
// VIEWS/ADMIN/OPTIONS-PAGE-SIDEBAR.PHP
// -----------------------------------------------------------------------------
// Plugin options page sidebar.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Sidebar
// =============================================================================

// Sidebar
// =============================================================================

?>

<div id="postbox-container-1" class="postbox-container">
  <div class="meta-box-sortables">

    <!--
    SAVE
    -->

    <div class="postbox">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'Save', '__tco__' ); ?></span></h3>
      <div class="inside">
        <p><?php _e( 'Once you are satisfied with your settings, click the button below to save them.', '__tco__' ); ?></p>
        <p class="cf"><input id="submit" class="button button-primary" type="submit" name="tco_under_construction_submit" value="Update"></p>
      </div>
    </div>

    <!--
    ABOUT
    -->

    <div class="postbox">
      <div class="handlediv" title="<?php _e( 'Click to toggle', '__tco__' ); ?>"><br></div>
      <h3 class="hndle"><span><?php _e( 'About', '__tco__' ); ?></span></h3>
      <div class="inside">
        <dl class="accordion">

          <dt class="toggle"><?php _e( 'Completed By', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'Select a date from the datepicker of when you expect your site maintenance to be complete. This will initiate a countdown on the frontend of your site, allowing your visitors to know when to expect everything to be back up and running.', '__tco__' ); ?></p>
              <p><?php _e( 'Clearing this field will remove the countdown on the frontend of your site, leaving only the heading, subheading, and social profile links if you have included those.', '__tco__' ); ?></p>
            </div>
          </dd>

          <dt class="toggle"><?php _e( 'Support', '__tco__' ); ?></dt>
          <dd class="panel">
            <div class="panel-inner">
              <p><?php _e( 'Please visit our <a href="https://theme.co/docs/under-construction" target="_blank">Docs article</a> for this plugin if you have any questions.', '__tco__' ); ?></p>
            </div>
          </dd>

        </dl>
      </div>
    </div>

  </div>
</div>
