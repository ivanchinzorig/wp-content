<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 16/06/2017
 * Time: 2:10 CH
 */

if(!function_exists('s7upf_vc_tool_panel_color'))
{
    function s7upf_vc_tool_panel_color($attr)
    {
        $html = '';
        extract(shortcode_atts(array(

        ),$attr));

        $main_color = s7upf_get_value_by_id('main_color');
        $html .=    '<div class="widget-indexdm choose-main-color" id="widget_indexdm_color">
                        <a href="" class="dm-open-color dm-button-color" data-title="Close" data-title-close="Color"><i class="fa fa-long-arrow-left"></i><i class="fa fa-long-arrow-right"></i></a>
                        <div class="widget-indexdm-inner">
                            <div class="dm-header">
                                <div class="header-description">
                                    <h4>Choose Color</h4>
                                    <ul class="list-main-color text-left">
                                        <li class="active"><a class="styleswitch" data-color="'.$main_color.'" href="#" style="background: '.$main_color.';" ><span style="color: '.$main_color.';">Default</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="red" style="background: red;" ><span style="color: red;">Red</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="blue" style="background: blue;" ><span style="color: blue;">blue</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="green" style="background: green;" ><span style="color: green;">green</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="orange" style="background: orange;" ><span style="color: orange;">orange</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="navy" style="background: navy;" ><span style="color: navy;">navy</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="darkcyan" style="background: darkcyan;" ><span style="color: darkcyan;">dark_cyan</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="#5C6DBD" style="background: #5C6DBD;" ><span style="color: #5C6DBD;">dark_blue</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="#F3B516" style="background: #F3B516;" ><span style="color: #F3B516;">yellow</span></a></li>
                                        <li><a class="styleswitch" href="#" data-color="#E3521B" style="background: #E3521B;" ><span style="color: #E3521B;">Red_orange</span></a></li>
                                       
                                    </ul>
                                </div>      
                            </div>
                        </div>          
                    </div>';
        return $html;
    }
}
/*
stp_reg_shortcode('s7upf_tool_panel_color','s7upf_vc_tool_panel_color');

vc_map( array(
    "name"      => esc_html__("SV Tool Panel Color", 'handmade'),
    "base"      => "s7upf_tool_panel_color",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Title",'handmade'),
            "param_name" => "title",
        ),

    )
));*/