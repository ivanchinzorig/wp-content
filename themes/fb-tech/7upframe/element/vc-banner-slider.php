<?php
/**
 * Created by Sublime text 2.
 * User: 7uptheme
 * Date: 18/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_banner_slider'))
{
    function s7upf_vc_banner_slider($attr,$content = false)
    {
        $html = $add_item_banner_3= $data_banner_custom =$data_banner_3 = $data_banner_2 = $add_item_banner_2 = $style = $add_item_banner_1 = $data_banner_1 = $autoplay = $navigation = $el_class =$transition= $pagination =$bg_image_size='' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'add_item_banner_1'      => '',
            'add_item_banner_2'      => '',
            'add_item_banner_3'      => '',
            'add_item_banner_custom'      => '',
            'navigation'      => 'false',
            'autoplay'      => 'true',
            'pagination'      => 'false',
            'bg_image_size'      => '',
            'transition'      => 'fade',
            'el_class'      => '',

        ),$attr));
        if(isset($add_item_banner_1))
            $data_banner_1 = vc_param_group_parse_atts($add_item_banner_1);
        if(isset($add_item_banner_2))
            $data_banner_2 = vc_param_group_parse_atts($add_item_banner_2);
        if(isset($add_item_banner_3))
            $data_banner_3 = vc_param_group_parse_atts($add_item_banner_3);
        if(isset($add_item_banner_custom))
            $data_banner_custom = vc_param_group_parse_atts($add_item_banner_custom);
        
        $html .= S7upf_Template::load_view('elements/banner-slider/banner',$style,array(
            'navigation' => $navigation,
            'pagination' => $pagination,
            'autoplay' => $autoplay,
            'transition' => $transition,
            'el_class' => $el_class,
            'data_banner_1' => $data_banner_1,
            'bg_image_size' => $bg_image_size,
            'data_banner_2' => $data_banner_2,
            'data_banner_3' => $data_banner_3,
            'data_banner_custom' => $data_banner_custom,
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_banner_slider','s7upf_vc_banner_slider');

vc_map( array(
    "name"      => esc_html__("SV Banner Slider", 'fb-tech'),
    "base"      => "s7upf_banner_slider",
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
                esc_html__('Style 2 (Custom info)','fb-tech')=>'style-custom',

            ),
            'description' => esc_html__( 'Select style', 'fb-tech' )
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_banner_slider',
            'heading' => '',
            'element' => 'style'
        ),
        //Style 1
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add banner item', 'fb-tech'),
            'param_name' => 'add_item_banner_1',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Background Image', 'fb-tech' ),
                    'param_name' => 'bg_image',
                    'description' => esc_html__('Select image from library.','fb-tech'),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Add link background', 'fb-tech' ),
                    'param_name' => 'bg_link',
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title 1', 'fb-tech' ),
                    'param_name' => 'title_1',
                    'admin_label' => true,
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title 2', 'fb-tech' ),
                    'param_name' => 'title_2',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Add button', 'fb-tech' ),
                    'param_name' => 'button',
                ),
                array(
                    'type' => 'animation_style',
                    'heading' => esc_html__( 'Animation info', 'fb-tech' ),
                    'param_name' => 'animation_css',
                    'value' => '',
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
                    "type" => "dropdown",
                    "heading" => esc_html__("Position info",'fb-tech'),
                    'group' => esc_html__('Design Option','fb-tech'),
                    "param_name" => "position",
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                    'description' => esc_html__( 'Select Position.', 'fb-tech' ),
                    'value' => array(
                        esc_html__('Left','fb-tech') => '',
                        esc_html__('Center','fb-tech') => 'pull-auto-center',
                        esc_html__('Right','fb-tech') => 'pull-right',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                    "heading" => esc_html__("Alignment info text",'fb-tech'),
                    'group' => esc_html__('Design Option','fb-tech'),
                    "param_name" => "alignment",
                    'description' => esc_html__( 'Select alignment.', 'fb-tech' ),
                    'value' => array(
                        esc_html__('Center','fb-tech') => 'text-center',
                        esc_html__('Left','fb-tech') => 'text-left',
                        esc_html__('Right','fb-tech') => 'text-right',
                    ),
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        //Style custom
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add banner item', 'fb-tech'),
            'param_name' => 'add_item_banner_custom',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Background Image', 'fb-tech' ),
                    'param_name' => 'bg_image',
                    'admin_label' => true,
                    'description' => esc_html__('Select image from library.','fb-tech'),
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Add link background', 'fb-tech' ),
                    'param_name' => 'bg_link',
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                ),
                array(
                    'type' => 'textarea_raw_html',
                    'heading' => esc_html__( 'Banner Info', 'fb-tech' ),
                    'param_name' => 'info',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'animation_style',
                    'heading' => esc_html__( 'Animation info', 'fb-tech' ),
                    'param_name' => 'animation_css',
                    'value' => '',
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
                    "type" => "dropdown",
                    "heading" => esc_html__("Position info",'fb-tech'),
                    'group' => esc_html__('Design Option','fb-tech'),
                    "param_name" => "position",
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                    'description' => esc_html__( 'Select Position.', 'fb-tech' ),
                    'value' => array(
                        esc_html__('Left','fb-tech') => 'pull-left',
                        esc_html__('Center','fb-tech') => 'pull-auto-center',
                        esc_html__('Right','fb-tech') => 'pull-right',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                    "heading" => esc_html__("Alignment info text",'fb-tech'),
                    'group' => esc_html__('Design Option','fb-tech'),
                    "param_name" => "alignment",
                    'description' => esc_html__( 'Select alignment.', 'fb-tech' ),
                    'value' => array(
                        esc_html__('Center','fb-tech') => 'text-center',
                        esc_html__('Left','fb-tech') => 'text-left',
                        esc_html__('Right','fb-tech') => 'text-right',
                    ),
                ),

                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name",'fb-tech'),
                    "param_name" => "el_class_item",
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style-custom')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),
        array(
            'type' => 'dropdown',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Autoplay slider', 'fb-tech' ),
            'param_name' => 'autoplay',
            'value' => array(
                esc_html__('On','fb-tech') => 'true',
                esc_html__('Off','fb-tech') => 'false',
            ),
        ),
        array(
            'type' => 'dropdown',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Navigation slider', 'fb-tech' ),
            'param_name' => 'navigation',
            'value' => array(
                esc_html__('Hide','fb-tech') => 'false',
                esc_html__('Show','fb-tech') => 'true',
            ),
        ),
        array(
            'type' => 'dropdown',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Pagination slider', 'fb-tech' ),
            'param_name' => 'pagination',
            'value' => array(
                esc_html__('Hide','fb-tech') => 'false',
                esc_html__('Show','fb-tech') => 'true',
            ),
            
        ),
        array(
            'type' => 'dropdown',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Transition slider', 'fb-tech' ),
            'param_name' => 'transition',
            'description' => esc_html__( 'Select animation when the slider is play', 'fb-tech' ),
            'value' => array(
                esc_html__('Fade','fb-tech') => 'fade',
                esc_html__('BackSlide','fb-tech') => 'backSlide',
                esc_html__('GoDown','fb-tech') => 'goDown',
                esc_html__('FadeUp','fb-tech') => 'fadeUp',
                esc_html__('Slide (none)','fb-tech') => '',
            ),
        ),
        array(
            'type' => 'textfield',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Custom background image size', 'fb-tech'),
            'param_name' => 'bg_image_size',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
        ),

    )
));