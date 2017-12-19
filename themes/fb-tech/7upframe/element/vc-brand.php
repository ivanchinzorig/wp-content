<?php
/**
 * Created by PhpStorm.
 * User: 7uptheme
 * Date: 08/04/2017
 * Time: 10:37
 */
if(!function_exists('s7upf_vc_brand'))
{
    function s7upf_vc_brand($attr,$content = false)
    {
        $html = $style =$title= $navigation= $el_class=$data_item_brand = $autoplay = $image_size = $itemscustom = '' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'title'      => '',
            'add_item_brand'      => '',
            'image_size' => '',
            'autoplay'      => 'true',
            'navigation'      => 'false',
            'itemscustom'      => '',
            'el_class'      => '',
        ),$attr));
        if(isset($add_item_brand))
            $data_item_brand = vc_param_group_parse_atts($add_item_brand);

        $html .= S7upf_Template::load_view('elements/brand',false,array(
            'data_item_brand' => $data_item_brand,
            'style' => $style,
            'image_size' => $image_size,
            'autoplay' => $autoplay,
            'navigation' => $navigation,
            'itemscustom' => $itemscustom,
            'el_class' => $el_class,
            'title' => $title,
        ));
        return $html;
    }
}
stp_reg_shortcode('s7upf_brand','s7upf_vc_brand');

vc_map(
    array(
        "name"      => esc_html__("SV Brand", 'fb-tech'),
        "base"      => "s7upf_brand",
        "icon"      => "icon-st",
        "category"  => '7Up-theme',
        "params"    => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__( 'Style', 'fb-tech' ),
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Style 1 (Slider)','fb-tech')=>'style1',
                    esc_html__('Style 2 (Slider)','fb-tech')=>'style2',
                ),
                'description' => esc_html__( 'Select style', 'fb-tech' )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'fb-tech'),
                'param_name' => 'title',
                'edit_field_class' => 'vc_column vc_col-sm-12',
                'description' => esc_html__('Enter title.', 'fb-tech'),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Add brand item', 'fb-tech'),
                'param_name' => 'add_item_brand',
                'value' =>'',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Image', 'fb-tech' ),
                        'param_name' => 'image',
                        'description' => esc_html__('Select image from library.','fb-tech'),
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link item', 'fb-tech' ),
                        'param_name' => 'link',
                    ),

                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                ),
                'dependency'    =>array(
                    'element'   =>'style',
                    'value'     =>array('style1','style2')
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
                'edit_field_class'=>'vc_col-sm-12 vc_column mb-style-itemscustom',
                'group' => esc_html__('Design Option','fb-tech'),
                'std' => '[0,2],[480,3],[768,4],[990,5]',
                'description' => esc_html__( 'EX: [0,2],[480,3],[768,4],[990,5],[1200,6]', 'fb-tech' ),
                'dependency'    =>array(
                    'element'   =>'style',
                    'value'     =>array('style1','style2')
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
                'dependency'    =>array(
                    'element'   =>'style',
                    'value'     =>array('style1','style2')
                ),
            ),
            array(
                'type' => 'dropdown',
                'group' => esc_html__('Design Option','fb-tech'),
                'heading' => esc_html__( 'Autoplay', 'fb-tech' ),
                'param_name' => 'autoplay',
                'value' => array(
                    esc_html__('On','fb-tech') => 'true',
                    esc_html__('Off','fb-tech') => 'false',
                ),
                'dependency'    =>array(
                    'element'   =>'style',
                    'value'     =>array('style1','style2')
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom image size', 'fb-tech'),
                'group' => esc_html__('Design Option','fb-tech'),
                'param_name' => 'image_size',
                'edit_field_class' => 'vc_column vc_col-sm-12',
                'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
            ),
        )
    )
);