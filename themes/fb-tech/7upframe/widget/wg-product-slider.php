<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18/11/2016
 * Time: 9:18 SA
 */
if ( !class_exists('WC_Product') ) {
    return;
}

if(!class_exists('S7upf_Widget_Product_Slider')) {
    class S7upf_Widget_Product_Slider extends WC_Widget
    {
        static function _init()
        {
            add_action('widgets_init', array(__CLASS__, '_add_widget'));
        }

        static function _add_widget()
        {
            register_widget('S7upf_Widget_Product_Slider');
        }

        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->widget_cssclass = 'woocommerce widget widget-product-slider poroduct-type';
            $this->widget_description = esc_html__('Display a list of your products on your site.', 'fb-tech');
            $this->widget_id = 'S7upf_Widget_Product_Slider';
            $this->widget_name = esc_html__('S7up Products slider', 'fb-tech');

            parent::__construct();
        }

        /**
         * Updates a particular instance of a widget.
         *
         * @see WP_Widget->update
         *
         * @param array $new_instance
         * @param array $old_instance
         *
         * @return array
         */
        public function update($new_instance, $old_instance)
        {
            $this->init_settings();

            return parent::update($new_instance, $old_instance);
        }

        public function form($instance)
        {
            $this->init_settings();

            parent::form($instance);
        }

        /**
         * Init settings after post types are registered.
         */
        public function init_settings()
        {

            $category_array = array();
            $tags = get_terms('product_cat');
            if(is_array($tags) && !empty($tags)){
                foreach ($tags as $tag) {
                    $category_array['s7upf_cart_'.$tag->slug]=array(
                        'type' => 'checkbox',
                        'std' => $tag->slug,
                        'label' => $tag->name,
                        'class' => 's7upf_cart_admin',
                    );
                }
            }
            $this->settings = array_merge(
                array(
                    'title'  => array(
                        'type'  => 'text',
                        'std'   => __( 'Products', 'fb-tech' ),
                        'label' => __( 'Title', 'fb-tech' ),
                    ),
                    'number_post'  => array(
                        'type'  => 'number',
                        'std'   => '',
                        'label' => __( 'Number post (Default: 8)', 'fb-tech' ),
                    ),
                    'pro_feature' => array(
                        'type'  => 'select',
                        'std'   => '',
                        'label' => __( 'Product Featured', 'fb-tech' ),
                        'options' => array(
                            '' => __( 'Off', 'fb-tech' ),
                            'on'  => __( 'On', 'fb-tech' ),
                        ),
                    ),
                    'pro_sale' => array(
                        'type'  => 'select',
                        'std'   => '',
                        'label' => __( 'Products On Sale', 'fb-tech' ),
                        'options' => array(
                            '' => __( 'Off', 'fb-tech' ),
                            'on'  => __( 'On', 'fb-tech' ),
                        ),
                    ),
                    'title_category' => array(
                        'type'  => 'text',
                        'std'   => '',
                        'class' => 's7upf_title_filter_category_admin',
                        'label' => __( 'Filter by category (Default get all)', 'fb-tech' ),
                    ),

                ),
                $category_array,
                array(
                    'order_by' => array(
                        'type'  => 'select',
                        'std'   => '',
                        'label' => __( 'Order by', 'fb-tech' ),
                        'options' => array(
                            '' => __( 'None', 'fb-tech' ),
                            'title'  => __( 'Title Product', 'fb-tech' ),
                            'date'  => __( 'Date Product', 'fb-tech' ),
                            'modified'  => __( 'Last Modified Date', 'fb-tech' ),
                            'parent'  => __( 'Last Modified Date', 'fb-tech' ),
                            'rand'  => __( 'Random', 'fb-tech' ),
                            'comment_count'  => __( 'Comment Count', 'fb-tech' ),
                            'bestsell'  => __( 'Bestsell Product', 'fb-tech' ),
                            'rating'  => __( 'Rating Product', 'fb-tech' ),
                            'mostview'  => __( 'Most view Product', 'fb-tech' ),
                            'price'  => __( 'Sort by price', 'fb-tech' ),
                        ),
                    ),
                    'order' => array(
                        'type'  => 'select',
                        'std'   => 'DESC',
                        'label' => __( 'Order', 'fb-tech' ),
                        'options' => array(
                            'DESC' => __( 'Descending', 'fb-tech' ),
                            'ASC'  => __( 'Ascending', 'fb-tech' ),
                        ),
                    ),
                    'number_row' => array(
                        'type'  => 'number',
                        'std'   => '',
                        'label' => __( 'Number product in item silder (Default: 4)', 'fb-tech' ),
                    ),
                    'image_size' => array(
                        'type'  => 'text',
                        'std'   => '',
                        'label' => __( 'Custom image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme. Alternatively enter size in pixels : 200x100 (Width x Height))', 'fb-tech' ),
                    ),
                )
            );
        }

        /**
         * Output widget.
         *
         * @see WP_Widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget($args, $instance)
        {
            echo wp_kses_post($args['before_widget']);
            if ( ! empty( $instance['title'] ) ) {
                echo wp_kses_post($args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }
            $number_post  = (isset( $instance['number_post']) and  $instance['number_post'] !== 0)  ? $instance['number_post'] : 8;
            $pro_feature = isset( $instance['pro_feature'] ) ? $instance['pro_feature'] : $this->settings['pro_feature']['std'];
            $pro_sale = isset( $instance['pro_sale'] ) ? $instance['pro_sale'] : $this->settings['pro_sale']['std'];
            $order_by = isset( $instance['order_by'] ) ? $instance['order_by'] : $this->settings['order_by']['std'];
            $order = isset( $instance['order'] ) ? $instance['order'] : $this->settings['order']['std'];
            $number_row = (isset( $instance['number_row'] )and  $instance['number_row'] !== 0) ? $instance['number_row'] : 4;
            $image_size = isset( $instance['image_size'] ) ? $instance['image_size'] : $this->settings['image_size']['std'];
            $terms_cart = get_terms('product_cat');
            $product_category = array();
            $i=0;
            if(!empty($terms_cart) and is_array($terms_cart)){
                foreach ($terms_cart as $key=>$value){
                    if(($instance['s7upf_cart_'.$value->slug])==1){
                        $product_category[$i] =  $value->slug;
                        $i = $i+1;
                    }
                }
            }
            $args_post=array(
                'post_type'         => 'product',
                'posts_per_page'    => (int)$number_post,
                'orderby'           => $order_by,
                'order' => $order,
                'post_status'    => 'publish',
            );
            if (!empty($product_category)) {
                if ($product_category[0] != '') {
                    $args_post['tax_query'][] = array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $product_category,
                    );
                }
            }
            if($order_by == 'rating'){
                $args_post['meta_key'] = '_wc_average_rating';
                $args_post['meta_query'] = WC()->query->get_meta_query();
                $args_post['tax_query'] = WC()->query->get_tax_query();
                $args_post['no_found_rows'] = 1;
                $args_post['orderby'] = 'meta_value_num';
                $args_post['order'] =  $order;
            }
            if($order_by == 'mostview'){
                $args_post['meta_key'] = 'post_views';
                $args_post['orderby'] = 'meta_value_num';
            }
            if($order_by == 'bestsell'){
                $args_post['meta_key'] = 'total_sales';
                $args_post['orderby'] = 'meta_value_num';
                $args_post['meta_query'] = WC()->query->get_meta_query();
                $args_post['tax_query'] = WC()->query->get_tax_query();
                $args_post['ignore_sticky_posts'] = 1;
            }
            if($order_by == 'price'){
                $args_post['orderby']  = "meta_value_num ID";
                $args_post['order']    = $order;
                $args_post['meta_key'] = '_price';
            }
            if($pro_sale=='on'){
                $args_post['meta_query']['relation']= 'OR';
                $args_post['meta_query'][]=array(
                    'key'   => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type'          => 'numeric'
                );
                $args_post['meta_query'][]=array(
                    'key'   => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type'          => 'numeric'
                );
            }
            if($pro_feature == 'on'){
                $args_post['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );

            }
            $query = new WP_Query($args_post);
            $count_post= $query->post_count;
            $i = 1;
            $image_size  = s7upf_get_size_image('80x80',$image_size);
            $default_image = get_template_directory_uri().'/assets/images/no-thumb/placeholder.png';

            global $post;
            if($query->have_posts()) {  ?>
                <div class="product-type-slider">
                    <div class="wrap-item group-navi" data-itemscustom="[[0,1],[560,1],[768,1]]" data-navigation="true" data-autoplay="true"
                         data-pagination="false">
                        <?php  while ($query->have_posts()) {
                            $query->the_post(); ?>
                            <?php if($i % (int)$number_row == 1 || $number_row == 1 ) echo '<div class="item">'; ?>
                            <div class="item-product table">
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
                                        }
                                        ?>
                                    </a>
                                    <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link product-ajax-popup"><?php echo esc_html__('Quick view','fb-tech'); ?></a>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title title14"><a href="<?php the_permalink(); ?>"><?php  echo wp_trim_words( get_the_title(), 5 , '...' ); ?></a></h3>
                                    <div class="product-price">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>

                                </div>
                            </div>
                            <?php if($i % (int)$number_row == 0 || $i == $count_post || $number_row == 1) echo '</div>'?>

                            <?php $i = $i+1; } ?>
                    </div>
                </div>
                <?php
            } wp_reset_postdata();
            echo wp_kses_post($args['after_widget']);
        }
    }
    S7upf_Widget_Product_Slider::_init();
}