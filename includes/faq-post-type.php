<?php
function faq_info_instigator_register_post_type() {
    $labels = array(
        'name'                  => 'FAQ Instigators',
        'singular_name'         => 'FAQ Instigator',
        'add_new'               => 'Add New FAQ',
        'add_new_item'          => 'Add New FAQ',
        'edit_item'             => 'Edit FAQ',
        'new_item'              => 'New FAQ',
        'view_item'             => 'View FAQ',
        'search_items'          => 'Search FAQs',
        'not_found'             => 'No FAQs found',
        'not_found_in_trash'    => 'No FAQs found in Trash',
        'all_items'             => 'All FAQs',
        'menu_name'             => 'FAQ Instigators',
        'name_admin_bar'        => 'FAQ Instigator'
    );

   $args = array(
        'labels'             => $labels,
        'public'             => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'menu_icon'          => 'dashicons-editor-help', // Dashicons icon for FAQs
        'rewrite'            => array( 'slug' => 'faq' ),
        'publicly_queryable' => true,
        'exclude_from_search'=> false,
        'capability_type'    => 'post',
    );
    register_post_type( 'faq_info_instigator', $args );
}
add_action( 'init', 'faq_info_instigator_register_post_type' );