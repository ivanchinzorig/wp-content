<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24/04/2017
 * Time: 17:37
 */
if(!function_exists('s7upf_vc_bread_crumb'))
{
    function s7upf_vc_bread_crumb($attr,$content = false)
    {
        $html =$el_class  = '' ;
        extract(shortcode_atts(array(
            'el_class'      => '',
        ),$attr));
        $html .= '<div class="element-breadcrumb '.$el_class.'">';
        if(class_exists('WC_Product') and is_woocommerce())
            $html .= woocommerce_breadcrumb();
        else
            $html .= S7upf_Template::load_view('elements/breadcrumb',false);
        $html .= '</div>';
        return $html;
    }
}

stp_reg_shortcode('s7upf_bread_crumb','s7upf_vc_bread_crumb');
vc_map( array(
    "name"      => esc_html__("SV Bread Crumb", 'fb-tech'),
    "base"      => "s7upf_bread_crumb",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),
    )
));