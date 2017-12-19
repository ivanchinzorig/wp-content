<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!function_exists('s7upf_set_theme_config')){
    function s7upf_set_theme_config(){
        global $s7upf_dir,$s7upf_config;
        /**************************************** BEGIN ****************************************/
        $s7upf_dir = get_template_directory_uri() . '/7upframe';
        $s7upf_config = array();
        $s7upf_config['dir'] = $s7upf_dir;
        $s7upf_config['css_url'] = $s7upf_dir . '/assets/css/';
        $s7upf_config['js_url'] = $s7upf_dir . '/assets/js/';
        $s7upf_config['nav_menu'] = array(
            'primary' => esc_html__( 'Primary Navigation', 'fb-tech' ),
        );
        $s7upf_config['mega_menu'] = '1';
        $s7upf_config['sidebars']=array(
            array(
                'name'              => esc_html__( 'Blog Sidebar', 'fb-tech' ),
                'id'                => 'blog-sidebar',
                'description'       => esc_html__( 'Widgets in this area will be shown on all blog page.', 'fb-tech'),
                'before_title'      => '<h3 class="widget-title">',
                'after_title'       => '</h3>',
                'before_widget'     => '<div id="%1$s" class="sidebar-widget widget %2$s">',
                'after_widget'      => '</div>',
            )
        );
        $s7upf_config['import_config'] = array(
                'homepage_default'          => 'Home 1',
                'blogpage_default'          => 'Blog',
                'menu_locations'            => array("Menu main" => "primary"),
                'set_woocommerce_page'      => 1
            );
        $s7upf_config['import_theme_option'] = 'YTo3OTp7czoxNzoiczd1cGZfaGVhZGVyX3BhZ2UiO3M6MToiNyI7czoxNzoiczd1cGZfZm9vdGVyX3BhZ2UiO3M6MjoiMjAiO3M6MTQ6InM3dXBmXzQwNF9wYWdlIjtzOjA6IiI7czoyMDoiczd1cGZfc2hvd19icmVhZHJ1bWIiO3M6Mjoib24iO3M6MTM6InJpZ2h0X3RvX2xlZnQiO3M6Mzoib2ZmIjtzOjEwOiJtYWluX2NvbG9yIjtzOjA6IiI7czoxMToibWFwX2FwaV9rZXkiO3M6Mzk6IkFJemFTeUJYMklpRUJnLTBsUUtRUTZ3azZzV1JHUW5XSTdpb2dmMCI7czoxMDoiY3VzdG9tX2NzcyI7czowOiIiO3M6MjM6InM3dXBmX2N1c3RvbV9qYXZhc2NyaXB0IjtzOjA6IiI7czo0OiJsb2dvIjtzOjA6IiI7czo3OiJmYXZpY29uIjtzOjA6IiI7czoxNjoiczd1cGZfbWVudV9maXhlZCI7czoyOiJvbiI7czoxNjoiczd1cGZfbWVudV9jb2xvciI7czowOiIiO3M6MjI6InM3dXBmX21lbnVfY29sb3JfaG92ZXIiO3M6MDoiIjtzOjIzOiJzN3VwZl9tZW51X2NvbG9yX2FjdGl2ZSI7czowOiIiO3M6MTY6InM3dXBmX3N0eWxlX2Jsb2ciO3M6Njoic3R5bGUyIjtzOjE5OiJzN3VwZl9jb2xfYmxvZ19ncmlkIjtzOjE6IjQiO3M6Mjk6Im51bWJlcl93b3JkX2V4Y2VycHRfYmxvZ19saXN0IjtzOjI6IjMwIjtzOjI3OiJjdXN0b21fc2l6ZV9pbWFnZV9ibG9nX2xpc3QiO3M6MDoiIjtzOjIzOiJlbmFibGVfYmFubmVyX2Jsb2dfbGlzdCI7czoyOiJvbiI7czoyNjoibGlzdF9pdGVtX2Jhbm5lcl9ibG9nX2xpc3QiO2E6Mzp7aTowO2E6Mzp7czo1OiJ0aXRsZSI7czo2OiJpdGVtIDEiO3M6MzoiaW1nIjtzOjc3OiJodHRwOi8vN3VwdGhlbWUuY29tL3dvcmRwcmVzcy9mYi10ZWNoL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE3LzA5L3NsaWRlMS0xLmpwZyI7czo0OiJpbmZvIjtzOjE2ODoiCQkJCQkJCQk8aDIgY2xhc3M9InRpdGxlMzAgY29sb3IiPkJsb2c8L2gyPgkNCgkJCQkJCQkJPGgyIGNsYXNzPSJ0aXRsZTMwIHdoaXRlIj5VcCB0byA1MCUgT2ZmIEFsbCBJdGVtczwvaDI+DQoJCQkJCQkJCTxhIGhyZWY9IiMiIGNsYXNzPSJzaG9wLWJ1dHRvbiBjb2xvciI+U2hvcCBOb3c8L2E+Ijt9aToxO2E6Mzp7czo1OiJ0aXRsZSI7czo2OiJJdGVtIDIiO3M6MzoiaW1nIjtzOjc3OiJodHRwOi8vN3VwdGhlbWUuY29tL3dvcmRwcmVzcy9mYi10ZWNoL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE3LzA5L3NsaWRlMi0xLmpwZyI7czo0OiJpbmZvIjtzOjE4MToiCQkJCQkJCQk8aDIgY2xhc3M9InRpdGxlMzAgY29sb3IiPkxhcHRvcCBEZWxsIFhQUzwvaDI+CQ0KCQkJCQkJCQk8aDIgY2xhc3M9InRpdGxlMzAgd2hpdGUiPk5ldyBNb2RlbCAyMDE4IGJ5IEZhbmJvbmc8L2gyPg0KCQkJCQkJCQk8YSBocmVmPSIjIiBjbGFzcz0ic2hvcC1idXR0b24gY29sb3IiPlNob3AgTm93PC9hPiI7fWk6MjthOjM6e3M6NToidGl0bGUiO3M6NjoiSXRlbSAzIjtzOjM6ImltZyI7czo3NzoiaHR0cDovLzd1cHRoZW1lLmNvbS93b3JkcHJlc3MvZmItdGVjaC93cC1jb250ZW50L3VwbG9hZHMvMjAxNy8wOS9zbGlkZTMtMS5qcGciO3M6NDoiaW5mbyI7czoxNzY6IjxoMiBjbGFzcz0idGl0bGUzMCBjb2xvciI+VG9wIFByb2R1Y3RzIDIwMTg8L2gyPgkNCgkJCQkJCQkJPGgyIGNsYXNzPSJ0aXRsZTMwIHdoaXRlIj5Bc3VzIExhcHRvcCBDb3JlIGkxMC1pbnRlbDwvaDI+DQoJCQkJCQkJCTxhIGhyZWY9IiMiIGNsYXNzPSJzaG9wLWJ1dHRvbiBjb2xvciI+U2hvcCBOb3c8L2E+Ijt9fXM6MjM6InM3dXBmX3N0eWxlX2Jsb2dfc2VhcmNoIjtzOjA6IiI7czoyNjoiczd1cGZfY29sX2Jsb2dfZ3JpZF9zZWFyY2giO3M6MToiNCI7czozMDoiZW5hYmxlX2Jhbm5lcl9ibG9nX2xpc3Rfc2VhcmNoIjtzOjM6Im9mZiI7czoyMDoiZW5hYmxlX2Jhbm5lcl9zaW5nbGUiO3M6Mjoib24iO3M6MTk6ImJveGVzX2Jhbm5lcl9zaW5nbGUiO3M6Mzoib2ZmIjtzOjI4OiJsaXN0X2l0ZW1fYmFubmVyX2Jsb2dfc2luZ2xlIjthOjM6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6NjoiSXRlbSAxIjtzOjM6ImltZyI7czo3NzoiaHR0cDovLzd1cHRoZW1lLmNvbS93b3JkcHJlc3MvZmItdGVjaC93cC1jb250ZW50L3VwbG9hZHMvMjAxNy8wOS9zbGlkZTEtMS5qcGciO3M6NDoiaW5mbyI7czoxNTA6IjxoMiBjbGFzcz0idGl0bGUzMCBjb2xvciI+U2hvcCBEZWFsczwvaDI+CQ0KPGgyIGNsYXNzPSJ0aXRsZTMwIHdoaXRlIj5VcCB0byA1MCUgT2ZmIEFsbCBJdGVtczwvaDI+DQo8YSBocmVmPSIjIiBjbGFzcz0ic2hvcC1idXR0b24gY29sb3IiPlNob3AgTm93PC9hPiI7fWk6MTthOjM6e3M6NToidGl0bGUiO3M6NjoiSXRlbSAyIjtzOjM6ImltZyI7czo3NzoiaHR0cDovLzd1cHRoZW1lLmNvbS93b3JkcHJlc3MvZmItdGVjaC93cC1jb250ZW50L3VwbG9hZHMvMjAxNy8wOS9zbGlkZTItMS5qcGciO3M6NDoiaW5mbyI7czoxNTI6IjxoMiBjbGFzcz0idGl0bGUzMCBjb2xvciI+TGFwdG9wIERlbGwgWFBTPC9oMj48aDIgY2xhc3M9InRpdGxlMzAgd2hpdGUiPk5ldyBNb2RlbCAyMDE4IGJ5IEZhbmJvbmc8L2gyPjxhIGhyZWY9IiMiIGNsYXNzPSJzaG9wLWJ1dHRvbiBjb2xvciI+U2hvcCBOb3c8L2E+Ijt9aToyO2E6Mzp7czo1OiJ0aXRsZSI7czo2OiJJdGVtIDMiO3M6MzoiaW1nIjtzOjc3OiJodHRwOi8vN3VwdGhlbWUuY29tL3dvcmRwcmVzcy9mYi10ZWNoL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE3LzA5L3NsaWRlMy0xLmpwZyI7czo0OiJpbmZvIjtzOjE2MDoiPGgyIGNsYXNzPSJ0aXRsZTMwIGNvbG9yIj5Ub3AgUHJvZHVjdHMgMjAxODwvaDI+CQ0KPGgyIGNsYXNzPSJ0aXRsZTMwIHdoaXRlIj5Bc3VzIExhcHRvcCBDb3JlIGkxMC1pbnRlbDwvaDI+DQo8YSBocmVmPSIjIiBjbGFzcz0ic2hvcC1idXR0b24gY29sb3IiPlNob3AgTm93PC9hPiI7fX1zOjE3OiJoaWRlX21lZGlhX3NpbmdsZSI7czozOiJvZmYiO3M6MjQ6ImVuYWJsZV9zaGFyZV9zaW5nbGVfYmxvZyI7czoyOiJvbiI7czozMToiZW5hYmxlX3Bvc3RfY29udHJvbF9zaW5nbGVfYmxvZyI7czoyOiJvbiI7czoyNjoiZW5hYmxlX3JlbGF0ZWRfc2luZ2xlX2Jsb2ciO3M6Mjoib24iO3M6MTg6InRpdGxlX3JlbGF0ZWRfcG9zdCI7czowOiIiO3M6MTk6Im51bWJlcl9yZWxhdGVkX3Bvc3QiO3M6MjoiMTAiO3M6MzA6ImVuYWJsZV9pbmZvX2F1dGhvcl9zaW5nbGVfYmxvZyI7czoyOiJvbiI7czoyNzoiczd1cGZfc2lkZWJhcl9wb3NpdGlvbl9ibG9nIjtzOjU6InJpZ2h0IjtzOjE4OiJzN3VwZl9zaWRlYmFyX2Jsb2ciO3M6MTI6ImJsb2ctc2lkZWJhciI7czoyNzoiczd1cGZfc2lkZWJhcl9wb3NpdGlvbl9wYWdlIjtzOjI6Im5vIjtzOjE4OiJzN3VwZl9zaWRlYmFyX3BhZ2UiO3M6MDoiIjtzOjM1OiJzN3VwZl9zaWRlYmFyX3Bvc2l0aW9uX3BhZ2VfYXJjaGl2ZSI7czo1OiJyaWdodCI7czoyNjoiczd1cGZfc2lkZWJhcl9wYWdlX2FyY2hpdmUiO3M6MTI6ImJsb2ctc2lkZWJhciI7czoyNzoiczd1cGZfc2lkZWJhcl9wb3NpdGlvbl9wb3N0IjtzOjU6InJpZ2h0IjtzOjE4OiJzN3VwZl9zaWRlYmFyX3Bvc3QiO3M6MTI6ImJsb2ctc2lkZWJhciI7czoxNzoiczd1cGZfYWRkX3NpZGViYXIiO2E6Mzp7aTowO2E6Mjp7czo1OiJ0aXRsZSI7czoxMjoiU2hvcCBTaWRlYmFyIjtzOjIwOiJ3aWRnZXRfdGl0bGVfaGVhZGluZyI7czoyOiJoMiI7fWk6MTthOjI6e3M6NToidGl0bGUiO3M6MTY6IlByb2R1Y3QgU2lkZXJiYXIiO3M6MjA6IndpZGdldF90aXRsZV9oZWFkaW5nIjtzOjI6ImgyIjt9aToyO2E6Mjp7czo1OiJ0aXRsZSI7czoxNDoiU2hvcCBTaWRlYmVyIDIiO3M6MjA6IndpZGdldF90aXRsZV9oZWFkaW5nIjtzOjI6ImgyIjt9fXM6MTI6Imdvb2dsZV9mb250cyI7YToxOntpOjA7YToxOntzOjY6ImZhbWlseSI7czowOiIiO319czoyNzoiczd1cGZfc29ydF9ieV9wcmljZV9wcm9kdWN0IjtzOjM3OiIwLTEwMCAxMDAtMjAwIDIwMC0zMDAgMzAwLTQwMCA0MDAtNTAwIjtzOjI0OiJzdF9wcm9kdWN0X3Bvc3RfcGVyX3BhZ2UiO3M6MjoiMTYiO3M6MjQ6InM3dXBmX2VuYWJsZV9uZXdfcHJvZHVjdCI7czozOiJvZmYiO3M6Mjg6InM3dXBmX251bWJlcl9kYXlfbmV3X3Byb2R1Y3QiO3M6MjoiMTAiO3M6MjY6Indvb19zdHlsZV92aWV3X3dheV9wcm9kdWN0IjtzOjQ6ImdyaWQiO3M6MjY6InM3dXBmX3dvcmRfZXhjZXJwdF9wcm9kdWN0IjtzOjI6IjIwIjtzOjE1OiJ3b29fc2hvcF9jb2x1bW4iO3M6MToiMyI7czoyMzoiZW5hYmxlX2Jhbm5lcl9zaG9wX2xpc3QiO3M6Mjoib24iO3M6MjY6Imxpc3RfaXRlbV9iYW5uZXJfc2hvcF9saXN0IjthOjE6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6MDoiIjtzOjM6ImltZyI7czo3NjoiaHR0cDovLzd1cHRoZW1lLmNvbS93b3JkcHJlc3MvZmItdGVjaC93cC1jb250ZW50L3VwbG9hZHMvMjAxNy8wOS9iYW5uZXIyLmpwZyI7czo0OiJpbmZvIjtzOjIwNzoiPGgzIGNsYXNzPSJ0aXRsZTE0IGNvbG9yIHRpdGxlLXVuZGVybGluZSI+MTMtaW5jaCBDaGFzc2lzPC9oMz48aDIgY2xhc3M9InRpdGxlMzAgd2hpdGUiPkxpZ2h0ZW4geW91ciBsb2FkPC9oMj48cCBjbGFzcz0iZGVzYyB3aGl0ZSI+WmVuQm9vayBVWDQzMCBpcyBkZXNpZ25lZCB0byBnbyB3aGVyZXZlciB5b3VyIGJ1c3kgbGlmZXN0eWxlIHRha2VzIHlvdSA8L3A+Ijt9fXM6MjY6InM3dXBmX3NpZGViYXJfcG9zaXRpb25fd29vIjtzOjI6Im5vIjtzOjE3OiJzN3VwZl9zaWRlYmFyX3dvbyI7czowOiIiO3M6Mjg6InM3dXBmX2N1c3RvbV9zaXplX2ltYWdlX2xpc3QiO3M6NzoiMjc4eDE4NSI7czoyNToiZW5hYmxlX2Jhbm5lcl9zaG9wX3NpbmdsZSI7czoyOiJvbiI7czoyNDoiYm94ZXNfYmFubmVyX3Nob3Bfc2luZ2xlIjtzOjI6Im9uIjtzOjI4OiJsaXN0X2l0ZW1fYmFubmVyX3Nob3Bfc2luZ2xlIjthOjE6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6MDoiIjtzOjM6ImltZyI7czo3NjoiaHR0cDovLzd1cHRoZW1lLmNvbS93b3JkcHJlc3MvZmItdGVjaC93cC1jb250ZW50L3VwbG9hZHMvMjAxNy8wOS9iYW5uZXIyLmpwZyI7czo0OiJpbmZvIjtzOjIwNzoiPGgzIGNsYXNzPSJ0aXRsZTE0IGNvbG9yIHRpdGxlLXVuZGVybGluZSI+MTMtaW5jaCBDaGFzc2lzPC9oMz48aDIgY2xhc3M9InRpdGxlMzAgd2hpdGUiPkxpZ2h0ZW4geW91ciBsb2FkPC9oMj48cCBjbGFzcz0iZGVzYyB3aGl0ZSI+WmVuQm9vayBVWDQzMCBpcyBkZXNpZ25lZCB0byBnbyB3aGVyZXZlciB5b3VyIGJ1c3kgbGlmZXN0eWxlIHRha2VzIHlvdSA8L3A+Ijt9fXM6MzI6InM3dXBmX3Nob3dfYmFubmVyX3Byb2R1Y3RfZGV0YWlsIjtzOjI6Im9uIjtzOjM3OiJzN3VwZl9zaWRlYmFyX3Bvc2l0aW9uX2RldGFpbF9wcm9kdWN0IjtzOjQ6ImxlZnQiO3M6Mjg6InM3dXBmX3NpZGViYXJfZGV0YWlsX3Byb2R1Y3QiO3M6MTY6InByb2R1Y3Qtc2lkZXJiYXIiO3M6MzE6InM3dXBmX3Nob3dfc2hhcmVfcHJvZHVjdF9kZXRhaWwiO3M6Mjoib24iO3M6MzE6InM3dXBmX2ltYWdlX3Byb2R1Y3RfZGV0YWlsX3NpemUiO3M6MDoiIjtzOjMzOiJzN3VwZl9zaG93X3JlbGF0ZWRfcHJvZHVjdF9kZXRhaWwiO3M6Mjoib24iO3M6Mjc6InM3dXBmX3RpdGxlX3JlbGF0ZWRfcHJvZHVjdCI7czoxNjoiUmVsYXRlZCBQcm9kdWN0cyI7czoyODoiczd1cGZfbnVtYmVyX3JlbGF0ZWRfcHJvZHVjdCI7czoyOiIxMCI7czozNDoiczd1cGZfc2hvd191cF9zZWxsc19wcm9kdWN0X2RldGFpbCI7czozOiJvZmYiO3M6Mjg6InM3dXBmX3RpdGxlX3VwX3NlbGxzX3Byb2R1Y3QiO3M6MDoiIjtzOjExOiJ3b29fY2F0ZWxvZyI7czozOiJvZmYiO3M6MTE6ImhpZGVfZGV0YWlsIjtzOjM6Im9mZiI7czoxOToic2hvd19idXR0b25fY2F0YWxvZyI7czozOiJvZmYiO3M6MTk6ImJ1dHRvbl90ZXh0X2NhdGFsb2ciO3M6MDoiIjtzOjE3OiJ1cmxfcHJvdG9jb2xfdHlwZSI7czowOiIiO3M6MTY6ImxpbmtfdXJsX2NhdGFsb2ciO3M6MDoiIjtzOjE1OiJoaWRlX290aGVyX3BhZ2UiO3M6Mzoib2ZmIjtzOjEwOiJoaWRlX3ByaWNlIjtzOjM6Im9mZiI7czoxMDoidGV4dF9wcmljZSI7czowOiIiO3M6MTA6ImhpZGVfYWRtaW4iO3M6Mzoib2ZmIjt9';
        $s7upf_config['import_widget'] = '{"blog-sidebar":{"categories-2":{"title":"","count":1,"hierarchical":1,"dropdown":0},"s7upf_bloglistpostswidget-2":{"title":"LATEST POSTS","posts_per_page":"3","style":"default","category":"0","order":"desc","order_by":"none","word_excerpt":"5"},"s7upf_bloglistpostswidget-3":{"title":"RECENT COMMENTS","posts_per_page":"3","style":"comment","category":"0","order":"desc","order_by":"comment_count","word_excerpt":"3"},"tag_cloud-3":{"title":"TAG CLOUD","count":0,"taxonomy":"post_tag"},"archives-3":{"title":"ARCHIVES","count":0,"dropdown":0}},"shop-sidebar":{"woocommerce_product_categories-2":{"title":"Product categories","orderby":"name","dropdown":0,"count":0,"hierarchical":1,"show_children_only":0,"hide_empty":0},"s7upf_product_filter-2":{"title":"PRICE","filter_price":1,"title_attribute":"","s7upf_color":0,"s7upf_manufacturer":0,"title_attribute_hide":"","hide_attribute_label":0,"class_css":""},"s7upf_product_filter-3":{"title":"Color","filter_price":0,"title_attribute":"","s7upf_color":1,"s7upf_manufacturer":0,"title_attribute_hide":"","hide_attribute_label":1,"class_css":""},"s7upf_product_filter-4":{"title":"Manufacturer","filter_price":0,"title_attribute":"","s7upf_color":0,"s7upf_manufacturer":1,"title_attribute_hide":"","hide_attribute_label":1,"class_css":""}},"product-siderbar":{"woocommerce_product_categories-3":{"title":"Product categories","orderby":"name","dropdown":0,"count":1,"hierarchical":1,"show_children_only":0,"hide_empty":0},"woocommerce_product_tag_cloud-2":{"title":"Product tags"},"s7upf_widget_product_slider-2":{"title":"Products","number_post":6,"pro_feature":"","pro_sale":"","title_category":"","s7upf_cart_dell":0,"s7upf_cart_lenovo":0,"s7upf_cart_phone":0,"s7upf_cart_samsung":0,"s7upf_cart_sony-vio":0,"s7upf_cart_watches":0,"order_by":"","order":"DESC","number_row":3,"image_size":""},"text-2":{"title":"Our Services","text":"<div class=\"service-product text-center\">\r\n<div class=\"list-service-product\">\r\n<div class=\"item-service-product text-uppercase\"><i class=\"icon ion-android-globe color title60\"><\/i>\r\n<ul class=\"list-none gray\">\r\n \t<li>FREE DELIVERY<\/li>\r\n \t<li>WORLDWIDE*<\/li>\r\n \t<li>*MORE INFO HERE<\/li>\r\n<\/ul>\r\n<\/div>\r\n<div class=\"item-service-product text-uppercase\"><i class=\"icon ion-clock color title60\"><\/i>\r\n<ul class=\"list-none gray\">\r\n \t<li>UNLIMITED NEXT-DAY<\/li>\r\n \t<li>DELIVERY TO THE UK<\/li>\r\n \t<li>ONLY \u00a39.95 A YEAR<\/li>\r\n<\/ul>\r\n<\/div>\r\n<\/div>\r\n<\/div>","filter":true,"visual":true}},"shop-sideber-2":{"text-4":{"title":"Our Services","text":"<div class=\"service-product text-center\">\r\n<div class=\"list-service-product\">\r\n<div class=\"item-service-product text-uppercase\"><p><i class=\"icon ion-android-globe color title60\"><\/i><\/p>\r\n<ul class=\"list-none gray\">\r\n<li>FREE DELIVERY<\/li>\r\n<li>WORLDWIDE*<\/li>\r\n<li>*MORE INFO HERE<\/li>\r\n<\/ul>\r\n<\/div>\r\n<div class=\"item-service-product text-uppercase\"><p><i class=\"icon ion-clock color title60\"><\/i><\/p>\r\n<ul class=\"list-none gray\">\r\n<li>UNLIMITED NEXT-DAY<\/li>\r\n<li>DELIVERY TO THE UK<\/li>\r\n<li>ONLY \u00a39.95 A YEAR<\/li>\r\n<\/ul>\r\n<\/div>\r\n<\/div>\r\n<\/div>","filter":true,"visual":true}}}';
        $s7upf_config['import_category'] = '';

        /**************************************** PLUGINS ****************************************/

        $s7upf_config['require-plugin'] = array(    
            array(
                'name'               => esc_html__('Option Tree', 'fb-tech'), // The plugin name.
                'slug'               => 'option-tree', // The plugin slug (typically the folder name).
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'      => esc_html__( 'Contact Form 7', 'fb-tech'),
                'slug'      => 'contact-form-7',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__( 'Visual Composer', 'fb-tech'),
                'slug'      => 'js_composer',
                'required'  => true,
                'source'    =>get_template_directory().'/plugins/js_composer.zip'
            ),
            array(
                'name'      => esc_html__( '7up Core', 'fb-tech'),
                'slug'      => '7up-core',
                'required'  => true,
                'source'    =>get_template_directory().'/plugins/7up-core.zip'
            ),
            array(
                'name'      => esc_html__( 'WooCommerce', 'fb-tech'),
                'slug'      => 'woocommerce',
                'required'  => true,
            ),
            array(
                'name' => esc_html__('Mail Chimp','fb-tech'),
                'slug' => 'mailchimp-for-wp',
                'required' => true
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Compare','fb-tech'),
                'slug'      => 'yith-woocommerce-compare',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Wishlist','fb-tech'),
                'slug'      => 'yith-woocommerce-wishlist',
                'required'  => true,
            )
        );

    /**************************************** PLUGINS ****************************************/
        $s7upf_config['theme-option'] = array(
            'sections' => array(
                array(
                    'id' => 'option_general',
                    'title' => '<i class="fa fa-cog"></i>'.esc_html__(' General Settings', 'fb-tech')
                ),
                array(
                    'id' => 'option_logo',
                    'title' => '<i class="fa fa-image"></i>'.esc_html__(' Logo Settings', 'fb-tech')
                ),
                array(
                    'id' => 'option_menu',
                    'title' => '<i class="fa fa-align-justify"></i>'.esc_html__(' Menu Settings', 'fb-tech')
                ),
                array(
                    'id' => 'option_blog',
                    'title' => '<i class="fa fa-file-text-o"></i> '.esc_html__('Blog Settings', 'fb-tech')
                ),
                array(
                    'id' => 'option_layout',
                    'title' => '<i class="fa fa-columns"></i>'.esc_html__(' Layout Settings', 'fb-tech')
                ),
                array(
                    'id' => 'option_typography',
                    'title' => '<i class="fa fa-font"></i>'.esc_html__(' Typography', 'fb-tech')
                )
            ),
            'settings' => array(
                 /*----------------Begin General --------------------*/
                array(
                    'id' => 'tab_general_theme',
                    'type' => 'tab',
                    'section' => 'option_general',
                    'label' => esc_html__('General theme','fb-tech')
                ),
                array(
                    'id'          => 's7upf_header_page',
                    'label'       => esc_html__( 'Header Page', 'fb-tech' ),
                    'desc'        => esc_html__( 'Include Header content. Go to Header in admin menu to edit/create header content. Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific header for it', 'fb-tech' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => s7upf_list_post_type('s7upf_header')
                ),
                array(
                    'id'          => 's7upf_footer_page',
                    'label'       => esc_html__( 'Footer Page', 'fb-tech' ),
                    'desc'        => esc_html__( 'Include Footer content. Go to Footer in admin menu to edit/create footer content.  Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific footer for it', 'fb-tech' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => s7upf_list_post_type('s7upf_footer')
                ),
                array(
                    'id'          => 's7upf_404_page',
                    'label'       => esc_html__( '404 Page', 'fb-tech' ),
                    'desc'        => esc_html__( 'Include page to 404 page', 'fb-tech' ),
                    'type'        => 'page-select',
                    'section'     => 'option_general'
                ),
                array(
                    'id' => 's7upf_show_breadrumb',
                    'label' => esc_html__('Show BreadCrumb', 'fb-tech'),
                    'desc' => esc_html__('This allow you to show or hide BreadCrumb', 'fb-tech'),
                    'type' => 'on-off',
                    'section' => 'option_general',
                    'std' => 'off'
                ),
                array(
                    'id'          => 'right_to_left',
                    'label'       => esc_html__('Right to left','fb-tech'),
                    'type'        => 'on-off',
                    'desc' => esc_html__('Language feature to right.', 'fb-tech'),
                    'section'     => 'option_general',
                    'std' => 'off'
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','fb-tech'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_general',
                ),                
                array(
                    'id'          => 'map_api_key',
                    'label'       => esc_html__('Map API key','fb-tech'),
                    'type'        => 'text',
                    'section'     => 'option_general',
                    'std'         => 'AIzaSyBX2IiEBg-0lQKQQ6wk6sWRGQnWI7iogf0',
                ),
                array(
                    'id' => 'tab_general_css_js',
                    'type' => 'tab',
                    'section' => 'option_general',
                    'label' => esc_html__('Edit style','fb-tech')
                ),
                array(
                    'id'          => 'custom_css',
                    'label'       => esc_html__('Custom CSS','fb-tech'),
                    'type'        => 'css',
                    'desc' => esc_html__('Enter code css.', 'fb-tech'),
                    'section'     => 'option_general',
                ),
                array(
                    'id'          => 's7upf_custom_javascript',
                    'label'       => esc_html__('Custom JavaScript','fb-tech'),
                    'type'        => 'javascript',
                    'desc' => esc_html__('Enter code JavaScript.', 'fb-tech'),
                    'section'     => 'option_general',
                ),
                /*----------------End General ----------------------*/

                /*----------------Begin Logo --------------------*/
                array(
                    'id' => 'logo',
                    'label' => esc_html__('Logo', 'fb-tech'),
                    'desc' => esc_html__('This allow you to change logo', 'fb-tech'),
                    'type' => 'upload',
                    'section' => 'option_logo',
                ),        
                array(
                    'id' => 'favicon',
                    'label' => esc_html__('Favicon', 'fb-tech'),
                    'desc' => esc_html__('This allow you to change favicon of your website', 'fb-tech'),
                    'type' => 'upload',
                    'section' => 'option_logo'
                ),
                /*----------------End Logo ----------------------*/

                /*----------------Begin Menu --------------------*/
                array(
                    'id'          => 's7upf_menu_fixed',
                    'label'       => esc_html__('Menu Fixed','fb-tech'),
                    'desc'        => 'Menu change to fixed when scroll',
                    'type'        => 'on-off',
                    'section'     => 'option_menu',
                    'std'         => 'on',
                ),
                array(
                    'id'          => 's7upf_menu_color',
                    'label'       => esc_html__('Menu style','fb-tech'),
                    'type'        => 'typography',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 's7upf_menu_color_hover',
                    'label'       => esc_html__('Hover color','fb-tech'),
                    'desc'        => esc_html__('Choose color','fb-tech'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 's7upf_menu_color_active',
                    'label'       => esc_html__('Active color','fb-tech'),
                    'desc'        => esc_html__('Choose color','fb-tech'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_menu',
                ),
                /*----------------End Menu ----------------------*/
                /*----------------Begin Blog --------------------*/
                array(
                    'id' => 'st_tab_blog',
                    'type' => 'tab',
                    'section' => 'option_blog',
                    'label' => esc_html__('Page list post','fb-tech')
                ),

                array(
                    'id' => 's7upf_style_blog',
                    'label' => esc_html__('Style blog', 'fb-tech'),
                    'desc' => esc_html__('Select style', 'fb-tech'),
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'value'=>'',
                            'label'=>esc_html__('Default style','fb-tech'),
                        ),
                        array(
                            'value'=>'style2',
                            'label'=>esc_html__('Classic list style ','fb-tech'),
                        ),
                        array(
                            'value'=>'style3',
                            'label'=>esc_html__(' classic grid style','fb-tech'),
                        ),
                    ),
                    'section' => 'option_blog',
                ),
                array(
                    'id' => 's7upf_col_blog_grid',
                    'label' => esc_html__('Number column grid', 'fb-tech'),
                    'desc' => esc_html__('Select column', 'fb-tech'),
                    'type'        => 'select',
                    'condition'   => 's7upf_style_blog:is(style3)',
                    'choices'     => array(
                        array(
                            'value'=>'12',
                            'label'=>esc_html__('1 column (Full width)','fb-tech'),
                        ),
                        array(
                            'value'=>'6',
                            'label'=>esc_html__('2 columns','fb-tech'),
                        ),
                        array(
                            'value'=>'4',
                            'label'=>esc_html__('3 columns','fb-tech'),
                        ),
                        array(
                            'value'=>'3',
                            'label'=>esc_html__('4 columns','fb-tech'),
                        ),
                    ),
                    'section' => 'option_blog',
                    'std' => '4',
                ),
                array(
                    'id' => 'number_word_excerpt_blog_list',
                    'label' => esc_html__('Number word excerpt', 'fb-tech'),
                    'desc' => esc_html__('This allows you to change the number of words in the excerpt (Default: 30 word).', 'fb-tech'),
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '0,100,1',
                    'section' => 'option_blog',
                    'std'  => 30
                ),
                array(
                    'id'          => 'custom_size_image_blog_list',
                    'label'       => esc_html__('Custom size image','fb-tech'),
                    'type'        => 'text',
                    'section' => 'option_blog',
                    'desc'=>esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','fb-tech'),
                ),
                array(
                    'id' => 'enable_banner_blog_list',
                    'label' => esc_html__('Enable banner', 'fb-tech'),
                    'desc' => esc_html__('This allow you to turn on or off Banner.', 'fb-tech'),
                    'type' => 'on-off',
                    'section' => 'option_blog',
                    'std'  => 'off'
                ),
                array(
                    'id' => 'list_item_banner_blog_list',
                    'label' => esc_html__('Add banner slider item', 'fb-tech'),
                    'desc' => esc_html__('Enter info.', 'fb-tech'),
                    'type' => 'list-item',
                    'section' => 'option_blog',
                    'condition'   => 'enable_banner_blog_list:is(on)',
                    'settings'    => array(
                        array(
                            'id'        => 'img',
                            'label' => esc_html__('Background banner', 'fb-tech'),
                            'desc' => esc_html__('Select image from library.', 'fb-tech'),
                            'rows'        => '4',
                            'type'        => 'upload',
                        ),
                        array(
                            'id'        => 'info',
                            'label' => esc_html__('Info banner', 'fb-tech'),
                            'desc' => esc_html__('Enter info.', 'fb-tech'),
                            'std'        => '<h2 class="title30 color">Laptop Dell XPS</h2><h2 class="title30 white">New Model 2018 by Fanbong</h2><a href="#" class="shop-button color">Shop Now</a>',
                            'type'        => 'textarea-simple',
                        ),

                    )
                ),

                array(
                    'id' => 'st_tab_search_template',
                    'type' => 'tab',
                    'section' => 'option_blog',
                    'label' => esc_html__('Search template','fb-tech')
                ),
                array(
                    'id' => 's7upf_style_blog_search',
                    'label' => esc_html__('Template style', 'fb-tech'),
                    'desc' => esc_html__('Select style', 'fb-tech'),
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'value'=>'',
                            'label'=>esc_html__('Default style','fb-tech'),
                        ),
                        array(
                            'value'=>'style2',
                            'label'=>esc_html__('Classic list style ','fb-tech'),
                        ),
                        array(
                            'value'=>'style3',
                            'label'=>esc_html__(' classic grid style','fb-tech'),
                        ),
                    ),
                    'std'=>'',
                    'section' => 'option_blog',
                ),
                array(
                    'id' => 's7upf_col_blog_grid_search',
                    'label' => esc_html__('Number column grid', 'fb-tech'),
                    'desc' => esc_html__('Select column', 'fb-tech'),
                    'type'        => 'select',
                    'condition'   => 's7upf_style_blog_search:is(style3)',
                    'choices'     => array(
                        array(
                            'value'=>'12',
                            'label'=>esc_html__('1 column (Full width)','fb-tech'),
                        ),
                        array(
                            'value'=>'6',
                            'label'=>esc_html__('2 columns','fb-tech'),
                        ),
                        array(
                            'value'=>'4',
                            'label'=>esc_html__('3 columns','fb-tech'),
                        ),
                        array(
                            'value'=>'3',
                            'label'=>esc_html__('4 columns','fb-tech'),
                        ),
                    ),
                    'section' => 'option_blog',
                    'std' => '4',
                ),
                array(
                    'id'          => 'enable_banner_blog_list_search',
                    'label'       => esc_html__('Enable banner','fb-tech'),
                    'desc' => esc_html__('This allow you to turn on or off Banner.', 'fb-tech'),
                    'type'        => 'on-off',
                    'section' => 'option_blog',
                    'std' => 'off',
                ),
                array(
                    'id' => 'list_item_banner_blog_list_search',
                    'label' => esc_html__('Add banner slider item', 'fb-tech'),
                    'desc' => esc_html__('Enter info.', 'fb-tech'),
                    'type' => 'list-item',
                    'section' => 'option_blog',
                    'condition'   => 'enable_banner_blog_list_search:is(on)',
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
                    'id' => 'st_tab_blog_detail',
                    'type' => 'tab',
                    'section' => 'option_blog',
                    'label' => esc_html__('Page post detail','fb-tech')
                ),

                array(
                    'id'          => 'enable_banner_single',
                    'label'       => esc_html__('Enable banner','fb-tech'),
                    'desc' => esc_html__('This allow you to turn on or off Banner.', 'fb-tech'),
                    'type'        => 'on-off',
                    'section' => 'option_blog',
                    'std' => 'off',
                ),
                array(
                    'id'          => 'boxes_banner_single',
                    'label'       => esc_html__('Boxes/Fullwidth banner','fb-tech'),
                    'desc' => esc_html__('Boxes/Fullwidth banner.', 'fb-tech'),
                    'type'        => 'on-off',
                    'section' => 'option_blog',
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
                //End banner
                array(
                    'id' => 'hide_media_single',
                    'label' => esc_html__('Hidden media in detail page', 'fb-tech'),
                    'type' => 'on-off',
                    'desc' => esc_html__('This allow you hidden media, gallery or image in your posts.','fb-tech'),
                    'std' => 'off',
                    'section' => 'option_blog',
                ),

                array(
                    'id'          => 'enable_share_single_blog',
                    'label'       => esc_html__('Enable share post','fb-tech'),
                    'desc' => esc_html__('This allow you to show button share.', 'fb-tech'),
                    'type'        => 'on-off',
                    'section' => 'option_blog',
                    'std' => 'off',
                ),
                array(
                    'id'          => 'enable_post_control_single_blog',
                    'label'       => esc_html__('Enable post control','fb-tech'),
                    'desc' => esc_html__('This allow you to show bar post control.', 'fb-tech'),
                    'type'        => 'on-off',
                    'section' => 'option_blog',
                    'std' => 'off',
                ),
                array(
                    'id'          => 'enable_related_single_blog',
                    'label'       => esc_html__('Enable post related','fb-tech'),
                    'desc' => esc_html__('This allow you to show list post related.', 'fb-tech'),
                    'type'        => 'on-off',
                    'section' => 'option_blog',
                    'std' => 'off',
                ),
                array(
                    'id'          => 'title_related_post',
                    'label'       => esc_html__('Title related','fb-tech'),
                    'desc' => esc_html__('Enter text', 'fb-tech'),
                    'type'        => 'text',
                    'section' => 'option_blog',
                    'condition'   => 'enable_related_post:is(on)',
                ),
                array(
                    'id'          => 'number_related_post',
                    'label'       => esc_html__('Number post related','fb-tech'),
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '0,100,1',
                    'section' => 'option_blog',
                    'condition'   => 'enable_related_post:is(on)',
                    'std'  => 10
                ),
                array(
                    'id'          => 'enable_info_author_single_blog',
                    'label'       => esc_html__('Enable info author','fb-tech'),
                    'desc' => esc_html__('This allow you to show box info author.', 'fb-tech'),
                    'type'        => 'on-off',
                    'section' => 'option_blog',
                    'std' => 'off',
                ),

                /*----------------End Blog ----------------------*/

                /*----------------Begin Layout --------------------*/
                array(
                    'id'          => 's7upf_sidebar_position_blog',
                    'label'       => esc_html__('Sidebar Blog','fb-tech'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fb-tech'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fb-tech'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fb-tech'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fb-tech'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_blog',
                    'label'       => esc_html__('Sidebar select display in blog','fb-tech'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 's7upf_sidebar_position_blog:not(no)',
                ),
                /****end blog****/
                array(
                    'id'          => 's7upf_sidebar_position_page',
                    'label'       => esc_html__('Sidebar Page','fb-tech'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fb-tech'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fb-tech'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fb-tech'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fb-tech'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_page',
                    'label'       => esc_html__('Sidebar select display in page','fb-tech'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 's7upf_sidebar_position_page:not(no)',
                ),
                /****end page****/
                array(
                    'id'          => 's7upf_sidebar_position_page_archive',
                    'label'       => esc_html__('Sidebar Position on Page Archives:','fb-tech'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fb-tech'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fb-tech'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fb-tech'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fb-tech'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_page_archive',
                    'label'       => esc_html__('Sidebar select display in page Archives','fb-tech'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 's7upf_sidebar_position_page_archive:not(no)',
                ),
                // END
                array(
                    'id'          => 's7upf_sidebar_position_post',
                    'label'       => esc_html__('Sidebar Single Post','fb-tech'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fb-tech'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fb-tech'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fb-tech'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fb-tech'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_post',
                    'label'       => esc_html__('Sidebar select display in single post','fb-tech'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 's7upf_sidebar_position_post:not(no)',
                ),
                array(
                    'id'          => 's7upf_add_sidebar',
                    'label'       => esc_html__('Add SideBar','fb-tech'),
                    'type'        => 'list-item',
                    'section'     => 'option_layout',
                    'std'         => '',
                    'settings'    => array( 
                        array(
                            'id'          => 'widget_title_heading',
                            'label'       => esc_html__('Choose heading title widget','fb-tech'),
                            'type'        => 'select',
                            'std'        => 'h3',
                            'choices'     => array(
                                array(
                                    'value'=>'h1',
                                    'label'=>esc_html__('H1','fb-tech'),
                                ),
                                array(
                                    'value'=>'h2',
                                    'label'=>esc_html__('H2','fb-tech'),
                                ),
                                array(
                                    'value'=>'h3',
                                    'label'=>esc_html__('H3','fb-tech'),
                                ),
                                array(
                                    'value'=>'h4',
                                    'label'=>esc_html__('H4','fb-tech'),
                                ),
                                array(
                                    'value'=>'h5',
                                    'label'=>esc_html__('H5','fb-tech'),
                                ),
                                array(
                                    'value'=>'h6',
                                    'label'=>esc_html__('H6','fb-tech'),
                                ),
                            )
                        ),
                    ),
                ),
                /*----------------End Layout ----------------------*/

                /*----------------Begin Blog ----------------------*/       
                

                /*----------------End BLOG----------------------*/

                /*----------------Begin Typography ----------------------*/
                array(
                    'id'          => 's7upf_custom_typography',
                    'label'       => esc_html__('Add Settings','fb-tech'),
                    'type'        => 'list-item',
                    'section'     => 'option_typography',
                    'std'         => '',
                    'settings'    => array(
                        array(
                            'id'          => 'typo_area',
                            'label'       => esc_html__('Choose Area to style','fb-tech'),
                            'type'        => 'select',
                            'std'        => 'main',
                            'choices'     => array(
                                array(
                                    'value'=>'header',
                                    'label'=>esc_html__('Header','fb-tech'),
                                ),
                                array(
                                    'value'=>'main',
                                    'label'=>esc_html__('Main Content','fb-tech'),
                                ),
                                array(
                                    'value'=>'widget',
                                    'label'=>esc_html__('Widget','fb-tech'),
                                ),
                                array(
                                    'value'=>'footer',
                                    'label'=>esc_html__('Footer','fb-tech'),
                                ),
                            )
                        ),
                        array(
                            'id'          => 'typo_heading',
                            'label'       => esc_html__('Choose heading Area','fb-tech'),
                            'type'        => 'select',
                            'std'        => 'h3',
                            'choices'     => array(
                                array(
                                    'value'=>'h1',
                                    'label'=>esc_html__('H1','fb-tech'),
                                ),
                                array(
                                    'value'=>'h2',
                                    'label'=>esc_html__('H2','fb-tech'),
                                ),
                                array(
                                    'value'=>'h3',
                                    'label'=>esc_html__('H3','fb-tech'),
                                ),
                                array(
                                    'value'=>'h4',
                                    'label'=>esc_html__('H4','fb-tech'),
                                ),
                                array(
                                    'value'=>'h5',
                                    'label'=>esc_html__('H5','fb-tech'),
                                ),
                                array(
                                    'value'=>'h6',
                                    'label'=>esc_html__('H6','fb-tech'),
                                ),
                                array(
                                    'value'=>'a',
                                    'label'=>esc_html__('a','fb-tech'),
                                ),
                                array(
                                    'value'=>'p',
                                    'label'=>esc_html__('p','fb-tech'),
                                ),
                            )
                        ),
                        array(
                            'id'          => 'typography_style',
                            'label'       => esc_html__('Add Style','fb-tech'),
                            'type'        => 'typography',
                            'section'     => 'option_typography',
                        ),
                    ),
                ),        
                array(
                    'id'          => 'google_fonts',
                    'label'       => esc_html__('Add Google Fonts','fb-tech'),
                    'type'        => 'google-fonts',
                    'section'     => 'option_typography',
                ),
                /*----------------End Typography ----------------------*/
            )
        );
        if(class_exists( 'WooCommerce' )){
            array_push($s7upf_config['theme-option']['sections'], array(
                'id' => 'option_woo',
                'title' => '<i class="fa fa-shopping-cart"></i>'.esc_html__(' Shop Settings', 'fb-tech')
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                    'id' => 'st_tab_product_general',
                    'type' => 'tab',
                    'section' => 'option_woo',
                    'label' => esc_html__('General product','fb-tech')
                )
            );
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_sort_by_price_product',
                'label'       => esc_html__('Sort by price','fb-tech'),
                'type'        => 'text',
                'section'     => 'option_woo',
                'desc'=>esc_html__('Enter price ranges to filter (Example: 100-200 200-300 300.40-500.00).','fb-tech'),

            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                    'id'          => 'st_product_post_per_page',
                    'label'       => esc_html__('Post per page','fb-tech'),
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '1,100,1',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('This allows you to change the number of products in shop page (Default 9 product).','fb-tech'),
                    'std'         => 16
                )
            );
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_enable_new_product',
                'label'       => esc_html__('Enable new product','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'std'     => 'off',
                'desc'=>esc_html__('This allows you to control sticker display for products which are marked as NEW in wooCommerce.','fb-tech'),
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                    'id'          => 's7upf_number_day_new_product',
                    'label'       => esc_html__('Number of days for new product','fb-tech'),
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '1,150,1',
                    'section'     => 'option_woo',
                    'condition'   => 's7upf_enable_new_product:is(on)',
                    'desc'        => esc_html__('Specify the No of days before to be disaplay product as New (Default 10 days).','fb-tech'),
                    'std'         => 10
                )
            );

            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'woo_style_view_way_product',
                'label'       => esc_html__('Choose view way product','fb-tech'),
                'type'        => 'select',
                'section'     => 'option_woo',
                'std'         => 'grid',
                'choices'     => array(
                    array(
                        'value'=> 'grid',
                        'label'=> esc_html__('Grid view','fb-tech'),
                    ),
                    array(
                        'value'=> 'list',
                        'label'=> esc_html__('List view','fb-tech'),
                    ),
                )
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                    'id'          => 's7upf_word_excerpt_product',
                    'label'       => esc_html__('Number word excerpt(Style list)','fb-tech'),
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '0,100,1',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('This allows you to change the number of words in the excerpt (Default: 20 word).','fb-tech'),
                    'std'         => 20
                )
            );
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'woo_shop_column',
                'label'       => esc_html__('Choose shop column (Style grid)','fb-tech'),
                'type'        => 'select',
                'section'     => 'option_woo',
                'choices'     => array(
                    array(
                        'value'=> 3,
                        'label'=> 4,
                    ),
                    array(
                        'value'=> 4,
                        'label'=> 3,
                    ),
                    array(
                        'value'=> 6,
                        'label'=> 2,
                    ),
                    array(
                        'value'=> 12,
                        'label'=> 1,
                    ),
                )
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                    'id' => 'st_tab_product_list',
                    'type' => 'tab',
                    'section' => 'option_woo',
                    'label' => esc_html__('List product','fb-tech')
                )
            );
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'enable_banner_shop_list',
                'label'       => esc_html__('Enable banner','fb-tech'),
                'desc' => esc_html__('This allow you to turn on or off Banner.', 'fb-tech'),
                'type'        => 'on-off',
                'section' => 'option_woo',
                'std' => 'off',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id' => 'list_item_banner_shop_list',
                'label' => esc_html__('Add banner slider item', 'fb-tech'),
                'desc' => esc_html__('Enter info.', 'fb-tech'),
                'type' => 'list-item',
                'section' => 'option_woo',
                'condition'   => 'enable_banner_shop_list:is(on)',
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
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_sidebar_position_woo',
                'label'       => esc_html__('Sidebar Position shop page','fb-tech'),
                'type'        => 'select',
                'section'     => 'option_woo',
                'desc'=>esc_html__('Left, or Right, or Center','fb-tech'),
                'choices'     => array(
                    array(
                        'value'=>'no',
                        'label'=>esc_html__('No Sidebar','fb-tech'),
                    ),
                    array(
                        'value'=>'left',
                        'label'=>esc_html__('Left','fb-tech'),
                    ),
                    array(
                        'value'=>'right',
                        'label'=>esc_html__('Right','fb-tech'),
                    )
                )
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_sidebar_woo',
                'label'       => esc_html__('Sidebar select shop page','fb-tech'),
                'type'        => 'sidebar-select',
                'section'     => 'option_woo',
                'condition'   => 's7upf_sidebar_position_woo:not(no)',
                'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','fb-tech'),
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_custom_size_image_list',
                'label'       => esc_html__('Custom size image','fb-tech'),
                'type'        => 'text',
                'section'     => 'option_woo',
                'desc'=>esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','fb-tech'),

            ));

            array_push($s7upf_config['theme-option']['settings'], array(
                    'id' => 'st_tab_product_page',
                    'type' => 'tab',
                    'section' => 'option_woo',
                    'label' => esc_html__('Product page','fb-tech')
                )
            );
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'enable_banner_shop_single',
                'label'       => esc_html__('Enable banner','fb-tech'),
                'desc' => esc_html__('This allow you to turn on or off Banner.', 'fb-tech'),
                'type'        => 'on-off',
                'section' => 'option_woo',
                'std' => 'off',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'boxes_banner_shop_single',
                'label'       => esc_html__('Boxes/Fullwidth banner','fb-tech'),
                'desc' => esc_html__('Boxes/Fullwidth banner.', 'fb-tech'),
                'type'        => 'on-off',
                'section' => 'option_woo',
                'std' => 'off',
                'condition'   => 'enable_banner_shop_single:is(on)',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id' => 'list_item_banner_shop_single',
                'label' => esc_html__('Add banner slider item', 'fb-tech'),
                'desc' => esc_html__('Enter info.', 'fb-tech'),
                'type' => 'list-item',
                'section' => 'option_woo',
                'condition'   => 'enable_banner_shop_single:is(on)',
                'settings'    => array(
                    array(
                        'id'        => 'img',
                        'label' => esc_html__('Background banner', 'fb-tech'),
                        'desc' => esc_html__('Select image from library.', 'fb-tech'),
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
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_show_banner_product_detail',
                'label'       => esc_html__('Show breadcrumb','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'desc'=>esc_html__('This allow you to show or hide breadcrumb in detail products','fb-tech'),
                'std'=>'off'
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_style_gallery_detail',
                'label'       => esc_html__('Gallery image style','fb-tech'),
                'type'        => 'select',
                'section'     => 'option_woo',
                'desc'=>esc_html__('This allows you to change the gallery style','fb-tech'),
                'choices'     => array(
                    array(
                        'value'=>'off',
                        'label'=>esc_html__('Horizontal','fb-tech'),
                    ),
                    array(
                        'value'=>'on',
                        'label'=>esc_html__('Vertical','fb-tech'),
                    ),
                ),
                'std'=>'off'
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_sidebar_position_detail_product',
                'label'       => esc_html__('Sidebar position product page','fb-tech'),
                'type'        => 'select',
                'section'     => 'option_woo',
                'desc'=>esc_html__('Left, or Right, or Center','fb-tech'),
                'choices'     => array(
                    array(
                        'value'=>'no',
                        'label'=>esc_html__('No Sidebar','fb-tech'),
                    ),
                    array(
                        'value'=>'left',
                        'label'=>esc_html__('Left','fb-tech'),
                    ),
                    array(
                        'value'=>'right',
                        'label'=>esc_html__('Right','fb-tech'),
                    )
                )
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_sidebar_detail_product',
                'label'       => esc_html__('Sidebar select product page','fb-tech'),
                'type'        => 'sidebar-select',
                'section'     => 'option_woo',
                'condition'   => 's7upf_sidebar_position_detail_product:not(no)',
                'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','fb-tech'),
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_show_share_product_detail',
                'label'       => esc_html__('Show share product','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'desc'=>esc_html__('This allow you to show or hide box share in product detail','fb-tech'),
                'std'=>'on'
            ));

            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_image_product_detail_size',
                'label'       => esc_html__('Custom image size product (Default 800x800)','fb-tech'),
                'type'        => 'text',
                'section'     => 'option_woo',
                'desc'=>esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','fb-tech'),
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_show_service_product_detail',
                'label'       => esc_html__('Show service product','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'desc'=>esc_html__('This allow you to show or hide box service product in product detail','fb-tech'),
                'std'=>'off'
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_title_service_product',
                'label'       => esc_html__('Title service','fb-tech'),
                'type'        => 'text',
                'section'     => 'option_woo',
                'condition'   => 's7upf_show_service_product_detail:is(on)',
                'desc'=>esc_html__('Enter text.','fb-tech'),
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_info_service_product',
                'label'       => esc_html__('Info service','fb-tech'),
                'type'        => 'textarea-simple',
                'section'     => 'option_woo',
                'rows'        => '4',
                'condition'   => 's7upf_show_service_product_detail:is(on)',
                'desc'=>esc_html__('Enter text.','fb-tech'),
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_show_related_product_detail',
                'label'       => esc_html__('Show related product','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'desc'=>esc_html__('This allow you to show or hide related product in product detail','fb-tech'),
                'std'=>'off'
            ));


            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_title_related_product',
                'label'       => esc_html__('Title related product','fb-tech'),
                'type'        => 'text',
                'section'     => 'option_woo',
                'desc'        => esc_html__('This allows you to change the title related product.','fb-tech'),
                'condition'   => 's7upf_show_related_product_detail:is(on)',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_number_related_product',
                'label'       => esc_html__('Number related product','fb-tech'),
                'type'        => 'numeric-slider',
                'min_max_step'=> '1,100,1',
                'section'     => 'option_woo',
                'std'         => 4,
                'desc'        => esc_html__('Number product to show in related products box.','fb-tech'),
                'condition'   => 's7upf_show_related_product_detail:is(on)',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_show_up_sells_product_detail',
                'label'       => esc_html__('Show Up-sells product','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'desc'=>esc_html__('This allow you to show or hide Up-sells product in product detail','fb-tech'),
                'std'=>'off'
            ));

            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 's7upf_title_up_sells_product',
                'label'       => esc_html__('Title Up-sells product','fb-tech'),
                'type'        => 'text',
                'section'     => 'option_woo',
                'desc'        => esc_html__('This allows you to change the title Up-sells product.','fb-tech'),
                'condition'   => 's7upf_show_up_sells_product_detail:is(on)',
            ));

            array_push($s7upf_config['theme-option']['settings'], array(
                    'id' => 'st_tab_catalog',
                    'type' => 'tab',
                    'section' => 'option_woo',
                    'label' => esc_html__('Catalog Mode','fb-tech')
                )
            );
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'woo_catelog',
                'label'       => esc_html__('Enable WooCommerce Catalog Mode','fb-tech'),
                'desc'        => esc_html__('This allows you enable Catalog Mode.','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'std'         => 'off'
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'hide_detail',
                'label'       => esc_html__('Hide "Add to cart" button','fb-tech'),
                'type'        => 'on-off',
                'desc'        => esc_html__('Hide in product detail page.','fb-tech'),
                'section'     => 'option_woo',
                'condition'   => 'woo_catelog:is(on)',
                'std'         => 'off'
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'show_button_catalog',
                'label'       => esc_html__('Custom button "Add to cart"','fb-tech'),
                'type'        => 'on-off',
                'desc'        => esc_html__('Replace and edit button "Add to cart" in product detail','fb-tech'),
                'section'     => 'option_woo',
                'condition'   => 'hide_detail:is(on)',
                'std'         => 'off',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'button_text_catalog',
                'label'       => esc_html__('Button text','fb-tech'),
                'type'        => 'text',
                'desc'        => esc_html__('Show in product details page.','fb-tech'),
                'section'     => 'option_woo',
                'condition'   => 'show_button_catalog:is(on),hide_detail:is(on)',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'url_protocol_type',
                'label'       => esc_html__('URL protocol type','fb-tech'),
                'type'        => 'select',
                'desc'        => esc_html__('Specify the type of the URL.','fb-tech'),
                'section'     => 'option_woo',
                'condition'   => 'show_button_catalog:is(on),hide_detail:is(on)',
                'choices'     => array(
                    array(
                        'value'=>'',
                        'label'=>esc_html__('Generic URL','fb-tech'),
                    ),
                    array(
                        'value'=>'email',
                        'label'=>esc_html__('E-Mail address','fb-tech'),
                    ),
                    array(
                        'value'=>'phone_number',
                        'label'=>esc_html__('Phone number','fb-tech'),
                    ),
                    array(
                        'value'=>'skype',
                        'label'=>esc_html__('Skype contact','fb-tech'),
                    ),
                )
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'link_url_catalog',
                'label'       => esc_html__('Link URL','fb-tech'),
                'type'        => 'text',
                'desc'        => esc_html__('Specify the type URL.','fb-tech'),
                'section'     => 'option_woo',
                'condition'   => 'show_button_catalog:is(on),hide_detail:is(on)',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'hide_other_page',
                'label'       => esc_html__('Hide "Add to cart" button','fb-tech'),
                'type'        => 'on-off',
                'desc'        => esc_html__('Hide in other shop pages.','fb-tech'),
                'section'     => 'option_woo',
                'condition'   => 'woo_catelog:is(on)',
                'std'         => 'off',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'hide_price',
                'label'       => esc_html__('Hide Price','fb-tech'),
                'desc'        => esc_html__('Hide the price of products in your shop and replace it with a text.','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'condition'   => 'woo_catelog:is(on)',
                'std'         => 'off',
            ));
            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'text_price',
                'label'       => esc_html__('Alternative text','fb-tech'),
                'desc'        => esc_html__('This text will replace price.','fb-tech'),
                'type'        => 'text',
                'section'     => 'option_woo',
                'condition'   => 'hide_price:is(on)',
            ));

            array_push($s7upf_config['theme-option']['settings'],array(
                'id'          => 'hide_admin',
                'label'       => esc_html__('Admin View','fb-tech'),
                'desc'        => esc_html__('Enable Catalog Mode also for administrators.','fb-tech'),
                'type'        => 'on-off',
                'section'     => 'option_woo',
                'condition'   => 'woo_catelog:is(on)',
                'std'         => 'off',
            ));
        }
    }
}
s7upf_set_theme_config();