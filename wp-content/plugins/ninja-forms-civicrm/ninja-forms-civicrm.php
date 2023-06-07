<?php
/*
Plugin Name: Ninja Forms - CiviCRM
Description: Ninja Forms integration with CiviCRM
Version: 3.0.1
Author: Saturday Drive
Text Domain: ninja-forms-civicrm
Domain Path: /lang/

Release Description: Upcoming Release
Copyright 2021 WP Ninjas.
*/
add_action('plugins_loaded', 'nf_civicrm_plugins_loaded', 0);

function nf_civicrm_plugins_loaded()
{
   
    if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
        if (class_exists('Ninja_Forms')) {
            include_once __DIR__ . '/bootstrap.php';
        } else {
            //Ninja Forms is not active
        }
    } else {
        //add_action('admin_notices', 'nf_civicrm_php_nag');
    }
}

add_action( 'admin_init', 'nf_civicrm_setup_license' );

function nf_civicrm_setup_license()
    {
        if ( ! class_exists( 'NF_Extension_Updater' ) ) return;

        new NF_Extension_Updater( 'Ninja Forms CiviCRM', '3.0.1', 'Saturday Drive', __FILE__, 'ninja-forms-civicrm' );
    }