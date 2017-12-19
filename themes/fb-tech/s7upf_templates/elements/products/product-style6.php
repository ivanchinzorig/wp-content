<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 23/09/2017
 * Time: 3:08 CH
 */
if(empty($itemscustom)) $itemscustom='[0,1],[560,2],[990,3]'; else $itemscustom= s7upf_base64decode($itemscustom);
$image_size  = s7upf_get_size_image('400x400',$image_size);

?>
<div class="featured-product-box3 mb-element-product-<?php echo esc_attr($style);?> <?php echo esc_attr($extra_class)?>">
    <?php if(!empty($title)){ ?>
        <h2 class="title-underline title30 text-uppercase font-bold"><?php echo esc_attr($title); ?></h2>
    <?php } ?>
    <?php if($pro_query->have_posts()){  $i = 1; $count_product= $pro_query->post_count; ?>
        <div class="product-slider3 product-slider woocommerce">
            <div class="wrap-item group-navi center-navi" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-navigation="<?php echo esc_attr($navigation)?>" data-pagination="<?php echo esc_attr($pagination_slider)?>" data-itemscustom="[<?php echo esc_attr($itemscustom)?>]">
                <?php while ($pro_query->have_posts()){
                    $pro_query->the_post(); global $product;
                    if($i%2==0){
                        $class_bg_img = 'bg_even '.S7upf_Assets::build_css('background:'.$bg_img_even.';');
                    }else{
                        $class_bg_img = 'bg_odd '.S7upf_Assets::build_css('background:'.$bg_img_odd.';');
                    }?>

                    <div class="item-product text-center style2">
                        <div class="product-thumb <?php echo esc_attr($class_bg_img)?>">
                            <?php s7upf_get_image_product_element($image_size,$default_image,$animation_img,$hide_mask_img); ?>
                            <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link product-ajax-popup"><?php echo esc_html__('Quick view','fb-tech'); ?></a>
                            <div class="product-label">
                                <?php
                                $enable_new = s7upf_get_option('s7upf_enable_new_product');
                                $day = s7upf_get_option('s7upf_number_day_new_product');
                                if('on' === $enable_new){
                                    echo s7upf_show_product_loop_new_badge($day,'<span class="new-label">','</span>');
                                }
                                ?>
                                <?php if ( $product->is_on_sale()) : ?>
                                    <span class="sale-label"><?php echo esc_html__('Sale','fb-tech')?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="product-info">
                            <?php
                            $terms = wp_get_post_terms( get_the_ID(), 'product_cat');
                            if(!empty($terms) and is_array($terms))
                                foreach($terms as $key=>$term){
                                    if($key == 0){?>
                                        <a class="cat-parent color" href="<?php echo esc_url(get_term_link($term->slug,'product_cat')); ?>"><?php echo esc_attr($term->name); ?></a>
                                    <?php } else{ ?>
                                        , <a class="cat-parent color" href="<?php echo esc_url(get_term_link($term->slug,'product_cat')); ?>"><?php echo esc_attr($term->name); ?></a>
                                    <?php }
                                } ?>
                            <h3 class="title16 font-bold product-title"><a href="<?php echo the_permalink()?>"><?php echo the_title(); ?></a></h3>

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

                    <?php $i = $i+1; } wp_reset_postdata();  ?>

            </div>
        </div>
    <?php } ?>
</div>