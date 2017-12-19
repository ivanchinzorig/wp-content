<?php
/**
 * Created by PhpStorm
 * User: up7theme
 * Date: 29/02/16
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_blog'))
{
    function s7upf_vc_blog($attr)
    {
        $html = $itemscustom =$posi_navigation=$number_row=$hide_date=$hide_author=$hide_category=$hide_tags=$autoplay = $extra_class = $navigation = $title=$date_format = $main_color = $user_id = $col_layout = $style = $post_format = $post_id = $word_excerpt = $image_size = $pagination = $number = $order_by = $order = '';
        extract(shortcode_atts(array(
            'number'     => '8',
            'word_excerpt'    => '30',
            'cats'      => '',
            'order'      => '',
            'order_by'   => '',
            'style'   => 'style1',
            'image_size'   => '',
            'pagination'   => 'off',
            'post_id'   => '',
            'user_id'   => 'off',
            'post_format'   => '',
            'col_layout'   => '12',
            'date_format'   => '',
            'video_height'   => '',
            'title'   => '',
            'navigation'   => 'true',
            'autoplay'   => 'true',
            'itemscustom'   => '',
            'extra_class'   => '',
            'hide_date'   => '',
            'hide_author'   => '',
            'hide_category'   => '',
            'hide_tags'   => '',
            'number_row'   => '',
            'posi_navigation'   => 'center-navi',
        ),$attr));
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => $paged,
            'post_status' => 'publish',
        );
        if($order_by == 'post_views'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'post_views';
        }
        if($order_by == 'time_update'){
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'time_update';
        }
        if($order_by == '_post_like_count'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_post_like_count';
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'category',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        $query = new WP_Query($args);
        if($user_id == 'on' and !empty($post_id)){
            $ids_arr = explode(',', $post_id);
            $ids_arr = array_unique($ids_arr);
            $args2 = array(
                'post_type' => 'post',
                'post__in'=>$ids_arr,
                'posts_per_page'    => $number,
                'paged'             => $paged,
                'post_status' => 'publish',
                'order'             => $order,
                'orderby'           => $order_by,
            );
            $query = new WP_Query($args2);
        }
        $max_page = $query->max_num_pages;
        $html .= S7upf_Template::load_view('elements/blog/blog',$style,array(
            'query' => $query,
            'word_excerpt' => $word_excerpt,
            'image_size' => $image_size,
            'post_format' => $post_format,
            'pagination' => $pagination,
            'paged' => $paged,
            'col_layout' => $col_layout,
            'main_color' => $main_color,
            'date_format' => $date_format,
            'style' => $style,
            'title' => $title,
            'navigation' => $navigation,
            'autoplay' => $autoplay,
            'itemscustom' => $itemscustom,
            'extra_class' => $extra_class,
            'hide_tags' => $hide_tags,
            'hide_category' => $hide_category,
            'hide_author' => $hide_author,
            'hide_date' => $hide_date,
            'number_row' => $number_row,
            'posi_navigation' => $posi_navigation,
        ));
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('s7upf_blog','s7upf_vc_blog');

vc_map( array(
    "name"      => esc_html__("SV Blog", 'fb-tech'),
    "base"      => "s7upf_blog",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style blog",'fb-tech'),
            "param_name" => "style",
            'admin_label' => true,
            'description'   => esc_html__( 'Select style blog.', 'fb-tech' ),
            "value"         => array(
                esc_html__('Style 1 (Default)','fb-tech') => 'style1',
                esc_html__('Style 2 (Classic)','fb-tech') => 'style2',
                esc_html__('Style 3 (Classic)','fb-tech') => 'style3',
                esc_html__('Style 4 (Slider)','fb-tech') => 'style4',
                esc_html__('Style 5 (Slider)','fb-tech') => 'style5',
                esc_html__('Style 6 (slider)','fb-tech') => 'style6',
                esc_html__('Style 7 (list)','fb-tech') => 'style7',
            ),
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_blog',
            'heading' => '',
            'element' => 'style',
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'title',
            "heading" => esc_html__("Title element",'fb-tech'),
            'description' => __( 'Enter text', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2','style3','style4','style5','style6','style7')
            ),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Use ID post",'fb-tech'),
            "param_name" => "user_id",
            'admin_label' => true,
            "value"         => array(
                esc_html__('Off','fb-tech') => 'off',
                esc_html__('On','fb-tech') => 'on',
            ),
        ),
        array(
            'type' => 'autocomplete',
            'heading' => __( 'Posts', 'fb-tech' ),
            'param_name' => 'post_id',
            'edit_field_class'=>'vc_col-sm-12 vc_column',
            'settings' => array(
                'multiple' => true,
                'sortable' => true,
                'unique_values' => true,
                // In UI show results except selected. NB! You should manually check values in backend
            ),
            'save_always' => true,
            'description' => __( 'Enter List of Posts', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'user_id',
                'value'     =>array('on')
            ),
        ),
        array(
            "type" => "s7up_number",
            "heading" => esc_html__("Number post",'fb-tech'),
            "param_name" => "number",
            'edit_field_class'=>'vc_col-sm-12 vc_column',
            'admin_label' => true,
            'std' => 8,
            "min" => 0,
            'suffix' => esc_html__('Post','fb-tech'),
        ),
        array(
            'holder'     => 'div',
            'heading'     => esc_html__( 'Categories', 'fb-tech' ),
            'type'        => 'checkbox',
            'param_name'  => 'cats',
            'value'       => s7upf_list_taxonomy('category',false),
            'edit_field_class'=>'vc_col-sm-12 vc_column s7upf-category-option',
            'dependency'    =>array(
                'element'   =>'user_id',
                'value'     =>array('off')
            ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Order",'fb-tech'),
            "param_name"    => "order",
            "value"         => array(
                esc_html__('Desc','fb-tech') => 'DESC',
                esc_html__('Asc','fb-tech')  => 'ASC',
            ),
            'edit_field_class'=>'vc_col-sm-6 vc_column',

        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Order By",'fb-tech'),
            "param_name"    => "order_by",
            "value"         => s7upf_get_order_list(),
            'edit_field_class'=>'vc_col-sm-6 vc_column',

        ),

        array(
            "type" => "s7up_number",
            "heading" => esc_html__("Number word excerpt",'fb-tech'),
            "param_name" => "word_excerpt",
            'edit_field_class'=>'vc_col-sm-6 vc_column',
            "min" => 0,
            'suffix' => esc_html__('word','fb-tech'),
            'std'=>30
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Enable Pagination', 'fb-tech'),
            'param_name' => 'pagination',
            'edit_field_class'=>'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__("Off", 'fb-tech') => 'off',
                esc_html__("On", 'fb-tech') => 'on'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1','style2','style3')
            ),

        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Extra Class Name','fb-tech'),
            'param_name' => 'extra_class',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.','fb-tech'),
        ),

        array(
            'type' => 'dropdown',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Column layout', 'fb-tech'),
            'param_name' => 'col_layout',
            'value' => array(
                esc_html__("Columns 1", 'fb-tech') => '12',
                esc_html__("Columns 2", 'fb-tech') => '6',
                esc_html__("Columns 3", 'fb-tech') => '4',
                esc_html__("Columns 4", 'fb-tech') => '3',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'checkbox',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Hide date box', 'fb-tech'),
            'param_name' => 'hide_date',
            'edit_field_class'=>'vc_col-sm-6 vc_column',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'checkbox',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Hide author box', 'fb-tech'),
            'param_name' => 'hide_author',
            'edit_field_class'=>'vc_col-sm-6 vc_column',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'checkbox',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Hide category box', 'fb-tech'),
            'param_name' => 'hide_category',
            'edit_field_class'=>'vc_col-sm-6 vc_column',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'checkbox',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Hide tags box', 'fb-tech'),
            'param_name' => 'hide_tags',
            'edit_field_class'=>'vc_col-sm-6 vc_column',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style3')
            ),
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__( 'Custom number item by device (Structure: ["Width of device (unit: px)","Number item"])', 'fb-tech' ),
            'param_name' => 'itemscustom',
            'edit_field_class'=>'vc_col-sm-12 vc_column mb-style-itemscustom',
            'group' => esc_html__('Design Option','fb-tech'),
            'description' => esc_html__( 'EX: [0,2],[480,3],[768,4],[990,5],[1200,6]', 'fb-tech' ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4','style5','style6')
            ),
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Custom row Slider', 'fb-tech' ),
            'param_name' => 'number_row',
            'value' => array(
                esc_html__('Default','fb-tech')=>'',
                esc_html__('1 Row','fb-tech')=>1,
                esc_html__('2 Rows','fb-tech')=>2,
                esc_html__('3 Rows','fb-tech')=>3,
                esc_html__('4 Rows','fb-tech')=>4,
                esc_html__('5 Rows','fb-tech')=>5,
                esc_html__('6 Rows','fb-tech')=>6,
                esc_html__('7 Rows','fb-tech')=>7,
                esc_html__('8 Rows','fb-tech')=>8,
                esc_html__('9 Rows','fb-tech')=>9,
                esc_html__('10 Rows','fb-tech')=>10,
                esc_html__('15 Rows','fb-tech')=>15,
                esc_html__('20 Rows','fb-tech')=>20,
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value' => array('style5'),
            ),
            'description' => esc_html__( 'Select number row of slides.', 'fb-tech' )
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
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4','style5','style6')
            ),

        ),
        array(
            'type' => 'dropdown',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Navigation slider', 'fb-tech' ),
            'param_name' => 'navigation',
            'value' => array(
                esc_html__('Show','fb-tech') => 'true',
                esc_html__('Hide','fb-tech') => 'false',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4','style5','style6')
            ),
        ),
        array(
            'type' => 'dropdown',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Position navigation', 'fb-tech' ),
            'param_name' => 'posi_navigation',
            'value' => array(
                esc_html__('Center','fb-tech') => 'center-navi',
                esc_html__('Right','fb-tech') => '',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style4')
            ),
        ),
        array(
            'type' => 'textfield',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__( 'Custom Date Format (Default get in Settings/General)', 'fb-tech' ),
            'param_name' => 'date_format',
            'description' => wp_kses(__('Eg: d/m/Y <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Documentation on date and time formatting</a>','fb-tech'),array('a' => array('href' => array(),'target'=>array()))),
        ),
        array(
            'type' => 'textfield',
            'group' => esc_html__('Design Option','fb-tech'),
            'heading' => esc_html__('Custom image size', 'fb-tech'),
            'param_name' => 'image_size',
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fb-tech'),
        ),

    )
));
