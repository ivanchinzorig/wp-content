<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24/04/2017
 * Time: 17:37
 */
if(!function_exists('s7upf_vc_service'))
{
    function s7upf_vc_service($attr,$content = false)
    {
        $html = $style =$color_text=$animation_css=$bg_color=$title=$desc= $icon=$data_delay =$link= $el_class  = '' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'animation_css'      => '',
            'title'      => '',
            'desc'      => '',
            'icon'      => '',
            'data_delay'      => '',
            'el_class'      => '',
            'link'      => '',
            'bg_color'      => '',
            'color_text'      => '',
        ),$attr));
        $html .= S7upf_Template::load_view('elements/service',false,array(
            'style' => $style,
            'data_delay' => $data_delay,
            'animation_css' => $animation_css,
            'el_class' => $el_class,
            'content' => $content,
            'link' => $link,
            'title'      => $title,
            'desc'      => $desc,
            'icon'      => $icon,
            'bg_color'      => $bg_color,
            'color_text'      => $color_text,
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_service','s7upf_vc_service');

vc_map( array(
    "name"      => esc_html__("SV Service", 'fb-tech'),
    "base"      => "s7upf_service",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Style', 'fb-tech' ),
            'param_name' => 'style',
            'value' => array(
                esc_html__('Style 1 (Default)','fb-tech')=>'style1',
                esc_html__('Style 2','fb-tech')=>'style2',
                esc_html__('Style 3','fb-tech')=>'style3',
                esc_html__('Style 4','fb-tech')=>'style4',
                esc_html__('Style 5','fb-tech')=>'style5',

            ),
            'description' => esc_html__( 'Select style', 'fb-tech' )
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_service',
            'heading' => '',
            'element' => 'style',
        ),
         array(
             'type' => 'textarea_html',
             'heading' => esc_html__( 'Content box', 'fb-tech' ),
             'param_name' => 'content',
             'description' => esc_html__('Enter text','fb-tech'),
             'dependency'    =>array(
                 'element'   =>'style',
                 'value'     =>array('style1','style4','style5')
             ),
         ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon', 'fb-tech' ),
            'param_name' => 'icon',
            'edit_field_class' => 'vc_column vc_col-sm-12 s7upf_icon_ios',
            'description' => esc_html__('Select icon','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2','style3','style4','style5')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'fb-tech' ),
            'param_name' => 'title',
            'description' => esc_html__('Enter text','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2','style3')
            ),
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description', 'fb-tech' ),
            'param_name' => 'desc',
            'description' => esc_html__('Enter text','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Add link', 'fb-tech' ),
            'param_name' => 'link',
            'description' => esc_html__('Enter Link/URL','fb-tech'),
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
            'heading' => esc_html__('Background color', 'fb-tech'),
            'param_name' => 'bg_color',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
            'description' => esc_html__('Select color', 'fb-tech'),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Color text', 'fb-tech'),
            'param_name' => 'color_text',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
            'description' => esc_html__('Select color', 'fb-tech'),
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation', 'fb-tech' ),
            'param_name' => 'animation_css',
            'group' => esc_html__('Design Option','fb-tech'),
            'value' => '',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
            'settings' => array(
                'type' => 'in',
                'custom' => array(
                    array(
                        'label' => __( 'Default', 'fb-tech' ),
                        'values' => array(
                            esc_html__( 'Top to bottom', 'fb-tech' ) => 'top-to-bottom',
                            esc_html__( 'Bottom to top', 'fb-tech' ) => 'bottom-to-top',
                            esc_html__( 'Left to right', 'fb-tech' ) => 'left-to-right',
                            esc_html__( 'Right to left', 'fb-tech' ) => 'right-to-left',
                            esc_html__( 'Appear from center', 'fb-tech' ) => 'appear',
                        ),
                    ),
                ),
            ),
            'description' => esc_html__( 'Select type of animation for element to be animated when it (enters) the browsers viewport (Note: works only in modern browsers).', 'fb-tech' ),
        ),
        array(
            "type" => "textfield",
            'group' => esc_html__('Design Option','fb-tech'),
            "heading" => esc_html__("Data delay (Unit: s)",'fb-tech'),
            "param_name" => "data_delay",
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
    )
));