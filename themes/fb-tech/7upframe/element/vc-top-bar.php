<?php
/**
 * Created by Sublime text 2.
 * User: 7uptheme
 * Date: 18/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_top_bar')){
    function s7upf_vc_top_bar($attr,$content = false)
    {
        $html  =$style=$logo_img=$show_search =$live_search=$icon_color=$text_color=$el_class =$show_mini_cart=$show_log_in='';
        extract(shortcode_atts(array(
            'show_log_in'      => 'on',
            'logo_img'      => '',
            'el_class'      => '',
            'style'      => 'style1',
            'show_search'      => 'on',
            'show_mini_cart'      => 'on',
            'text_color'      => '',
            'icon_color'      => '',
            'live_search'      => 'true',
        ),$attr));
        $html .= S7upf_Template::load_view('elements/top-bar',false, array(
            'show_log_in' => $show_log_in,
            'logo_img' => $logo_img,
            'el_class' => $el_class,
            'content' => $content,
            'style' => $style,
            'show_search' => $show_search,
            'show_mini_cart' => $show_mini_cart,
            'icon_color' => $icon_color,
            'text_color' => $text_color,
            'live_search' => $live_search,
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_top_bar','s7upf_vc_top_bar');

vc_map( array(
    "name"      => esc_html__("SV Top Bar", 'fb-tech'),
    "base"      => "s7upf_top_bar",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Style', 'fb-tech' ),
            'param_name' => 'style',
            'description' => esc_html__( 'Select style', 'fb-tech' ),
            'value' => array(
                esc_html__('Style 1','fb-tech')=>'style1',
                esc_html__('Style 2','fb-tech')=>'style2',
            ),
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_topbar',
            'heading' => '',
            'element' => 'style',
        ),

        array(
            'type' => 'textarea_html',
            'heading' => esc_html__( 'Content', 'fb-tech' ),
            'param_name' => 'content',
            'description' => esc_html__( 'Enter text', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            "type" => "attach_image",
            'admin_label' => true,
            "heading" => esc_html__("Logo image",'fb-tech'),
            "param_name" => "logo_img",
            'description' => esc_html__( 'Select image from library', 'fb-tech' ),
            'dependency' => array(
                'element' => 'style',
                'value' => array('style2')
            ),
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Show log in', 'fb-tech' ),
            'param_name' => 'show_log_in',
            'value' => array(
                esc_html__('On','fb-tech')=>'on',
                esc_html__('Off','fb-tech')=>'off',
            ),
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Show search', 'fb-tech' ),
            'param_name' => 'show_search',
            'value' => array(
                esc_html__('On','fb-tech')=>'on',
                esc_html__('Off','fb-tech')=>'off',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Live Search', 'fb-tech' ),
            'param_name' => 'live_search',
            'admin_label' => true,
            'value'=>array(
                esc_html__('On','fb-tech')=> 'true',
                esc_html__('Off','fb-tech')=> 'false',
            ),
            'dependency'    =>array(
                'element'   =>'show_search',
                'value'     =>array('on')
            ),
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Show mini cart', 'fb-tech' ),
            'param_name' => 'show_mini_cart',
            'value' => array(
                esc_html__('On','fb-tech')=>'on',
                esc_html__('Off','fb-tech')=>'off',
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Text color', 'fb-tech' ),
            'param_name' => 'text_color',
            'description' => esc_html__( 'Select color', 'fb-tech' ),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Icon color', 'fb-tech' ),
            'param_name' => 'icon_color',
            'description' => esc_html__( 'Select color', 'fb-tech' ),
        ),
    )
));

add_action( 'wp_ajax_live_search', 's7upf_live_search' );
add_action( 'wp_ajax_nopriv_live_search', 's7upf_live_search' );
if(!function_exists('s7upf_live_search')){
    function s7upf_live_search() {
        $key = $_POST['key'];
        $post_type = $_POST['post_type'];
        $trim_key = trim($key);
        $args = array(
            'post_type' => $post_type,
            's'         => $key,
        );
        $img_df='';
        $query = new WP_Query( $args );
        $default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_70x70.png';
        $img_df = '<img src='.$default_thumbnail.'>';
        if( $query->have_posts() && !empty($key) && !empty($trim_key)){
            while ( $query->have_posts() ) : $query->the_post();
                global $product;
                $post_object = get_post( $product->get_id() );
                setup_postdata( $GLOBALS['post'] =& $post_object );
                echo    '<div class="item-search-pro">
                            <div class="search-ajax-thumb product-thumb">
                                <a href="'.esc_url(get_the_permalink()).'" class="product-thumb-link">';
                if(has_post_thumbnail()) echo   get_the_post_thumbnail(get_the_ID(),array(70,70)); else echo do_shortcode($img_df);
                echo'</a>
                                
                            </div>
                            <div class="search-ajax-title product-info">
                                <h3 class="product-title title14">
                                    <a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a>
                                </h3>
                                <div class="product-price">
                                   '.$product->get_price_html().'
                                </div>
                               '.s7upf_get_rating_html().'
                            </div>
                            
                        </div>';
            endwhile;
        }
        else{
            echo '<p class="text-center">'.esc_html__("No any results with this keyword.",'fb-tech').'</p>';
        }
        wp_reset_postdata();
    }
}