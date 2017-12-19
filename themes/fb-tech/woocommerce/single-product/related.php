<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
$itemscustom='3';
$sidebar_pos = s7upf_get_sidebar();
if($sidebar_pos['position'] == 'no') $itemscustom = '4';
$show_related = s7upf_get_option('s7upf_show_related_product_detail');
$title_related = s7upf_get_option('s7upf_title_related_product');
$default_image = get_template_directory_uri().'/assets/images/no-thumb/placeholder.png';
$image_size = s7upf_get_option('s7upf_custom_size_image_list');
$image_size  = s7upf_get_size_image('300x300',$image_size);

if ( $related_products and $show_related == 'on') : ?>
    <div class="product-related product-related-css <?php if(empty($title_related)) echo'no-title'; ?>">
        <?php if(!empty($title_related)) {?>
            <h2 class="title24 font-bold"><span><?php echo esc_attr($title_related); ?></span></h2>
        <?php } ?>
        <div class="product-trend-slider">
            <div class="wrap-item group-navi" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1],[560,2],[768,3],[990,<?php echo esc_attr($itemscustom); ?>]]">
                <?php foreach ( $related_products as $related_product ) :
                    $post_object = get_post( $related_product->get_id() );
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    $terms = wp_get_post_terms( $related_product->get_id(), 'product_cat');
                    $attachment_ids = $related_product->get_gallery_image_ids(); ?>
                    <div class="item-product text-center style1">
                        <div class="product-thumb">
                            <a href="<?php the_permalink(); ?>" class="product-thumb-link zoom-thumb">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $related_product );
                                    echo get_the_post_thumbnail( $related_product->get_id(), $image_size, array(
                                        'title'	 => $props['title'],
                                        'alt'    => $props['alt'],
                                    ) );
                                }  else {
                                    $dimensions = wc_get_image_size( $image_size ); ?>
                                    <img src="<?php echo esc_url($default_image); ?>" width="<?php echo esc_attr( $dimensions['width'] ) ?> " height="<?php echo esc_attr( $dimensions['height'] ) ?> "  alt="<?php esc_html_e('Image Default','fb-tech')?>" title="<?php esc_html_e('product','fb-tech')?>" />
                                    <?php
                                }?>
                            </a>
                            <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link title14 product-ajax-popup"><?php echo esc_html__('Quick View','fb-tech')?></a>
                        </div>
                        <div class="product-info">
                            <?php
                            if(!empty($terms) and is_array($terms))
                                foreach($terms as $term){ ?>
                                    <a href="<?php echo esc_url(get_term_link($term->slug,'product_cat')); ?>" class="cat-parent color"><?php echo esc_attr($term->name); ?></a>
                                <?php } ?>
                            <h3 class="title16 font-bold product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="product-price">
                                <?php woocommerce_template_loop_price(); ?>
                            </div>
                            <div class="product-extra-link style1">
                                <?php echo s7up_wishlist_url(); ?>
                                <?php woocommerce_template_loop_add_to_cart();?>
                                <?php echo s7upf_compare_url(); ?>
                            </div>
                            <?php echo s7upf_get_rating_html();?>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
endif;
wp_reset_postdata();