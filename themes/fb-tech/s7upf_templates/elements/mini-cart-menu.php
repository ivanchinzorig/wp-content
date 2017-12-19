<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 07/09/2017
 * Time: 8:51 SA
 */
if ( !class_exists('WC_Product') and is_admin() ) {
    return;
}?>
<div class="mini-cart-box mini-cart1 dropdown-box">
    <a class="mini-cart-link bg-color" href="#">
        <div class="total-default hidden"><?php echo wc_price(0)?></div>
        <span class="mini-cart-icon title18 white"><i class="icon ion-android-cart"></i></span>
        <sup class="mini-cart-number white title10  mb-count-ajax"><?php echo count(WC()->cart->get_cart()); ?></sup>
        <span class="mini-cart-label white"><?php echo esc_html__('Cart','fb-tech')?></span>
    </a>
    <div class="mini-cart-content dropdown-list text-left">
        <?php s7upf_mini_cart(); ?>
    </div>
</div>
