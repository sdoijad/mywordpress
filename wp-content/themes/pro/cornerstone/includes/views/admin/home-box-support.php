<div class="tco-box tco-box-min-height tco-box-support">
  <header class="tco-box-header">
    <?php echo $status_icon_dynamic; ?>
    <h2 class="tco-box-title"><?php _e( 'Support', 'cornerstone' ); ?></h2>
  </header>
  <div class="tco-box-content">
    <ul class="tco-box-features">
      <li>
        <?php tco_common()->admin_icon( 'woman', 'tco-box-feature-icon' ); ?>
        <div class="tco-box-feature-info">
          <h4 class="tco-box-content-title"><?php _e( 'Real People', 'cornerstone' ); ?></h4>
          <span class="tco-box-content-text"><?php _e( 'A professional and courteous staff', 'cornerstone' ); ?></span>
        </div>
      </li>
      <li>
        <?php tco_common()->admin_icon( 'tfs', 'tco-box-feature-icon' ); ?>
        <div class="tco-box-feature-info">
          <h4 class="tco-box-content-title"><?php _e( 'Around the Clock', 'cornerstone' ); ?></h4>
          <span class="tco-box-content-text"><?php _e( 'Get help at any time, day or night', 'cornerstone' ); ?></span>
        </div>
      </li>
      <li>
        <?php tco_common()->admin_icon( 'docs', 'tco-box-feature-icon' ); ?>
        <div class="tco-box-feature-info">
          <h4 class="tco-box-content-title"><?php _e( 'Docs', 'cornerstone' ); ?></h4>
          <span class="tco-box-content-text"><?php _e( 'Dozens of articles and videos', 'cornerstone' ); ?></span>
        </div>
      </li>
    </ul>
    <?php if ( $is_validated ) : ?>
      <div class="tco-btn-group-horizontal">
        <a class="tco-btn" href="https://theme.co/docs/" target="_blank"><?php _e( 'Docs', 'cornerstone' ); ?></a><a class="tco-btn" href="https://theme.co/account/dashboard/" target="_blank"><?php _e( 'Support', 'cornerstone' ); ?></a>
      </div>
    <?php else : ?>
      <a class="tco-btn tco-btn-nope" href="#" data-tco-toggle=".tco-box-support .tco-overlay"><?php _e( 'Get World-Class Support', 'cornerstone' ); ?></a>
    <?php endif; ?>
  </div>
  <footer class="tco-box-footer">
    <div class="tco-box-bg" style="background-image: url(<?php tco_common()->admin_image( 'box-support-tco-box-bg.jpg' ); ?>);"></div>
    <?php if ( ! $is_validated ) :

    $box_class = '.tco-box-support';
    include( cornerstone()->path . '/includes/views/admin/home-validate-overlay.php' );

    endif; ?>
  </footer>
</div>
