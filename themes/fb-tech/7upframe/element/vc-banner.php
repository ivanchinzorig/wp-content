<?php
/**
 * Created by PhpStorm.
 * User: 7uptheme
 * Date: 04/04/2017
 * Time: 14:17
 */

if(!function_exists('s7upf_vc_banner'))
{
    function s7upf_vc_banner($attr,$content = false)
    {
        $html = $style =$min_height= $data_item_5=$button =$position=$image_link=$position3=$animation_image3=$parallax=$animation_img=$image=$bg_color= $animation_css= $image_size = $extra_class ='' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'image_size'      => '',
            'image'      => '',
            'position'      => 'pull-right',
            'position3'      => 'pull-left',
            'animation_css'      => '',
            'extra_class'      => '',
            'animation_img'      => '',
            'animation_image3'      => '',
            'bg_color'      => '',
            'image_link'      => '',
            'min_height'      => '',
            'button'      => '',
            'add_item_5'      => '',
            'title'      => '',
            'desc'      => '',
            'title_intro'      => '',
            'image_bg'      => '',
        ),$attr));
        if(isset($add_item_5))
            $data_item_5 = vc_param_group_parse_atts($add_item_5);
        $html .= S7upf_Template::load_view('elements/banner',false,array(
            'style' => $style,
            'image' => $image,
            'position' => $position,
            'position3' => $position3,
            'animation_image3' => $animation_image3,
            'image_size' => $image_size,
            'extra_class' => $extra_class,            
            'content' => $content,
            'animation_css' => $animation_css,
            'animation_img' => $animation_img,
            'bg_color' => $bg_color,//style 2
            'min_height' => $min_height,//style 2
            'button' => $button,//style 2
            'image_link' => $image_link,//style 3
            'data_item_5' => $data_item_5,//style 5
            'desc' => $desc,//style 5
            'title' => $title,//style 5
            'title_intro' => $title_intro,//style 5
            'image_bg' => $image_bg,//style 5
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_banner','s7upf_vc_banner');

vc_map( array(
    "name"      => esc_html__("SV Banner", 'fb-tech'),
    "base"      => "s7upf_banner",
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
                esc_html__('Style 6','fb-tech')=>'style6',

            ),
            'description' => esc_html__( 'Select style', 'fb-tech' )
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_banner',
            'heading' => '',
            'element' => 'style',
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add color item', 'fb-tech'),
            'param_name' => 'add_item_5',
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
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Color', 'fb-tech' ),
                    'param_name' => 'color',
                    'description' => esc_html__('Select color.','fb-tech'),
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'fb-tech' ),
                    'param_name' => 'image',
                    'edit_field_class'=>'vc_col-sm-12 vc_column',
                    'description' => esc_html__('Select image from library.','fb-tech'),
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style5')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title intro', 'fb-tech' ),
            'param_name' => 'title_intro',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style5','style6')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title product', 'fb-tech' ),
            'param_name' => 'title',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style5')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Description', 'fb-tech' ),
            'param_name' => 'desc',
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style5')
            ),
        ),

        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image* (Required)', 'fb-tech' ),
            'param_name' => 'image',
            'edit_field_class' => 'vc_column vc_col-sm-6',
            'description' => esc_html__('Select image from library.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1','style2','style3','style4','style6')
            ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image background', 'fb-tech' ),
            'param_name' => 'image_bg',
            'description' => esc_html__('Select image from library.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style6')
            ),
        ),

        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Add link image', 'fb-tech' ),
            'param_name' => 'image_link',
            'edit_field_class' => 'vc_column vc_col-sm-6',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1','style2','style3')
            ),
        ),
        array(
            'type' => 'textarea_html',
            'heading' => esc_html__( 'Content banner', 'fb-tech' ),
            'param_name' => 'content',
            'description' => esc_html__('Enter text','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1','style2','style3','style4','style5','style6')
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Add button', 'fb-tech' ),
            'param_name' => 'button',
            'description' => esc_html__('Enter link/URL.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4')
            ),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__('Extra Class Name','fb-tech'),
            'param_name' => 'extra_class',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.','fb-tech'),
        ),

        array(
            "type" => "dropdown",
            "heading" => esc_html__("Position",'fb-tech'),
            'group' => esc_html__('Design Option','fb-tech'),
            "param_name" => "position",
            'description' => esc_html__( 'Select alignment.', 'fb-tech' ),
            'value' => array(
                esc_html__('Right','fb-tech') => 'pull-right',
                esc_html__('Left','fb-tech') => 'pull-left',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),

        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Position",'fb-tech'),
            'group' => esc_html__('Design Option','fb-tech'),
            "param_name" => "position3",
            'description' => esc_html__( 'Select alignment.', 'fb-tech' ),
            'value' => array(
                esc_html__('Left','fb-tech') => 'pull-left',
                esc_html__('Right','fb-tech') => 'pull-right',
                esc_html__('Top','fb-tech') => 'pull-top',
                esc_html__('Bottom','fb-tech') => 'pull-bottom',
                esc_html__('Center','fb-tech') => 'pull-center-center',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),

        ),

        array(
            "type" => "dropdown",
            "heading" => esc_html__("Image animation",'fb-tech'),
            'group' => esc_html__('Design Option','fb-tech'),
            "param_name" => "animation_image3",
            'description' => esc_html__( 'Select animation.', 'fb-tech' ),
            'value' => array(
                esc_html__('None','fb-tech') => '',
                esc_html__('Zoom image','fb-tech') => 'zoom-image',
                esc_html__('Zoom out','fb-tech') => 'zoom-out',
                esc_html__('Line scale','fb-tech') => 'line-scale',
                esc_html__('Zoom image and Line scale','fb-tech') => 'zoom-image line-scale',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),

        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation content', 'fb-tech' ),
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
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation image', 'fb-tech' ),
            'param_name' => 'animation_img',
            'group' => esc_html__('Design Option','fb-tech'),
            'value' => '',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
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
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background color', 'fb-tech' ),
            'param_name' => 'bg_color',
            'group' => esc_html__('Design Option','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
            'description' => esc_html__( 'Select color).', 'fb-tech' ),
        ),
        array(
            'type' => 's7up_number',
            'heading' => esc_html__( 'Min height', 'fb-tech' ),
            'param_name' => 'min_height',
            "min" => 0,
            'suffix' => esc_html__('px','fb-tech'),
            'group' => esc_html__('Design Option','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
            'description' => esc_html__( 'Select color).', 'fb-tech' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Size', 'fb-tech'),
            'param_name' => 'image_size',
            'group' => esc_html__('Design Option','fb-tech'),
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
        ),
    )
));