<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 19/09/2017
 * Time: 11:41 SA
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
?>
<div class="product-price">
    <?php woocommerce_template_single_price(); ?>
</div>
<?php if( $rating_count > 0 and 'yes' === get_option( 'woocommerce_enable_review_rating' ) ){ ?>
        <?php echo s7upf_get_rating_html();?>
        <?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link add-review" rel="nofollow"><?php printf( _n( '%s Add your review', '%s Add your reviews', $review_count, 'fb-tech' ), '<span class="number-rate silver">(' . esc_html( $review_count ) . ')</span>' ); ?></a><?php endif ?>
<?php } ?>
<div class="desc product-desc">
    <?php woocommerce_template_single_excerpt(); ?>
</div>
<?php woocommerce_template_single_add_to_cart();
if(class_exists('YITH_WCWL_Init') || class_exists('YITH_Woocompare')){?>
<ul class="detail-wishlist-compare list-inline-block">
    <li>
        <?php echo s7up_wishlist_url('<span>'.esc_html__('Add to Wishlist','fb-tech').'</span>'); ?>
    </li>
    <li>
        <?php echo s7upf_compare_url(false,'<span>'.esc_html__('Add to Compare','fb-tech').'</span>');?>
    </li>
</ul>
<?php
}
$box_share = s7upf_get_option('s7upf_show_share_product_detail');
if($box_share=='on') { $admin_email = get_option('admin_email'); ?>
    <div class="detail-social-button share-product-detail">
        <a class="share-mail silver"   href="mailto:<?php echo esc_attr($admin_email);?>"></a>
        <a class="share-mayin silver"   href="javascript:window.print()"></a>
        <a class="share-google silver" target="popup"  href="https://plus.google.com/share?url=<?php the_permalink(); ?>"></a>
        <a class="share-twitter silver" target="popup" href="http://twitter.com/share?url=<?php the_permalink() ?>"></a>
        <a class="no-open share-pin silver" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" target="popup"></a>
        <a class="share-face silver" target="popup" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"></a>
    </div>
    <?php
}
