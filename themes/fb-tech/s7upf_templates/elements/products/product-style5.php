<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 23/09/2017
 * Time: 3:08 CH
 */
if(empty($itemscustom)) $itemscustom='[0,1],[560,2],[990,1]'; else $itemscustom= s7upf_base64decode($itemscustom);
$image_size  = s7upf_get_size_image('120x120',$image_size);
if(empty($number_row)) $number_row = 3;
?>
<div class="box-product-type mb-element-product-<?php echo esc_attr($style);?> <?php echo esc_attr($extra_class)?>">
    <?php if(!empty($title)){ ?>
        <h2 class="title18 text-uppercase font-bold title-line-after"><?php echo esc_attr($title); ?></h2>
    <?php } ?>
    <?php if($pro_query->have_posts()){  $i = 1; $count_product= $pro_query->post_count; ?>
        <div class="product-type-slider woocommerce">
            <div class="wrap-item group-navi" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-navigation="<?php echo esc_attr($navigation)?>" data-pagination="<?php echo esc_attr($pagination_slider)?>" data-itemscustom="[<?php echo esc_attr($itemscustom)?>]">
                <?php while ($pro_query->have_posts()){
                    $pro_query->the_post(); global $product;
                    if($i%2==0){
                        $class_bg_img = 'bg_even '.S7upf_Assets::build_css('background:'.$bg_img_even.';');
                    }else{
                        $class_bg_img = 'bg_odd '.S7upf_Assets::build_css('background:'.$bg_img_odd.';');
                    }?>
                    <?php if($i % (int)$number_row == 1  || $count_product == 1|| $number_row == 1) echo '<div class="item">'; ?>

                    <div class="item-product-type table">
                        <div class="product-thumb <?php echo esc_attr($class_bg_img); ?>">
                            <?php s7upf_get_image_product_element($image_size,$default_image,$animation_img,$hide_mask_img); ?>
                        </div>
                        <div class="product-info">
                            <h3 class="title14"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
                            <div class="product-price">
                                <?php woocommerce_template_loop_price(); ?>
                            </div>
                        </div>
                    </div>
                    <?php if($i % (int)$number_row  == 0 || $i == $count_product  || $count_product == 1 || $number_row == 1) echo '</div>'; ?>

                    <?php   $i=$i+1; } wp_reset_postdata();  ?>

            </div>
        </div>
    <?php } ?>
</div>
