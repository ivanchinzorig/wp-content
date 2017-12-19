<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product, $post;
$default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_110x80.png';
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype='multipart/form-data'>
    <div class="table-group-detail table-responsive radius">

    <table class="group_table table">
        <tbody>
        <tr>
            <th><span><?php esc_html_e('Image','fb-tech')?></span></th>
            <th><span><?php esc_html_e('PRODUCT NAME','fb-tech')?></span></th>
            <th><span><?php esc_html_e('price','fb-tech')?></span></th>
            <th><span><?php esc_html_e('Qty','fb-tech')?></span></th>
        </tr>
        <?php
        $quantites_required = false;
        $previous_post      = $post;

        foreach ( $grouped_products as $grouped_product ) {
            $post_object        = get_post( $grouped_product->get_id() );
            $quantites_required = $quantites_required || ( $grouped_product->is_purchasable() && ! $grouped_product->has_options() );

            setup_postdata( $post =& $post_object );
            ?>
            <tr id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
                <td>
                    <div class="product-thumb">
                        <a class="product-thumb-link" href="<?php echo esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink( $grouped_product->get_id() ), $grouped_product->get_id() ) );?>">
                            <?php
                            if ( has_post_thumbnail($post_object) ) {
                                $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post_object );
                                echo get_the_post_thumbnail( $post_object,array(100,67), array(
                                    'title'	 => $props['title'],
                                    'alt'    => $props['alt'],
                                ) );
                            }else echo '<img alt="" src="'.esc_url($default_thumbnail).'">'; ?>

                        </a>
                    </div>
                </td>
                <td>
                    <h3 class="product-title title14 font-bold"> <?php echo ($grouped_product->is_visible()) ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink( $grouped_product->get_id() ), $grouped_product->get_id() ) ) . '">' . $grouped_product->get_name() . '</a>' : $grouped_product->get_name(); ?></h3>
                </td>
                <td class="price">
                    <div class="product-price ">
                        <?php
                        echo do_shortcode($grouped_product->get_price_html());
                        echo wc_get_stock_html( $grouped_product );
                        ?>
                    </div>
                </td>
                <td>
                    <?php if ( ! $grouped_product->is_purchasable() || $grouped_product->has_options() ) : ?>
                        <?php woocommerce_template_loop_add_to_cart(); ?>

                    <?php elseif ( $grouped_product->is_sold_individually() ) : ?>
                        <input type="checkbox" name="<?php echo esc_attr( 'quantity[' . $grouped_product->get_id() . ']' ); ?>" value="1" class="wc-grouped-product-add-to-cart-checkbox" />

                    <?php else : ?>
                        <?php
                        /**
                         * @since 3.0.0.
                         */
                        do_action( 'woocommerce_before_add_to_cart_quantity' );

                        woocommerce_quantity_input( array(
                            'input_name'  => 'quantity[' . $grouped_product->get_id() . ']',
                            'input_value' => isset( $_POST['quantity'][ $grouped_product->get_id() ] ) ? wc_stock_amount( $_POST['quantity'][ $grouped_product->get_id() ] ) : 0,
                            'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product ),
                            'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product->get_max_purchase_quantity(), $grouped_product ),
                        ) );

                        /**
                         * @since 3.0.0.
                         */
                        do_action( 'woocommerce_after_add_to_cart_quantity' );
                        ?>
                    <?php endif; ?>
                </td>
            </tr>

            <?php
        }
        // Return data to original post.
        setup_postdata( $post =& $previous_post );
        ?>
        </tbody>
    </table>

    </div>
    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

    <?php if ( $quantites_required ) : ?>

        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

    <?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
