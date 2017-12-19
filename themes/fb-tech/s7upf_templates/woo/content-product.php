<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 18/09/2017
 * Time: 2:03 CH
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $product;
global $post;
$type = 'grid';
$type = s7upf_get_option('woo_style_view_way_product');
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
$default_image = get_template_directory_uri().'/assets/images/no-thumb/placeholder.png';
$image_size = s7upf_get_option('s7upf_custom_size_image_list');
$image_size  = s7upf_get_size_image('300x300',$image_size);
$word_excerpt = s7upf_get_option('s7upf_word_excerpt_product',20);
$terms = wp_get_post_terms( get_the_ID(), 'product_cat');
if('list' === $type){ ?>
    <div class="row">
        <div class="col-md-4 col-sm-5 col-xs-12">
            <div class="product-thumb">
                <a href="<?php the_permalink(); ?>" class="product-thumb-link zoom-thumb">
                    <?php
                    if ( has_post_thumbnail() ) {
                        $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
                        echo get_the_post_thumbnail( $post->ID, $image_size, array(
                            'title'	 => $props['title'],
                            'alt'    => $props['alt'],
                        ) );
                    }  else {
                        $dimensions = wc_get_image_size( $image_size ); ?>
                        <img src="<?php echo esc_url($default_image); ?>" width="<?php echo esc_attr( $dimensions['width'] ) ?> " height="<?php echo esc_attr( $dimensions['height'] ) ?> "  alt="<?php esc_html_e('Image Default','fb-tech')?>" title="<?php esc_html_e('product','fb-tech')?>" />
                        <?php
                    } ?>
                </a>
                <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link product-ajax-popup"><?php echo esc_html__('Quick view','fb-tech'); ?></a>
               <?php s7up_get_label_new_sale_product(); ?>
            </div>
        </div>
        <div class="col-md-8 col-sm-7 col-xs-12">
            <div class="product-info">
                <?php
                if(!empty($terms) and is_array($terms))
                    foreach($terms as $key=>$term){
                        if($key == 0){?>
                            <a class="cat-parent color" href="<?php echo esc_url(get_term_link($term->slug,'product_cat')); ?>"><?php echo esc_attr($term->name); ?></a>
                        <?php } else{ ?>
                            , <a class="cat-parent color" href="<?php echo esc_url(get_term_link($term->slug,'product_cat')); ?>"><?php echo esc_attr($term->name); ?></a>
                        <?php }
                    } ?>
                <h3 class="title16 font-bold product-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
                <div class="product-price">
                    <?php woocommerce_template_loop_price(); ?>
                </div>
                <?php echo s7upf_get_rating_html();
                    if($word_excerpt !== '0' and has_excerpt( get_the_ID())){ ?>
                    <div class="desc product-desc"><?php
                        echo wp_trim_words( get_the_excerpt(), (int)$word_excerpt , '...' ); ?>
                    </div>
                <?php } ?>
                <div class="product-extra-link style1">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                    <?php echo s7up_wishlist_url(); ?>
                    <?php echo s7upf_compare_url(); ?>

                </div>
            </div>
        </div>
    </div>

    <?php
}else{ ?>
    <div class="item-product text-center style1">
        <div class="product-thumb">
            <a href="<?php the_permalink(); ?>" class="product-thumb-link bg-cyan zoom-thumb">
                <?php
                if ( has_post_thumbnail() ) {
                    $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
                    echo get_the_post_thumbnail( $post->ID, $image_size, array(
                        'title'	 => $props['title'],
                        'alt'    => $props['alt'],
                    ) );
                }  else {
                    $dimensions = wc_get_image_size( $image_size ); ?>
                    <img src="<?php echo esc_url($default_image); ?>" width="<?php echo esc_attr( $dimensions['width'] ) ?> " height="<?php echo esc_attr( $dimensions['height'] ) ?> "  alt="<?php esc_html_e('Image Default','fb-tech')?>" title="<?php esc_html_e('product','fb-tech')?>" />
                    <?php
                } ?>
            </a>
            <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link product-ajax-popup"><?php echo esc_html__('Quick view','fb-tech'); ?></a>
            <?php s7up_get_label_new_sale_product(); ?>
        </div>
        <div class="product-info">
            <?php
            if(!empty($terms) and is_array($terms))
                foreach($terms as $key=>$term){
                    if($key == 0){?>
                        <a class="cat-parent color" href="<?php echo esc_url(get_term_link($term->slug,'product_cat')); ?>"><?php echo esc_attr($term->name); ?></a>
                    <?php } else{ ?>
                        , <a class="cat-parent color" href="<?php echo esc_url(get_term_link($term->slug,'product_cat')); ?>"><?php echo esc_attr($term->name); ?></a>
                    <?php }
                } ?>
            <h3 class="title16 font-bold product-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
            <div class="product-price">
                <?php woocommerce_template_loop_price(); ?>
            </div>
            <div class="product-extra-link style1">
                <?php echo s7up_wishlist_url(); ?>
                <?php woocommerce_template_loop_add_to_cart(); ?>
                <?php echo s7upf_compare_url(); ?>
            </div>
            <?php echo s7upf_get_rating_html();?>
        </div>
    </div>
    <?php
}