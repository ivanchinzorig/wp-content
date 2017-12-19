<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 25/04/2017
 * Time: 10:28
 */
if(!function_exists('s7upf_vc_mail_chimp'))
{
    function s7upf_vc_mail_chimp($attr,$content = false)
    {
        $html = $style =$title_color = $title = $placeholder =$el_class =$title_color= $position = $submit_name = $shortcode =  $main_color = $desc_color = $desc = $placeholder = '' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'title'      => '',
            'desc'      => '',
            'placeholder'      => '',
            'desc_color'      => '',
            'shortcode'      => '',
            'submit_name'      => '',
            'el_class'      => '',
            'title_color'      => '',

        ),$attr));

        $html .= S7upf_Template::load_view('elements/mailchimp',false,array(
            'style' => $style,
            'title'      => $title,
            'desc'      => $desc,
            'placeholder'      => $placeholder,
            'shortcode'      => $shortcode,
            'position'      => $position,
            'submit_name'      => $submit_name,
            'el_class'      => $el_class,
            'title_color'      => $title_color,
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_mail_chimp','s7upf_vc_mail_chimp');

vc_map( array(
    "name"      => esc_html__("SV MailChimp", 'fb-tech'),
    "base"      => "s7upf_mail_chimp",
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
            ),
            'description' => esc_html__( 'Select style', 'fb-tech' )
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_mailchimp',
            'heading' => '',
            'element' => 'style',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Get ID shortcode Mailchimp', 'fb-tech' ),
            'param_name' => 'shortcode',
            'admin_label' => true,
            'description' => esc_html__('Enter shortcode.','fb-tech'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'fb-tech' ),
            'param_name' => 'title',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Description', 'fb-tech' ),
            'param_name' => 'desc',
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2','style4')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Placeholder input', 'fb-tech' ),
            'param_name' => 'placeholder',
            'description' => esc_html__('Enter text.','fb-tech'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Submit name', 'fb-tech' ),
            'param_name' => 'submit_name',
            'description' => esc_html__('Enter text.','fb-tech'),

        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),

        //---------- Design Option -------------------//
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title color', 'fb-tech' ),
            'param_name' => 'title_color',
            'group' => esc_html__('Design Option','fb-tech'),
            'description' => esc_html__( 'Select color).', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
    )
));