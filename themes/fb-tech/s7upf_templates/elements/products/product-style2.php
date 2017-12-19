<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 21/04/2017
 * Time: 10:28
 */
$image_size  = s7upf_get_size_image('400x400',$image_size);
if(empty($col_layout)) $col_layout = '3';
$type = 'list';
$i=1;
if($pro_query->have_posts()){ ?>
    <div class="woocommerce  mb-element-product-<?php echo esc_attr($style); ?> <?php echo esc_attr($extra_class)?>">
        <?php
        if($order_by_show == 'on'){
            s7upf_shop_filter_html($pro_query,$orderby_shop,'list',$select_attributes,$title,$sort_by_price_product);
            if(isset($_GET['type'])){
                $type = $_GET['type'];
            }
        }
        if ('list' == $type){?>
            <div class="product-listview product">

                <?php  while ($pro_query->have_posts()) {
                    $pro_query->the_post(); global $product;
                    if($i%2==0){
                        $class_bg_img = S7upf_Assets::build_css('background:'.$bg_img_even.';');
                    }else{
                        $class_bg_img = S7upf_Assets::build_css('background:'.$bg_img_odd.';');
                    }?>
                    <div class="item-product item-product-list drop-shadow">
                        <div class="row">
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="product-thumb <?php echo esc_attr($class_bg_img); ?>">
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
                            </div>
                            <div class="col-md-8 col-sm-7 col-xs-12">
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
                    </div>
                <?php $i=$i+1; } ?>
            </div>
        <?php }else{ ?>

            <div class="product-gridview product">
                <div class="row">
                    <?php  while ($pro_query->have_posts()) {
                        $pro_query->the_post(); global $product;
                        if($i%2==0){
                            $class_bg_img = 'bg_even '.S7upf_Assets::build_css('background:'.$bg_img_even.';');
                        }else{
                            $class_bg_img = 'bg_odd '.S7upf_Assets::build_css('background:'.$bg_img_odd.';');
                        }?>
                        <div class="col-md-<?php echo esc_attr($col_layout); ?> col-sm-4 col-xs-6">
                            <div class="item-product text-center style1">
                                <div class="product-thumb <?php echo esc_attr($class_bg_img); ?>">
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
                        </div>

                    <?php  $i=$i+1; } ?>
                </div>
            </div>
        <?php } wp_reset_postdata(); ?>
    </div>
<?php }else{ ?>
    <h2 class="no-products color"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo esc_html__('No products were found matching your selection.','fb-tech'); ?></h2><?php
}

if($pagination == 'on'){ ?>
    <div class="pagi-nav text-center">
        <?php
        echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
            'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
            'format'       => '',
            'add_args'     => false,
            'current'      =>  max(1, $paged),
            'total'        => $pro_query->max_num_pages,
            'prev_text'    => '<i class="icon ion-ios-arrow-thin-left"></i>',
            'next_text'    => '<i class="icon ion-ios-arrow-thin-right"></i>',
            'type' => 'plain',
            'end_size'     => 3,
            'mid_size'     => 3,
        ) ) );
        ?>
    </div>
<?php }