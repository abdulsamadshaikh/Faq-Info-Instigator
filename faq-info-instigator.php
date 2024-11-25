<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*
Plugin Name: FAQ Info Instigator
Description: Easily create and manage FAQs on your WordPress site. Display FAQs with a shortcode on post or dedicated pages.
Version: 1.0.0
Author: Abdul Samad
Author URI: https://getabdulsamad.com
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: faq-info-instigator
*/

// Include necessary files
require_once plugin_dir_path( __FILE__ ) . 'includes/faq-post-type.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/faq-taxonomy.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/faq-shortcode.php';

// Enqueue Style and Script
function enqueue_faq_info_instigator_assets() {
    // Enqueue style CSS file
    wp_enqueue_style('faq_info_instigator', plugin_dir_url(__FILE__) . 'assets/css/styles.css', array(), '1.0');
    // Enqueue Font Awesome
    wp_enqueue_style('faq-info-instigator-font-awesome', plugin_dir_url(__FILE__) . 'assets/css/font-awesome.all.min.css', array(), '5.15.4');
    // Enqueue script JS file
    wp_enqueue_script('faq-info-instigator', plugin_dir_url(__FILE__) . 'assets/js/scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_faq_info_instigator_assets');

// Modify search query to include FAQ post type
function faq_info_instigator_search( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( $query->is_search ) {
            $query->set( 'post_type', array( 'post', 'page', 'faq_info_instigator' ) );
        }
    }
    return $query;
}
add_filter( 'pre_get_posts', 'faq_info_instigator_search' );
