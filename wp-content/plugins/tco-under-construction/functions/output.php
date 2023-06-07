<?php

// =============================================================================
// FUNCTIONS/OUTPUT.PHP
// -----------------------------------------------------------------------------
// Plugin output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Under Construction
//   02. Output
// =============================================================================

// Under Construction
// =============================================================================

function get_user_IP() { //changed to eliminate warnings

    $client  = in_array( 'HTTP_CLIENT_IP', $_SERVER ) ? $_SERVER['HTTP_CLIENT_IP'] : '';
    $forward = in_array( 'HTTP_X_FORWARDED_FOR', $_SERVER ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }
    else{
        $ip = $remote;
    }

    return $ip == '::1' ? '127.0.0.1' : $ip ; //Allow it for localhost

}

function is_allowed_ip ( $allowed_ips ) {

    if ( isset( $allowed_ips ) && !empty( $allowed_ips ) ) {

      $allowed_ips = explode(' ', $allowed_ips);
      $user_ip = get_user_IP();

      return in_array( $user_ip, $allowed_ips);

    }

    return false;

}

function tco_under_construction_output( $original_template ) {

  require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

  if ( isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 && ! is_user_logged_in() ) {

    if( isset( $_COOKIE['tco_under_construction_bypass'] ) && $_COOKIE['tco_under_construction_bypass'] == $tco_under_construction_bypass_token ) {
      return $original_template;
    }

    if ( !empty($tco_under_construction_whitelist) && is_allowed_ip( $tco_under_construction_whitelist ) ) {

      return $original_template;

    }

    //Just remove Opengraph regardless of response code
    remove_action( 'wp_head', 'x_social_meta', 2 );

    if ( isset( $tco_under_construction_use_custom ) && $tco_under_construction_use_custom == 1 ) {
      return tco_under_construction_custom_output( $tco_under_construction_use_custom );
    } else {
      return TCO_UNDER_CONSTRUCTION_PATH . '/views/site/under-construction.php';
    }

  } else {

    return $original_template;

  }

}

function tco_under_construction_bypass_output () {

    require TCO_UNDER_CONSTRUCTION_PATH . '/views/site/bypass.php';

}


// Under Construction Custom Page
// =============================================================================

function tco_under_construction_custom_output( $original_template ) {

  require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

  $custom_post = get_post( (int) $tco_under_construction_custom );

  if ( ! is_a( $custom_post, 'WP_Post' ) ) {
    return $original_template;
  }

  GLOBAL $wp_query;
  GLOBAL $post;

  $post = $custom_post;

  $wp_query->posts             = array( $post );
  $wp_query->queried_object_id = $post->ID;
  $wp_query->queried_object    = $post;
  $wp_query->post_count        = 1;
  $wp_query->found_posts       = 1;
  $wp_query->max_num_pages     = 0;
  $wp_query->is_404            = false;
  $wp_query->is_page           = true;
  $wp_query->is_singular	     = true;

  if ( isset( $tco_under_construction_bypass_password ) && !empty ( $tco_under_construction_bypass_password ) ) {
    add_action( 'wp_footer', 'tco_under_construction_bypass_output' );
  }

  return get_page_template();
}



add_filter('cs_match_header_assignment', 'tco_under_construction_original_header');

function tco_under_construction_original_header( $match ) {

    require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );


    //Return the correct match if password or IP is allowed
    if( ( isset( $_COOKIE['tco_under_construction_bypass'] ) && $_COOKIE['tco_under_construction_bypass'] == $tco_under_construction_bypass_token ) || (!empty($tco_under_construction_whitelist) && is_allowed_ip( $tco_under_construction_whitelist ) ) || is_user_logged_in() ) {
      return $match;
    }

    // exit if under construction is disabled
    if(empty($tco_under_construction_enable))  {
       return $match;
    }

    // exit when user is logged in
    if(isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 && is_user_logged_in())  {
       return $match;
    }

    // exit if custom page is not used
    if(empty($tco_under_construction_use_custom)) {
        return $match;
    }

    // exit if custom page is not set
    if(empty($tco_under_construction_custom)) {
        return $match;
    }

    $header_assignments = null;

    // Pro V6
    if (class_exists('Themeco\Cornerstone\Services\Assignments')) {
      $header_assignments = CS()->novus('Assignments')->get_last_active_header();
    } else {
      // Prior to V6
      $header_assignments = class_exists('Cornerstone_Assignments')
        ? CS()->component('Assignments')->get_last_active_header()
        : CS()->component( 'Header_Assignments' )->get_assignments();
    }

    // check if page is a front page
    if(get_option('page_on_front') == $tco_under_construction_custom  && !empty($header_assignments['indexes']['front'])) {
        return $header_assignments['indexes']['front'];
    }

    // check specific post assignment
    if(!empty($header_assignments['posts']['post-' . $tco_under_construction_custom])) {
        return $header_assignments['posts']['post-' . $tco_under_construction_custom];
    }

    // check global assignment
    if(!empty($header_assignments['global'])) {
        return $header_assignments['global'];
    }

    // return default header
    return null;

}

add_filter('cs_match_footer_assignment', 'tco_under_construction_original_footer');
function tco_under_construction_original_footer($match) {
    require( TCO_UNDER_CONSTRUCTION_PATH . '/functions/options.php' );

    // exit if under construction is disabled
    if(empty($tco_under_construction_enable))  {
       return $match;
    }

    // exit when user is logged in
    if(isset( $tco_under_construction_enable ) && $tco_under_construction_enable == 1 && is_user_logged_in())  {
       return $match;
    }

    // exit if custom page is not used
    if(empty($tco_under_construction_use_custom)) {
        return $match;
    }

    // exit if custom page is not set
    if(empty($tco_under_construction_custom)) {
        return $match;
    }

    $footer_assignments = null;

    // V6
    if (class_exists('Themeco\Cornerstone\Services\Assignments')) {
      $footer_assignments = CS()->novus('Assignments')->get_last_active_footer();
    } else {
      // Prior to V6
      $footer_assignments = class_exists('Cornerstone_Assignments')
        ? CS()->component('Assignments')->get_last_active_footer()
        : CS()->component( 'Footer_Assignments' )->get_assignments();
    }

    // check if page is a front page
    if(get_option('page_on_front') == $tco_under_construction_custom && !empty($footer_assignments['indexes']['front'])) {
        return $footer_assignments['indexes']['front'];
    }

    // check specific post assignment first
    if(!empty($footer_assignments['posts']['post-' . $tco_under_construction_custom])) {
        return $footer_assignments['posts']['post-' . $tco_under_construction_custom];
    }

    // check global assignment
    if(!empty($footer_assignments['global'])) {
        return $footer_assignments['global'];
    }

    // return default footer
    return null;
}


// Output
// =============================================================================

add_filter( 'template_include', 'tco_under_construction_output', 99);
