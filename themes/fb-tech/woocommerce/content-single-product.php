<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
$sidebar = s7upf_get_sidebar();
$sidebar_pos = $sidebar['position'];

//data s7upf_show_service_product_detail
$show_service = s7upf_get_value_by_id('s7upf_show_service_product_detail');
$title_service = s7upf_get_option_both_id('s7upf_title_service_product','s7upf_title_service_product','s7upf_show_service_product_detail');
$info_service = s7upf_get_option_both_id('s7upf_info_service_product','s7upf_info_service_product','s7upf_show_service_product_detail');
$style_gallery = s7upf_get_value_by_id('s7upf_style_gallery_detail');
$class_col_img ='5';
$class_col_info ='7';
if('on' == $style_gallery){
    $class_col_img='6';
    $class_col_info='6';
}
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action( 'woocommerce_before_single_product_summary' );
    ?>
    <div class="detail-product ">
        <div class="row">
            <div class="<?php echo ($sidebar_pos == 'no')? 'col-md-'.$class_col_img.' col-sm-'.$class_col_img.' col-xs-12' :'col-md-7 col-sm-12 col-xs-12'; ?>">
                <?php woocommerce_show_product_images(); ?>
            </div>
            <div class="<?php echo ($sidebar_pos == 'no')? 'col-md-'.$class_col_info.' col-sm-'.$class_col_info.' col-xs-12' :'col-md-5 col-sm-12 col-xs-12'; ?>">
                <div class="detail-info show_product_service_<?php echo esc_attr($show_service); ?>">
                    <div class="summary entry-summary">
                        <?php
                        /**
                         * woocommerce_single_product_summary hook.
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked WC_Structured_Data::generate_product_data() - 60
                         */
                        do_action( 'woocommerce_single_product_summary' );
                        ?>

                    </div><!-- .summary -->
                    <?php if($show_service == 'on'){ ?>
                    <div class="service-product-custom text-center">
                        <?php if(!empty($title_service)){  ?>
                        <h2 class="title18 white"><?php echo esc_attr($title_service); ?></h2>
                        <?php } ?>
                        <?php if(!empty($title_service)){  ?>
                        <div class="list-service-product">
                            <?php echo do_shortcode($info_service); ?>
                        </div>
                        <?php } ?>
                    </div><!-- .service-product -->
                    <?php } ?>
                </div>

             </div>
        </div>
    </div>


    <?php
    /**
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );
    ?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
