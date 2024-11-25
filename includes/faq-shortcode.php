<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// FAQ Accordion Shortcode
function faq_info_instigator_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'category' => '',
    ), $atts, 'faq_info_instigator' );

    $args = array(
        'post_type'      => 'faq_info_instigator',
        'posts_per_page' => -1,
    );

    // Add category filter if specified
    if ( ! empty( $atts['category'] ) ) {
        $args['faq_category'] = sanitize_text_field( $atts['category'] );
    }

    $faqs_query = new WP_Query( $args );

    if ( $faqs_query->have_posts() ) {
        $output = '<div class="faq-info-instigator">';
        while ( $faqs_query->have_posts() ) {
            $faqs_query->the_post();
            $faq_thumbnail = ( has_post_thumbnail() ? 'faq-thumbnail' : '' );
            $output .= '<div id="faq" class="faq">';
            $output .= '<div class="faq-title"><h3>' . esc_html( get_the_title() ) . '</h3>
                <button class="faq-toggle">
                    <i class="fas fa-plus"></i>
                    <i class="fas fa-minus"></i>
                </button>
            </div>';
            $output .= '<div class="faq-content ' . esc_attr( $faq_thumbnail ) . '">';
            $output .= '<div class="faq-text">' . wp_kses_post( get_the_content() ) . '</div>';
            if ( has_post_thumbnail() ) {
                $output .= '<div class="faq-featured-image">' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '</div>';
            }
            $output .= '</div>'; // Close faq-content
            $output .= '</div>'; // Close faq
        }
        $output .= '</div>'; // Close faq-info-instigator
        wp_reset_postdata();
    } else {
        $output = '<p>' . esc_html__( 'No FAQs found.', 'text-domain' ) . '</p>';
    }

    return $output;
}
add_shortcode( 'faq_info_instigator', 'faq_info_instigator_shortcode' );

// FAQ Categories Shortcode
function faq_info_instigator_category_shortcode( $atts ) {
    $atts = shortcode_atts( array(), $atts, 'faq_info_instigator_categories' );

    $terms = get_terms( array(
        'taxonomy' => 'faq_category',
        'hide_empty' => false,
    ) );

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        $output = '<ul class="faq-info-instigator-categories">';
        foreach ( $terms as $term ) {
            $catDescription = ( !empty( $term->description ) ? ' cat-description' : '' );
            $output .= '<li class="' . esc_attr( $catDescription ) . '">';
            $output .= '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
            if ( ! empty( $term->description ) ) {
                $output .= '<p>' . esc_html( $term->description ) . '</p>';
            }
            $output .= '</li>';
        }
        $output .= '</ul>';
    } else {
        $output = '<p>' . esc_html__( 'No FAQ categories found.', 'text-domain' ) . '</p>';
    }

    return $output;
}
add_shortcode( 'faq_info_instigator_categories', 'faq_info_instigator_category_shortcode' );