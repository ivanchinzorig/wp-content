<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */

add_action('admin_init', 's7upf_custom_meta_boxes');
if(!function_exists('s7upf_custom_meta_boxes')){
    function s7upf_custom_meta_boxes(){
        //Format content
        $format_metabox_post = array(
            'id' => 'block_format_content',
            'title' => esc_html__('Post Settings', 'fb-tech'),
            'desc' => '',
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'label' => esc_html__('Format setting','fb-tech'),
                    'id' => 'mb_format_setting',
                    'type' => 'tab'
                ),
                array(
                    'id' => 'format_gallery',
                    'label' => esc_html__('Add Gallery', 'fb-tech'),
                    'type' => 'Gallery',
                    'desc' => esc_html__('Create gallery image for gallery format','fb-tech')
                ),
                array(
                    'id' => 'format_media',
                    'label' => esc_html__('Link Media', 'fb-tech'),
                    'type' => 'text',
                    'desc' => esc_html__('Get link video(audio) in youtube, vimeo, soundclound, share host,... then input a link media. Note: Share host: there are 3 supported video formats mp4, ogg, webm ','fb-tech')
                ),

                array(
                    'id' => 'mb_banner_setting',
                    'label' => esc_html__('Banner setting','fb-tech'),
                    'type' => 'tab'
                ),
            
                array(
                    'id' => 'enable_banner_single',
                    'label' => esc_html__('Enable banner', 'fb-tech'),
                    'desc' => esc_html__('This allow you to turn on or off Banner.', 'fb-tech'),
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('-- User in theme option --','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'value'=>'off',
                            'label'=>esc_html__('Off','fb-tech'),
                        ),
                        array(
                            'value'=>'on',
                            'label'=>esc_html__('On','fb-tech'),
                        ),
                    ),
                    'section' => 'option_blog',
                    'std'  => ''
                ),
                array(
                    'id'          => 'boxes_banner_single',
                    'label'       => esc_html__('Boxes/Fullwidth banner','fb-tech'),
                    'desc' => esc_html__('Boxes/Fullwidth banner.', 'fb-tech'),
                    'type'        => 'on-off',
                    'std' => 'off',
                    'condition'   => 'enable_banner_single:is(on)',
                ),
                array(
                    'id' => 'list_item_banner_blog_single',
                    'label' => esc_html__('Add banner slider item', 'fb-tech'),
                    'desc' => esc_html__('Enter info.', 'fb-tech'),
                    'type' => 'list-item',
                    'section' => 'option_blog',
                    'condition'   => 'enable_banner_single:is(on)',
                    'settings'    => array(
                        array(
                            'id'        => 'img',
                            'label' => esc_html__('Background banner', 'fb-tech'),
                            'desc' => esc_html__('Select image from library.', 'fb-tech'),
                            'std'        => '',
                            'type'        => 'upload',
                        ),
                        array(
                            'id'        => 'info',
                            'label' => esc_html__('Info banner', 'fb-tech'),
                            'desc' => esc_html__('Enter info.', 'fb-tech'),
                            'std'        => '<h2 class="title30 color">Laptop Dell XPS</h2><h2 class="title30 white">New Model 2018 by Fanbong</h2><a href="#" class="shop-button color">Shop Now</a>',
                            'rows'        => '4',
                            'type'        => 'textarea-simple',
                        ),

                    )
                ),


                array(
                    'id' => 'mb_layout_setting',
                    'label' => esc_html__('Layout setting','fb-tech'),
                    'type' => 'tab'
                ),
                array(
                    'id' => 's7upf_show_breadrumb',
                    'label' => esc_html__('Show BreadCrumb', 'fb-tech'),
                    'desc' => esc_html__('This allow you to show or hide BreadCrumb', 'fb-tech'),
                    'type' => 'select',
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('-- User in theme option --','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','fb-tech'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('Off','fb-tech'),
                            'value'=>'off'
                        ),
                    ),

                ),
                array(
                    'id'          => 's7upf_header_page',
                    'label'       => esc_html__( 'Header Page', 'fb-tech' ),
                    'desc'        => esc_html__( 'Include page to Header', 'fb-tech' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => s7upf_list_header_page()
                ),
                array(
                    'id'          => 's7upf_footer_page',
                    'label'       => esc_html__( 'Footer Page', 'fb-tech' ),
                    'desc'        => esc_html__( 'Include page to Footer', 'fb-tech' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => s7upf_list_footer_page()
                ),
                array(
                    'id'          => 's7upf_sidebar_position',
                    'label'       => esc_html__('Sidebar position ','fb-tech'),
                    'type'        => 'select',
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('-- User in theme option --','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('No Sidebar','fb-tech'),
                            'value'=>'no'
                        ),
                        array(
                            'label'=>esc_html__('Left sidebar','fb-tech'),
                            'value'=>'left'
                        ),
                        array(
                            'label'=>esc_html__('Right sidebar','fb-tech'),
                            'value'=>'right'
                        ),
                    ),

                ),
                array(
                    'id'        =>'s7upf_select_sidebar',
                    'class'=>'style_condition',
                    'label'     =>esc_html__('Selects sidebar','fb-tech'),
                    'type'      =>'sidebar-select',
                    'condition' => 's7upf_sidebar_position:not(no),s7upf_sidebar_position:not()',
                ),
                array(
                    'id' => 'hide_media_single',
                    'label' => esc_html__('Hidden media in detail page', 'fb-tech'),
                    'type' => 'select',
                    'desc' => esc_html__('This allow you hidden media, gallery or image in your posts.','fb-tech'),
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('-- User in theme option --','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','fb-tech'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('Off','fb-tech'),
                            'value'=>'off'
                        ),
                    ),

                ),
                array(
                    'id' => 'enable_share_single_blog',
                    'label' => esc_html__('Hidden Enable share post', 'fb-tech'),
                    'type' => 'select',
                    'desc' => esc_html__('This allow you to show button share.','fb-tech'),
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('-- User in theme option --','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','fb-tech'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('Off','fb-tech'),
                            'value'=>'off'
                        ),
                    ),

                ),
                array(
                    'id' => 'enable_post_control_single_blog',
                    'label' => esc_html__('Enable post control', 'fb-tech'),
                    'type' => 'select',
                    'desc' => esc_html__('This allow you to show bar post control.','fb-tech'),
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('-- User in theme option --','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','fb-tech'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('Off','fb-tech'),
                            'value'=>'off'
                        ),
                    ),

                ),
                array(
                    'id' => 'enable_info_author_single_blog',
                    'label' => esc_html__('Enable info author', 'fb-tech'),
                    'type' => 'select',
                    'desc' => esc_html__('This allow you to show box info author.','fb-tech'),
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('-- User in theme option --','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','fb-tech'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('Off','fb-tech'),
                            'value'=>'off'
                        ),
                    ),

                ),


            ),
        );
        $format_metabox_page = array(
            'id' => 'block_format_content',
            'title' => esc_html__('Page Settings', 'fb-tech'),
            'desc' => '',
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'label' => esc_html__('General setting','fb-tech'),
                    'id' => 'mb_general_setting',
                    'type' => 'tab'
                ),
                array(
                    'id'          => 's7upf_header_page',
                    'label'       => esc_html__( 'Header Page', 'fb-tech' ),
                    'desc'        => esc_html__( 'Include page to Header', 'fb-tech' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => s7upf_list_header_page()
                ),
                array(
                    'id'          => 's7upf_footer_page',
                    'label'       => esc_html__( 'Footer Page', 'fb-tech' ),
                    'desc'        => esc_html__( 'Include page to Footer', 'fb-tech' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => s7upf_list_footer_page()
                ),
                array(
                    'id' => 's7upf_boxed_width',
                    'label' => esc_html__('Layout Boxed', 'fb-tech'),
                    'desc' => esc_html__('This allows you to enable layout boxed', 'fb-tech'),
                    'type' => 'select',
                    'section' => 'option_general',
                    'std' => 'off',
                    'choices'     => array(
                        array(
                        'label'=>esc_html__('Off','fb-tech'),
                        'value'=>'off'
                        ),
                        array(
                            'label'=>esc_html__('On','fb-tech'),
                            'value'=>'on'
                        ),

                    ),
                ),
                array(
                    'id'          => 's7upf_margin_boxed',
                    'class'=>'style_condition',
                    'label'       => esc_html__('Margin boxed (Default: 20px)','fb-tech'),
                    'type'        => 'text',
                    'section'     => 'option_general',
                    'condition'   => 's7upf_boxed_width:is(on)',
                ),

                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color (Default in theme option)','fb-tech'),
                    'type'        => 'colorpicker',
                    'desc' => esc_html__('This allow you custom color main of page.', 'fb-tech'),
                ),

                array(
                    'id'          => 'hide_title_page',
                    'label'       => esc_html__('Hide title page','fb-tech'),
                    'type'        => 'on-off',
                    'std' => 'off',
                ),
                array(
                    'id' => 's7upf_show_breadrumb_page',
                    'label' => esc_html__('Show BreadCrumb', 'fb-tech'),
                    'desc' => esc_html__('This allow you to show or hide BreadCrumb', 'fb-tech'),
                    'type' => 'on-off',
                    'std' => 'off',
                ),
                array(
                    'id' => 'mb_banner_setting',
                    'label' => esc_html__('Banner setting','fb-tech'),
                    'type' => 'tab'
                ),
                array(
                    'id'          => 'enable_banner_page',
                    'label'       => esc_html__('Enable banner','fb-tech'),
                    'type'        => 'on-off',
                    'std' => 'off',

                ),
                array(
                    'id'          => 'boxes_banner_page',
                    'label'       => esc_html__('Boxes/Fullwidth banner','fb-tech'),
                    'type'        => 'on-off',
                    'std' => 'off',
                    'condition'   => 'enable_banner_page:is(on)',
                ),
                array(
                    'id' => 'list_item_banner_page',
                    'label' => esc_html__('Add banner slider item', 'fb-tech'),
                    'desc' => esc_html__('Enter info.', 'fb-tech'),
                    'type' => 'list-item',
                    'condition'   => 'enable_banner_page:is(on)',
                    'settings'    => array(
                        array(
                            'id'        => 'img',
                            'label' => esc_html__('Background banner', 'fb-tech'),
                            'desc' => esc_html__('Select image from library.', 'fb-tech'),
                            'std'        => '',
                            'type'        => 'upload',
                        ),
                        array(
                            'id'        => 'info',
                            'label' => esc_html__('Info banner', 'fb-tech'),
                            'desc' => esc_html__('Enter info.', 'fb-tech'),
                            'std'        => '<h2 class="title30 color">Laptop Dell XPS</h2><h2 class="title30 white">New Model 2018 by Fanbong</h2><a href="#" class="shop-button color">Shop Now</a>',
                            'rows'        => '4',
                            'type'        => 'textarea-simple',
                        ),

                    )
                ),


            ),
        );
        $format_metabox_header = array(
            'id' => 'block_format_content',
            'title' => esc_html__('Header Settings', 'fb-tech'),
            'desc' => '',
            'pages' => array('s7upf_header'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id'          => 's7upf_header_fix_top',
                    'label'       => esc_html__( 'Header fix top', 'fb-tech' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('Off','fb-tech'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','fb-tech'),
                            'value'=>'header3'
                        ),
                    ),
                ),

            ),
        );

        if (function_exists('ot_register_meta_box')){
            ot_register_meta_box($format_metabox_post);
            ot_register_meta_box($format_metabox_page);
            ot_register_meta_box($format_metabox_header);
        }
    }
}
?>