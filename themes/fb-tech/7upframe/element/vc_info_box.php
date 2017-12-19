<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24/04/2017
 * Time: 17:37
 */
if(!function_exists('s7upf_vc_info_box'))
{
    function s7upf_vc_info_box($attr,$content = false)
    {
        $html =$data_box6=$title=$button=$icon_link=$icon=$alignment=$image_size=$image_link=$data_box4=$image=$desc=$choice=$title_link=$text_position=$title_item_color=$icon_color=$title_color=$data_box2=$el_class=$add_item_info1=$style= $text_color= $time_down= '' ;
        extract(shortcode_atts(array(
            'style' => 'style1',
            'time_down' => '',
            'title' => '',
            'alignment' => 'text-center',
            'el_class' => '',
            'text_color' => '',
            'add_item_info1' => '',
            'add_item_info4' => '',
            'title_color' => '',
            'title_item_color' => '',
            'icon_color' => '',
            'choice' => '',
            'text_position' => 'text-left',
            'title_link' => '',
            'desc' => '',
            'image' => '',
            'image_size' => '',
            'image_link' => '',
            'add_item_info6' => '',
            'icon_link' => '',
            'icon' => '',
            'button' => '',
        ),$attr));
        if(isset($add_item_info1))
            $data_box2 = vc_param_group_parse_atts($add_item_info1);
        if(isset($add_item_info4))
            $data_box4 = vc_param_group_parse_atts($add_item_info4);
        if(isset($add_item_info6))
            $data_box6 = vc_param_group_parse_atts($add_item_info6);
        $html .= S7upf_Template::load_view('elements/info-box',false,array(
            'style' => $style,
            'time_down' => $time_down,
            'title' => $title,
            'alignment' => $alignment,
            'el_class' => $el_class,
            'text_color' => $text_color,
            'data_box2' => $data_box2,
            'title_color' => $title_color,
            'icon_color' => $icon_color,
            'title_item_color' => $title_item_color,
            'choice' => $choice,
            'text_position' => $text_position,
            'title_link' => $title_link,
            'desc' => $desc,
            'data_box4' => $data_box4,
            'image' => $image,
            'image_link' => $image_link,
            'image_size' => $image_size,
            'data_box6' => $data_box6,
            'icon' => $icon,
            'content' => $content,
            'icon_link' => $icon_link,
            'button' => $button,
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_info_box','s7upf_vc_info_box');

vc_map( array(
    "name"      => esc_html__("SV Info Box", 'fb-tech'),
    "base"      => "s7upf_info_box",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Style', 'fb-tech' ),
            'param_name' => 'style',
            'value' => array(
                esc_html__('Style 1 (Time countdown)','fb-tech')=>'style1',
                esc_html__('Style 2 (Contact box)','fb-tech')=>'style2',
                esc_html__('Style 3 (Choice)','fb-tech')=>'style3',
                esc_html__('Style 4 (Category)','fb-tech')=>'style4',
                esc_html__('Style 5 (Category)','fb-tech')=>'style5',
                esc_html__('Style 6 (Accordion)','fb-tech')=>'style6',
                esc_html__('Style 7 (Accordion)','fb-tech')=>'style9',
                esc_html__('Style 8 (Contact box)','fb-tech')=>'style7',
                esc_html__('Style 9 (Featured box)','fb-tech')=>'style8',
                esc_html__('Style 10 (Pricing tablet)','fb-tech')=>'style10',
            ),
            'description' => esc_html__( 'Select style', 'fb-tech' )
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_infobox',
            'heading' => '',
            'element' => 'style',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Choice', 'fb-tech' ),
            'param_name' => 'choice',
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image', 'fb-tech' ),
            'param_name' => 'image',
            'edit_field_class' => 'vc_column vc_col-sm-6',
            'description' => esc_html__('Select image from library.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4','style5')
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Add link image', 'fb-tech' ),
            'param_name' => 'image_link',
            'edit_field_class' => 'vc_column vc_col-sm-6',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1','style2','style3','style4','style5')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'fb-tech' ),
            'param_name' => 'title',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1','style2','style3','style4','style5','style6','style10')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Description', 'fb-tech' ),
            'param_name' => 'desc',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3','style10')
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Title link', 'fb-tech' ),
            'param_name' => 'title_link',
            'description' => esc_html__('Enter Link/URL.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon', 'fb-tech' ),
            'param_name' => 'icon',
            'edit_field_class'=>'vc_col-sm-12 vc_column s7upf_icon_ios',
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style7','style8')
            ),
        ),
        array(
            'type' => 'textarea_html',
            'heading' => esc_html__( 'Content', 'fb-tech' ),
            'param_name' => 'content',
            'edit_field_class'=>'vc_col-sm-12 vc_column',
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style7','style8','style10')
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Add button', 'fb-tech' ),
            'param_name' => 'button',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style10')
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Add link icon', 'fb-tech' ),
            'param_name' => 'icon_link',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style8')
            ),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add info item', 'fb-tech'),
            'param_name' => 'add_item_info1',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title', 'fb-tech' ),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Icon', 'fb-tech' ),
                    'param_name' => 'icon',
                    'edit_field_class'=>'vc_col-sm-12 vc_column s7upf_icon_ios',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add info item', 'fb-tech'),
            'param_name' => 'add_item_info6',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title', 'fb-tech' ),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Icon title', 'fb-tech' ),
                    'param_name' => 'icon',
                    'edit_field_class'=>'vc_col-sm-12 vc_column s7upf_icon_ios',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Description', 'fb-tech' ),
                    'param_name' => 'desc',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style6','style9')
            ),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add info item', 'fb-tech'),
            'param_name' => 'add_item_info4',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title', 'fb-tech' ),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Link', 'fb-tech' ),
                    'param_name' => 'link',
                    'description' => esc_html__('Enter Link/URL.','fb-tech'),
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4','style5')
            ),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Time countdown', 'fb-tech' ),
            'param_name' => 'time_down',
            'edit_field_class'=>'vc_col-sm-12 vc_column s7up_vc_calendar',
            'admin_label' => true,
            'description' => esc_html__('Enter time.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Alignment",'fb-tech'),
            'group' => esc_html__('Design Option','fb-tech'),
            "param_name" => "alignment",
            'description' => esc_html__( 'Select alignment.', 'fb-tech' ),
            'value' => array(
                esc_html__('Center','fb-tech') => 'text-center',
                esc_html__('Left','fb-tech') => 'text-left',
                esc_html__('Right','fb-tech') => 'text-right',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Text position",'fb-tech'),
            'group' => esc_html__('Design Option','fb-tech'),
            "param_name" => "text_position",
            'description' => esc_html__( 'Select alignment.', 'fb-tech' ),
            'value' => array(
                esc_html__('Right','fb-tech') => 'text-left',
                esc_html__('Left','fb-tech') => 'text-right',

            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Text color', 'fb-tech' ),
            'param_name' => 'text_color',
            'description' => esc_html__( 'Select color', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Title color', 'fb-tech' ),
            'param_name' => 'title_color',
            'description' => esc_html__( 'Select color', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Title item color', 'fb-tech' ),
            'param_name' => 'title_item_color',
            'description' => esc_html__( 'Select color', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Icon color', 'fb-tech' ),
            'param_name' => 'icon_color',
            'description' => esc_html__( 'Select color', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Size', 'fb-tech'),
            'param_name' => 'image_size',
            'group' => esc_html__('Design Option','fb-tech'),
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4','style5')
            ),
        ),
        
    )
));