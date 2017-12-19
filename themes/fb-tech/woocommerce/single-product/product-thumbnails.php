<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $product;
$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
$attachment_ids = $product->get_gallery_image_ids();
if ( $attachment_ids ) {
    foreach ( $attachment_ids as $key=>$attachment_id ) {
        $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
        $thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
        $attributes      = array(
            'title'                   => get_post_field( 'post_title', $attachment_id ),
            'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
            'data-src'                => $full_size_image[0],
            'data-large_image'        => $full_size_image[0],
            'data-large_image_width'  => $full_size_image[1],
            'data-large_image_height' => $full_size_image[2],
        );
$active='';
if(!has_post_thumbnail() and $key == 0)$active='active';
        $html  = '<li data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a class="'.$active.'" href="' . esc_url( $full_size_image[0] ) . '">';
        $html .= wp_get_attachment_image( $attachment_id, $thumbnail_size, false, $attributes );
        $html .= '</a></li>';

        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
    }
}