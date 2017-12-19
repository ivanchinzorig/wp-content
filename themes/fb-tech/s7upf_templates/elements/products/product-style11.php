<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 25/09/2017
 * Time: 2:02 CH
 */
$vip_args = array();
if(empty($itemscustom)) $itemscustom='[0,1],[480,2],[768,3],[990,4]'; else $itemscustom= s7upf_base64decode($itemscustom);
$image_size  = s7upf_get_size_image('258x258',$image_size);
if(empty($position_tab_active)) $position_tab_active = 1;
$time = s7upf_get_deals_time();

if(!empty($data_item_tab) and is_array($data_item_tab)){ ?>
    <div class="product-tab-box product-block7 woocommerce mb-element-product-<?php echo esc_attr($style); ?> <?php echo esc_attr($extra_class)?>">

        <ul class="title-best-tab list-inline-block text-uppercase font-bold">
            <?php foreach ($data_item_tab as $key => $value){
                if($key +1 == (int)$position_tab_active) $class_active = 'active'; else $class_active =''; ?>
                <li class="<?php echo esc_attr($class_active); ?>"><a class="shop-button bg-color rect" href="#tab-vip<?php echo esc_attr($key); echo esc_attr($time); ?>" data-toggle="tab"><?php if(!empty($value['title'])) echo esc_attr($value['title']); ?></a></li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <?php
            foreach ($data_item_tab as $key => $value){
                $link ='';
                if($key +1 == $position_tab_active) $class_active = 'active'; else $class_active =''; ?>
                <div id="tab-vip<?php echo esc_attr($key); echo esc_attr($time); ?>" class="tab-pane fade in <?php echo esc_attr($class_active); ?>">
                    <div class="product-slider">
                        <div class="wrap-item group-navi" data-pagination="<?php echo esc_attr($pagination_slider); ?>" data-navigation="<?php echo esc_attr($navigation)?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-itemscustom="[<?php echo esc_attr($itemscustom)?>]">
                            <?php
                            if(empty($value['product_number'])) $value['product_number']=12;
                            if ($value['order_by'] == 'best_seller') {
                                $vip_args = array(
                                    'post_type' => 'product',
                                    'meta_key' => 'total_sales',
                                    'orderby' => 'meta_value_num',
                                    'post_status'    => 'publish',
                                    'order' => $value['order'],
                                    'posts_per_page' => $value['product_number']
                                );
                            } elseif ($value['order_by'] == 'top_rating') {
                                $vip_args = array(
                                    'post_type' => 'product',
                                    'post_status'    => 'publish',
                                    'posts_per_page' => $value['product_number'],
                                    'meta_key' => '_wc_average_rating',
                                    'orderby'        => 'meta_value_num',
                                    'order'          => $value['order'],
                                    'meta_query'     => WC()->query->get_meta_query(),
                                    'tax_query'      => WC()->query->get_tax_query(),
                                );
                                $vip_args['meta_query'] = WC()->query->get_meta_query();
                            } elseif ($value['order_by'] == 'mostview'){
                                $vip_args = array(
                                    'post_type' => 'product',
                                    'post_status'    => 'publish',
                                    'posts_per_page' => $value['product_number'],
                                    'meta_key'           => 'post_views',
                                    'order'             => $value['order'],
                                    'orderby'             => 'meta_value_num',
                                );
                            } else {
                                $vip_args = array(
                                    'post_type' => 'product',
                                    'post_status'    => 'publish',
                                    'orderby' => $value['order_by'],
                                    'order' => $value['order'],
                                    'posts_per_page' => $value['product_number'],
                                );
                            }

                            // filter by category
                            if (!empty($value['product_category'])) {
                                $list_cat = explode(",", $value['product_category']);
                                if ($list_cat[0] != '') {
                                    $vip_args['tax_query'][] = array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'slug',
                                        'terms' => $list_cat,
                                    );
                                }
                            }

                            // filter product is trending now
                            if (!empty($value['trending_now']) and $value['trending_now'] == 'yes') {
                                $vip_args['meta_query'][] = array(
                                    'key' => 'trending_now',
                                    'value' => 'yes',
                                    'compare' => 'LIKE'
                                );
                            }

                            // Filter product by feature
                            if (!empty($value['pro_feature']) and $value['pro_feature'] == 'yes') {
                                $vip_args['tax_query'][] = array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'featured',
                                    'operator' => 'IN',
                                );
                            }
                            if (!empty($value['pro_sale']) and $value['pro_sale'] == 'yes') {
                                $vip_args['post__in'] = array_unique( wc_get_product_ids_on_sale());
                            }
                            $vip_query = new WP_Query($vip_args);
                            $count_post = $vip_query->post_count;
                            $i = 1; $j=1; $k=1;
                            $class_bg_even = 'bg_even '.S7upf_Assets::build_css('background:'.$bg_img_even.';');
                            $class_bg_odd = 'bg_odd '.S7upf_Assets::build_css('background:'.$bg_img_odd.';');
                            if(empty($number_row)) $number_row = 1;
                            if($vip_query->have_posts()) {
                                while($vip_query->have_posts()) {
                                    $vip_query->the_post(); global $product; $class_bg_img='';?>
                                    <?php
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

                                    } ?>
                                    <?php if($i % (int)$number_row == 1  || $count_post == 1|| $number_row == 1) echo '<div class="item">'; ?>
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
                                    <?php if($i % (int)$number_row  == 0 || $i == $count_post  || $count_post == 1 || $number_row == 1) echo '</div>';
                                    $i=$i+1; if($i % (int)$number_row == 1 ) $j++; ?>
                                    <!-- End Item -->
                                <?php } wp_reset_postdata();
                            } ?>
                        </div>
                    </div>
                </div>
                <!-- End Tab -->
            <?php } ?>
        </div>
    </div>
    <?php
}
