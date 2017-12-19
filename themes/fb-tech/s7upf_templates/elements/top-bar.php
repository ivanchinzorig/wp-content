<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 05/09/2017
 * Time: 9:34 SA
 */
$class_color_text = S7upf_Assets::build_css('color:'.$text_color.';');
$class_color_icon = S7upf_Assets::build_css('color:'.$icon_color.';');
if('style1' == $style){ ?>
    <div class="top-header element-top-bar style1 <?php echo esc_attr($el_class);?>">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="desc hot-line"><?php echo wpb_js_remove_wpautop($content, true); ?></div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <ul class="search-cart-top list-inline-block pull-right">
                    <?php if('on' == $show_search){?>
                    <li>
                        <form class="search-hover live-search-<?php echo esc_attr($live_search);?>">
                            <input name="s" type="text" autocomplete="off" value="<?php echo get_search_query()?>">
                            <input name="post_type" type="hidden" value="product">
                            <input value="" type="submit" class="hidden">
                            <span class="gray  <?php echo esc_attr($class_color_text); ?>"><i class="title18 color icon ion-ios-search-strong <?php echo esc_attr($class_color_icon); ?>"></i><?php echo esc_html__('Search','fb-tech')?></span>
                            <div class="list-product-search"></div>
                        </form>
                    </li>
                    <?php } if('on' == $show_log_in){ ?>
                    <li>
                        <?php if(is_user_logged_in()){?>
                            <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="sign-up  <?php echo esc_attr($class_color_text); ?>"><span class="color title18 <?php echo esc_attr($class_color_icon); ?>"><i class="icon ion-android-person"></i></span><?php echo esc_html__('Logout','fb-tech')?></a>
                        <?php } elseif(!is_user_logged_in()){?>
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') );  ?>" class="sign-up  <?php echo esc_attr($class_color_text); ?>"><span class="color title18 <?php echo esc_attr($class_color_icon); ?>"><i class="icon ion-android-person"></i></span><?php echo esc_html__('Sign Up','fb-tech')?></a>
                        <?php } ?>
                    </li>
                    <?php }
                    if('on' == $show_mini_cart and class_exists('WC_Product') and !is_admin()){?>
                    <li>
                        <div class="mini-cart-box mini-cart1 dropdown-box">
                            <a class="mini-cart-link" href="#">
                                <div class="total-default hidden"><?php echo wc_price(0)?></div>
                                <span class="mini-cart-icon title18 color  <?php echo esc_attr($class_color_icon); ?>"><i class="icon ion-android-cart"></i></span>
                                <sup class="mini-cart-number gray title10 mb-count-ajax <?php echo esc_attr($class_color_icon); ?>"><?php echo count(WC()->cart->get_cart()); ?></sup>
                                <span class="mini-cart-label gray <?php echo esc_attr($class_color_text); ?>"><?php echo esc_html__('Cart','fb-tech')?></span>
                            </a>
                            <div class="mini-cart-content dropdown-list text-left">
                                <?php s7upf_mini_cart(); ?>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
}else{

    $logo = '';
    if(!empty($logo_img)){
        $img = wp_get_attachment_image_src( $logo_img ,"full");
        $logo .= $img[0];
    }else{
        $logo .= s7upf_get_option('logo');
    }?>
    <div class="top-header top-header3 element-top-bar style2 <?php echo esc_attr($el_class);?>">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="logo logo3">
                    <h1 class="hidden"><?php echo get_bloginfo('name', 'display'); ?></h1>
                    <a href="<?php echo esc_url(get_home_url('/'))?>"><img src="<?php echo esc_url($logo); ?>" alt="logo"></a>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <ul class="search-cart-top list-inline-block pull-right">
                    <?php if('on' == $show_search){?>
                        <li>
                            <form class="search-hover live-search-<?php echo esc_attr($live_search);?>">
                                <input name="s" type="text" autocomplete="off" value="<?php echo get_search_query()?>">
                                <input name="post_type" type="hidden" value="product">
                                <input value="" type="submit" class="hidden">
                                <span class="gray  <?php echo esc_attr($class_color_text); ?>"><i class="title18 color icon ion-ios-search-strong <?php echo esc_attr($class_color_icon); ?>"></i><?php echo esc_html__('Search','fb-tech')?></span>
                                <div class="list-product-search"></div>
                            </form>
                        </li>
                    <?php } if('on' == $show_log_in){ ?>
                        <li>
                            <?php if(is_user_logged_in()){?>
                                <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="sign-up  <?php echo esc_attr($class_color_text); ?>"><span class="color title18 <?php echo esc_attr($class_color_icon); ?>"><i class="icon ion-android-person"></i></span><?php echo esc_html__('Logout','fb-tech')?></a>
                            <?php } elseif(!is_user_logged_in()){?>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') );  ?>" class="sign-up  <?php echo esc_attr($class_color_text); ?>"><span class="color title18 <?php echo esc_attr($class_color_icon); ?>"><i class="icon ion-android-person"></i></span><?php echo esc_html__('Sign Up','fb-tech')?></a>
                            <?php } ?>
                        </li>
                    <?php } if('on' == $show_mini_cart and class_exists('WC_Product') and !is_admin()){?>
                        <li>
                            <div class="mini-cart-box mini-cart1 dropdown-box">
                                <a class="mini-cart-link" href="#">
                                    <div class="total-default hidden"><?php echo wc_price(0)?></div>
                                    <span class="mini-cart-icon title18 color  <?php echo esc_attr($class_color_icon); ?>"><i class="icon ion-android-cart"></i></span>
                                    <sup class="mini-cart-number gray title10 mb-count-ajax <?php echo esc_attr($class_color_icon); ?>"><?php echo count(WC()->cart->get_cart()); ?></sup>
                                    <span class="mini-cart-label gray <?php echo esc_attr($class_color_text); ?>"><?php echo esc_html__('Cart','fb-tech')?></span>
                                </a>
                                <div class="mini-cart-content dropdown-list text-left">
                                    <?php s7upf_mini_cart(); ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                </div>
            </div>
    </div>
    <?php
}