<?php
/**
 * Created by Sublime text 2.
 * User: 7uptheme
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_logo_header'))
{
    function s7upf_vc_logo_header($attr)
    {
        $html = $logo_img = $alignment = $el_class= '';
        extract(shortcode_atts(array(
            'logo_img'      => '',
            'alignment'      => 'text-left',
            'el_class'      => '',
        ),$attr));
        $html .= S7upf_Template::load_view('elements/logo-header',false,array(
            'logo_img'  => $logo_img,
            'alignment'  => $alignment,
            'el_class'  => $el_class,
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_logo_header','s7upf_vc_logo_header');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_add_admin_logo_header',10,100 );
if ( ! function_exists( 's7upf_add_admin_logo_header' ) ) {
    function s7upf_add_admin_logo_header(){
        vc_map( array(
            "name"      => esc_html__("SV Logo", 'fb-tech'),
            "base"      => "s7upf_logo_header",
            "icon"      => "icon-st",
            "category"  => '7Up-theme',
            "params"    => array(
                array(
                    "type" => "attach_image",
                    'admin_label' => true,
                    "heading" => esc_html__("Logo image",'fb-tech'),
                    "param_name" => "logo_img",
                    'description' => esc_html__( 'Select image from library', 'fb-tech' )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Logo alignment",'fb-tech'),
                    "param_name" => "alignment",
                    'admin_label' => true,
                    'description' => esc_html__( 'Select image alignment.', 'fb-tech' ),
                    'value' => array(
                        esc_html__('Left','fb-tech') => 'text-left',
                        esc_html__('Right','fb-tech') => 'text-right',
                        esc_html__('Center','fb-tech') => 'text-center',
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name",'fb-tech'),
                    "param_name" => "el_class",
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
                ),
            )
        ));
    }
}
