<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 05/06/2017
 * Time: 14:00
 */
?>
<div class="mb-popup-product woocommerce detail-with-sidebar detail-light-box content-detail">
    <div class="title-product-detail">
        <h2 class="title30 font-bold"><?php the_title(); ?></h2>

    </div>
    <div class="detail-product product">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12">
                <?php woocommerce_show_product_images(); ?>
            </div>
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="detail-info">
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
                </div>
            </div>
        </div>
    </div>

</div>
