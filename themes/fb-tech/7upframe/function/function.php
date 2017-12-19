<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
 
/******************************************Core Function******************************************/
//Get option
if(!function_exists('s7upf_get_option')){
    function s7upf_get_option($key,$default=NULL)
    {
        if(function_exists('ot_get_option'))
        {
            return ot_get_option($key,$default);
        }

        return $default;
    }
}
//Get list post type
if(!function_exists('s7upf_list_post_type'))
{
    function s7upf_list_post_type($post_type,$type = true)
    {
        global $post;
        $page_list = array();
        if($type){
            $page_list[] = array(
                'value' => '',
                'label' => esc_html__('-- Choose One --','fb-tech')
            );
        }
        else $page_list[] = esc_html__('-- Choose One --','fb-tech');
        $args= array(
        'post_type' => $post_type,
        'posts_per_page' => -1, 
        );
        $query = new WP_Query($args);
        if($query->have_posts()): while ($query->have_posts()):$query->the_post();
            if($type){
                $page_list[] = array(
                    'value' => $post->ID,
                    'label' => $post->post_title
                );
            }
            else $page_list[$post->ID] = $post->post_title;
            endwhile;
        endif;
        wp_reset_postdata();
        return $page_list;
    }
}
//Get list header page
if(!function_exists('s7upf_list_header_page'))
{
    function s7upf_list_header_page()
    {
        global $post;
        $page_list = array();
        $page_list[] = array(
            'value' => '',
            'label' => esc_html__('-- Choose One --','fb-tech')
        );
        $args= array(
            'post_type' => 's7upf_header',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if($query->have_posts()): while ($query->have_posts()):$query->the_post();
                 $page_list[] = array(
                    'value' => $post->ID,
                    'label' => $post->post_title
                );
        endwhile;
        endif;
        wp_reset_postdata();
        return $page_list;
    }
}

//Get list footer page
if(!function_exists('s7upf_list_footer_page'))
{
    function s7upf_list_footer_page()
    {
        global $post;
        $page_list = array();
        $page_list[] = array(
            'value' => '',
            'label' => esc_html__('-- Choose One --','fb-tech')
        );
        $args= array(
            'post_type' => 's7upf_footer',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if($query->have_posts()): while ($query->have_posts()):$query->the_post();
            $page_list[] = array(
                'value' => $post->ID,
                'label' => $post->post_title
            );
        endwhile;
        endif;
        wp_reset_postdata();
        return $page_list;
    }
}

if(!function_exists('s7upf_get_data_isset')){
    function s7upf_get_data_isset($parent,$key){
        if(is_array($parent) && count($parent) > 0){
            if(isset($parent[$key])){
                return $parent[$key];
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
}
//Get list sidebar
if(!function_exists('s7upf_get_sidebar_ids'))
{
    function s7upf_get_sidebar_ids($for_optiontree=false)
    {
        global $wp_registered_sidebars;
        $r=array();
        $r[]=esc_html__('--Select--','fb-tech');
        if(!empty($wp_registered_sidebars)){
            foreach($wp_registered_sidebars as $key=>$value)
            {

                if($for_optiontree){
                    $r[]=array(
                        'value'=>$value['id'],
                        'label'=>$value['name']
                    );
                }else{
                    $r[$value['id']]=$value['name'];
                }
            }
        }
        return $r;
    }
}
if(!function_exists('s7upf_get_size_image')){
    function s7upf_get_size_image($default, $value = ''){
        $return = $default;
        if(strpos($value,'x')){
            $size_arr = explode('x',$value);
            if(is_array($size_arr) and count($size_arr) == 2){
                $return = $size_arr;
            }
        }else{
            if($value != '' and !empty($value)){
                $return = $value;
            }else if(strpos($default,'x')){
                $size_arr = explode('x',$default);
                if(is_array($size_arr) and count($size_arr) == 2){
                    $return = $size_arr;
                }
            }
        }
        return $return;
    }
}
if(!function_exists('s7upf_get_vc_build_link')){
    function s7upf_get_vc_build_link($link='' , $class='' , $get='html' , $title_text='' , $attr_title = false){
        $text = '';
        if ( ! empty( $link ) and function_exists('vc_build_link')) {
            $link = vc_build_link( $link );
            if(empty($title_text) and !empty($link['title'])) $title_text = $link['title'];
            if(!empty($title_text))
            $text = '<a class="'.$class.'" '.(($link['url']) ? 'href="'.esc_url( $link['url'] ).'"':''). ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' ) . ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' ) . ( ($link['title'] and $attr_title == true) ? ' title="' . esc_attr( $link['title'] ) . '"' : '' ) . '>' . $title_text . '</a>';

            if('link' === $get and isset($link['url'])){
                $text = esc_url($link['url']);
            }
        }

        return $text;
    }
}

//Get list mega menu page
if(!function_exists('s7upf_list_meage_menu_page'))
{
    function s7upf_list_meage_menu_page()
    {
        global $post;
        $page_list = array();
        $page_list[''] = esc_html__('None','fb-tech');
        $args= array(
            'post_type' => 's7upf_mega_item',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if($query->have_posts()): while ($query->have_posts()):$query->the_post();
            $page_list[$post->ID] = $post->post_title;
        endwhile;
        endif;
        wp_reset_postdata();
        return $page_list;
    }
}
if (!function_exists('s7upf_convert_array')) {

    function s7upf_convert_array($old_array)
    {
        $new_array = array();
        foreach ($old_array as $key => $value) {
            $new_array[$value] = $key;
        }
        return $new_array;
    }
}

if(!function_exists('s7upf_get_order_list_shop')) {
    function s7upf_get_order_list_shop($current = false, $extra = array(), $return = 'array')
    {
        $default = array(
            'none' => esc_html__('None', 'fb-tech'),
            'ID' => esc_html__('Product ID', 'fb-tech'),
            'author' => esc_html__('Author', 'fb-tech'),
            'title' => esc_html__('Product Title', 'fb-tech'),
            'date' => esc_html__('Product Date', 'fb-tech'),
            'modified' => esc_html__('Last Modified Date', 'fb-tech'),
            'parent' => esc_html__('Product Parent', 'fb-tech'),
            'rand' => esc_html__('Random', 'fb-tech'),
            'comment_count' => esc_html__('Comment Count', 'fb-tech'),
            'popularity' => esc_html__('Product popularity - Best Seller','fb-tech'),
            'rating' => esc_html__('Rating','fb-tech'),
            'mostview' => esc_html__('Most View','fb-tech'),
            'price' => esc_html__('Sort by price','fb-tech'),
        );

        if (!empty($extra) and is_array($extra)) {
            $default = array_merge($default, $extra);
        }

        if ($return == "array") {
            return $default;
        } elseif ($return == 'option') {
            $html = '';
            if (!empty($default)) {
                foreach ($default as $key => $value) {
                    $selected = selected($key, $current, false);
                    $html .= "<option {$selected} value='{$key}'>{$value}</option>";
                }
            }
            return $html;
        }
    }
}

// get list attribute
if(!function_exists('s7upf_list_attribute_product'))
{
    function s7upf_list_attribute_product($show_all = true)
    {
        if($show_all) $attribute_array = array('--Select--' => '');
        else $attribute_array = array();
        $attribute_taxonomies = wc_get_attribute_taxonomies();
        if ($attribute_taxonomies) {
            foreach ($attribute_taxonomies as $key=>$tax) {
                if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) {
                    $attribute_array[$tax->attribute_label]=$tax->attribute_name;
                }
            }
        }
        return $attribute_array;
    }
}

//Get order list
if(!function_exists('s7upf_get_order_list'))
{
    function s7upf_get_order_list($current=false,$extra=array(),$return='array')
    {
        $default = array(
            esc_html__('None','fb-tech')               => 'none',
            esc_html__('Post ID','fb-tech')            => 'ID',
            esc_html__('Author','fb-tech')             => 'author',
            esc_html__('Post Title','fb-tech')         => 'title',
            esc_html__('Post Name','fb-tech')          => 'name',
            esc_html__('Post Date','fb-tech')          => 'date',
            esc_html__('Last Modified Date','fb-tech') => 'modified',
            esc_html__('Post Parent','fb-tech')        => 'parent',
            esc_html__('Random','fb-tech')             => 'rand',
            esc_html__('Comment Count','fb-tech')      => 'comment_count',
            esc_html__('View Post','fb-tech')          => 'post_views',
            esc_html__('Like Post','fb-tech')          => '_post_like_count',
            esc_html__('Custom Modified Date','fb-tech')=> 'time_update',
        );

        if(!empty($extra) and is_array($extra))
        {
            $default=array_merge($default,$extra);
        }

        if($return=="array")
        {
            return $default;
        }elseif($return=='option')
        {
            $html='';
            if(!empty($default)){
                foreach($default as $key=>$value){
                    $selected=selected($value,$current,false);
                    $html.="<option {$selected} value='{$value}'>{$key}</option>";
                }
            }
            return $html;
        }
    }
}

// Get sidebar
if(!function_exists('s7upf_get_sidebar'))
{
    function s7upf_get_sidebar()
    {
        $default=array(
            'position'=>'right',
            'id'      =>'blog-sidebar'
        );

        return apply_filters('s7upf_get_sidebar',$default);
    }
}

//Favicon
if(!function_exists('s7upf_load_favicon') )
{
    function s7upf_load_favicon()
    {
        $value = s7upf_get_option('favicon');
        $favicon = (isset($value) && !empty($value))?$value:false;
        if($favicon)
            echo '<link rel="Shortcut Icon" href="' . esc_url( $favicon ) . '" type="image/x-icon" />' . "\n";
    }
}
if(!function_exists( 'wp_site_icon' ) ){
    add_action( 'wp_head','s7upf_load_favicon');
    add_action('login_head', 's7upf_load_favicon');
    add_action('admin_head', 's7upf_load_favicon');
}

//Fill css background
if(!function_exists('s7upf_fill_css_background'))
{
    function s7upf_fill_css_background($data)
    {
        $string = '';
        if(!empty($data['background-color'])) $string .= 'background-color:'.$data['background-color'].';'."\n";
        if(!empty($data['background-repeat'])) $string .= 'background-repeat:'.$data['background-repeat'].';'."\n";
        if(!empty($data['background-attachment'])) $string .= 'background-attachment:'.$data['background-attachment'].';'."\n";
        if(!empty($data['background-position'])) $string .= 'background-position:'.$data['background-position'].';'."\n";
        if(!empty($data['background-size'])) $string .= 'background-size:'.$data['background-size'].';'."\n";
        if(!empty($data['background-image'])) $string .= 'background-image:url("'.$data['background-image'].'");'."\n";
        if(!empty($string)) return S7upf_Assets::build_css($string);
        else return false;
    }
}

// Get list menu
if(!function_exists('s7upf_list_menu_name'))
{
    function s7upf_list_menu_name()
    {
        $menu_nav = wp_get_nav_menus();
        $menu_list = array('Default' => '');
        if(is_array($menu_nav) && !empty($menu_nav))
        {
            foreach($menu_nav as $item)
            { 
                if(is_object($item))
                {
                    $menu_list[$item->name] = $item->slug;
                }
            }
        }
        return $menu_list;
    }
}

//Display BreadCrumb
if(!function_exists('s7upf_display_breadcrumb'))
{
    function s7upf_display_breadcrumb()
    {
        $enable_breadcrumb = s7upf_get_option('s7upf_show_breadrumb');
        if(is_single()){
            $enable_breadcrumb = s7upf_get_value_by_id('s7upf_show_breadrumb');
            if(class_exists('WC_Product') and is_woocommerce()){
                $enable_breadcrumb = s7upf_get_value_by_id('s7upf_show_banner_product_detail');
            }
        }else if(is_page()){
            $enable_breadcrumb = get_post_meta(get_the_ID(),'s7upf_show_breadrumb_page',true);
        }
        if($enable_breadcrumb == 'on'){
            ?>
            <div class="bread-crumb">
                <?php if(class_exists('WC_Product') and is_woocommerce()) woocommerce_breadcrumb(); else echo s7upf_breadcrumb();?>
            </div>
        <?php }
    }
}


//get type url
if(!function_exists('s7upf_get_key_url')){
    function s7upf_get_key_url($key,$value){
        if(function_exists('s7upf_get_current_url')) $current_url = s7upf_get_current_url();
        else $current_url = get_the_permalink();
        if(isset($_GET[$key])){
            $current_url = str_replace('&'.$key.'='.$_GET[$key], '', $current_url);
            $current_url = str_replace('?'.$key.'='.$_GET[$key], '?', $current_url);
        }
        if(strpos($current_url,'?') > -1 ){
            $current_url .= '&amp;'.$key.'='.$value;
        }
        else {
            $current_url .= '?'.$key.'='.$value;
        }
        return $current_url;
    }
}
//get option both id
if(!function_exists('s7upf_get_option_both_id')){
    function s7upf_get_option_both_id($id_option, $id_metabox, $key_check, $value=NULL){
        $key_check_metabox = get_post_meta(get_the_ID(),$key_check,true);
        $key_check_option = s7upf_get_option($key_check);
        if('' !== $key_check_option and 'off' !== $key_check_option){
            $value = s7upf_get_option($id_option,$value);
        }
        if(''!==$key_check_metabox and 'off'!==$key_check_metabox){
            $value = get_post_meta(get_the_ID(),$id_metabox,true);
        }else if('off' == $key_check_metabox){
            return;
        }
        return $value;
    }
}

function s7upf_breadcrumb(){
    /* === OPTIONS === */
    $text['home']     = '<i class="icon ion-ios-home"></i>';
    $text['category'] = esc_html__('%s','fb-tech');
    $text['tax']      = esc_html__('Archive for "%s"','fb-tech');
    $text['search']   = esc_html__('Search Results for "%s" Query','fb-tech');
    $text['tag']      = esc_html__('%s','fb-tech');
    $text['author']   = esc_html__('Articles Posted by %s','fb-tech');
    $text['404']      = esc_html__('Error 404','fb-tech');
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = '<span class="delimiter"> <i class="icon ion-ios-arrow-right"></i> </span>';
    $delimiter_cat   = ' , ';
    $before      = '<span class="current">';
    $after       = '</span>';
    /* === END OF OPTIONS === */
    global $post;
    $homeLink = home_url() . '/';
    $linkBefore = '<span class = "mb">';
    $linkAfter = '</span>';

    $link = $linkBefore . '<a href="%1$s">%2$s</a>' . $linkAfter;
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
    } else {
        echo '<div id="crumbs" >' . sprintf($link, $homeLink, $text['home']) . $delimiter;

        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a', $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo do_shortcode($cats);
            }
            echo do_shortcode($before . sprintf($text['category'], single_cat_title('', false)) . $after);
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if (!is_wp_error($thisCat) and $thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' , $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo do_shortcode($cats);
            }
            echo do_shortcode($before . sprintf($text['tax'], single_cat_title('', false)) . $after);

        }elseif ( is_search() ) {
            echo do_shortcode($before . sprintf($text['search'], get_search_query()) . $after);
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo do_shortcode($before . get_the_time('d') . $after);
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo do_shortcode($before . get_the_time('F') . $after);
        } elseif ( is_year() ) {
            echo do_shortcode($before . get_the_time('Y') . $after);
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($showCurrent == 1) echo do_shortcode($delimiter . $before . get_the_title() . $after);
            } else {
                $cat = get_the_category();
                foreach ($cat as $key=>$value){
                    if($key+1 == count($cat)){
                        $cats = get_category_parents($value, TRUE, $delimiter);
                    }else{
                        $cats = get_category_parents($value, TRUE, $delimiter_cat);
                    }
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $linkBefore . '<a' , $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo do_shortcode($cats);
                }
                if ($showCurrent == 1) echo do_shortcode($before . get_the_title() . $after);
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo do_shortcode($before . $post_type->labels->singular_name . $after);
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a', $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo do_shortcode($cats);
            printf($link, get_permalink($parent), $parent->post_title);
            if ($showCurrent == 1) echo do_shortcode($delimiter . $before . get_the_title() . $after);
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo do_shortcode($before . get_the_title() . $after);
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo do_shortcode($breadcrumbs[$i]);
                if ($i != count($breadcrumbs)-1) echo do_shortcode($delimiter);
            }
            if ($showCurrent == 1) echo do_shortcode($delimiter . $before . get_the_title() . $after);
        } elseif ( is_tag() ) {
            echo do_shortcode($before . sprintf($text['tag'], single_tag_title('', false)) . $after);
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo do_shortcode($before . sprintf($text['author'], $userdata->display_name) . $after);
        } elseif ( is_404() ) {
            echo do_shortcode($before . $text['404'] . $after);
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo esc_html__('Page','fb-tech') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</div>';
    }
}

//Get page value by ID
if(!function_exists('s7upf_get_value_by_id'))
{   
    function s7upf_get_value_by_id($key)
    {
        if(!empty($key)){
            $id = get_the_ID();
            if(is_front_page() && is_home()) $id = (int)get_option( 'page_on_front' );
            if(!is_front_page() && is_home()) $id = (int)get_option( 'page_for_posts' );
            if(is_archive() || is_search()) $id = 0;
            if (class_exists('woocommerce')) {
                if(is_shop()) $id = (int)get_option('woocommerce_shop_page_id');
                if(is_cart()) $id = (int)get_option('woocommerce_cart_page_id');
                if(is_checkout()) $id = (int)get_option('woocommerce_checkout_page_id');
                if(is_account_page()) $id = (int)get_option('woocommerce_myaccount_page_id');
            }
            $value = get_post_meta($id,$key,true);
            if(empty($value)) $value = s7upf_get_option($key);
            return $value;
        }
        else return 'Missing a variable of this funtion';
    }
}

//Check woocommerce page
if (!function_exists('s7upf_is_woocommerce_page')) {
    function s7upf_is_woocommerce_page() {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
    }
}

//navigation
if(!function_exists('s7upf_paging_nav'))
{
    function s7upf_paging_nav()
    {
        // Don't print empty markup if there's only one page.
        if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
            return;
        }
        $style_blog = s7upf_get_style_blog('s7upf_style_blog');
        $class_style='df-pagination-blog';
        if($style_blog == 'style2' || $style_blog == 'style3')  $class_style='pagi-nav text-center';
        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => esc_html__( '&larr;', 'fb-tech' ),
            'next_text' => esc_html__( '&rarr;', 'fb-tech' ),
        ) );

        if ($links) : ?>
        <div class="row">
            <div class="col-md-12">
                <nav class="<?php echo esc_attr($class_style)?>" role="navigation">
                    <div class="loop-pagination">
                        <?php echo do_shortcode($links); ?>
                    </div><!-- .pagination -->
                </nav><!-- .navigation -->
            </div>
        </div>
        <?php endif;
    }
}

//Set post view
if(!function_exists('s7upf_set_post_view'))
{
    function s7upf_set_post_view($post_id=false)
    {
        if(!$post_id) $post_id=get_the_ID();

        $view=(int)get_post_meta($post_id,'post_views',true);
        $view++;
        update_post_meta($post_id,'post_views',$view);
    }
}

if(!function_exists('s7upf_get_post_view'))
{
    function s7upf_get_post_view($post_id=false)
    {
        if(!$post_id) $post_id=get_the_ID();

        return (int)get_post_meta($post_id,'post_views',true);
    }
}

//remove attr embed
if(!function_exists('s7upf_remove_w3c')){
    function s7upf_remove_w3c($embed_code){
        $embed_code=str_replace('webkitallowfullscreen','',$embed_code);
        $embed_code=str_replace('mozallowfullscreen','',$embed_code);
        $embed_code=str_replace('frameborder="0"','',$embed_code);
        $embed_code=str_replace('frameborder="no"','',$embed_code);
        $embed_code=str_replace('scrolling="no"','',$embed_code);
        $embed_code=str_replace('&','&amp;',$embed_code);
        return $embed_code;
    }
}

// MetaBox
if(!function_exists('s7upf_display_metabox'))
{
    function s7upf_display_metabox($type ='') {
        switch ($type) {
            case 'blog':?>
                <div class="tp-meta">
                    <span class="tp-meta-date"><i class="fa fa-calendar"></i> <?php echo get_the_date('d M Y,'); ?></span> 
                    <span class="tp-meta-admin"><i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a> , </span> 
                    <span class="tp-meta-comments"><i class="fa fa-comments"></i> [<?php echo get_comments_number(); ?>]
                        <a href="<?php echo esc_url( get_comments_link() ); ?>">
                            <?php 
                            if(get_comments_number()>1) esc_html_e('Comments', 'fb-tech') ;
                            else esc_html_e('Comment', 'fb-tech') ;
                            ?>
                        </a>
                    </span>
                </div>
                <?php
                break;

            case 'single_post':?>
                <ul class="list-none total-post-info">
                    <li>
                        <div class="post-date-author title14">
                            <?php if(is_sticky()){ ?><span class="color"><i class="icon ion-pin"></i><?php echo esc_html__(' Sticky','fb-tech');?></span><?php } ?>
                            <span class="color"><i class="icon ion-calendar"></i><?php echo get_the_date(get_option('date_format')); ?></span>
                            <a class="color" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" ><i class="icon ion-compose"></i><?php echo get_the_author(); ?></a>

                        </div>
                    </li>
                    <?php $cats = get_the_category_list(', ');
                    if($cats) { ?>
                        <li>
                            <div class="post-tags-cats title14 color">
                                <i class="icon ion-android-folder"></i>
                                <?php echo do_shortcode($cats); ?>
                            </div>
                        </li>
                    <?php } ?>
                    <?php $tags = get_the_tag_list(' ',', ',' ');
                    if($tags) { ?>
                        <li>
                            <div class="post-tags-cats title14 color">
                                <i class="icon ion-ios-pricetags"></i>
                                <?php echo do_shortcode($tags);?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <?php
                break;
            case 'share-single':
                $enable_share= s7upf_get_value_by_id('enable_share_single_blog');
                if('on' ==$enable_share) { ?>
                    <div class="social-single">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"
                           class="inline-block round silver" target="popup"><i class="fa fa-facebook"
                                                                               aria-hidden="true"></i></a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=<?php echo get_the_excerpt() ?>"
                           target="popup" class="inline-block round silver"><i class="fa fa-linkedin"
                                                                               aria-hidden="true"></i></a>
                        <a href="http://twitter.com/share?url=<?php the_permalink() ?>" class="inline-block round silver"
                           target="popup"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
                           class="inline-block round silver" target="popup"><i class="fa fa-google-plus"
                                                                               aria-hidden="true"></i></a>
                        <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"
                           class="inline-block round silver"><i class="fa fa-pinterest" aria-hidden="true"></i></a>

                    </div>
                    <?php
                }
                break;
            case 'single-info-author':
                $enable_info_author=s7upf_get_value_by_id('enable_info_author_single_blog');
                if('on' ==$enable_info_author) { ?>
                <div class="single-info-author table">
                    <div class="author-thumb">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                            <?php echo get_avatar(get_current_user_id(), 100); ?>
                        </a>
                    </div>
                    <div class="author-info">
                        <span class=" silver"><?php echo esc_html__('Written By','fb-tech')?></span>
                        <h3 class="title18 font-bold text-uppercase"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a></h3>
                        <a href="#" class=" silver"><?php
                            $user_meta=get_userdata(get_current_user_id());
                            if(!empty($user_meta->roles[0])) echo esc_attr($user_meta->roles[0]);
                            ?></a>
                        <div class="author-social">
                            <a href="#" class="title18  silver"><i class="icon ion-social-twitter"></i></a>
                            <a href="#" class="title18  silver"><i class="icon ion-social-facebook"></i></a>
                            <a href="#" class="title18  silver"><i class="icon ion-social-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <?php
                }
                break;
            case 'post-control':
                $enable_post_control=s7upf_get_value_by_id('enable_post_control_single_blog');
                if('on' ==$enable_post_control) {
                    $previous = get_previous_post();
                    $next = get_next_post();
                    if(get_previous_post() || get_next_post()) { ?>
                        <div class="post-control">
                            <div class="row">
                                <?php if(!empty($previous)){ ?>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="title14 text-left"><a href="<?php echo esc_url(get_preview_post_link($previous->ID))?>" class=" prev-post"><i class="icon ion-ios-arrow-left"></i> <span><?php echo get_the_title($previous->ID); ?></span></a></h3>
                                    </div>
                                <?php } if(!empty($next)){?>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="title14 text-right"><a href="<?php echo esc_url(get_preview_post_link($next->ID))?>" class=" next-post"> <span><?php echo get_the_title($next->ID); ?></span><i class="icon ion-ios-arrow-right"></i> </a></h3>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                break;
            default:?>
                <ul class="post_meta_links">
                    <li class="date"><?php echo get_the_time('d F Y')?></li>
                    <li class="post_by"><i><?php esc_html_e('by', 'fb-tech');?>:</i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a></li>
                    <li class="post_categoty"><i><?php esc_html_e('in', 'fb-tech');?>:</i>
                        <?php $cats = get_the_category_list(', ');?>
                        <?php if($cats) echo do_shortcode($cats); else esc_html_e("No Category",'fb-tech');?>
                    </li>
                    <li class="post_categoty st_post_tag"><i><?php esc_html_e('tag', 'fb-tech');?>:</i>
                        <?php $cats = get_the_tag_list(' ',', ',' ');?>
                        <?php if($cats) echo do_shortcode($cats); else esc_html_e("No Tag",'fb-tech');?>
                    </li>
                    <li class="post_comments"><i><?php esc_html_e('note', 'fb-tech');?>:</i> <a href="<?php echo esc_url( get_comments_link() ); ?>"><?php echo get_comments_number(); ?>
                        <?php 
                            if(get_comments_number()>1) esc_html_e('Comments', 'fb-tech') ;
                            else esc_html_e('Comment', 'fb-tech') ;
                        ?>
                    </a></li>
                </ul>                
                <?php
                break;
        }
    ?>        
    <?php
    }
}
if(!function_exists('s7upf_get_header_default')){
    function s7upf_get_header_default()
    { ?>
        <div class="header-nav header-nav4 bg-white df-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="logo logo1">
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                               title="<?php echo esc_attr__("logo", 'fb-tech'); ?>">
                                <?php $s7upf_logo = s7upf_get_option('logo'); ?>
                                <?php if ($s7upf_logo != '') {
                                    echo '<h1 class="hidden">' . get_bloginfo('name', 'display') . '</h1><img src="' . esc_url($s7upf_logo) . '" alt="logo">';
                                } else {
                                    echo '<h1>' . get_bloginfo('name', 'display') . '</h1>';
                                }
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <?php if (has_nav_menu('primary')) { ?>
                            <nav class="main-nav main-nav3">
                                <?php
                                wp_nav_menu(array(
                                        'theme_location' => 'primary',
                                        'container' => false,
                                        'walker' => new S7upf_Walker_Nav_Menu(),
                                    )
                                ); ?>
                                <a href="#" class="toggle-mobile-menu"><span></span></a>
                            </nav>
                        <?php }else { ?><p class="df-text-nav"><?php echo esc_html__('Make your menu at Appearance => Menus','fb-tech'); ?></p><?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('s7upf_get_footer_default')){
    function s7upf_get_footer_default(){
        ?>
        <div id="footer" class="df-footer">
            <div class="container">
                <p class="copyright"><?php esc_html_e("Copyright &copy; by 7up. All Rights Reserved. Designed by",'fb-tech')?> <a href="<?php echo esc_url('http://7uptheme.com/'); ?>"><span><?php esc_html_e("7uptheme",'fb-tech')?></span>.<?php esc_html_e("com",'fb-tech')?></a>.</p>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('s7upf_get_footer_visual')){
    function s7upf_get_footer_visual($page_id){
        ?>
        <div id="footer" class="footer-page">
            <div class="container">
                <?php echo S7upf_Template::get_vc_pagecontent($page_id);?>
            </div>
        </div>
        <?php
    }
}

if(!function_exists('s7upf_check_catelog_mode')){
    function s7upf_check_catelog_mode(){
        if ( !class_exists('WC_Product') )  return;
        $catelog_mode = s7upf_get_option('woo_catelog');
        $hide_other_page = s7upf_get_option('hide_other_page');
        $hide_detail = s7upf_get_option('hide_detail');
        $hide_admin = s7upf_get_option('hide_admin');
        $hide_shop = s7upf_get_option('hide_shop');
        $hide_price = s7upf_get_option('hide_price');
        $show_mode = 'off';
        if($catelog_mode == 'on'){
            if($hide_other_page == 'on' && !is_super_admin() && !is_shop() && !is_single()) $show_mode = 'on';
            if($hide_other_page == 'on' && $hide_admin == 'on' && is_super_admin() && !is_shop() && !is_single() ) $show_mode = 'on';
            if($hide_price == 'on' && !is_super_admin()) $show_mode = 'on';
            if($hide_price == 'on' && $hide_admin == 'on' && is_super_admin() ) $show_mode = 'on';
            if(is_shop()) {
                if($hide_shop == 'on' && !is_super_admin()) $show_mode = 'on';
                if($hide_shop == 'on' && $hide_admin == 'on' && is_super_admin()) $show_mode = 'on';
            }
            if(is_single()) {
                if($hide_detail == 'on' && !is_super_admin()) $show_mode = 'on';
                if($hide_detail == 'on' && $hide_admin == 'on' && is_super_admin()) $show_mode = 'on';
            }
        }
        return $show_mode;
    }
}
if(!function_exists('s7upf_get_header_visual')){
    function s7upf_get_header_visual($page_id){
        ?>
        <div class="header-page <?php echo get_post_meta($page_id,'s7upf_header_fix_top',true); ?>">
            <div class="container">
                <?php echo S7upf_Template::get_vc_pagecontent($page_id);?>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('s7upf_get_main_class')){
    function s7upf_get_main_class(){
        $sidebar=s7upf_get_sidebar();
        $sidebar_pos=$sidebar['position'];
        $main_class = 'col-md-12';
        if($sidebar_pos != 'no') $main_class = 'col-md-9 col-sm-8 col-xs-12';
        return $main_class;
    }
}
if(!function_exists('s7upf_output_sidebar')){
    function s7upf_output_sidebar($position){
        $sidebar = s7upf_get_sidebar();
        $sidebar_pos = $sidebar['position'];
        if($sidebar_pos == $position) get_sidebar();
    }
}
if(!function_exists('s7upf_fix_import_category')){
    function s7upf_fix_import_category($taxonomy){
        global $s7upf_config;
        $data = $s7upf_config['import_category'];
        if(!empty($data)){
            $data = json_decode($data,true);
            foreach ($data as $cat => $value) {
                $parent_id = 0;
                $term = get_term_by( 'slug',$cat, $taxonomy );
                $term_parent = get_term_by( 'slug', $value['parent'], $taxonomy );
                if(isset($term_parent->term_id)) $parent_id = $term_parent->term_id;
                if($parent_id) wp_update_term( $term->term_id, $taxonomy, array('parent'=> $parent_id) );
                if($value['thumbnail']){
                    if($taxonomy == 'product_cat')  update_metadata( 'woocommerce_term', $term->term_id, 'thumbnail_id', $value['thumbnail']);
                    else{
                        update_term_meta( $term->term_id, 'thumbnail_id', $value['thumbnail']);
                    }
                }
            }
        }
    }
}
if ( ! function_exists( 's7upf_get_google_link' ) ) {
    function s7upf_get_google_link() {
        $protocol = is_ssl() ? 'https' : 'http';
        $fonts_url = '';
        $fonts  = array(
                    'Poppins:300,400,700,500',
                    'Lato:300,400,700',
                );
        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
            ), $protocol.'://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
}
// get list taxonomy
if(!function_exists('s7upf_list_taxonomy'))
{
    function s7upf_list_taxonomy($taxonomy,$show_all = true)
    {
        if($show_all) $list = array('--Select--' => '');
        else $list = array();
        if(!isset($taxonomy) || empty($taxonomy)) $taxonomy = 'category';
        $tags = get_terms($taxonomy);
        if(is_array($tags) && !empty($tags)){
            foreach ($tags as $tag) {
                $list[$tag->name] = $tag->slug;
            }
        }
        return $list;
    }
}

if(!function_exists('s7upf_get_custom_javascript')){
    function s7upf_get_custom_javascript(){
        $custom_js = s7upf_get_option('s7upf_custom_javascript');
        if(!empty($custom_js)){
            ?><script type="text/javascript"><?php
                print $custom_js;
                ?></script><?php
        }
    }
}

//get data by key of cat
if(!function_exists('s7upf_get_metabox_shop_cat')){
    function s7upf_get_metabox_shop_cat($cat_id, $option_id, $default = ''){
        $value = $default;
        if(class_exists('woocommerce')) {
            if (is_product_category()) {
                $t_id = get_queried_object()->term_id;
                $value = get_term_meta($t_id, $cat_id, true);

            }
        }
        if(empty($value)){
            $value = s7upf_get_option($option_id);
        }

        return $value;
    }
}

if(!function_exists('s7upf_get_metabox_check_on_off_shop_cat')){
    function s7upf_get_metabox_check_on_off_shop_cat($cat_id, $option_id, $key_check, $default = ''){
        $value = $default;
        if(class_exists('woocommerce')) {
            if (is_product_category()) {
                $t_id = get_queried_object()->term_id;

                $check = get_term_meta($t_id,$key_check,true);
                if($check == ''){
                    $value = s7upf_get_option($option_id);
                }else{

                    $value = get_term_meta($t_id, $cat_id, true);
                }
            }else{
                $value = s7upf_get_option($option_id);
            }
        }

        return $value;
    }
}
/***************************************END Core Function***************************************/


/***************************************Add Theme Function***************************************/

//Display Banner
if(!function_exists('s7upf_display_banner'))
{
    function s7upf_display_banner()
    {
        $item_slider_banner='';
        $enable_banner = 'off';
        $boxes_banner = 'off';
        if(is_single()){
            $enable_banner = s7upf_get_value_by_id('enable_banner_single');
            $item_slider_banner = s7upf_get_option_both_id('list_item_banner_blog_single','list_item_banner_blog_single','enable_banner_single');
            $boxes_banner = s7upf_get_option_both_id('boxes_banner_single','boxes_banner_single','enable_banner_single');
            if(class_exists('WC_Product') and is_woocommerce()){
                $enable_banner = s7upf_get_value_by_id('enable_banner_shop_single');
                $item_slider_banner = s7upf_get_option_both_id('list_item_banner_shop_single','list_item_banner_shop_single','enable_banner_shop_single');
                $boxes_banner = s7upf_get_option_both_id('boxes_banner_shop_single','boxes_banner_shop_single','enable_banner_shop_single');

            }
        }else if(is_search()){
            $enable_banner = s7upf_get_option('enable_banner_blog_list_search');
            $item_slider_banner = s7upf_get_option('list_item_banner_blog_list_search');
        }else if(is_archive()){
            $enable_banner = s7upf_get_value_by_id('enable_banner_blog_list');
            $item_slider_banner = s7upf_get_option_both_id('list_item_banner_blog_list','list_item_banner_blog_list','enable_banner_blog_list');

            if(class_exists('WC_Product') and is_woocommerce()){
                $enable_banner = s7upf_get_metabox_shop_cat('enable_banner_shop_cat','enable_banner_shop_list');
                $item_slider_banner =  s7upf_get_metabox_check_on_off_shop_cat('banner-product-cat-item','list_item_banner_blog_list','enable_banner_shop_cat');
                if(is_shop()){

                    $item_slider_banner =  s7upf_get_option('list_item_banner_shop_list');
                }else if(is_product_category()){
                    $item_slider_banner =  s7upf_get_metabox_check_on_off_shop_cat('banner-product-cat-item','list_item_banner_shop_list','enable_banner_shop_cat');
                }
            }
        }else if(is_home()){
            $enable_banner = s7upf_get_option('enable_banner_blog_list');
            $item_slider_banner = s7upf_get_option('list_item_banner_blog_list');
        }else if(is_page()){

            $enable_banner = get_post_meta(get_the_ID(),'enable_banner_page',true);
            $item_slider_banner = get_post_meta(get_the_ID(),'list_item_banner_page',true);
            $boxes_banner = get_post_meta(get_the_ID(),'boxes_banner_page',true);

        }

        if($enable_banner == 'on'){
            if(!empty($item_slider_banner) and is_array($item_slider_banner)){
                $control = (count($item_slider_banner)>1)?'true' : 'false';
                if($boxes_banner=='on') echo '<div class="container">'; ?>
                    <div class="banner-slider bg-slider banner-slider-shop">
                        <div class="wrap-item white-pagi" data-gation="true" <?php if($control=='true') {?> data-transition="fade" data-autoplay="true" <?php } ?>data-itemscustom="[[0,1]]">
                            <?php foreach ($item_slider_banner as $value){ ?>
                            <div class="item-slider item-slider-shop">
                                <div class="banner-thumb">
                                    <?php if(!empty($value['img'])){ ?>
                                        <a href="#"><img src="<?php echo esc_url($value['img'])?>" alt="" /></a>
                                    <?php } ?>
                                </div>
                                <div class="banner-info animated" data-animated="zoomIn">
                                    <div class="container">
                                        <div class="banner-info-inner text-center">
                                           <?php if(!empty($value['info'])) echo do_shortcode($value['info']);?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
            <?php
                if($boxes_banner=='on') echo '</div>';
            }?>
        <?php }
    }
}
if(!function_exists('s7upf_get_style_blog')){
    function s7upf_get_style_blog(){
        if(is_search()){
            return s7upf_get_option('s7upf_style_blog_search');
        } else{
            return s7upf_get_option('s7upf_style_blog');
        }
    }
}

// Mini cart
if(!function_exists('s7upf_mini_cart')) {
    function s7upf_mini_cart($echo = false)
    {
        $default_image = get_template_directory_uri().'/assets/images/no-thumb/img_70x70.png';

        if (!WC()->cart->is_empty()) {
            ?>
            <h2 class="title18 font-bold rale-font">(<span class="cart-item-count mb-count-ajax"><?php echo count( WC()->cart->get_cart() );?></span>)<?php echo(count( WC()->cart->get_cart() )>1)? esc_html__(' ITEMS IN MY CART','fb-tech'): esc_html__(' ITEM IN MY CART','fb-tech'); ?> </h2>
            <div class="list-mini-cart-item woocommerce">
                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                    $thumb_html = '<img alt="product" src="'.$default_image.'">';
                    if(has_post_thumbnail($product_id)) $thumb_html = $_product->get_image(array(70,70));

                    $post_object = get_post( $_product->get_id() );
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    ?>
                    <div class="product-mini-cart table product mb-style-minicart" data-key="<?php echo esc_attr($cart_item_key); ?>">
                        <div class="product-thumb">
                            <a class="product-thumb-link" href="<?php echo esc_url( $_product->get_permalink( $cart_item )); ?>">
                                <?php echo wp_kses_post($thumb_html);?>
                            </a>
                            <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash-o" aria-hidden="true"></i></a>',
                                esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                __( 'Remove this item', 'fb-tech' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ), $cart_item_key );?>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title title16 font-bold">
                                <a href="<?php echo esc_url( $_product->get_permalink( $cart_item )); ?>"><?php echo esc_attr($_product->get_title()); ?></a>
                            </h3>
                            <div class="product-price">
                                <ins class="title14 font-bold">
                                    <span>
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                        ?>
                                    </span>
                                </ins>
                            </div>
                            <div class="mini-cart-qty">
                                <label><?php echo esc_html__('Qty:','fb-tech')?></label>
                                <span><?php echo esc_attr($cart_item['quantity']); ?></span>
                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>
            <div class="mini-cart-total text-uppercase rale-font title18 clearfix">
                <strong class="pull-left"><?php echo esc_html__('TOTAL','fb-tech')?></strong>
                <span class="pull-right color"><?php echo WC()->cart->get_cart_total(); ?></span>
            </div>
            <div class="mini-cart-button">
                <a class="mini-cart-view shop-button color" href="<?php echo esc_url(wc_get_cart_url())?>"><?php echo esc_html__('View my cart ','fb-tech')?></a>
                <a class="mini-cart-checkout shop-button color" href="<?php echo esc_url(wc_get_checkout_url())?>"><?php echo esc_html__('Checkout','fb-tech')?></a>
            </div>
            <?php
        }else{
            ?>
            <h5 class="mini-cart-head"><?php echo esc_html__("No Product in your cart.",'fb-tech')?></h5>
            <?php
        }
    }
}

if(!function_exists('s7upf_get_rating_html')){
    function s7upf_get_rating_html($count = false,$style = ''){
        global $product;
        $html = '';
        $star = $product->get_average_rating();
        $review_count = $product->get_review_count();
        $width = $star / 5 * 100;
        $class_width = S7upf_Assets::build_css('width:'.$width.'%');
        $html .=    '<div class="product-rate '.esc_attr($style).'">
                        <div class="product-rating '.$class_width.'"></div>';
        if($count) $html .= '<span>('.$review_count.'s)</span>';
        $html .=    '</div>';
        return $html;
    }
}
if(!function_exists('s7upf_get_filtered_price')){
    function s7upf_get_filtered_price() {
        global $wpdb, $wp_the_query;
        $args       = $wp_the_query->query_vars;
        $tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
        $meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

        if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
            $tax_query[] = array(
                'taxonomy' => $args['taxonomy'],
                'terms'    => array( $args['term'] ),
                'field'    => 'slug',
            );
        }

        foreach ( $meta_query + $tax_query as $key => $query ) {
            if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
                unset( $meta_query[ $key ] );
            }
        }

        $meta_query = new WP_Meta_Query( $meta_query );
        $tax_query  = new WP_Tax_Query( $tax_query );

        $meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
        $tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

        $sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
        $sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
        $sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
                        AND {$wpdb->posts}.post_status = 'publish'
                        AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
                        AND price_meta.meta_value > '' ";
        $sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

        if ( $search = WC_Query::get_main_search_query_sql() ) {
            $sql .= ' AND ' . $search;
        }

        return $wpdb->get_row( $sql );
    }
}
//Compare URL
if(!function_exists('s7upf_compare_url')){
    function s7upf_compare_url($id = false,$text=''){
        $html = '';
        if(class_exists('YITH_Woocompare')){
            if(!$id) $id = get_the_ID();
            $cp_link = str_replace('&', '&amp;',add_query_arg( array('action' => 'yith-woocompare-add-product','id' => $id )));
            $html .= ' <a href="'.esc_url($cp_link).'" class="mb-compare product-compare compare compare-link color title30" data-product_id="'.get_the_ID().'"><i class="icon ion-ios-checkmark-outline"></i>';
            if(!empty($text)) $html .= $text;
            $html .= '</a>';
        }
        return $html;
    }
}
if(!function_exists('s7up_wishlist_url')){
    function s7up_wishlist_url($text="", $class=""){
        $html = '';
        if(class_exists('YITH_WCWL_Init')){
            $html .= ' <a href="'.esc_url(str_replace('&', '&amp;',add_query_arg( 'add_to_wishlist', get_the_ID() ))).'"  class="mb-wishlist add_to_wishlist wishlist-link color title30 '.$class.'" rel="nofollow" data-product-id="'.get_the_ID().'" data-product-title="'.esc_attr(get_the_title()).'"><i class="icon ion-android-favorite-outline"></i>';
            if(!empty($text)) $html .= $text;
            $html .= ' </a>';
        }
        return $html;
    }
}

if(!function_exists('s7upf_product_loop_discount_sale')){
    function s7upf_product_loop_discount_sale()
    {
        if (!class_exists('WC_Product')) return;
        $sale = $sale_min=$sale_max='';
        global $product;
        if (!$product->is_in_stock()) return;
        $sale_price = get_post_meta($product->get_id(), '_price', true);
        $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
        $array_regular_price = array();
        $array_sale_price = array();

        if ($product->get_type() == 'variable') { //then this is a variable product
            $available_variations = $product->get_available_variations();
            if (!empty($available_variations) and is_array($available_variations)) {
                foreach ($available_variations as $key => $value) {
                    if(!empty($value['display_regular_price']))
                        $array_regular_price[$key] = $value['display_regular_price'];
                    if(!empty($value['display_price']) and $value['display_price'] !== $value['display_regular_price'])
                        $array_sale_price[$key] = $value['display_price'];
                }
            }
            if(!empty($array_regular_price)){
                $max_regular_price = max($array_regular_price);
                $min_regular_price = min($array_regular_price);
            }
            if(!empty($array_sale_price)){
                $max_sale_price = max($array_sale_price);
                $min_sale_price = min($array_sale_price);
            }
            if(!empty($max_regular_price) and !empty($max_sale_price) and $max_regular_price > $max_sale_price){
                $sale_max = ceil((($max_regular_price - $max_sale_price) / $max_regular_price) * 100);
            }
            if(!empty($min_regular_price) and !empty($min_sale_price) and $min_regular_price > $min_sale_price){
                $sale_min = ceil((($min_regular_price - $min_sale_price) / $min_regular_price) * 100);

            }
            if(!empty($sale_min)) $sale = $sale_min;
            if(!empty($sale_max) and $sale_max !== $sale_min) $sale .= '-'.$sale_max;
        }else if (!empty($regular_price) && !empty($sale_price) && $regular_price > $sale_price) {
            $sale = ceil((($regular_price - $sale_price) / $regular_price) * 100);
        }
        return $sale;
    }
}
if(!function_exists('s7upf_show_product_loop_new_badge')){
    function s7upf_show_product_loop_new_badge($day='',$before='',$after=''){

        $html = '';
        if(is_int($day) and !empty($day))
            $day = 10;
        $postdate = get_the_time ( 'Y-m-d' );
        $postdatestamp = strtotime ( $postdate );

        if ((time () - (60 * 60 * 24 * $day)) < $postdatestamp ) {
            $html .= wp_kses_post($before);
            $html .= esc_html__('New','fb-tech');
            $html .= wp_kses_post($after);
        }
        return $html;
    }
}

if(!function_exists('s7up_get_label_new_sale_product')){
    function s7up_get_label_new_sale_product(){
        global $product;
        $class ='';
        $discount = s7upf_product_loop_discount_sale();
        $enable_new_product = s7upf_get_option('s7upf_enable_new_product');
        $day = s7upf_get_option('s7upf_number_day_new_product');
        if($product->is_on_sale()) $class= 'co-on-sale';?>
        <div class="product-label">
            <?php if ( $product->is_on_sale() ) { ?>
                <span class="sale-label"><?php echo esc_html__('Sale','fb-tech')?></span>
            <?php }
            if('on' === $enable_new_product){
                echo s7upf_show_product_loop_new_badge($day,'<span class="new-label '.$class.'">','</span>');
            }
            ?>
        </div>
    <?php }
}

if(!function_exists('s7upf_get_image_product_element')) {
    function s7upf_get_image_product_element($image_size = 'full', $default_image = '',$animation_img='',$hide_mask_img = 'yes',$title_enable=false){
        global $post;
        if($hide_mask_img=='yes') $class=''; else $class='product-thumb-link';
        $product = new WC_product(get_the_ID());
        $attachment_ids = $product->get_gallery_image_ids();
        if($animation_img == 'zoom-out') echo '<div class="banner-adv zoom-out">';
        if($animation_img == 'zoom-rotate') echo '<div class="banner-adv zoom-rotate">';
        ?>
        <a href="<?php the_permalink(); ?>" class="<?php if($animation_img=='zoom-out'|| $animation_img=='zoom-rotate') echo'adv-thumb-link '.$class; else echo esc_attr($class).' '.$animation_img; ?> ">
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
            if('zoom-out' === $animation_img){
                if(is_array($attachment_ids) and count($attachment_ids)>0){

                    foreach ($attachment_ids as $key => $value){
                        if($key == 0){
                            echo wp_get_attachment_image($value,$image_size,false);
                        }
                    }
                } else if ( has_post_thumbnail() ) {
                    $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
                    echo get_the_post_thumbnail( $post->ID, $image_size, array(
                        'title'	 => $props['title'],
                        'alt'    => $props['alt'],
                    ) );
                }  else {
                    $dimensions = wc_get_image_size( $image_size ); ?>
                    <img src="<?php echo esc_url($default_image); ?>" width="<?php echo esc_attr( $dimensions['width'] ) ?> " height="<?php echo esc_attr( $dimensions['height'] ) ?> "  alt="<?php esc_html_e('Image Default','fb-tech')?>" />
                    <?php
                }
            }

            if($title_enable == true){ ?>
            <h3 class="title16 font-bold product-title"><?php the_title(); ?></h3>
        <?php } ?>

        </a>
        <?php
        if($animation_img == 'zoom-out'|| $animation_img == 'zoom-rotate') echo '</div>';

    }
}

if(!function_exists('s7upf_shop_filter_html')){
    function s7upf_shop_filter_html($query,$orderby = 'menu_order',$type='grid',$select_attributes,$title='',$sort_by_price_product='')
    {

        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        }

        $number = s7upf_get_option('st_product_post_per_page');
        if (isset($_GET['number'])) {
            $number = $_GET['number'];
        }
        $orderby = 'menu_order';
        if (isset($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        }
        ?>
        <div class="shop-title">
            <div class="row">
                <div class="col-md-12">
                    <?php if (!empty($title)) { ?>
                        <h2 class="font-bold title30 text-uppercase title-line-after pull-left"><?php echo esc_attr($title); ?></h2>
                    <?php } ?>
                    <ul class="list-inline-block sort-bar pull-right">
                        <li>
                            <div class="select-box sort-by">
                                <?php s7upf_catalog_ordering($query, $orderby) ?>
                            </div>
                        </li>
                        <li>
                            <div class="view-type">
                                <a href="<?php echo esc_url(s7upf_get_key_url('type', 'grid')) ?>"
                                   class="grid-view <?php if ('grid' === $type) echo 'active' ?>"><i
                                            class="icon ion-grid"></i></a>
                                <a href="<?php echo esc_url(s7upf_get_key_url('type', 'list')) ?>"
                                   class="list-view <?php if ('list' === $type) echo 'active' ?>"><i
                                            class="icon ion-android-menu"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (!empty($select_attributes) || !empty($sort_by_price_product)) { ?>
        <div class="refine-search">
            <h2 class="title14 color"><?php echo esc_html__('Refine your search:', 'fb-tech'); ?></h2>
            <a href="#" class="color close-search"><i class="icon ion-ios-close-outline"></i></a>
            <ul class="list-inline-block list-select-attr">
                <?php
                global $product;
                $attributes = wc_get_attribute_taxonomies();
                if (!empty($select_attributes)) $select_attributes = explode(',', $select_attributes);
                if (!empty($attributes)) {
                    foreach ($attributes as $attribute) {
                        $attribute_label = $attribute->attribute_label;
                        $taxonomy_filter_name = str_replace('pa_', '', $attribute->attribute_name);
                        $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();

                        $check_show = true;
                        if (!empty($select_attributes) and is_array($select_attributes)) {
                            $check_show = in_array($attribute->attribute_name, $select_attributes);
                        }
                        if ($check_show == true) { ?>
                            <li>
                                <div class="select-box">
                                    <select class="s7upf_layered_nav_<?php echo esc_attr($taxonomy_filter_name); ?>">
                                        <?php
                                        $terms = get_terms('pa_' . $attribute->attribute_name);
                                        $any_label = sprintf(__('Any %s', 'fb-tech'), $attribute->attribute_name);

                                        if (!empty($terms)) {
                                            ?>
                                            <option value=""><?php echo esc_attr($any_label); ?></option>
                                            <?php
                                            foreach ($terms as $term) {
                                                $current_values = isset($_chosen_attributes[$term->taxonomy]['terms']) ? $_chosen_attributes[$term->taxonomy]['terms'] : array();
                                                $option_is_set = in_array($term->slug, $current_values); ?>
                                                <option value="<?php echo esc_attr($term->slug) ?>" <?php echo selected($option_is_set, true, false) ?> > <?php echo esc_html($term->name) ?></option>
                                                <?php
                                            }
                                        } ?>
                                    </select>
                                    <?php
                                    wc_enqueue_js("
                            jQuery( '.s7upf_layered_nav_" . esc_js($taxonomy_filter_name) . "' ).change( function() {
                                var slug = jQuery( this ).val();
                                location.href = '" . preg_replace('%\/page\/[0-9]+%', '', str_replace(array('&amp;', '%2C'), array('&', ','), esc_js(add_query_arg('filtering', '1', remove_query_arg(array('page', 'filter_' . $taxonomy_filter_name)))))) . "&filter_" . esc_js($taxonomy_filter_name) . "=' + slug;
                            });
                        ");
                                    ?>
                                </div>
                            </li>
                            <?php
                        }
                    }
                }
                ?>
                <?php
                $prices = s7upf_get_filtered_price();
                $min = floor($prices->min_price);
                $max = ceil($prices->max_price);
                if (!empty($sort_by_price_product)) {
                    $array_price = explode(' ', $sort_by_price_product); ?>
                    <li>
                        <div class="select-box">
                            <select class="s7upf_layered_nav_gia">
                                <?php
                                $option_is_set_price = false;
                                if (is_array($array_price)) {
                                    ?>
                                    <option value="<?php echo esc_attr($min) ?>-<?php echo esc_attr($max) ?>"><?php echo esc_html__('Price', 'fb-tech'); ?></option>
                                    <?php
                                    foreach ($array_price as $value) {
                                        $array_min_max = explode('-', $value);
                                        if (isset($_GET['min_price']) && isset($_GET['max_price'])) {

                                            if ($_GET['min_price'] == $array_min_max[0] and $_GET['max_price'] == $array_min_max[1])
                                                $option_is_set_price = true;
                                            else $option_is_set_price = false;
                                        } ?>
                                        <option value="<?php echo esc_attr($value) ?>" <?php echo selected($option_is_set_price, true, false) ?>> <?php echo esc_html($value) ?></option>
                                    <?php }
                                } ?>
                            </select>
                            <?php
                            wc_enqueue_js("
                        jQuery( '.s7upf_layered_nav_gia' ).change( function() {
                            var a = jQuery( this ).val();
                            var arr =  a.split('-'); 
                            location.href = '" . preg_replace('%\/page\/[0-9]+%', '', str_replace(array('&amp;', '%2C'), array('&', ','), esc_js(add_query_arg('filtering', '1', remove_query_arg(array('page', 'min_price', 'max_price')))))) . "&min_price=' + arr[0]+'&max_price=' + arr[1];
                           
                        });
                    ");
                            ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>


        <?php
        }
    }
}

if ( ! function_exists( 's7upf_catalog_ordering' ) ) {
    function s7upf_catalog_ordering($query,$set_orderby = '') {
        $orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        if(!empty($set_orderby)) $orderby = $set_orderby;
        $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
            'menu_order' => esc_html__( 'Default sorting', 'fb-tech' ),
            'popularity' => esc_html__( 'Sort by popularity', 'fb-tech' ),
            'rating'     => esc_html__( 'Sort by average rating', 'fb-tech' ),
            'date'       => esc_html__( 'Sort by newness', 'fb-tech' ),
            'price'      => esc_html__( 'Sort by price: low to high', 'fb-tech' ),
            'price-desc' => esc_html__( 'Sort by price: high to low', 'fb-tech' ),
        ) );

        if ( ! $show_default_orderby ) {
            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
            unset( $catalog_orderby_options['rating'] );
        }

        wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
    }
}

if(!function_exists('s7upf_get_deals_time')){
    function s7upf_get_deals_time($time = '0:0'){
        $curren_time = getdate();
        $time2 = explode(':', $time);
        $hours = $min = 0;
        if(isset($time2[0])) $hours = (int)$time2[0];
        if(isset($time2[1])) $min = (int)$time2[1];
        $data_h = $hours - $curren_time['hours'];
        $data_m = $min - $curren_time['minutes'];
        $time = $data_h*3600+$data_m*60+60-$curren_time['seconds'];
        return $time;
    }
}
/***************************************END Theme Function***************************************/
