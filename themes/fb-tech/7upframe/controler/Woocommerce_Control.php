<?php
/**
 * Created by Sublime Text 2.
 * User: 7uptheme
 * Date: 14/04/75
 * Time: 10:20 AM
 */
if(!class_exists('S7upf_Woocommerce_Controller')){
    class S7upf_Woocommerce_Controller{
        static function _init(){
            if (!class_exists('WC_Product')) return;
            add_action('after_setup_theme', array(__CLASS__, '_woocommerce_support'));
            add_action( 'admin_init',array(__CLASS__, 's7upf_metabox_shop'));
            // remover action
            remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
            remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
            remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
            remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
            //---------content-product-----------
            remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
            remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
            remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
            remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
            remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
            remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
            remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
            remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);
            //------------content-single-product--------------
            remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
            remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images',20);

            remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);

            //------------page cart--------------
            remove_action('woocommerce_cart_collaterals','woocommerce_cross_sell_display');
            add_action('woocommerce_after_cart','woocommerce_cross_sell_display',10);


            //Filter function catalog mode
            add_filter( 'woocommerce_loop_add_to_cart_link', array(__CLASS__,'s7upf_custom_add_to_cart_link'));
            add_action( 's7upf_template_single_add_to_cart', array(__CLASS__,'s7upf_filter_single_add_to_cart'), 20 );
            add_filter( 'woocommerce_get_price_html', array(__CLASS__,'s7upf_change_price_html'), 100, 2 );
            add_filter('woocommerce_show_page_title', array(__CLASS__,'s7upf_remove_page_title'));
            //metabox cat
            add_action('product_cat_add_form_fields', array(__CLASS__,'s7upf_product_cat_metabox_add'), 10, 1);
            add_action('product_cat_edit_form_fields', array(__CLASS__,'s7upf_product_cat_metabox_edit'), 10, 1);
            add_action('created_product_cat', array(__CLASS__,'s7upf_product_save_category_metadata'), 10, 1);
            add_action('edited_product_cat', array(__CLASS__,'s7upf_product_save_category_metadata'), 10, 1);

            //mini cart ajax
            add_action('wp_ajax_add_to_cart',array(__CLASS__,'s7upf_mini_cart_ajax'));
            add_action('wp_ajax_nopriv_add_to_cart',array(__CLASS__,'s7upf_mini_cart_ajax'));
            add_action('wp_ajax_product_remove',array(__CLASS__,'s7upf_mini_cart_product_remove'));
            add_action('wp_ajax_nopriv_product_remove',array(__CLASS__,'s7upf_mini_cart_product_remove'));

            //Add Type Attributes Woo
            add_action( 'woocommerce_product_option_terms', array( __CLASS__, 's7upf_product_option_terms_attribute' ), 10, 2 );
            if(is_admin()){
                add_filter( 'product_attributes_type_selector', array( __CLASS__, 's7upf_add_attribute_types' ) );
                add_action('admin_enqueue_scripts', array(__CLASS__, 's7upf_attributes_admin_scripts'));
                add_action('admin_init', array(__CLASS__, 's7upf_init_attribute_hooks'));
                add_action( 's7upf_product_attribute_field', array( __CLASS__, 's7upf_attribute_fields' ), 10, 3 );
            }
            //Font end attribute
            add_filter( 'woocommerce_dropdown_variation_attribute_options_html', array( __CLASS__, 's7upf_get_swatch_html_attribute' ), 100, 2 );
            add_filter( 's7upf_filters_swatch_html_attribute', array( __CLASS__, 's7upf_swatch_html_attribute' ), 5, 4 );
            // End Type Attributes Woo

            //Product popup ajax
            add_action('wp_ajax_product_popup_content', array(__CLASS__,'s7upf_product_popup_content' ));
            add_action('wp_ajax_nopriv_product_popup_content', array(__CLASS__,'s7upf_product_popup_content' ));


            //Action
            
            add_action('init', array(__CLASS__, 's7upf_update_post_per_page'));
            add_action('woocommerce_after_main_content', array(__CLASS__, 's7upf_woo_end_main_content'),5);
            add_action('woocommerce_before_main_content', array(__CLASS__, 's7upf_woo_begin_main_content'),50);
            add_action('woocommerce_before_shop_loop',array(__CLASS__,'s7upf_woo_box_view_product'),40);
            add_action( "woocommerce_widget_field_s7uplabel",  array(__CLASS__,'s7upf_widget_field_type_label'), 10, 4 );

            //content-product
            add_action('woocommerce_shop_loop_item_title', array(__CLASS__, 's7upf_template_loop_content_product'),20);
            //single product
            add_action('woocommerce_before_single_product_summary', array(__CLASS__, 's7upf_template_single_title'),30);
            add_action('woocommerce_single_product_summary', array(__CLASS__, 's7upf_template_info_single_product'),30);
            //Filter

            add_filter('woocommerce_breadcrumb_defaults',array(__CLASS__,'s7upf_woocommerce_breadcrumb_defaults'));
            add_filter('woocommerce_output_related_products_args',array(__CLASS__,'s7upf_output_related_products_args'),10,1);
            add_filter('woocommerce_product_tabs', array(__CLASS__,'s7upf_custom_description_tab'), 98 );
            add_filter('woocommerce_review_gravatar_size', array(__CLASS__,'s7upf_review_gravatar_size'), 10, 1);
            add_filter('woocommerce_product_get_rating_html', array(__CLASS__,'s7upf_product_get_rating_html'));
            add_filter('woocommerce_product_thumbnails_large_size', array(__CLASS__,'s7upf_product_thumbnails_large_size'));
            add_filter( 'woocommerce_loop_add_to_cart_args', array(__CLASS__,'s7upf_fix_add_cart'));
        }
        static  function s7upf_fix_add_cart($args){
            if(isset($args['class'])){
                $class = str_replace('ajax_add_to_cart', 's7up-ajax_add_to_cart', $args['class']);
                $args['class'] = $class;
            }
            return $args;
        }
        static function s7upf_widget_field_type_label($key, $value, $setting, $instance){
            ?>
            <p>
                <label class="s7up_label" for="<?php echo esc_attr($key); ?>"><?php echo esc_attr($setting['label']); ?></label>
            </p>
            <?php
        }
        static function s7upf_product_get_rating_html(){
            global $comment;
            $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
            $width = ($rating / 5 ) * 100;
            $class_width = S7upf_Assets::build_css('width:'.$width.'%');
            $rating_html = '<div class="mb-review-rating product-rate"><div class = "product-rating '.$class_width.'"></div> </div>';
           return $rating_html;
        }
        static function s7upf_product_thumbnails_large_size(){
            $image_size = s7upf_get_option('s7upf_image_product_detail_size');
            if(!empty($image_size)){
                $image_size = s7upf_get_size_image('full',$image_size);
            }
            return $image_size;
        }
        static function s7upf_template_loop_content_product(){
            echo S7upf_Template::load_view('woo/content-product',false);
        }
        static function s7upf_template_info_single_product(){
            echo S7upf_Template::load_view('woo/single-product/info-single',false);
        }

        static function s7upf_template_single_title(){ ?>
            <div class="title-product-detail">
                <h2 class="title30 font-bold"><?php the_title(); ?></h2>
                <div class="product-control">
                    <?php
                    echo next_post_link('%link', '<i class="icon ion-ios-arrow-left"></i>', TRUE, ' ', 'product_cat');
                    echo previous_post_link('%link', '<i class="icon ion-ios-arrow-right"></i>', TRUE, ' ', 'product_cat');
                    ?>

                </div>
            </div>
            <?php
        }

        static function s7upf_woo_box_view_product(){
            echo S7upf_Template::load_view('woo/top-bar-view',false);
        }
        static function s7upf_remove_page_title(){
            return false;
        }
        static function s7upf_review_gravatar_size(){
            return 70;
        }
        static function s7upf_woocommerce_breadcrumb_defaults(){
            return array(
                'delimiter'   => '<span class="delimiter"> <i class="icon ion-ios-arrow-right"></i> </span>',
                'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'Home', 'breadcrumb', 'fb-tech' ),
            );
        }

        static function s7upf_woo_begin_main_content(){ ?>
            <div class="row">
            <?php s7upf_output_sidebar('left'); ?>
                <div  class = "<?php echo esc_attr(s7upf_get_main_class()); ?>">
                    <div class="main-content-shop">
            <?php
        }
        static function s7upf_woo_end_main_content(){ ?>
                    </div><!--end .main-content-shop-->
                </div><!--end .col-->
            <?php s7upf_output_sidebar('right'); ?>
            </div><!--end .row-->
            <?php
        }

        static function s7upf_update_post_per_page(){
            $number = s7upf_get_option('st_product_post_per_page');
            if(isset($_GET['number'])){
                $number = $_GET['number'];
            }
            add_filter('loop_shop_per_page', create_function('$cols', 'return ' . $number . ';'), 20);
        }
        static function s7upf_product_popup_content() {
            $product_id = $_POST['product_id'];

            $query = new WP_Query( array(
                'post_type' => 'product',
                'post__in' => array($product_id)
            ));
            if( $query->have_posts() ):

                while ( $query->have_posts() ) : $query->the_post();
                    echo S7upf_Template::load_view('woo/popup-product-dialog',false);
                endwhile;
            endif;
            wp_reset_postdata();
        }


        // Begin Filter Add Tab in product detail
        static function s7upf_custom_description_tab( $tabs ) {
            $data_tabs = get_post_meta(get_the_ID(),'s7upf_product_tab_data',true);
            if(!empty($data_tabs) and is_array($data_tabs)){
                foreach ($data_tabs as $key=>$data_tab){
                    $tabs['s7upf_custom_tab_' . $key] = array(
                        'title' => (!empty($data_tab['title']) ? $data_tab['title'] : $key),
                        'priority' => (!empty($data_tab['priority']) ? $data_tab['priority'] : 50),
                        'callback' => array(__CLASS__, 's7upf_render_tab'),
                        'content' => apply_filters('the_content', $data_tab['tab_content']) //this allows shortcodes in custom tabs
                    );
                }
            }

            return $tabs;
        }
        static function s7upf_render_tab($key, $tab) {
            echo apply_filters('s7upf_product_custom_tab_content', $tab['content'], $tab, $key);
        }
        // End Add Tab in product detail

        static function s7upf_output_related_products_args($args){
            $number_product = 4;
            $number_product = s7upf_get_option('s7upf_number_related_product');
            $args =array(
                'posts_per_page' 	=> (int)$number_product,
                'orderby' 			=> 'title',
            );
            return $args;
        }

        //Function button share in product detail
        static function s7upf_share_product(){
            $box_share = s7upf_get_option('s7upf_show_share_product_detail');
            if($box_share=='on') { ?>
                <div class="detail-social">
                    <a class="social-link silver" href="#"><i class="fa fa-share"></i></a>
                    <ul class="list-social-share list-none">
                        <li><a target="popup" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"><i class="fa fa-facebook"></i><span><?php echo esc_html__('Facebook','fb-tech')?></span></a></li>
                        <li><a target="popup" href="http://twitter.com/share?url=<?php the_permalink() ?>"><i class="fa fa-twitter "></i><span><?php echo esc_html__('Twitter','fb-tech')?></span></a></li>
                        <li><a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" target="popup"><i class="fa fa-pinterest"></i><span><?php echo esc_html__('Pinterest','fb-tech')?></span></a></li>
                        <li><a target="popup"  href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i><span><?php echo esc_html__('Google +','fb-tech')?></span></a></li>
                    </ul>
                </div>

                <?php
            }
        }

        static function s7upf_template_single_rating($count = false){
            global $product;
            $star = $product->get_average_rating();
            $review_count = $product->get_review_count();
            $width = $star / 5 * 100;
            $class_width = S7upf_Assets::build_css('width:'.$width.'%'); ?>
            <div class="product-rate">
                <div class="product-rating <?php echo esc_attr($class_width); ?>"></div>
                <?php
                if($count){ ?>
                    <span>(<?php echo esc_attr($review_count); ?>s)</span>
                <?php }
                ?>
            </div>
            <?php
        }

        //Begin Mini cart ajax
        function s7upf_mini_cart_ajax() {

            $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
            $quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
            $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

            if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) ) {
                do_action( 'woocommerce_ajax_added_to_cart', $product_id );
                WC_AJAX::get_refreshed_fragments();
            } else {
                $this->json_headers();

                // If there was an error adding to the cart, redirect to the product page to show any errors
                $data = array(
                    'error' => true,
                    'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
                );
                echo json_encode( $data );
            }
            die();
        }
        static function s7upf_mini_cart_product_remove() {
            global $wpdb, $woocommerce;
            $cart_item_key = $_POST['cart_item_key'];
            if ( $woocommerce->cart->get_cart_item( $cart_item_key ) ) {
                $woocommerce->cart->remove_cart_item( $cart_item_key );
            }
            WC_AJAX::get_refreshed_fragments();
            die();
        }
        //End Mini cart ajax



        //*********************************************************//
        //--------------------FUNCTION DEFAULT---------------------//
        //*********************************************************//


        static function _woocommerce_support(){
            add_theme_support('woocommerce');
        }

        //-------- Begin Add Type Attributes------------//

        //Backend end attribute type color, image, label
        static function s7upf_get_tax_attribute( $taxonomy ) {
            global $wpdb;

            $attr = substr( $taxonomy, 3 );
            $attr = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = '$attr'" );

            return $attr;
        }
        static function s7upf_product_option_terms_attribute( $taxonomy, $index ) {
            $types = array(
                'color' => esc_html__( 'Color', 'fb-tech' ),
                'image' => esc_html__( 'Image', 'fb-tech' ),
                'label' => esc_html__( 'Label', 'fb-tech' ),
            );
            if ( ! array_key_exists( $taxonomy->attribute_type,$types) ) {
                return;
            }

            $taxonomy_name = wc_attribute_taxonomy_name( $taxonomy->attribute_name );
            global $thepostid;
            ?>

            <select multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select terms', 'fb-tech' ); ?>" class="multiselect attribute_values wc-enhanced-select" name="attribute_values[<?php echo esc_attr($index); ?>][]">
                <?php

                $all_terms = get_terms( $taxonomy_name, apply_filters( 'woocommerce_product_attribute_terms', array( 'orderby' => 'name', 'hide_empty' => false ) ) );
                if ( $all_terms ) {
                    foreach ( $all_terms as $term ) {
                        echo '<option value="' . esc_attr( $term->term_id ) . '" ' . selected( has_term( absint( $term->term_id ), $taxonomy_name, $thepostid ), true, false ) . '>' . esc_attr( apply_filters( 'woocommerce_product_attribute_term_name', $term->name, $term ) ) . '</option>';
                    }
                }
                ?>
            </select>
            <button class="button plus select_all_attributes"><?php esc_html_e( 'Select all', 'fb-tech' ); ?></button>
            <button class="button minus select_no_attributes"><?php esc_html_e( 'Select none', 'fb-tech' ); ?></button>
            <button class="button fr plus tawcvs_add_new_attribute" data-type="<?php echo esc_attr($taxonomy->attribute_type); ?>"><?php esc_html_e( 'Add new', 'fb-tech' ); ?></button>

            <?php
        }
        static function s7upf_init_attribute_hooks() {
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            if ( empty( $attribute_taxonomies ) ) {
                return;
            }

            foreach ( $attribute_taxonomies as $tax ) {
                add_action( 'pa_' . $tax->attribute_name . '_add_form_fields', array( __CLASS__, 's7up_add_attribute_fields' ) );
                add_action( 'pa_' . $tax->attribute_name . '_edit_form_fields', array( __CLASS__, 's7up_edit_attribute_fields' ), 10, 2 );
            }
            add_action( 'created_term', array( __CLASS__, 's7upf_save_term_meta_attribute' ), 10, 2 );
            add_action( 'edit_term', array( __CLASS__, 's7upf_save_term_meta_attribute' ), 10, 2 );
        }
        static function s7up_add_attribute_fields( $taxonomy ) {
            $attr = S7upf_Woocommerce_Controller::s7upf_get_tax_attribute( $taxonomy );
            do_action( 's7upf_product_attribute_field', $attr->attribute_type, '', 'add' );
        }
        static function s7up_edit_attribute_fields( $term, $taxonomy ) {
            $attr = S7upf_Woocommerce_Controller::s7upf_get_tax_attribute( $taxonomy );
            $value = get_term_meta( $term->term_id, $attr->attribute_type, true );

            do_action( 's7upf_product_attribute_field', $attr->attribute_type, $value, 'edit' );
        }
        static function s7upf_attribute_fields( $type, $value, $form ) {
            // Return if this is a default attribute type
            if ( in_array( $type, array( 'select', 'text' ) ) ) {
                return;
            }
            $types = array(
                'color' => esc_html__( 'Color', 'fb-tech' ),
                'image' => esc_html__( 'Image', 'fb-tech' ),
                'label' => esc_html__( 'Label', 'fb-tech' ),
            );
            // Print the open tag of field container
            printf(
                '<%s class="form-field">%s<label for="term-%s">%s</label>%s',
                'edit' == $form ? 'tr' : 'div',
                'edit' == $form ? '<th>' : '',
                esc_attr( $type ),
                $types[$type],
                'edit' == $form ? '</th><td>' : ''
            );

            switch ( $type ) {
                case 'image':;
                    $image_default ='';
                    if(empty($value)){
                        $image_default = WC()->plugin_url() . '/assets/images/placeholder.png';
                    }
                    $image = $value ? $value  : WC()->plugin_url() . '/assets/images/placeholder.png';

                    ?>
                    <div class="wrap-metabox">
                        <div class="live-previews">
                            <?php if(!empty($image_default)) echo '<img src="'.esc_url($image_default).'"/>'?><?php if(!empty($value)) echo '<img src="'.esc_url($image).'"/>'?>
                        </div>
                        <a class="button button-primary sv-button-remove "> <?php esc_html_e("Remove",'fb-tech')?></a>
                        <a class="button button-primary sv-button-upload"><?php esc_html_e("Upload",'fb-tech')?></a>
                        <input name="image" type="hidden" class="sv-image-value" value="<?php echo esc_attr( $value ) ?>"> </input>
                    </div>

                    <?php
                    break;

                default:
                    ?>
                    <input type="text" id="term-<?php echo esc_attr( $type ) ?>" name="<?php echo esc_attr( $type ) ?>" value="<?php echo esc_attr( $value ) ?>" />
                    <?php
                    break;
            }

            // Print the close tag of field container
            echo 'edit' == $form ? '</td></tr>' : '</div>';
        }
        public function s7upf_save_term_meta_attribute( $term_id, $tt_id ) {
            $types = array(
                'color' => esc_html__( 'Color', 'fb-tech' ),
                'image' => esc_html__( 'Image', 'fb-tech' ),
                'label' => esc_html__( 'Label', 'fb-tech' ),
            );
            foreach ( $types as $type => $label ) {
                if ( isset( $_POST[$type] ) ) {
                    update_term_meta( $term_id, $type, $_POST[$type] );
                }
            }
        }
        static function s7upf_add_attribute_types($types) {
            $add_type = array(
                'color' => esc_html__( 'Color', 'fb-tech' ),
                'image' => esc_html__( 'Image', 'fb-tech' ),
                'label' => esc_html__( 'Label', 'fb-tech' ),
            );
            $types = array_merge( $types, $add_type);
            return $types;
        }
        static function s7upf_attributes_admin_scripts(){
            $screen = get_current_screen();
            if (strpos($screen->id, 'pa_') !== false) :
                wp_enqueue_media();
                wp_enqueue_style( 'wp-color-picker' );
                wp_enqueue_script( 'wp-color-picker');
            endif;
        }

        //Font end attribute type color, image, label
        static function s7upf_get_swatch_html_attribute( $html, $args ) {
            $swatch_types = array(
                'color' => esc_html__( 'Color', 'fb-tech' ),
                'image' => esc_html__( 'Image', 'fb-tech' ),
                'label' => esc_html__( 'Label', 'fb-tech' ),
            );
            $attr         = S7upf_Woocommerce_Controller::s7upf_get_tax_attribute( $args['attribute'] );
            // Return if this is normal attribute
            if ( empty( $attr ) ) {
                return $html;
            }

            if ( ! array_key_exists( $attr->attribute_type, $swatch_types ) ) {
                return $html;
            }
            $options   = $args['options'];
            $product   = $args['product'];
            $attribute = $args['attribute'];
            $class     = "variation-selector variation-select-{$attr->attribute_type}";
            $swatches  = '';

            if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
                $attributes = $product->get_variation_attributes();
                $options    = $attributes[$attribute];
            }

            if ( array_key_exists( $attr->attribute_type, $swatch_types ) ) {
                if ( ! empty( $options ) && $product && taxonomy_exists( $attribute ) ) {
                    // Get terms if this is a taxonomy - ordered. We need the names too.
                    $terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

                    foreach ( $terms as $term ) {
                        if ( in_array( $term->slug, $options ) ) {
                            $swatches .= apply_filters( 's7upf_filters_swatch_html_attribute', '', $term, $attr, $args );
                        }
                    }
                }

                if ( ! empty( $swatches ) ) {
                    $class .= ' hidden';

                    $swatches = '<div class="tawcvs-swatches" data-attribute_name="attribute_' . esc_attr( $attribute ) . '">' . $swatches . '</div>';
                    $html     = '<div class="' . esc_attr( $class ) . '">' . $html . '</div>' . $swatches;
                }
            }

            return $html;
        }
        static function s7upf_swatch_html_attribute( $html, $term, $attr, $args ) {
            $selected = sanitize_title( $args['selected'] ) == $term->slug ? 'selected' : '';
            $name     = esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) );

            switch ( $attr->attribute_type ) {
                case 'color':
                    $class_white = '';
                    $color = get_term_meta( $term->term_id, 'color', true );
                    list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
                    if($color == '#fff' || $color == '#ffffff') $class_white = 'mau_trang';
                    $class_color = S7upf_Assets::build_css('background-color:'.$color.';' );
                    $html = sprintf(
                        '<span class="swatch swatch-color '.$class_white.' '.$class_color.' swatch-%s %s" title="%s" data-value="%s"><span class="hide">%s</span></span>',
                        esc_attr( $term->slug ),
                        $selected,
                        esc_attr( $name ),
                        esc_attr( $term->slug ),
                        $name
                    );
                    break;

                case 'image':
                    $image = get_term_meta( $term->term_id, 'image', true );
                    $image = $image ?  $image : WC()->plugin_url() . '/assets/images/placeholder.png';
                    $html  = sprintf(
                        '<span class="swatch swatch-image swatch-%s %s" title="%s" data-value="%s"><img src="%s" alt="%s"><span class="hide">%s</span></span>',
                        esc_attr( $term->slug ),
                        $selected,
                        esc_attr( $name ),
                        esc_attr( $term->slug ),
                        esc_url( $image ),
                        esc_attr( $name ),
                        esc_attr( $name )
                    );
                    break;

                case 'label':
                    $label = get_term_meta( $term->term_id, 'label', true );
                    $label = $label ? $label : $name;
                    $html  = sprintf(
                        '<span class="swatch swatch-label swatch-%s %s" title="%s" data-value="%s">%s</span>',
                        esc_attr( $term->slug ),
                        $selected,
                        esc_attr( $name ),
                        esc_attr( $term->slug ),
                        esc_html( $label )
                    );
                    break;
            }

            return $html;
        }

        //--------- End Add Type Attributes ----------------//

        // Begin meta box category
        static  function s7upf_product_cat_metabox_add($tag) { ?>
            <div class="form-field s7upf_check_select">
                <label class="title"><?php esc_html_e('Enable banner', 'fb-tech'); ?></label>
                <select id="enable_banner_shop_cat" name="enable_banner_shop_cat">
                    <option value=""><?php esc_html_e('---User in theme settings---', 'fb-tech'); ?></option>
                    <option value="off"><?php esc_html_e('Off', 'fb-tech'); ?></option>
                    <option value="on"><?php esc_html_e('On', 'fb-tech'); ?></option>
                </select>
            </div>
            <div class="form-field option-check-select block-banner-cat" data-byselect="on">
                <div class="list-item-banner-cat">
                    <div class="item-banner-slider-cat" data-key="1">
                        <div class="header-item"><h2 class="title-item"><?php echo esc_html__('Item 1','fb-tech');?></h2><div class="right-h"><a href="#" class="s7upf-remover-item-banner"><i class="fa fa-trash-o" aria-hidden="true"></i></a><a href="#" class="show-hide"><i class="fa fa-plus" aria-hidden="true"></i></a></div></div>
                        <div class="content-item">
                            <label><?php esc_html_e('Image banner','fb-tech'); ?></label>
                            <div class="wrap-metabox">
                                <div class="live-previews"></div>
                                <a class="button button-primary sv-button-remove"> <?php esc_html_e("Remove",'fb-tech')?></a>
                                <a class="button button-primary sv-button-upload"><?php esc_html_e("Upload",'fb-tech')?></a>
                                <input name="banner-product-cat-item[0][img]" type="hidden" class="sv-image-value" value=""> </input>
                            </div>
                            <label><?php esc_html_e('Banner info','fb-tech'); ?></label>
                            <textarea name="banner-product-cat-item[0][info]" type="text" rows="4" cols="40"></textarea>
                        </div>
                    </div>
                </div>
                <a class="button button-primary s7upf-add-item-banner"><?php esc_html_e("Add item slider",'fb-tech')?></a>
            </div>

        <?php }
        static function s7upf_product_cat_metabox_edit($tag) { ?>
            <tr class="form-field s7upf_check_select">
                <th scope="row" valign="top">
                    <label class="title"><?php esc_html_e('Enable banner', 'fb-tech'); ?></label>
                </th>
                <td>
                    <select id="enable_banner_shop_cat" name="enable_banner_shop_cat" class="postform">
                        <option value="" <?php selected('',get_term_meta($tag->term_id, 'enable_banner_shop_cat', true));?> ><?php esc_html_e('---Theme settings---', 'fb-tech'); ?></option>
                        <option value="off" <?php selected('off',get_term_meta($tag->term_id, 'enable_banner_shop_cat', true));?> ><?php esc_html_e('Off', 'fb-tech'); ?></option>
                        <option value="on" <?php selected('on',get_term_meta($tag->term_id, 'enable_banner_shop_cat', true));?> ><?php esc_html_e('On', 'fb-tech'); ?></option>
                    </select>
                </td>
            </tr>
            <tr class="form-field option-check-select" data-byselect="on">
                <th scope="row"><label><?php esc_html_e('List banner item','fb-tech'); ?></label></th>
                <td>
                    <div class="form-field  block-banner-cat">
                        <div class="list-item-banner-cat">
                            <?php $i = 1; $data = get_term_meta($tag->term_id, 'banner-product-cat-item', true);
                            if(!empty($data) and is_array($data)){
                                foreach ($data as $key=>$value){ ?>
                                    <div class="item-banner-slider-cat" data-key="<?php echo esc_attr($i); ?>">
                                        <div class="header-item"><h2 class="title-item"><?php echo esc_html__('Item ','fb-tech');?><?php echo esc_attr($i);?></h2><div class="right-h"><a href="#" class="s7upf-remover-item-banner"><i class="fa fa-trash-o" aria-hidden="true"></i></a><a href="#" class="show-hide"><i class="fa fa-plus" aria-hidden="true"></i></a></div></div>
                                        <div class="content-item">
                                            <div class="wrap-metabox">
                                                <label>Image banner</label>
                                                <input name="banner-product-cat-item[<?php echo esc_attr($i);?>][img]" type="text" class="sv-image-value" value="<?php if(!empty($value['img'])) echo esc_attr($value['img'])?>"> </input>
                                                <a class="btn btn-primary sv-button-upload"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                <a class="btn btn-default sv-button-remove"> <i class="fa fa-minus" aria-hidden="true"></i></a>
                                                <div class="live-previews">
                                                    <?php if(!empty($value['img'])) echo '<img src="'.$value['img'].'" />'; ?>
                                                </div>

                                            </div>
                                            <label><?php esc_html_e('Banner info','fb-tech'); ?></label>
                                            <textarea name="banner-product-cat-item[<?php echo esc_attr($i);?>][info]" type="text" rows="4" cols="40"><?php if(!empty($value['info']))echo do_shortcode($value['info'])?></textarea>
                                        </div>
                                    </div>
                            <?php $i=$i+1; }
                            }
                            ?>
                        </div>
                        <a class="button button-primary s7upf-add-item-banner"><?php esc_html_e("Add item slider",'fb-tech')?></a>
                    </div>
                </td>
            </tr>


        <?php }
        static  function s7upf_product_save_category_metadata($term_id)
        {
            if (isset($_POST['enable_banner_shop_cat'])) update_term_meta( $term_id, 'enable_banner_shop_cat', $_POST['enable_banner_shop_cat']);
            if (isset($_POST['banner-product-cat-item'])) update_term_meta( $term_id, 'banner-product-cat-item', $_POST['banner-product-cat-item']);

        }
        // End metabox category

        // Metabox product page
        static  function s7upf_metabox_shop(){
            $s7upf_metabox = array(
                'id' => 's7upf_shop_setting',
                'title' => esc_html__('Shop Options','fb-tech'),
                'pages' => array('product'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'label' => esc_html__('General setting','fb-tech'),
                        'id' => 'mb_general_setting',
                        'type' => 'tab'
                    ),
                    array(
                        'id' => 'trending_now',
                        'label' => esc_html__('Product trending', 'fb-tech'),
                        'type' => 'checkbox',
                        'choices' => array(
                            array(
                                'label' => esc_html__('Trending now', 'fb-tech'),
                                'value' => 'yes'
                            )
                        ),
                    ),
                    array(
                        'id'          => 's7upf_sidebar_position_detail_product',
                        'label'       => esc_html__('Sidebar position product page','fb-tech'),
                        'type'        => 'select',
                        'desc'=>esc_html__('Left, or Right, or Center (Default get in Theme Option)','fb-tech'),
                        'choices'     => array(
                            array(
                                'value'=>'',
                                'label'=>esc_html__('--- Theme option ---','fb-tech'),
                            ),
                            array(
                                'value'=>'no',
                                'label'=>esc_html__('No Sidebar','fb-tech'),
                            ),
                            array(
                                'value'=>'left',
                                'label'=>esc_html__('Left','fb-tech'),
                            ),
                            array(
                                'value'=>'right',
                                'label'=>esc_html__('Right','fb-tech'),
                            )
                        )
                    ),

                    array(
                        'id'          => 's7upf_sidebar_detail_product',
                        'label'       => esc_html__('Sidebar select product page','fb-tech'),
                        'type'        => 'sidebar-select',
                        'condition'   => 's7upf_sidebar_position_detail_product:not(no),s7upf_sidebar_position_detail_product:not()',
                        'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','fb-tech'),
                    ),
                    array(
                        'id'          => 's7upf_show_banner_product_detail',
                        'label'       => esc_html__('Show breadcrumb','fb-tech'),
                        'type'        => 'select',
                        'section'     => 'option_woo',
                        'desc'=>esc_html__('This allow you to show or hide Banner in detail products','fb-tech'),
                        'std'=>'',
                        'choices'     => array(
                            array(
                                'value'=>'',
                                'label'=>esc_html__('--- Theme option ---','fb-tech'),
                            ),
                            array(
                                'value'=>'on',
                                'label'=>esc_html__('On','fb-tech'),
                            ),
                            array(
                                'value'=>'off',
                                'label'=>esc_html__('Off','fb-tech'),
                            )
                        )
                    ),
                    array(
                        'id'          => 's7upf_style_gallery_detail',
                        'label'       => esc_html__('Gallery image style ','fb-tech'),
                        'type'        => 'select',
                        'section'     => 'option_woo',
                        'desc'=>esc_html__('This allows you to change the gallery style','fb-tech'),
                        'std'=>'',
                        'choices'     => array(
                            array(
                                'value'=>'',
                                'label'=>esc_html__('--- Theme option ---','fb-tech'),
                            ),
                            array(
                                'value'=>'off',
                                'label'=>esc_html__('Horizontal','fb-tech'),
                            ),
                            array(
                                'value'=>'on',
                                'label'=>esc_html__('Vertical','fb-tech'),
                            )
                        )
                    ),
                    array(
                        'id'          => 's7upf_show_service_product_detail',
                        'label'       => esc_html__('Show service product','fb-tech'),
                        'type'        => 'select',
                        'section'     => 'option_woo',
                        'desc'=>esc_html__('This allow you to show or hide box service product in product detail','fb-tech'),
                        'std'=>'',
                        'choices'     => array(
                            array(
                                'value'=>'',
                                'label'=>esc_html__('--- Theme option ---','fb-tech'),
                            ),
                            array(
                                'value'=>'off',
                                'label'=>esc_html__('Off','fb-tech'),
                            ),
                            array(
                                'value'=>'on',
                                'label'=>esc_html__('On','fb-tech'),
                            )
                        )
                    ),
                    array(
                        'id'          => 's7upf_title_service_product',
                        'label'       => esc_html__('Title service','fb-tech'),
                        'type'        => 'text',
                        'section'     => 'option_woo',
                        'condition'   => 's7upf_show_service_product_detail:is(on)',
                        'desc'=>esc_html__('Enter text.','fb-tech'),
                    ),
                    array(
                        'id'          => 's7upf_info_service_product',
                        'label'       => esc_html__('Info service','fb-tech'),
                        'type'        => 'textarea-simple',
                        'section'     => 'option_woo',
                        'rows'        => '4',
                        'condition'   => 's7upf_show_service_product_detail:is(on)',
                        'desc'=>esc_html__('Enter text.','fb-tech'),
                    ),
                    array(
                        'id'          => 's7upf_product_tab_data',
                        'label'       => esc_html__('Add Tab','fb-tech'),
                        'type'        => 'list-item',
                        'settings'    => array(
                            array(
                                'id' => 'tab_content',
                                'label' => esc_html__('Content', 'fb-tech'),
                                'type' => 'textarea',
                            ),
                            array(
                                'id' => 'priority',
                                'label' => esc_html__('Priority (Default 50)', 'fb-tech'),
                                'type'        => 'numeric-slider',
                                'min_max_step'=> '0,100,5',
                                'std'         => 50
                            ),
                        )
                    ),

                    array(
                        'label' => esc_html__('Banner setting','fb-tech'),
                        'id' => 'mb_banner_setting',
                        'type' => 'tab'
                    ),
                    array(
                        'id'          => 'enable_banner_shop_single',
                        'label' => esc_html__('Enable banner', 'fb-tech'),
                        'desc' => esc_html__('This allow you to turn on or off Banner.', 'fb-tech'),
                        'type'        => 'select',
                        'choices'     => array(
                            array(
                                'value'=>'',
                                'label'=>esc_html__('--- Theme option ---','fb-tech'),
                            ),
                            array(
                                'value'=>'off',
                                'label'=>esc_html__('Off','fb-tech'),
                            ),
                            array(
                                'value'=>'on',
                                'label'=>esc_html__('On','fb-tech'),
                            ),
                        ),
                        'section' => 'option_woo',
                        'std'  => ''
                    ),
                    array(
                        'id'          => 'boxes_banner_shop_single',
                        'label'       => esc_html__('Boxes/Fullwidth banner','fb-tech'),
                        'desc' => esc_html__('Boxes/Fullwidth banner.', 'fb-tech'),
                        'type'        => 'on-off',
                        'std' => 'off',
                        'condition'   => 'enable_banner_shop_single:is(on)',
                    ),

                    array(
                        'id' => 'list_item_banner_shop_single',
                        'label' => esc_html__('Add banner slider item', 'fb-tech'),
                        'desc' => esc_html__('Enter info.', 'fb-tech'),
                        'type' => 'list-item',
                        'section' => 'option_woo',
                        'condition'   => 'enable_banner_shop_single:is(on)',
                        'settings'    => array(
                            array(
                                'id'        => 'img',
                                'label' => esc_html__('Background banner', 'fb-tech'),
                                'desc' => esc_html__('Select image from library.', 'fb-tech'),
                                'std'        => '',
                                'type'        => 'upload',
                            ),
                            array(
                                'id'        => 'info',
                                'label' => esc_html__('Info banner', 'fb-tech'),
                                'desc' => esc_html__('Enter info.', 'fb-tech'),
                                'std'        => '<h2 class="title30 color">Laptop Dell XPS</h2><h2 class="title30 white">New Model 2018 by Fanbong</h2><a href="#" class="shop-button color">Shop Now</a>',
                                'rows'        => '4',
                                'type'        => 'textarea-simple',
                            ),

                        )
                    )

                )
            );
            if(function_exists('ot_register_meta_box')){
                ot_register_meta_box($s7upf_metabox);
            }
        }
        // End metabox product page

        // Function catalog mode
        static function s7upf_custom_add_to_cart_link($content){
            $hide_other_page = s7upf_get_option('hide_other_page');
            $show_mode = s7upf_check_catelog_mode();
            if($show_mode == 'on' and $hide_other_page == 'on') $content = '';
            return $content;
        }
        static function s7upf_catelog_custom_button(){
            $html = '';
            $show_button_catalog = s7upf_get_option('show_button_catalog');
            $hide_detail = s7upf_get_option('hide_detail');
            $button_text_catalog = s7upf_get_option('button_text_catalog');
            $url_protocol_type = s7upf_get_option('url_protocol_type');
            $link_url_catalog = s7upf_get_option('link_url_catalog');
            if($show_button_catalog == 'on' and $hide_detail == 'on'){
                if($url_protocol_type == 'email'){
                    $html .= '<a href="mailto:'.$link_url_catalog.'" class="single_add_to_cart_button button alt mb_button_catalog"><i class="fa fa-envelope-o" aria-hidden="true"></i>'.$button_text_catalog.'</a>';
                }elseif ($url_protocol_type == 'phone_number'){
                    $html .= '<a href="tel:'.$link_url_catalog.'" class="single_add_to_cart_button button alt mb_button_catalog"><i class="fa fa-phone" aria-hidden="true"></i>'.$button_text_catalog.'</a>';
                }elseif ($url_protocol_type == 'skype'){
                    $html .= '<a href="skype:'.$link_url_catalog.'?userinfo" class="single_add_to_cart_button button alt mb_button_catalog"><i class="fa fa-skype" aria-hidden="true"></i>'.$button_text_catalog.'</a>';
                }else{
                    $html .= '<a href="'.esc_url($link_url_catalog).'" class="single_add_to_cart_button button alt mb_button_catalog">'.$button_text_catalog.'</a>';
                }

            }

            echo do_shortcode($html);
        }
        static function s7upf_filter_single_add_to_cart(){
            $hide_detail = s7upf_get_option('hide_detail');

            $show_mode = s7upf_check_catelog_mode();
            if($show_mode == 'on' and $hide_detail == 'on'){
                remove_action( 's7upf_template_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);
                add_action( 's7upf_template_single_add_to_cart', array(__CLASS__, 's7upf_catelog_custom_button'), 40);

            }
        }
        static function s7upf_change_price_html($price, $product){
            $text_price = s7upf_get_option('text_price');
            $show_mode = s7upf_check_catelog_mode();
            if($show_mode == 'on'){
                if(!empty($text_price)){
                    $price = $text_price;
                }else{
                    $price = '';
                }
            }

            return $price;
        }
        // End function catalog mode
    }
    S7upf_Woocommerce_Controller::_init();
}