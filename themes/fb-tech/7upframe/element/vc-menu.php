<?php
/**
 * Created by Sublime text 2.
 * User: 7uptheme
 * Date: 18/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_menu'))
{
    function s7upf_vc_menu($attr,$content = false)
    {
        $html = $el_class  = $menu =  $style = $show_icon= $show_mini_cart=$logo=$menu_position = $logo_img= '' ;
        extract(shortcode_atts(array(
            'menu'      => 'primary',
            'style'      => 'style1',
            'menu_position'      => 'text-right',
            'el_class'      => '',
            'show_icon'      => 'hide',
            'logo_img'      => '',
            'show_mini_cart'      => 'hide',

        ),$attr));
        switch ($style){
            case 'style1':
                $html .= '<nav class="element-menu-style1 main-nav main-nav1 pull-right icon-menu-'.$show_icon.' '.$el_class.'">';
                ob_start();
                if('primary'===$menu){
                    wp_nav_menu( array(
                        'theme_location' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }else{
                    wp_nav_menu( array(
                        'menu' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }
                $html .= @ob_get_clean();
                $html .= '<a href="#" class="toggle-mobile-menu"><span></span></a></nav>';
                break;
            case 'style2':
                $html .= '<nav class="element-menu-style2 main-nav main-nav3 icon-menu-'.$show_icon.' '.$el_class.'">';
                ob_start();
                if('primary'===$menu){
                    wp_nav_menu( array(
                        'theme_location' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }else{
                    wp_nav_menu( array(
                        'menu' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }
                $html .= @ob_get_clean();
                $html .= '<a href="#" class="toggle-mobile-menu"><span></span></a></nav>';
                break;
            case 'style3':
               $html .= '<nav class="element-menu-style3 main-nav main-nav5 pull-right icon-menu-'.$show_icon.' '.$el_class.'">';
                ob_start();
                if('primary'===$menu){
                    wp_nav_menu( array(
                        'theme_location' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }else{
                    wp_nav_menu( array(
                        'menu' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }
                $html .= @ob_get_clean();
                $html .= '<a href="#" class="toggle-mobile-menu"><span></span></a></nav>';
                break;
            case 'style4':

                if(!empty($logo_img)){
                    $img = wp_get_attachment_image_src( $logo_img ,"full");
                    $logo .= $img[0];
                }else{
                    $logo .= s7upf_get_option('logo');
                }
                $html .= ' <div class="element-menu-style4  '.$el_class.'">';

                $html .= '<div class="header-nav header-nav4 header-ontop6 bg-white header-ontop">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="logo logo1">
                                <h1 class="hidden">'.get_bloginfo('name', 'display').'</h1>
                                <a href="'.esc_url(get_home_url('/')).'"><img src="'.esc_url($logo).'" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="main-nav main-nav3">';
                               ob_start();
                               if('primary'===$menu){
                                   wp_nav_menu( array(
                                       'theme_location' => $menu,
                                       'container'=>false,
                                       'menu_class'=>'list-inline-block',
                                       'walker'=>new S7upf_Walker_Nav_Menu(),
                                   ));
                               }else{
                                   wp_nav_menu( array(
                                       'menu' => $menu,
                                       'container'=>false,
                                       'menu_class'=>'list-inline-block',
                                       'walker'=>new S7upf_Walker_Nav_Menu(),
                                   ));
                               }
                               $html .= @ob_get_clean();
                $html .= '   </div>
                        </div>
                        </div>
                    </div>
                </div>';
               $html .= ' <div class="header6">';
               $html .= '<nav class=" main-nav main-nav1 text-center icon-menu-'.$show_icon.'">';
                ob_start();
                if('primary'===$menu){
                    wp_nav_menu( array(
                        'theme_location' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }else{
                    wp_nav_menu( array(
                        'menu' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }
                $html .= @ob_get_clean();
                $html .= '<a href="#" class="toggle-mobile-menu"><span></span></a></nav>';
                if($show_mini_cart == 'show')
                $html .= S7upf_Template::load_view('elements/mini-cart-menu',false);
                $html .= '</div></div>';
                break;
            case 'style5':
                $html .= '<nav class="element-menu-style5 main-nav main-nav7 pull-right icon-menu-'.$show_icon.' '.$el_class.'">';
                ob_start();
                if('primary'===$menu){
                    wp_nav_menu( array(
                        'theme_location' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }else{
                    wp_nav_menu( array(
                        'menu' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-inline-block',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }
                $html .= @ob_get_clean();
                $html .= '<a href="#" class="toggle-mobile-menu"><span></span></a></nav>';
                break;
                break;
            default :
                $html .= '<div class="main-header4 element-menu-'.$style.' '.$scroll_fixed.'"><div class="mb-container"><div class="row"><div class="col-md-12">';
                $html .= '<nav class="main-nav main-nav5 '.$menu_position.'">';
                ob_start();
                if('primary'===$menu){
                    wp_nav_menu( array(
                        'theme_location' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-none',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }else{
                    wp_nav_menu( array(
                        'menu' => $menu,
                        'container'=>false,
                        'menu_class'=>'list-none',
                        'walker'=>new S7upf_Walker_Nav_Menu(),
                    ));
                }
                $html .= @ob_get_clean();
                $html .= '<a href="#" class="toggle-mobile-menu"><span></span></a></nav>';
                $html .= '</div></div></div></div>';
                break;
        }
        return $html;
    }
}

stp_reg_shortcode('s7upf_menu','s7upf_vc_menu');

vc_map( array(
    "name"      => esc_html__("SV Menu", 'fb-tech'),
    "base"      => "s7upf_menu",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Style menu', 'fb-tech' ),
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
            'param_name' => 'style_menu',
            'heading' => '',
            'element' => 'style',
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Menu name', 'fb-tech' ),
            'param_name' => 'menu',
            'value' => s7upf_list_menu_name(),
            'description' => esc_html__( 'Select Menu name to display', 'fb-tech' )
        ),

        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Show icon', 'fb-tech' ),
            'param_name' => 'show_icon',
            'value' => array(
                esc_html__('Hide','fb-tech')=>'hide',
                esc_html__('Show','fb-tech')=>'show',
            ),
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Show mini cart', 'fb-tech' ),
            'param_name' => 'show_mini_cart',
            'value' => array(
                esc_html__('Hide','fb-tech')=>'hide',
                esc_html__('Show','fb-tech')=>'show',
            ),
            'dependency' => array(
                'element' => 'style',
                'value' => array('style4')
            ),
        ),
        array(
            "type" => "attach_image",
            'admin_label' => true,
            "heading" => esc_html__("Logo image",'fb-tech'),
            "param_name" => "logo_img",
            'description' => esc_html__( 'Select image from library', 'fb-tech' ),
            'dependency' => array(
                'element' => 'style',
                'value' => array('style4')
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name",'fb-tech'),
            "param_name" => "el_class",
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech' ),
        ),
    )
));