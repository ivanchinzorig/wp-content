<?php
/**
 * Created by PhpStorm.
 * User: 7uptheme
 * Date: 04/04/2017
 * Time: 14:17
 */

if(!function_exists('s7upf_vc_testimonials'))
{
    function s7upf_vc_testimonials($attr,$content = false)
    {
        $html =$data_testimonials3= $image_size =$color_main=$img_right=$data_testimonials2=$link_title=$el_class= $add_item_testimonial_s6=$data_testimonial_s6=$style =$title=$text_color=$number_item=$title_color=$button=$sub_title=$pagination=$navigation=$autoplay =$main_color= $data_testimonial_s2= '' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'title'      => '',
            'sub_title'      => '',
            'image_size'      => '',
            'el_class'      => '',
            'link_title'      => '',
            'testimonials2'      => '',
            'img_right'      => '',
            'image_size'      => '',
            'color_main'      => '',
            'testimonials3'      => '',
            'autoplay'      => 'true',
            'itemscustom'      => '',
            'navigation'      => 'true',
            'pagination'      => 'false',

        ),$attr));
        if(isset($testimonials2))
            $data_testimonials2 = vc_param_group_parse_atts($testimonials2);
        if(isset($testimonials3))
            $data_testimonials3 = vc_param_group_parse_atts($testimonials3);
        $html .= S7upf_Template::load_view('elements/testimonials',false,array(
            'style' => $style,
            'content' => $content,
            'title' => $title,
            'sub_title' => $sub_title,
            'image_size' => $image_size,
            'el_class' => $el_class,
            'link_title' => $link_title,
            'data_testimonials2' => $data_testimonials2,
            'img_right' => $img_right,
            'image_size' => $image_size,
            'color_main' => $color_main,
            'data_testimonials3' => $data_testimonials3,
            'itemscustom' => $itemscustom,
            'autoplay' => $autoplay,
            'navigation' => $navigation,
            'pagination' => $pagination,
        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_testimonials','s7upf_vc_testimonials');

vc_map( array(
    "name"      => esc_html__("SV Testimonials", 'fb-tech'),
    "base"      => "s7upf_testimonials",
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
            'param_name' => 'style_testimonials',
            'heading' => '',
            'element' => 'style',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'fb-tech' ),
            'param_name' => 'title',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1','style3')
            ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Link title', 'fb-tech' ),
            'param_name' => 'link_title',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Sub title', 'fb-tech' ),
            'param_name' => 'sub_title',
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            'type' => 'textarea_html',
            'heading' => esc_html__( 'Content', 'fb-tech' ),
            'param_name' => 'content',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),

        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add testimonials item', 'fb-tech'),
            'param_name' => 'testimonials2',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title/Name', 'fb-tech' ),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Add link title', 'fb-tech' ),
                    'param_name' => 'link',
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Sub title', 'fb-tech' ),
                    'param_name' => 'sub_title',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Content', 'fb-tech' ),
                    'param_name' => 'desc',
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
            'heading' => esc_html__('Add client item', 'fb-tech'),
            'param_name' => 'testimonials3',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'fb-tech' ),
                    'param_name' => 'image',
                    'description' => esc_html__('Select image from library.','fb-tech'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title/Name', 'fb-tech' ),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Sub title', 'fb-tech' ),
                    'param_name' => 'sub_title',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Content', 'fb-tech' ),
                    'param_name' => 'desc',
                    'description' => esc_html__('Enter text.','fb-tech'),
                ),

                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Add link', 'fb-tech' ),
                    'param_name' => 'link',
                    'edit_field_class' => 'vc_column vc_col-sm-6',
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3','style4')
            ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image Right', 'fb-tech' ),
            'param_name' => 'img_right',
            'description' => esc_html__('Select image from library.','fb-tech'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__( 'Custom number item by device (Structure: ["Width of device (unit: px)","Number item"])', 'fb-tech' ),
            'param_name' => 'itemscustom',
            'group' => esc_html__('Design Option','fb-tech'),
            'edit_field_class'=>'vc_col-sm-12 vc_column mb-style-itemscustom',
            'std' => '[0,1],[480,1],[768,1],[990,1],[1200,1]',
            'description' => esc_html__( 'EX: [0,2],[480,3],[768,4],[990,5],[1200,6]', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Auto play silder', 'fb-tech' ),
            'param_name' => 'autoplay',
            'group' => esc_html__('Design Option','fb-tech'),
            'value' => array(
                esc_html__('On','fb-tech') => 'true',
                esc_html__('Off','fb-tech') => 'false',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3','style4')
            ),
            'description' => esc_html__( 'This allows you to enable or disable autoplay of slider.', 'fb-tech' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Navigation silder', 'fb-tech' ),
            'param_name' => 'navigation',
            'group' => esc_html__('Design Option','fb-tech'),
            'value' => array(
                esc_html__('On','fb-tech') => 'true',
                esc_html__('Off','fb-tech') => 'false',

            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3','style4')
            ),
            'description' => esc_html__( 'This allows you to enable or disable navigation of slider.', 'fb-tech' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Pagination silder', 'fb-tech' ),
            'param_name' => 'pagination',
            'group' => esc_html__('Design Option','fb-tech'),
            'value' => array(
                esc_html__('Off','fb-tech') => 'false',
                esc_html__('On','fb-tech') => 'true',

            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3','style4')
            ),
            'description' => esc_html__( 'This allows you to enable or disable pagination of slider.', 'fb-tech' )
        ),
        array(
            'type' => 'textfield',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Custom image size', 'fb-tech'),
            'param_name' => 'image_size',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2','style3','style4')
            ),
            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
        ),
        array(
            'type' => 'colorpicker',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Color', 'fb-tech'),
            'param_name' => 'color_main',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
            'description' => esc_html__('Select color', 'fb-tech'),
        ),
    )
));