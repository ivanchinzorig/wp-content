<?php
/**
 * Created by Sublime text 2.
 * User: 7uptheme
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_map'))
{
    function s7upf_vc_map($attr)
    {
        $html = $style = $width = $height = $el_class=$html_mask =  $market = $zoom = $location = $control = $scrollwheel = $disable_ui = $draggable = '';
        extract(shortcode_atts(array(
            'style'         =>'',
            'market'        =>'',
            'zoom'          =>'16',
            'location'      =>'',
            'control'       =>'yes',
            'scrollwheel'   =>'yes',
            'disable_ui'    =>'no',
            'draggable'     =>'yes',
            'width'     =>'100%',
            'height'     =>'500px',
            'el_class'     =>''
        ),$attr));
        $location = vc_param_group_parse_atts($attr['location']);
        $location_text = '';
        if(is_array($location) && count($location) > 0 ) {
            foreach ($location as $value) {
                if(!empty($value)) {
                    if(isset($value['image_location'])){
                        $img_src1 = wp_get_attachment_image_src($value['image_location'], "full");
                        if(is_array($img_src1) and count($img_src1)>0)
                            $img_src = $img_src1[0];
                    }
                    $location_text .= '|' . s7upf_get_data_isset($value,'st_lat') . '&&' . s7upf_get_data_isset($value,'st_long') . '&&' . s7upf_get_data_isset($value,'marker_title') . '&&' . s7upf_get_data_isset($value,'info_box') . '&&' . (!empty($img_src)?$img_src:'');
                }
            }
        }
        $img = array();$img[0]='';
        if($market != '') {
            $img = wp_get_attachment_image_src($market,"full");
        }
        $id = 'sv-map-'.uniqid();
        $map_css = S7upf_Assets::build_css('width:' . $width . ';height:' . $height . ';max-width-100%;');
        if($location_text !== '')
            $html .= '<div class="mb-google-map '.$el_class.'">'.$html_mask.'<div id = "'.$id.'" class="' . $map_css. ' sv-ggmaps" data-location="' . $location_text . '" data-market="' . $img[0] . '" data-zoom="' . $zoom . '" data-style="' . $style . '" data-control="' . $control . '" data-scrollwheel="' . $scrollwheel . '" data-disable_ui="' . $disable_ui . '" data-draggable="' . $draggable . '"></div></div>';
        return $html;
    }
}

stp_reg_shortcode('sv_map','s7upf_vc_map');

vc_map( array(
    "name"      => esc_html__("SV GoogleMap", 'fb-tech'),
    "base"      => "sv_map",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params" => array(
        array(
            'type' => 'param_group',
            "heading" => esc_html__("Add Map Location", 'fb-tech'),
            "param_name" => "location",
            'value' =>'',
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__( "Latitude", 'fb-tech' ),
                    "param_name" => "st_lat",
                    "value" => "",
                    "description" => esc_html__("Enter Latitude of location",'fb-tech'),

                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__( "Longitude", 'fb-tech' ),
                    "param_name" => "st_long",
                    "value" => "",
                    "description" => esc_html__("Enter Longitude of location",'fb-tech'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__( "Marker Title", 'fb-tech' ),
                    "param_name" => "marker_title",
                    "value" => "",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__( "Info Box", 'fb-tech' ),
                    "param_name" => "info_box",
                    "value" => "",
                    "description" => esc_html__("Enter info of location",'fb-tech'),

                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__( "Image Location", 'fb-tech' ),
                    "param_name" => "image_location",
                    "description" => esc_html__("Upload image",'fb-tech'),

                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            "group"=> esc_html__("Location",'fb-tech'),

        ),
        array(
            "type" => "textfield",
            "group"=> esc_html__("Location",'fb-tech'),
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => esc_html__("Map Style", 'fb-tech'),
            "param_name" => "style",
            'value' => array(
                esc_html__('Default', 'fb-tech') => 'style1',
                esc_html__('Grayscale', 'fb-tech') => 'grayscale',
                esc_html__('Blue', 'fb-tech') => 'blue',
                esc_html__('Dark', 'fb-tech') => 'dark',
                esc_html__('Pink', 'fb-tech') => 'pink',
                esc_html__('Light', 'fb-tech') => 'light',
                esc_html__('Blueessence', 'fb-tech') => 'blueessence',
                esc_html__('Bentley', 'fb-tech') => 'bentley',
                esc_html__('Retro', 'fb-tech') => 'retro',
                esc_html__('Cobalt', 'fb-tech') => 'cobalt',
                esc_html__('Brownie', 'fb-tech') => 'brownie',
                esc_html__('Snazzy', 'fb-tech') => 'snazzy'
            ),
            "group"=> esc_html__("Map Settings",'fb-tech'),
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_map',
            'heading' => '',
            'element' => 'style',
            "group"=> esc_html__("Map Settings",'fb-tech'),
        ),
        array(
            "type" => "s7up_number",
            "holder" => "div",
            "heading" => esc_html__("Map Zoom", 'fb-tech'),
            "param_name" => "zoom",
            "description" => esc_html__("Enter zoom for map (Default is 16 level).", 'fb-tech'),
            'min' => '1',
            'max' => '20',
            'suffix' => esc_html__('Level','fb-tech'),
            "group"=> esc_html__("Map Settings",'fb-tech'),
            'value' => '16'
        ),
        array(
            'type' => 'attach_image',
            "holder" => "div",
            'heading' => esc_html__('Marker Image', 'fb-tech'),
            'param_name' => 'market',
            "group"=> esc_html__("Map Settings",'fb-tech'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Map Width', 'fb-tech'),
            'param_name' => 'width',
            "description" => esc_html__("This is value to set width and height for map. Unit % , px or em. ", 'fb-tech'),
            "group"=> esc_html__("Map Settings",'fb-tech'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Map Height', 'fb-tech'),
            'param_name' => 'height',
            "group"=> esc_html__("Map Settings",'fb-tech'),
            "description" => esc_html__("This is value to set height for map. Unit % or px. Example: 100%,500px. Default is 500px", 'fb-tech')
        ),

        array(
            "type" => "dropdown",
            "heading" => esc_html__("Map Type Control", 'fb-tech'),
            "param_name" => "control",
            'value' => array(
                esc_html__('Yes', 'fb-tech') => 'yes',
                esc_html__('No', 'fb-tech') => 'no',
            ),
            "group"=> esc_html__("Map Settings",'fb-tech'),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Scroll wheel", 'fb-tech'),
            "param_name" => "scrollwheel",
            'value' => array(
                esc_html__('Yes', 'fb-tech') => 'yes',
                esc_html__('No', 'fb-tech') => 'no',
            ),
            "group"=> esc_html__("Map Settings",'fb-tech'),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Disable Default UI", 'fb-tech'),
            "param_name" => "disable_ui",
            'value' => array(
                esc_html__('No', 'fb-tech') => 'no',
                esc_html__('Yes', 'fb-tech') => 'yes',
            ),
            "group"=> esc_html__("Map Settings",'fb-tech'),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Draggable", 'fb-tech'),
            "param_name" => "draggable",
            'value' => array(
                esc_html__('Yes', 'fb-tech') => 'yes',
                esc_html__('No', 'fb-tech') => 'no',
            ),
            "group"=> esc_html__("Map Settings",'fb-tech'),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),

    )
));