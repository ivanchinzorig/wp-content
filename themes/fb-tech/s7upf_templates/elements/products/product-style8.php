<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 23/09/2017
 * Time: 2:14 CH
 */
if(empty($itemscustom)) $itemscustom='[0,1],[560,2],[767,3],[1200,4],[1400,5],[1600,6]'; else $itemscustom= s7upf_base64decode($itemscustom);
$get_image_size  = s7upf_get_size_image('268x268',$image_size);

if(empty($number_row)) $number_row = 1;
$class_bg_even = 'bg_even '.S7upf_Assets::build_css('background:'.$bg_img_even.';');
$class_bg_odd = 'bg_odd '.S7upf_Assets::build_css('background:'.$bg_img_odd.';');
?>
<div class="best-seller8 mb-element-product-<?php echo esc_attr($style);?>  <?php echo esc_attr($extra_class)?>">
    <?php if(!empty($title) || $select_filter_box == 'on'){ ?>
        <ul class="list-inline-block title-best-sale8">
            <?php if(!empty($title)){ ?>
            <li><h2 class="title24 font-bold text-uppercase"><?php echo esc_attr($title); ?></h2></li>
            <?php } ?>
            <?php if($select_filter_box == 'on'){ ?>
            <li>
                <div class="select-box select-filter gray select-product-ajax" data-args="<?php  echo esc_attr(json_encode(array('args'=>$args)))?>" data-hide_mask_img = '<?php echo esc_attr($hide_mask_img)?>' data-animation_img = '<?php echo esc_attr($animation_img)?>' data-image_size = '<?php echo esc_attr($image_size)?>' data-number_row = '<?php echo esc_attr($number_row)?>' data-bg_img_odd = '<?php echo esc_attr($bg_img_odd)?>' data-bg_img_even = '<?php echo esc_attr($bg_img_even)?>'>
                    <select>
                        <option value=""><?php esc_html_e('Filter','fb-tech')?></option>
                        <option value="price_asc"><?php esc_html_e('Price Low','fb-tech')?></option>
                        <option value="price_desc"><?php esc_html_e('Price High','fb-tech')?></option>
                        <option value="title_asc"><?php esc_html_e('A - Z','fb-tech')?></option>
                        <option value="title_desc"><?php esc_html_e('Z - A','fb-tech')?></option>
                    </select>
                </div>
            </li>
            <li><i class="icon-load fa-spin fa " aria-hidden="true"></i></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <?php if($pro_query->have_posts()){   $i = 1; $j=1; $k=1; $count_product= $pro_query->post_count; ?>
        <div class="product-slider8 product-slider woocommerce">
            <div class="wrap-item group-navi product-load-filter" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-navigation="<?php echo esc_attr($navigation)?>" data-pagination="<?php echo esc_attr($pagination_slider)?>" data-itemscustom="[<?php echo esc_attr($itemscustom)?>]">
                <?php while ($pro_query->have_posts()){
                    $pro_query->the_post(); global $product;
                    if($j %2 == 1 ){
                        if($i%2==0){
                            $class_bg_img = $class_bg_even;
                        }else{
                            $class_bg_img = $class_bg_odd;
                        }
                    }else{
                        if($k%2 == 1){
                            $class_bg_img = $class_bg_even;
                        }else{
                            $class_bg_img = $class_bg_odd;
                        }
                        if($k>=(int)$number_row) $k = 1;
                        else $k++;

                    }?>
                    <?php if($i % (int)$number_row == 1  || $count_product == 1|| $number_row == 1) echo '<div class="item">'; ?>
                    <div class="item-product text-center style1">
                        <div class="product-thumb <?php echo esc_attr($class_bg_img); ?>">
                            <?php s7upf_get_image_product_element($get_image_size,$default_image,$animation_img,$hide_mask_img); ?>
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
                    <?php if($i % (int)$number_row  == 0 || $i == $count_product  || $count_product == 1 || $number_row == 1) echo '</div>'; ?>
                    <?php $i=$i+1;
                    if($i % (int)$number_row == 1 ) $j++;
                } wp_reset_postdata();  ?>

            </div>
        </div>
    <?php  } ?>
</div>