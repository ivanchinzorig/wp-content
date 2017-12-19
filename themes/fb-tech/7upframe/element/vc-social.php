<?php
/**
 * Created by PhpStorm.
 * User: up7theme
 * Date: 12/04/2017
 * Time: 08:16
 */
if(!function_exists('s7upf_vc_social'))
{
    function s7upf_vc_social($attr,$content = false)
    {
        $html = $style  =$title = $data_social = '' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'add_item_social'      => '',
            'title'      => '',

        ),$attr));

        if(isset($add_item_social))
            $data_social = vc_param_group_parse_atts($add_item_social);

        $html .= S7upf_Template::load_view('elements/social',false,array(
            'style' => $style,
            'data_social' => $data_social,
            'title' => $title,
        ));
        return $html;
    }
}
stp_reg_shortcode('s7upf_social','s7upf_vc_social');

vc_map(
    array(
        "name"      => esc_html__("SV Social", 'fb-tech'),
        "base"      => "s7upf_social",
        "icon"      => "icon-st",
        "category"  => '7Up-theme',
        "params"    => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__( 'Style', 'fb-tech' ),
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Style 1 (classic)','fb-tech')=>'style1',
                ),
                'description' => esc_html__( 'Select style', 'fb-tech' )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'fb-tech' ),
                'param_name' => 'title',
                'description' => esc_html__('Enter text.','fb-tech'),
                'dependency'    =>array(
                    'element'   =>'style',
                    'value'     =>array('style1')
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Add social item', 'fb-tech'),
                'param_name' => 'add_item_social',
                'value' =>'',
                'params' => array(
                    array(
                        'type'          => 'iconpicker',
                        'heading'       => esc_html__( 'Icon', 'fb-tech' ),
                        'param_name'    => 'icon',
                        'value'         => '',
                        'settings'      => array(
                            'emptyIcon'     => true,
                            'iconsPerPage'  => 4000,
                        ),
                        'description'   => esc_html__( 'Select icon from library.', 'fb-tech' ),
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Add link', 'fb-tech' ),
                        'param_name' => 'link',
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

        )
    )
);