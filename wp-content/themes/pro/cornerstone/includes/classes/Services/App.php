<?php

namespace Themeco\Cornerstone\Services;

use Themeco\Cornerstone\Plugin;
use Themeco\Cornerstone\Util\ManagedParameters;
use Themeco\Cornerstone\Util\JsAsset;
use Themeco\Cornerstone\Util\View;
use Themeco\Cornerstone\Util\CssAsset;

class App implements Service {

  protected $show_admin_bar = false;
  protected $loadArgs;

  public function __construct(
    Plugin $plugin,
    Elements $elements,
    Conditionals $conditionals,
    Preferences $preferences,
    Config $config,
    Http $http,
    I18n $i18n,
    CssAsset $cssAsset,
    JsAsset $jsAsset,
    Social $social,
    View $view,
    Wpml $wpml
  ) {
    $this->plugin = $plugin;
    $this->elements = $elements;
    $this->conditionals = $conditionals;
    $this->preferences = $preferences;
    $this->config = $config;
    $this->http = $http;
    $this->i18n = $i18n;
    $this->view = $view;
    $this->wpml = $wpml;
    $this->social = $social;
    $this->jsAsset = $jsAsset;
    $this->cssAsset = $cssAsset;

    // NOTE: Refactor incomplete - most of the cornerstone() calls below could be converted from that service locator pattern
    // to dependency injection by moving them into the constructor
    // Even better, it would be ideal if each dependency registered their own data from within the respective service instead of aggregating it all here. e.g. WPML
  }

  public function setArgs( $args) {
    $this->loadArgs = $args;
    return $this;
  }

  public function boot() {

    add_action('cs_save_document', function() {
      update_option( 'cs_last_save', current_time( 'mysql' ) );
    });

    add_filter('media_view_settings', function($settings) {
      $settings['defaultProps']['size'] = 'full';
      return $settings;
    });
    add_filter( 'template_include', '__return_empty_string', 999999 );

    remove_all_actions( 'wp_enqueue_scripts' );
    remove_all_actions( 'wp_print_styles' );
    remove_all_actions( 'wp_print_head_scripts' );

    do_action('cornerstone_before_boot_app');

    global $wp_styles;
    global $wp_scripts;

    $wp_styles = new \WP_Styles();
    $wp_scripts = new \WP_Scripts();

    if ( $this->preferences->get_preference('show_wp_toolbar') ) {
      add_action( 'add_admin_bar_menus', array( $this, 'update_admin_bar' ) );

      if ( !class_exists('WP_Admin_Bar') ) {
        _wp_admin_bar_init();
      }

      add_action('wp_enqueue_scripts_clean', array( $this, 'adminBarEnqueue' ));
      $this->show_admin_bar = true;
    } else {
      add_filter( 'show_admin_bar', '__return_false' );
    }

    $this->enqueue_styles();
    $this->enqueue_scripts();
    nocache_headers();

    // Favicon setup
    $favicon = null;
    if (apply_filters("cs_app_favicon_enabled", true) && defined("CS_ROOT_URL")) {
      $favicon = CS_ROOT_URL . "assets/img/cs-logo-white.ico";
      $favicon = apply_filters('cs_app_favicon', $favicon);
    }

    $this->view->name( 'app/boilerplate')->render(true, array(
      'theme' => $this->preferences->get_preference('ui_theme', 'light'),
      'body_classes' => $this->body_classes(),
      'title' => 'Cornerstone',
      'favicon' => $favicon,
    ) );
    exit;

  }

  public function enqueue_styles() {

    wp_register_style( 'cs-dashicons', '/wp-includes/css/dashicons.min.css' );
    wp_register_style( 'cs-editor-buttons', '/wp-includes/css/editor.min.css' );


    $app_style_asset = $this->cssAsset->get( "assets/css/app/app");
    wp_enqueue_style( 'cs-app-style', $app_style_asset['url'], array(
      'cs-dashicons',
      'cs-editor-buttons',
      'code-editor',
      'wp-auth-check'
    ), $app_style_asset['version'] );

    wp_enqueue_style( 'wp-auth-check' );

  }

  public function register_app_scripts($isPreview = false ) {

    $app_asset = $this->jsAsset->get('assets/js/app');
    $deps = array( 'wp-api-fetch', 'jquery', 'lodash', 'moment', 'react', 'react-dom' );

    if ($isPreview) {
      $deps[] = 'cs';
    }

    wp_register_script( 'cs-app', $app_asset['url'], $deps, $app_asset['version'], false );

    $worker_asset = $this->jsAsset->get('assets/js/worker');

    $data = [
      'isPreview'        => $isPreview,
      'featureFlags'     => apply_filters('tco_feature_flags', [] ),
      'fetch'            => $this->http->fetchConfig(),
      'ajaxUrl'          => $this->http->ajaxUrl(true),
      'renderDebounce'   => apply_filters( 'cornerstone_render_debounce', 350 ),
      'canGzip'          => $this->http->gzip(),
      '_cs_nonce'        => $this->http->createNonce(),
      'debug'            => defined('WP_DEBUG') && WP_DEBUG,
      'workerUrl'        => add_query_arg( array( 'v' => $worker_asset['version'] ), $worker_asset['url'] ),
      'breakpoints' => cornerstone('Breakpoints')->appData()
    ];

    if ( $isPreview ) {
      $data['preview'] = cornerstone( 'Preview' )->data();

      $grid_presets = function_exists('x_layout_grid_presets') ? x_layout_grid_presets() : [];
      foreach($grid_presets as $key => $preset ) {
        $grid_presets[$key]['values'] = $this->elements->migrations()->migrate( [$preset['values']] )[0];
      }

      $slider_presets = function_exists('x_layout_slider_presets') ? x_layout_slider_presets() : [];
      foreach($slider_presets as $key => $preset ) {
        $slider_presets[$key]['values'] = $this->elements->migrations()->migrate( [$preset['values']] )[0];
      }

      $data['gridPresets'] = $grid_presets;
      $data['sliderPresets'] = $slider_presets;

    } else {
      $data['app'] = apply_filters( 'cs_app_data', $this->get_app_data() );

      if ($this->http->gzip()) {
        $data['app'] = base64_encode( gzcompress( json_encode( $data['app'] ) ) );
      }
    }

    wp_localize_script( 'cs-app', 'csAppConfig', [ 'data' => $data ] );

  }

  public function get_app_data() {

    $text_editor_style_asset = $this->cssAsset->get( "assets/css/app/tinymce-content");

    $locator = cornerstone( 'Locator' );
    $resolver = cornerstone( 'Resolver' );
    $elementIcons = include( $this->plugin->path . '/includes/elements/icons.php' );
    IconRepository::setIcons($elementIcons);

    $resolver->migrateUntypedLayouts();

    //Only use home_url() for both single and multi-site
    $urlBase = parse_url(home_url(), PHP_URL_PATH); //Don't use one-line trim, parse_url can return NULL which will trigger notices and warning.
    $urlBase = empty( $urlBase ) || $urlBase == '/' ? '/' : '/'.trim( $urlBase , '/').'/';
    $urlBase = apply_filters("cs_app_url_base", $urlBase);

    return array(
      'urlBase'                   => $urlBase,
      'appSlug'                   => trim( cornerstone('Settings')->appSlug(), '/\\' ),
      'permalinks'                => $this->loadArgs['permalinks'],
      'dashboardUrl'              => apply_filters("cs_wordpress_dashboard_url", admin_url()),
      'dashboardUrlCanEdit'       => apply_filters("cs_wordpress_dashboard_url_can_edit", true),
      'date_format'               => get_option( 'date_format' ),
      'time_format'               => get_option( 'time_format' ),
      'siteTitle'                 => html_entity_decode(get_bloginfo( 'name' )),
      'isRTL'                     => is_rtl(),
      'homePageId'                => $this->get_home_page_id(),
      'countdownTBD'              => date( 'Y-m-d H:i:s', strtotime( current_time( 'mysql' ) ) + WEEK_IN_SECONDS),
      'faConfig'                  => cornerstone('FontAwesome')->config(),
      'home_url'                  => home_url('/'),
      'today'                     => date_i18n( get_option( 'date_format' ), time() ),
      'wpml'                      => $this->wpml->appData(),
      'validationUrl'             => apply_filters('_cs_validation_url', admin_url( 'admin.php?page=cornerstone-home' ) ),
      'siteUrl'                   => esc_attr( trailingslashit( network_home_url() ) ),
      'postStatuses'              => get_post_statuses(),
      'load_google_fonts'         => apply_filters('cs_load_google_fonts', true ),
      'max_action_history_items'  => apply_filters('cs_max_action_history_items', 1000 ),
      'themeOptionsData'          => cornerstone('ThemeOptions')->getValues(),
      'dev'                       => defined('CS_APP_DEV_TOOLS') && CS_APP_DEV_TOOLS,
      'devToolkit'                => cornerstone('DevToolkit')->getAppData(),
      'remoteAssets'              => cornerstone('RemoteAssets')->getAppData(),
      'socialShareOptions'        => $this->social->get_social_share_options(),
      'pageTemplates'             => $this->get_page_templates(),
      'defaultPageTemplate'       => apply_filters( 'cs_default_page_template', 'default' ),
      'defaultImageWidth'         => apply_filters( 'cs_default_image_width', 48 ),
      'defaultImageHeight'        => apply_filters( 'cs_default_image_height', 48 ),
      'lastSave'                  => get_option( 'cs_last_save' ),
      'jsHintConfig'              => apply_filters( 'cs_jshint_config', array( 'esversion' => 6, 'asi' => true ) ),
      'textEditorContentCss'      => $text_editor_style_asset['url'],
      'locatorLimit'              => $locator->get_limit(),
      'orderbyOptions'            => $locator->get_orderby_options(),

      'maxUploadFiles'            => ini_get( 'max_file_uploads' ),
      'maxUploadSize'             => wp_max_upload_size(),

      // Max
      // @TODO take out and utilize filter in a Max class
      'maxEnabled'                => apply_filters('cs_max_enabled', true),

      // These are shared with the preview frame via Redux
      'fonts'                     => cornerstone( 'GlobalFonts' )->getAppData(),
      'colors'                    => cornerstone('GlobalColors')->getAppData(),

      'themecoDomain'             => $this->getThemecoDomain(),

      // These can be refactored into late data via locator.js
      // 'assignmentContexts'     => $this->conditionals->get_assignment_contexts(),
      'conditionContexts'      => $this->conditionals->get_condition_contexts(),
      'previewContexts'        => $this->conditionals->get_preview_contexts(),

      // Still available via window.csAppData[key] but will only be generated
      // once and passed into the preview iframe client side
      'shared' => [
        'env'                         => cornerstone('Env')->envData(),
        'app_i18n'                    => $this->i18n->group( 'app' ),
        'common_i18n'                 => $this->i18n->group( 'common' ),
        'permissions'                 => cornerstone('Permissions')->getUserPermissions(),
        'current_user'                => get_current_user_id(),
        'keybindings'                 => $this->config->group( 'keybindings' ),
        'preferences'                 => $this->preferences->get_user_preferences(),
        'themeOptionsConfig'          => cornerstone('ThemeOptions')->get_config(),
        'tssConfig'                   => cornerstone('Tss')->previewConfig(),
        'documentTypes'               => $resolver->getPopulatedDocumentTypeGroups(),
        'rowPresets'                  => array(
          '100%',
          '50% 50%',
          '33.33% 33.33% 33.33%',
          '25% 25% 25% 25%',
          '33.33% 66.66%',
          '66.66% 33.33%',
          '25% 50% 25%',
          '25% 75%',
          '75% 25%',
        ),

        // this is also managed over redux, but the extended colors are not

        'colorsExtended'  => cornerstone('GlobalColors')->getExtended(),
        'elements'        => cornerstone('Elements')->get_element_definitions(),
        'components'      => cornerstone('Components')->appData(),
        'cIdPrefix'         => apply_filters('cs_component_id_generation_prefix', ''),
        'managedParameters' => ManagedParameters::managedTypes(),
        'elementIncludes' => cornerstone('Elements')->get_includes(),
        'elementIcons'    => $elementIcons, // 8kb
        'fontData'        => apply_filters( 'cs_font_data', [] ), // 23kb
      ]
    );
  }

  // This is available in the app as csAppDataLate
  // It can't be used in the preview because it is requested after the preview starts to load
  public function get_late_data() {

    do_action( 'cs_before_late_data' );

    return array(
      'preferenceControls'    => $this->preferences->get_preference_controls(), // 2kb
      'fontAwesome'           => cornerstone('FontAwesome')->getFontIconsData(), // 39kb
      'themeOptionsControls'  => cornerstone('ThemeOptions')->get_controls(), // 12kb
      'elementLibrary'        => cornerstone( 'ElementLibrary' )->get_library(), // 8kb
      'elementsInspectorData' => cornerstone('Elements')->get_element_inspector_data(), // 354kb
      'dynamicContentFields'   => cornerstone('DynamicContent')->get_dynamic_fields(),

      'assignmentContexts'     => $this->conditionals->get_assignment_contexts(),
      // 'conditionContexts'      => $this->conditionals->get_condition_contexts(),
      // 'previewContexts'        => $this->conditionals->get_preview_contexts(),
    );
  }

  // Main Max API
  public function get_late_expansion_data() {
    $code = get_option( 'cs_product_validation_key' );
    if (empty($code)) {
      $code = 'no-code';
    }
    //$code = 'BAD_CODE'; //Testing

    $url = $this->getThemecoDomain();
    $url .= '/api-v2/max-packages/' . $code;

    $request = wp_remote_get( $url, array( 'timeout' => 15 ) );

    if (is_a($request, \WP_Error::class)) {
      return [
        'errors' => [
          'api' => $request->errors
        ]
      ];
    }

    $data = @json_decode($request["body"], true);

    return $data;
  }

  public function getThemecoDomain() {
    return defined("THEMECO_DOMAIN")
      ? \THEMECO_DOMAIN
      : 'https://theme.co';
  }

  public function get_home_page_id() {
    if (get_option('show_on_front') === 'page') {
      return get_option('page_on_front');
    }
    return null;
  }



  public function get_page_templates() {

    $choices = array();
    $page_templates = wp_get_theme()->get_page_templates();
    ksort( $page_templates );

    $choices[] = array( 'value' => 'default', 'label' => apply_filters( 'default_page_template_title',  __( 'Default Template' ), 'cornerstone' ) );

    foreach ($page_templates as $value => $label) {
      $choices[] = array( 'value' => $value, 'label' => $label );
    }

    return $choices;

  }

  public function enqueue_scripts() {

    $this->prime_editor();

    $this->register_app_scripts();
    wp_enqueue_script( 'cs-app' );

    // Dependencies
    wp_enqueue_script( 'wp-auth-check' );
    wp_enqueue_script( 'csslint' );
    wp_enqueue_script( 'jshint' );
    wp_enqueue_script( 'jsonlint' );
    wp_enqueue_script( 'htmlhint' );
    wp_enqueue_script( 'code-editor' );
    wp_enqueue_media();
  }

  public function update_admin_bar() {
    remove_action( 'admin_bar_menu', 'wp_admin_bar_customize_menu', 40 );
  }

  public function body_classes() {

    $classes = array( 'no-customize-support' );

    if ( is_rtl() ) {
      $classes[] = 'rtl';
    }

    if ( $this->show_admin_bar ) {
      $classes[] = 'admin-bar';
    }

    if ( empty( $classes ) ) {
      return;
    }

    $classes = array_map( 'esc_attr', array_unique( $classes ) );
    $class = join( ' ', $classes );
    return "class=\"$class\"";

  }

  /**
   * Prepare the WordPress Editor (wp_editor) for use as a control
   * This thing does NOT like to be used in multiple contexts where it's added and removed dynamically.
   * We're creating some initial settings here to be used later.
   * Callings this function also triggers all the required styles/scripts to be enqueued.
   * @return none
   */
  public function prime_editor() {

    // Remove all 3rd party integrations to prevent plugin conflicts.
    remove_all_actions('before_wp_tiny_mce');
    remove_all_filters('mce_external_plugins');
    remove_all_filters('mce_buttons');
    remove_all_filters('mce_buttons_2');
    remove_all_filters('mce_buttons_3');
    remove_all_filters('mce_buttons_4');
    remove_all_filters('tiny_mce_before_init');
    add_filter( 'tiny_mce_before_init', '_mce_set_direction' );

    // Cornerstone's editor is modified, so we will allow visual editing for all users.
    add_filter( 'user_can_richedit', '__return_true' );

    if( apply_filters( 'cornerstone_use_br_tags', false ) ) {
      add_filter('tiny_mce_before_init', array( $this, 'allow_br_tags' ) );
    }

    // Allow integrations to use hooks above before the editor is primed.
    do_action('cornerstone_before_wp_editor');

    add_filter('mce_buttons', array( $this, 'mce_buttons' ) );

    ob_start();
    wp_editor( '%%PLACEHOLDER%%','cswpeditor', array(
      'quicktags' => false,
      'tinymce'=> array(
        'toolbar1' => 'bold,italic,strikethrough,underline,bullist,numlist,forecolor,cs_media,wp_adv',
        'toolbar2' => 'link,unlink,alignleft,aligncenter,alignright,alignjustify,outdent,indent',
        'toolbar3' => 'formatselect,pastetext,removeformat,charmap,superscript,subscript,undo,redo'
      ),
      'editor_class' => 'cs-wp-editor',
      'drag_drop_upload' => true
    ) );
    ob_end_clean();
  }

  public function mce_buttons( $buttons ) {
    $end = array_pop($buttons);
    array_push($buttons,'cs_media', $end);
    return $buttons;
  }

  /**
   * Depending on workflow, users may wish to allow <br> tags.
   * This can be conditionally enabled with a filter.
   * add_filter( 'cornerstone_use_br_tags', '__return_true' );
   */
  public function allow_br_tags( $init ) {
    $init['forced_root_block'] = false;
    return $init;
  }
}
