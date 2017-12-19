<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 23/09/2017
 * Time: 3:08 CH
 */
$image_size  = s7upf_get_size_image('400x400',$image_size);
?>
<div class="featured-product8 mb-element-product-<?php echo esc_attr($style);?> <?php echo esc_attr($extra_class)?>">
    <?php if(!empty($title)){ ?>
        <h2 class="title24 font-bold text-upercase title-underline"><?php echo esc_attr($title); ?></h2>
    <?php } ?>
    <?php if($pro_query->have_posts()){ ?>
        <div class="featured8-slider slider-slick woocommerce">
            <div class="slick center">
                <?php while ($pro_query->have_posts()){
                    $pro_query->the_post(); global $product;

                    ?>
                    <div class="item-slick">
                        <div class="item-product style4">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="product-thumb">
                                        <?php s7upf_get_image_product_element($image_size,$default_image,$animation_img,$hide_mask_img); ?>
                                        <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link product-ajax-popup"><?php echo esc_html__('Quick view','fb-tech'); ?></a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                        <h3 class="title16 font-bold product-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                                         <div class="product-price">
                                            <?php woocommerce_template_loop_price(); ?>
                                        </div>
                                        <?php if($word_excerpt !== '0' and has_excerpt( get_the_ID())){ ?>
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
                        </div>
                    </div>

                  <?php }
                wp_reset_postdata();  ?>

            </div>
        </div>
    <?php } ?>
</div>