<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 6/13/17
 * Time: 1:46 PM
 */
if ( !class_exists('WC_Product') ) {
    return;
}
if(!function_exists('s7upf_vc_products'))
{
    function s7upf_vc_products($attr,$content = false)
    {
        $html = $style =$trending_now= $select_filter_box =$word_excerpt =$number_row=$pagination_slider= $navigation=$class  = $orderby_shop = $order_by_show =$extra_class  = $add_item_tab = $data_item_tab = $position_tab_active = $pagination = $title = $animation_img  = $secondary_color = $class_secondary_color = $col_layout = $main_color = $class_main_color = $itemscustom = $autoplay = $product_number =$order = $image_size = $order_by =$product_category = $select_tab = $pro_sale=  $filter_type = $pro_feature = $max_price = $min_price = '';
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'product_number'     => '12',
            'order_by' => 'date',
            'product_category' => '',
            'order' => 'DESC',
            'min_price'    => '',
            'max_price'    => '',
            'filter_type'    => '',
            'pro_feature'    => '',
            'pro_sale'    => '',
            'select_tab'    => '',
            'image_size'     => '',
            'word_excerpt'     => '30',
            'autoplay'     => 'true',
            'navigation'     => 'true',
            'pagination_slider'     => 'false',
            'itemscustom'     => '',
            'col_layout'     => '',
            'animation_img'     => 'animation_default',
            'title'     => '',
            'pagination'     => '',
            'position_tab_active'     => 1,
            'add_item_tab'     => '',
            'extra_class'     => '',
            'order_by_show'     => 'off',
            'number_row'     => '',
            'hide_mask_img'     => '',
            'select_attributes'     => '',
            'sort_by_price_product'     => '',
            'trending_now'     => 'no',
            'image_size_featured'     => '',
            'navigation_center'     => '',
            'bg_img_even'     => '',
            'bg_img_odd'     => '',
            'select_filter_box'     => '',

        ),$attr));
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        if(isset($_GET['number'])){
            $product_number = $_GET['number'];
        }
        if(!empty($add_item_tab))
            $data_item_tab = vc_param_group_parse_atts($add_item_tab);
        if ($order_by == 'popularity') {
            $args = array(
                'post_type' => 'product',
                'meta_key' => 'total_sales',
                'orderby' => 'meta_value_num',
                'post_status'    => 'publish',
                'paged'             => $paged,
                'order' => $order,
                'posts_per_page' => $product_number
            );
        } elseif ($order_by == 'rating') {
            $args = array(
                'post_type' => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => $product_number,
                'meta_key' => '_wc_average_rating',
                'orderby'        => 'meta_value_num',
                'paged'             => $paged,
                'order'          => $order,
                'meta_query'     => WC()->query->get_meta_query(),
                'tax_query'      => WC()->query->get_tax_query(),
            );
            $args['meta_query'] = WC()->query->get_meta_query();
        } elseif ($order_by == 'mostview'){
            $args = array(
                'post_type' => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => $product_number,
                'meta_key'           => 'post_views',
                'order'             => $order,
                'orderby'             => 'meta_value_num',
            );
        } elseif ($order_by == 'price'){
            $args['orderby']  = "meta_value_num ID";
            $args['order']    = $order;
            $args['meta_key'] = '_price';
        }  else {
            $args = array(
                'post_type' => 'product',
                'post_status'    => 'publish',
                'orderby' => $order_by,
                'order' => $order,
                'posts_per_page' => $product_number,
                'paged'             => $paged,
            );
        }
        if(isset($_GET['orderby'])){
            $orderby_shop = $_GET['orderby'];
        }
        switch ($orderby_shop) {
            case 'price' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'ASC';
                $args['meta_key'] = '_price';
                break;

            case 'price-desc' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'DESC';
                $args['meta_key'] = '_price';
                break;

            case 'popularity' :
                $args['meta_key'] = 'total_sales';
                $args['order']    = 'DESC';
                add_filter( 'posts_clauses', array( WC()->query, 'order_by_popularity_post_clauses' ) );
                break;

            case 'rating' :
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                $args['meta_query'] = WC()->query->get_meta_query();
                $args['tax_query'][] = WC()->query->get_tax_query();
                break;

            case 'date':
                $args['orderby'] = 'date';
                $args['order'] = 'DESC';
                break;

            case 'mostview':
                $args = array(
                    'post_type' => 'product',
                    'post_status'    => 'publish',
                    'posts_per_page' => $product_number,
                    'meta_key'           => 'post_views',
                    'order'             => 'DESC',
                    'orderby'             => 'meta_value_num',
                );
                break;

            case 'rand':
                $args = array(
                    'post_type' => 'product',
                    'post_status'    => 'publish',
                    'orderby' => 'rand',
                    'posts_per_page' => $product_number,
                    'paged'             => $paged,
                );
                break;

            case 'author':
                $args = array(
                    'post_type' => 'product',
                    'post_status'    => 'publish',
                    'orderby' => 'author',
                    'posts_per_page' => $product_number,
                    'paged'             => $paged,
                );
                break;

            case 'comment_count':
                $args = array(
                    'post_type' => 'product',
                    'post_status'    => 'publish',
                    'orderby' => 'comment_count',
                    'posts_per_page' => $product_number,
                    'paged'             => $paged,
                );
                break;

            case 'title':
                $args = array(
                    'post_type' => 'product',
                    'post_status'    => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'posts_per_page' => $product_number,
                    'paged'             => $paged,
                );
                break;

            default:
                $args= $args;
                break;
        }

        $attributes = wc_get_attribute_taxonomies();
        if(!empty($attributes)) {
            foreach ($attributes as $attribute) {
                if(isset($_GET['filter_'.$attribute->attribute_name])){
                    $filter = $_GET['filter_'.$attribute->attribute_name];
                    if(!empty($filter)){
                        $args['tax_query'][] = array(
                            'taxonomy' => 'pa_'.$attribute->attribute_name,
                            'field' => 'slug',
                            'terms' => $filter,
                            'operator' 		=> 'IN'
                        );
                    }
                }
            }
        }
        $min_price=0; $max_price=999999999;

        if(isset($_GET['min_price']) && isset($_GET['max_price'])){
            $min_price=$_GET['min_price'];  $max_price=$_GET['max_price'];
            if($max_price > $min_price){
                $args['meta_query'][]=array(
                    'key' => '_price',
                    'value' => array($min_price, $max_price),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                );
            }
        }

// filter by category
        if(!empty($_GET['product_cat'])) $product_category= $_GET['product_cat'];
        if (!empty($product_category)) {
            $list_cat = explode(",", $product_category);
            if ($list_cat[0] != '') {
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $list_cat,
                );
            }
        }

        // filter product is trending now
        if ($trending_now == 'yes') {
            $args['meta_query'][] = array(
                'key' => 'trending_now',
                'value' => 'yes',
                'compare' => 'LIKE'
            );
        }

        // Filter product by feature
        if ($pro_feature == 'yes') {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
        }

        //filter by pride
        $arr_post_in = array();
        if ($filter_type == 'price') {
            $arr_price = s7upf_price_filter($min_price, $max_price);
            if(count($arr_price)>0)
                $arr_post_in = array_merge($arr_post_in, $arr_price);

        }
        if ($pro_sale == 'yes') {

            if(count($arr_post_in)>0  or $filter_type == 'price') {
                $arr_post_in = array_intersect($arr_post_in, wc_get_product_ids_on_sale());

            }else{
                $arr_post_in = array_merge($arr_post_in, wc_get_product_ids_on_sale());
            }
        }
        if ($filter_type == 'browse') {
            if (isset($_COOKIE['sv_pro_cookie'])) {
                $pro_cookie = explode(',', $_COOKIE['sv_pro_cookie']);
                if (count($pro_cookie) > 0 ) {
                    if(count($arr_post_in)>0 or $pro_sale == 'yes' )
                        $arr_post_in = array_intersect($arr_post_in, $pro_cookie);
                    else
                        $arr_post_in = array_merge($arr_post_in, $pro_cookie);
                } else {
                    $html .= esc_html__('You have not viewed any products.', 'fb-tech');
                    wp_reset_postdata();
                    return $html;
                }
            } else {
                $html .= esc_html__('You have not viewed any products.', 'fb-tech');
                wp_reset_postdata();
                return $html;
            }
        }

        if(($filter_type == 'price' or $pro_sale == 'yes' or $filter_type == 'browse') and count($arr_post_in) < 1 ){
            $arr_post_in[0] = '-1';
            $args['post__in'] = array_unique($arr_post_in);
        }else{
            $args['post__in'] = array_unique($arr_post_in);
        }

        $pro_query = new WP_Query($args);
        $default_image = get_template_directory_uri().'/assets/images/no-thumb/placeholder.png';
        //check main color
        if(!empty($main_color)){
            $class .= ' '.S7upf_Assets::build_css('color:'.$main_color.';', ' div.product span.price');

        }

        //Check style
        $html .= S7upf_Template::load_view('elements/products/product', $style, array(
            'style' => $style,
            'image_size' => $image_size,
            'pro_query' => $pro_query,
            'word_excerpt' => $word_excerpt,//style 1, 10
            'default_image' => $default_image,
            'autoplay' => $autoplay,
            'itemscustom' => $itemscustom,
            'col_layout' => $col_layout,
            'class_main_color' => $class_main_color,
            'class_secondary_color' => $class_secondary_color,
            'animation_img' => $animation_img,
            'title' => $title,
            'pagination' => $pagination,
            'paged'        => $paged,
            'product_category'        => $product_category,
            'args'        => $args,
            'position_tab_active'        => $position_tab_active,
            'data_item_tab'        => $data_item_tab,
            'extra_class'        => $extra_class,
            'orderby_shop'        => $orderby_shop,
            'order_by_show'        => $order_by_show,
            'class'        => $class,
            'navigation'        => $navigation,
            'pagination_slider'        => $pagination_slider,
            'number_row'        => $number_row,
            'hide_mask_img'     => $hide_mask_img,
            'select_attributes'     => $select_attributes,
            'sort_by_price_product'     => $sort_by_price_product,
            'image_size_featured'     => $image_size_featured,
            'navigation_center'     => $navigation_center,
            'bg_img_even'     => $bg_img_even,
            'bg_img_odd'     => $bg_img_odd,
            'select_filter_box'     => $select_filter_box,
            'args'     => $args,
        ));
        wp_reset_postdata();
        return $html;
    }
}
stp_reg_shortcode('s7upf_products','s7upf_vc_products');
add_action( 'vc_before_init_base','s7upf_sv_add_category_product_element',10,100 );
if ( ! function_exists( 's7upf_sv_add_category_product_element' ) ) {
    function s7upf_sv_add_category_product_element()
    {
        vc_map(array(
            'name' => esc_html__('SV Products', 'fb-tech'),
            'base' => 's7upf_products',
            'category' => '7Up-theme',
            'icon' => 'icon-st',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => esc_html__('Style element', 'fb-tech'),
                    'param_name' => 'style',
                    'description' => esc_html__('Select style', 'fb-tech'),
                    'value' => array(
                        esc_html__('Style 1 (Grid default)', 'fb-tech') => 'style1',
                        esc_html__('Style 2 (List default)', 'fb-tech') => 'style2',
                        esc_html__('Style 3 (Slider)', 'fb-tech') => 'style3',
                        esc_html__('Style 4 (Slider)', 'fb-tech') => 'style4',
                        esc_html__('Style 5 (Slider)', 'fb-tech') => 'style5',
                        esc_html__('Style 6 (Slider)', 'fb-tech') => 'style6',
                        esc_html__('Style 7 (slider)', 'fb-tech') => 'style7',
                        esc_html__('Style 8 (Slider)', 'fb-tech') => 'style8',
                        esc_html__('Style 9 (Slider)', 'fb-tech') => 'style9',
                        esc_html__('Style 10 (tab)', 'fb-tech') => 'style10',
                        esc_html__('Style 11 (tab)', 'fb-tech') => 'style11',

                    ),
                ),
                array(
                    'type' => 's7up_image_check',
                    'param_name' => 'style_product',
                    'heading' => '',
                    'element' => 'style',
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title element', 'fb-tech'),
                    'param_name' => 'title',
                    'description' => esc_html__('Enter text', 'fb-tech'),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','megamenu')
                    ),
                ),

                array(
                    'type' => 'param_group',
                    'heading' => esc_html__('Add tab item', 'fb-tech'),
                    'param_name' => 'add_item_tab',
                    'value' =>'',
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Title tab', 'fb-tech' ),
                            'param_name' => 'title',
                            'admin_label' => true,
                            'description' => esc_html__('Enter text.','fb-tech'),
                        ),
                        array(
                            'type' => 's7up_number',
                            'heading' => esc_html__('Number Products', 'fb-tech'),
                            'param_name' => 'product_number',
                            'min' => 1,
                            'value'=> 12,
                            'suffix' => esc_html__('product', 'fb-tech'),
                            'description' => esc_html__('Enter a number to show product in page', 'fb-tech'),

                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Product Featured', 'fb-tech'),
                            'param_name' => 'pro_feature',
                            'edit_field_class' => 'vc_column vc_col-sm-4',
                            'std' => '',
                            'description' => esc_html__('Check the box to filter products is feature', 'fb-tech'),
                            'value' => array(
                                esc_html__("No", 'fb-tech') => '',
                                esc_html__("Yes", 'fb-tech') => 'yes'
                            ),
                        ),

                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Products On Sale', 'fb-tech'),
                            'param_name' => 'pro_sale',
                            'edit_field_class' => 'vc_column vc_col-sm-4',
                            'value' => array(
                                esc_html__("No", 'fb-tech') => '',
                                esc_html__("Yes", 'fb-tech') => 'yes'
                            ),
                            'std' => '',
                            'description' => esc_html__('Check the box to filter products is on sale', 'fb-tech')
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Products Trending Filter','fb-tech'),
                            'param_name' => 'trending_now',
                            'edit_field_class' => 'vc_column vc_col-sm-4',
                            'value' => array(
                                esc_html__("No", 'fb-tech') => '',
                                esc_html__("Yes", 'fb-tech') => 'yes'
                            ),
                            'std' => '',
                            'description' => esc_html__('Check the box to filter products is trending','fb-tech'),
                        ),


                        array(
                            'type' => 'checkbox',
                            'holder' => 'div',
                            'heading' => esc_html__('Select Categories', 'fb-tech'),
                            'param_name' => 'product_category',
                            'description' => esc_html__('Check the box to choose category', 'fb-tech'),
                            'value' => s7upf_list_taxonomy('product_cat',false),
                            'edit_field_class' => 's7upf-category-option vc_col-sm-12',
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Order By', 'fb-tech'),
                            'param_name' => 'order_by',
                            'value' => s7upf_convert_array(s7upf_get_order_list_shop()),
                            'edit_field_class' => 'vc_col-sm-6',

                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Order', 'fb-tech'),
                            'param_name' => 'order',
                            'value' => array(
                                esc_html__("Descending", 'fb-tech') => 'DESC',
                                esc_html__("Ascending", 'fb-tech') => 'ASC'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),

                    ),
                    'callbacks' => array(
                        'after_add' => 'vcChartParamAfterAddCallback'
                    ),
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value'     =>array('style10','style11')
                    ),
                ),
                array(
                    'type' => 's7up_number',
                    'heading' => esc_html__('Number Products', 'fb-tech'),
                    'param_name' => 'product_number',
                    'min' => 1,
                    'value'=> 12,
                    'suffix' => esc_html__('product', 'fb-tech'),
                    'description' => esc_html__('Enter a number to show product in page', 'fb-tech'),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),

                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Filter Type', 'fb-tech'),
                    'param_name' => 'filter_type',
                    'value' => array(
                        esc_html__('None', 'fb-tech') => '',
                        esc_html__('Filter By Price', 'fb-tech') => 'price',
                        esc_html__('Browse History', 'fb-tech') => 'browse'
                    ),
                    'description' => esc_html__('Select a filter type', 'fb-tech'),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),
                ),
                array(
                    'type' => 's7up_number',
                    'min' => 0,
                    'max' => 999999999,
                    'heading' => esc_html__('Min Price (*)', 'fb-tech'),
                    'param_name' => 'min_price',
                    'suffix'    => get_woocommerce_currency_symbol(),
                    'description' => esc_html__('Enter a min price', 'fb-tech'),
                    'dependency' => array(
                        'element' => 'filter_type',
                        'value' => array('price')
                    ),
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'filter_type',
                        'value' => array('price')
                    ),
                ),
                array(
                    'type' => 's7up_number',
                    'min' => 0,
                    'max' => 999999999,
                    'heading' => esc_html__('Max Price (*)', 'fb-tech'),
                    'param_name' => 'max_price',
                    'suffix'    => get_woocommerce_currency_symbol(),
                    'description' => esc_html__('Enter a max price', 'fb-tech'),
                    'dependency' => array(
                        'element' => 'filter_type',
                        'value' => array('price')
                    ),
                    'edit_field_class' => 'vc_column vc_col-sm-6'
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Product Featured', 'fb-tech'),
                    'param_name' => 'pro_feature',
                    'edit_field_class' => 'vc_column vc_col-sm-4',
                    'std' => 'no',
                    'description' => esc_html__('Check the box to filter products is feature', 'fb-tech'),
                    'value' => array(
                        esc_html__('Product featured', 'fb-tech') => 'yes'
                    ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),

                ),

                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Products On Sale', 'fb-tech'),
                    'param_name' => 'pro_sale',
                    'value' => array(
                        esc_html__('Product On Sale', 'fb-tech') => 'yes'
                    ),
                    'std' => 'no',
                    'edit_field_class' => 'vc_column vc_col-sm-4',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),
                    'description' => esc_html__('Check the box to filter products is on sale', 'fb-tech')
                ),

                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Products Trending Filter','fb-tech'),
                    'param_name' => 'trending_now',
                    'edit_field_class' => 'vc_column vc_col-sm-4',
                    'value' => array(
                        esc_html__('Trending Now','fb-tech') => 'yes'
                    ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),
                    'std' => 'no',
                    'description' => esc_html__('Check the box to filter products is trending','fb-tech'),
                ),
                array(
                    'type' => 'checkbox',
                    'holder' => 'div',
                    'heading' => esc_html__('Select Categories', 'fb-tech'),
                    'param_name' => 'product_category',
                    'description' => esc_html__('Check the box to choose category', 'fb-tech'),
                    'value' => s7upf_list_taxonomy('product_cat',false),
                    'edit_field_class' => 's7upf-category-option vc_col-sm-12',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),
                ),


                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Order By', 'fb-tech'),
                    'param_name' => 'order_by',
                    'value' => s7upf_convert_array(s7upf_get_order_list_shop()),
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Order', 'fb-tech'),
                    'param_name' => 'order',
                    'value' => array(
                        esc_html__("Descending", 'fb-tech') => 'DESC',
                        esc_html__("Ascending", 'fb-tech') => 'ASC'
                    ),
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9')
                    ),
                ),

                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Pagination bar', 'fb-tech'),
                    'param_name' => 'pagination',
                    'description' => esc_html__( 'This allows you to hide or show the pagination bar.', 'fb-tech' ),
                    'value' => array(
                        esc_html__("Off", 'fb-tech') => '',
                        esc_html__("On", 'fb-tech') => 'on'
                    ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Show bar order by', 'fb-tech'),
                    'param_name' => 'order_by_show',
                    'value' => array(
                        esc_html__('Off', 'fb-tech') => 'off',
                        esc_html__('On', 'fb-tech') => 'on',
                    ),
                    'edit_field_class' => 'vc_col-sm-12',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2')
                    )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Select filter attributes', 'fb-tech'),
                    'param_name' => 'select_attributes',
                    'value' => s7upf_list_attribute_product(false),
                    'edit_field_class' => 'vc_col-sm-12',
                    'dependency' => array(
                        'element' => 'order_by_show',
                        'value' => array('on')
                    )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Sort by price','fb-tech'),
                    'param_name' => 'sort_by_price_product',
                    'dependency' => array(
                        'element' => 'order_by_show',
                        'value' => array('on')
                    ),
                    'description' => esc_html__('Enter price ranges to filter (Example: 100-200 200-300 300.40-500.00).','fb-tech'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra Class Name','fb-tech'),
                    'param_name' => 'extra_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.','fb-tech'),
                ),
                //-------------------Design Option----------------

                array(
                    'type' => 's7up_number',
                    'heading' => esc_html__('Position tab active', 'fb-tech'),
                    'param_name' => 'position_tab_active',
                    'description' => esc_html__( 'Select the active tab position (From left to right)', 'fb-tech' ),
                    'std' => 1,
                    'min' => 1,
                    'suffix' => esc_html__('Position', 'fb-tech'),
                    'edit_field_class' => 'vc_col-sm-12',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style10','style11')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Column layout', 'fb-tech'),
                    'param_name' => 'col_layout',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'description' => esc_html__( 'This allows you to change the number column of the product grid.', 'fb-tech' ),
                    'value' => array(
                        esc_html__('Default','fb-tech')=>'',
                        esc_html__('4 columns','fb-tech')=>'3',
                        esc_html__('3 columns','fb-tech')=>'4',
                        esc_html__('2 columns','fb-tech')=>'6',
                        esc_html__('1 column','fb-tech')=>'12',
                    ),
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value'     =>array('style1','style2')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Show select filter', 'fb-tech' ),
                    'param_name' => 'select_filter_box',
                    'value' => array(
                        esc_html__('Off','fb-tech')=>'',
                        esc_html__('On','fb-tech')=>'on',
                    ),
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style8')
                    ),
                    'description' => esc_html__( 'Enable box filter.', 'fb-tech' )
                ),

                array(
                    'type' => 'textarea_raw_html',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Custom number item by device (Structure: ["Width of device (unit: px)","Number item"])', 'fb-tech' ),
                    'param_name' => 'itemscustom',
                    'edit_field_class'=>'vc_col-sm-12 vc_column mb-style-itemscustom',
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style3','style4','style5','style6','style7','style8','style10','style11')
                    ),
                    'description' => esc_html__( 'EX: [0,2],[480,3],[768,4],[990,5],[1200,6]', 'fb-tech' )
                ),

                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Custom row Slider', 'fb-tech' ),
                    'param_name' => 'number_row',
                    'value' => array(
                        esc_html__('Default','fb-tech')=>'',
                        esc_html__('1 Row','fb-tech')=>1,
                        esc_html__('2 Rows','fb-tech')=>2,
                        esc_html__('3 Rows','fb-tech')=>3,
                        esc_html__('4 Rows','fb-tech')=>4,
                        esc_html__('5 Rows','fb-tech')=>5,
                        esc_html__('6 Rows','fb-tech')=>6,
                        esc_html__('7 Rows','fb-tech')=>7,
                        esc_html__('8 Rows','fb-tech')=>8,
                        esc_html__('9 Rows','fb-tech')=>9,
                        esc_html__('10 Rows','fb-tech')=>10,
                        esc_html__('15 Rows','fb-tech')=>15,
                        esc_html__('20 Rows','fb-tech')=>20,
                    ),
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style3','style5','style7','style8','style10','style11')
                    ),
                    'description' => esc_html__( 'Select number row of slides.', 'fb-tech' )
                ),
                array(
                    'type' => 'dropdown',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Auto play silder', 'fb-tech' ),
                    'param_name' => 'autoplay',
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style3','style4','style5','style6','style7','style8','style10','style11')
                    ),
                    'value' => array(
                        esc_html__('On','fb-tech') => 'true',
                        esc_html__('Off','fb-tech') => 'false',

                    ),
                    'description' => esc_html__( 'This allows you to enable or disable autoplay of slider.', 'fb-tech' )
                ),
                array(
                    'type' => 'dropdown',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Navigation silder', 'fb-tech' ),
                    'param_name' => 'navigation',
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style3','style4','style5','style6','style7','style8','style10','style11')
                    ),
                    'value' => array(
                        esc_html__('On','fb-tech') => 'true',
                        esc_html__('Off','fb-tech') => 'false',

                    ),
                    'description' => esc_html__( 'This allows you to enable or disable navigation of slider.', 'fb-tech' )
                ),
                array(
                    'type' => 'dropdown',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Pagination silder', 'fb-tech' ),
                    'param_name' => 'pagination_slider',
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style3','style4','style5','style6','style7','style8','style10','style11')
                    ),
                    'value' => array(
                        esc_html__('Off','fb-tech') => 'false',
                        esc_html__('On','fb-tech') => 'true',

                    ),
                    'description' => esc_html__( 'This allows you to enable or disable pagination of slider.', 'fb-tech' )
                ),
                array(
                    'type' => 'dropdown',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Animation image', 'fb-tech' ),
                    'param_name' => 'animation_img',
                    'value' => array(
                        esc_html__('None','fb-tech') => 'animation_default',
                        esc_html__('Zoom','fb-tech') => 'zoom-thumb',
                        esc_html__('Zoom out','fb-tech') => 'zoom-out',
                        esc_html__('Zoom rotate','fb-tech') => 'zoom-rotate',
                    ),
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11')
                    ),
                    'description' => esc_html__( 'This allows you to change animation image product.', 'fb-tech' )
                ),
                array(
                    'type' => 'checkbox',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Hide over mask of image', 'fb-tech' ),
                    'param_name' => 'hide_mask_img',
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style1','style2','style3','style4','style6','style7','style8','style9','style10','style11')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'heading' => esc_html__( 'Move the navigation bar toward the center position', 'fb-tech' ),
                    'param_name' => 'navigation_center',
                    'dependency'    =>array(
                        'element'   =>'style',
                        'value' => array('style3')
                    ),
                ),
                array(
                    'type' => 's7up_number',
                    'heading' => esc_html__('Number word excerpt', 'fb-tech'),
                    'param_name' => 'word_excerpt',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'min' => 1,
                    'value'=>30,
                    'suffix' => esc_html__('word', 'fb-tech'),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style2','style9')
                    ),
                    'description' => esc_html__('Custom number word excerpt (default 30 word)', 'fb-tech')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Image Size', 'fb-tech'),
                    'param_name' => 'image_size',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'edit_field_class' => 'vc_column vc_col-sm-12',
                    'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Image size featured', 'fb-tech'),
                    'param_name' => 'image_size_featured',
                    'group' => esc_html__('Design Option','fb-tech'),
                    'edit_field_class' => 'vc_column vc_col-sm-12',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style4')
                    ),
                    'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
                ),

                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Background image even', 'fb-tech'),
                    'param_name' => 'bg_img_even',
                    'group' => esc_html__('Backggound image','fb-tech'),
                    'edit_field_class' => 'vc_column vc_col-sm-12',
                    'description' => esc_html__('Select color.', 'fb-tech'),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style5', 'style7','style10','style11')
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Background image odd', 'fb-tech'),
                    'param_name' => 'bg_img_odd',
                    'group' => esc_html__('Backggound image','fb-tech'),
                    'edit_field_class' => 'vc_column vc_col-sm-12',
                    'description' => esc_html__('Select color.', 'fb-tech'),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style1','style2','style3','style5', 'style7','style10','style11')
                    ),
                ),

            )
        ));
    }
}

add_action( 'wp_ajax_load_select_filter_product', 's7upf_load_select_filter_product' );
add_action( 'wp_ajax_nopriv_load_select_filter_product', 's7upf_load_select_filter_product' );
if(!function_exists('s7upf_load_select_filter_product')){
    function s7upf_load_select_filter_product() {
        $select_filter = $_POST['select_filter'];
        $bg_img_even = $_POST['bg_img_even'];
        $bg_img_odd = $_POST['bg_img_odd'];
        $number_row = $_POST['number_row'];
        $image_size = $_POST['image_size'];
        $animation_img = $_POST['animation_img'];
        $hide_mask_img = $_POST['hide_mask_img'];
        $data_load = $_POST['data_load1'];
        $data_load = str_replace('\"', '"', $data_load);
        $data_load = json_decode($data_load,true);
        $args = $data_load['args'];
        $html = '';

        if($select_filter == 'price_asc'){
            $args['orderby']  = "meta_value_num ID";
            $args['order']    = 'ASC';
            $args['meta_key'] = '_price';
        }else if($select_filter == 'price_desc'){
            $args['orderby']  = "meta_value_num ID";
            $args['order']    = 'DESC';
            $args['meta_key'] = '_price';
        }else if($select_filter == 'title_asc'){
            $args['orderby']  = "title";
            $args['order']    = 'ASC';
        }else if($select_filter == 'title_desc'){
            $args['orderby']  = "title";
            $args['order']    = 'DESC';
        }
        $query = new WP_Query($args);

        $class_bg_even = 'bg_even '.S7upf_Assets::build_css('background:'.$bg_img_even.';');
        $class_bg_odd = 'bg_odd '.S7upf_Assets::build_css('background:'.$bg_img_odd.';');
        if($query->have_posts()) {
            $i = 1;
            $j = 1;
            $k = 1;
            $count_product = $query->post_count;
            while ($query->have_posts()) {
                $query->the_post();
                if ($j % 2 == 1) {
                    if ($i % 2 == 0) {
                        $class_bg_img = $class_bg_even;
                    } else {
                        $class_bg_img = $class_bg_odd;
                    }
                } else {
                    if ($k % 2 == 1) {
                        $class_bg_img = $class_bg_even;
                    } else {
                        $class_bg_img = $class_bg_odd;
                    }
                    if ($k >= (int)$number_row) $k = 1;
                    else $k++;

                }
                if ($i % (int)$number_row == 1 || $count_product == 1 || $number_row == 1) $html .= '<div class="item">';

                $html .= S7upf_Template::load_view('elements/products/data-load-ajax', false, array(
                    'class_bg_img' => $class_bg_img,
                    'image_size' => $image_size,
                    'animation_img' => $animation_img,
                    'hide_mask_img' => $hide_mask_img,
                    'hide_mask_img' => $hide_mask_img,
                ));
                if ($i % (int)$number_row == 0 || $i == $count_product || $count_product == 1 || $number_row == 1) $html .= '</div>';
                $i = $i + 1;
                if ($i % (int)$number_row == 1) $j++;
            }
        }
        echo balanceTags($html);
        wp_reset_postdata();
        die();
    }
}