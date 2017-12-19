<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 13/08/15
 * Time: 10:20 AM
 */
$main_color = s7upf_get_value_by_id('main_color');
?>
<?php
$style = '';

/*****BEGIN MAIN COLOR*****/
if(!empty($main_color)){
    list($r, $g, $b) = sscanf($main_color, "#%02x%02x%02x");
	$style .= '.widget_nav_menu ul li > a:hover, .widget_recent_comments ul li > a:hover, .widget_meta ul li > a:hover, .widget_pages ul li > a:hover, .widget_categories ul li > a:hover, .widget_recent_entries ul li > a:hover, .widget_archive ul li > a:hover,.header-nav8 .main-nav3.main-nav>ul>li:hover>a,.about-button a .icon, .choise-accordion5 .item-toggle-tab.active .toggle-tab-title,.item-adv5:hover .adv-info5 h2,.desc.color,.pagi-nav a,.header-nav4 .main-nav3.main-nav>ul>li.current-menu-item>a, .header-nav4 .main-nav3.main-nav>ul>li:hover>a,.header-nav4 .main-nav3.main-nav > ul > li.current-menu-parent > a, .header-nav4 .main-nav3.main-nav > ul > li.current-menu-ancestor > a,.main-nav > ul > li .sub-menu > li.active > a, .main-nav > ul > li .sub-menu > li.current-menu-parent > a,.main-nav > ul > li .sub-menu > li.active > a, .main-nav > ul > li .sub-menu > li.current-menu-parent > a.pagi-nav a,.sidebar .widget_nav_menu ul li > a:hover, .sidebar .widget_recent_comments ul li > a:hover, .sidebar .widget_meta ul li > a:hover, .sidebar .widget_pages ul li > a:hover, .sidebar .widget_categories ul li > a:hover, .sidebar .widget_recent_entries ul li > a:hover, .sidebar .widget_archive ul li > a:hover,.content-blog-detail .post-tags-cats a,.wpb-js-composer .mega-menu-tour .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:hover,.wpb-js-composer .mega-menu-tour .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a,.woocommerce .s7up-css-cart .woocommerce-cart-form table .coupon .button,.woocommerce .s7up-css-cart .cart-collaterals .checkout-button,.woocommerce-account .woocommerce-MyAccount-content .edit-account fieldset legend,.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,.tagcloud a:hover,.widget_product_categories li.current-cat a:before,.widget_product_categories li.current-cat,.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,.featured-product8 .slick-arrow, .product-control a,.sidebar-widget ul li.current-cat > a, .sidebar-widget ul li.current_page_item > a,.form-newsletter4::after, .popcat-info4 .list-none li a:hover::before,.popcat-info3 .list-none li a:hover::before, .popcat-info4 .list-none li a:hover::before,.title-best-tab .shop-button:hover,.item-client .info-client a:hover,.shop-button.white:hover, a:focus, a:hover,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.popup-icon, .product-title a:hover,.cat-parent.color:hover,.owl-theme .owl-controls .owl-buttons div,.color
    {color: '.$main_color.' }'."\n";
    
    $style .= '.dm-button-color,.dm-button,.social-footer6 a:hover,.main-nav .toggle-mobile-menu span, .main-nav .toggle-mobile-menu::after, .main-nav .toggle-mobile-menu::before,.header6 .main-nav1>ul>li.current-menu-item>a, .header6 .main-nav1>ul>li:hover>a, .line-separate::after, .top-header.bg-color,.mb-element-product-style9 .woocommerce .product-extra-link a.button,.product-block7 .title-best-tab .shop-button,.element-menu-style5 > ul > li > a,.element-infobox9 .item-toggle-tab.active .icon,.function-icon a:hover,.white-pagi .owl-theme .owl-controls .owl-page.active span::after,.main-nav1>ul>li.current-menu-item>a, .main-nav1>ul>li:hover>a,.main-nav1 > ul > li.current-menu-parent > a, .main-nav1 > ul > li.current-menu-ancestor > a,.pagi-nav a.page-current, .pagi-nav a:hover,.pagi-nav .page-numbers.current,.woocommerce .s7up-css-cart .woocommerce-cart-form table .actions .button[name="update_cart"]:hover,.woocommerce .s7up-css-cart .woocommerce-cart-form table .coupon .button:hover,.woocommerce .s7up-css-cart .cart-collaterals .checkout-button:hover,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,.product-control a:hover,.woocommerce div.product form.cart .button,.range-filter .ui-slider-handle.ui-state-default.ui-corner-all, .range-filter .ui-slider-range,.range-filter .ui-slider-handle.ui-state-default.ui-corner-all, .range-filter .ui-slider-range,.view-type a.active,.item-choise:hover .choise-index,.title-best-tab li.active .shop-button, .title-underline::after,.title-best-tab li.active .shop-button, .title-underline::after,body .scroll-top,.bg-color,.shop-button.bg-color2:hover,.item-intro-box.active a,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.owl-theme .owl-controls .owl-buttons div:hover,.owl-theme .owl-controls .owl-page.active span,.shop-button.bg-color, .shop-button:hover,.title-line-after::after
    {background-color: '.$main_color.' }'."\n";

    $style .= '.adv-button5
    {background: rgba( '.$r.', '.$g.', '.$b.' , 0.9);}'."\n";

    $style .= '.item-blog5 .banner-info,.item-product.style3 .product-info
    {background: rgba( '.$r.', '.$g.', '.$b.' , 0.7);}'."\n";

    $style .= '.live-search-true .list-product-search::-webkit-scrollbar-thumb
    { background-image: -webkit-gradient(linear,
    40% 0%,
    75% 84%,
    from( '.$main_color.' ),
    to( '.$main_color.' ),
    color-stop(.6, '.$main_color.' ))}'."\n";

    $style .= '.main-border
    {border: 1px solid '.$main_color.' }'."\n";

    $style .= '.client-block7,.item-adv5:hover::before,.main-nav1>ul>li.current-menu-item>a, .main-nav1>ul>li:hover>a,.main-nav1 > ul > li.current-menu-parent > a, .main-nav1 > ul > li.current-menu-ancestor > a,.pagi-nav a,.pagi-nav .page-numbers.current,.block-quote,.woocommerce .s7up-css-cart .cart-collaterals .checkout-button:hover,.woocommerce .s7up-css-cart .woocommerce-cart-form table .coupon .button,.tagcloud a:hover,.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,.featured-product8 .slick-arrow, .product-control a,.detail-gallery .carousel ul li a.active,.view-type a.active,.item-choise:hover .choise-index,.title-best-tab .shop-button:hover,.item-intro-box.active a,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.owl-theme .owl-controls .owl-buttons div,.shop-button
    {border-color: '.$main_color.' }'."\n";

    $style .= '.owl-theme .owl-controls .owl-page.active span
    {box-shadow: 0 0 0 2px '.$main_color.' }'."\n";

   /* $style .= '
    .main-nav > ul > li.active > a, .main-nav > ul > li.current-menu-parent > a, .main-nav > ul > li.current-menu-ancestor > a
    {color: '.$main_color.' }'."\n";*/

}
/*****END MAIN COLOR*****/

/*****BEGIN CUSTOM CSS*****/
$custom_css = s7upf_get_option('custom_css');
if(!empty($custom_css)){
    $style .= $custom_css."\n";
}

/*****END CUSTOM CSS*****/

/*****BEGIN MENU COLOR*****/
$menu_color = s7upf_get_option('s7upf_menu_color');
$menu_hover = s7upf_get_option('s7upf_menu_color_hover');
$menu_active = s7upf_get_option('s7upf_menu_color_active');
if(is_array($menu_color) && !empty($menu_color)){
    $style .= 'nav>li>a{';
    if(!empty($menu_color['font-color'])) $style .= 'color:'.$menu_color['font-color'].';';
    if(!empty($menu_color['font-family'])) $style .= 'font-family:'.$menu_color['font-family'].';';
    if(!empty($menu_color['font-size'])) $style .= 'font-size:'.$menu_color['font-size'].';';
    if(!empty($menu_color['font-style'])) $style .= 'font-style:'.$menu_color['font-style'].';';
    if(!empty($menu_color['font-variant'])) $style .= 'font-variant:'.$menu_color['font-variant'].';';
    if(!empty($menu_color['font-weight'])) $style .= 'font-weight:'.$menu_color['font-weight'].';';
    if(!empty($menu_color['letter-spacing'])) $style .= 'letter-spacing:'.$menu_color['letter-spacing'].';';
    if(!empty($menu_color['line-height'])) $style .= 'line-height:'.$menu_color['line-height'].';';
    if(!empty($menu_color['text-decoration'])) $style .= 'text-decoration:'.$menu_color['text-decoration'].';';
    if(!empty($menu_color['text-transform'])) $style .= 'text-transform:'.$menu_color['text-transform'].';';
    $style .= '}'."\n";
}
if(!empty($menu_hover)){
    $style .= 'nav>li>a:hover{color:'.$menu_hover.'}'."\n";
    $style .= 'nav>li>a:hover{background-color:'.$menu_hover.'}'."\n";
}
if(!empty($menu_active)){
    $style .= 'nav li.parent-current-menu-item>a{color:'.$menu_active.'}'."\n";
    $style .= 'nav li.current-menu-item >a{background-color:'.$menu_active.'}'."\n";
}

/*****END MENU COLOR*****/

/*****BEGIN TYPOGRAPHY*****/
$typo_data = s7upf_get_option('s7upf_custom_typography');
if(is_array($typo_data) && !empty($typo_data)){
    foreach ($typo_data as $value) {
        switch ($value['typo_area']) {
            case 'header':
                $style_class = '.site-header';
                break;

            case 'footer':
                $style_class = '.site-footer';
                break;

            case 'widget':
                $style_class = '.widget';
                break;
            
            default:
                $style_class = '#main-content';
                break;
        }
        $class_array = explode(',', $style_class);
        $new_class = '';
        if(is_array($class_array)){
            foreach ($class_array as $prefix) {
                $new_class .= $prefix.' '.$value['typo_heading'].',';
            }
        }
        if(!empty($new_class)) $style .= $new_class.' .nocss{';
        if(!empty($value['typography_style']['font-color'])) $style .= 'color:'.$value['typography_style']['font-color'].';';
        if(!empty($value['typography_style']['font-family'])) $style .= 'font-family:'.$value['typography_style']['font-family'].';';
        if(!empty($value['typography_style']['font-size'])) $style .= 'font-size:'.$value['typography_style']['font-size'].';';
        if(!empty($value['typography_style']['font-style'])) $style .= 'font-style:'.$value['typography_style']['font-style'].';';
        if(!empty($value['typography_style']['font-variant'])) $style .= 'font-variant:'.$value['typography_style']['font-variant'].';';
        if(!empty($value['typography_style']['font-weight'])) $style .= 'font-weight:'.$value['typography_style']['font-weight'].';';
        if(!empty($value['typography_style']['letter-spacing'])) $style .= 'letter-spacing:'.$value['typography_style']['letter-spacing'].';';
        if(!empty($value['typography_style']['line-height'])) $style .= 'line-height:'.$value['typography_style']['line-height'].';';
        if(!empty($value['typography_style']['text-decoration'])) $style .= 'text-decoration:'.$value['typography_style']['text-decoration'].';';
        if(!empty($value['typography_style']['text-transform'])) $style .= 'text-transform:'.$value['typography_style']['text-transform'].';';
        $style .= '}';
        $style .= "\n";
    }
}

/*****END TYPOGRAPHY*****/

$custom_css = s7upf_get_option('custom_css');
if(!empty($custom_css)){
    $style .= $custom_css."\n";
}
if(!empty($style)) print $style;
?>