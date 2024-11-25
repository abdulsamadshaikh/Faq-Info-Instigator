<?php
// FAQ Taxonomies
function faq_info_instigator_register_taxonomy() {
    $args = array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => 'FAQ Categories',
            'singular_name'     => 'FAQ Category',
            'search_items'      => 'Search FAQ Categories',
            'all_items'         => 'All FAQ Categories',
            'parent_item'       => 'Parent FAQ Category',
            'parent_item_colon' => 'Parent FAQ Category:',
            'edit_item'         => 'Edit FAQ Category',
            'update_item'       => 'Update FAQ Category',
            'add_new_item'      => 'Add New FAQ Category',
            'new_item_name'     => 'New FAQ Category Name',
            'menu_name'         => 'Categories',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'faq-category' ),
    );
    register_taxonomy( 'faq_category', 'faq_info_instigator', $args );
}
add_action( 'init', 'faq_info_instigator_register_taxonomy' );
