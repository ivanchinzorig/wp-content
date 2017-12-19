<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 15/09/2017
 * Time: 10:39 SA
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$type = 'grid';
$type = s7upf_get_option('woo_style_view_way_product');
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
?>
<div class="shop-title">
    <div class="row">
        <div class="col-md-12">
            <h2 class="font-bold title30 text-uppercase title-line-after pull-left"><?php woocommerce_page_title(); ?></h2>
            <ul class="list-inline-block sort-bar pull-right">
                <li>
                    <div class="select-box sort-by">
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </li>
                <li>
                    <div class="view-type">
                        <a href="<?php echo esc_url(s7upf_get_key_url('type','grid'))?>" class="grid-view <?php if('grid' === $type) echo 'active'?>"><i class="icon ion-grid"></i></a>
                        <a href="<?php echo esc_url(s7upf_get_key_url('type','list'))?>" class="list-view <?php if('list' === $type) echo 'active'?>"><i class="icon ion-android-menu"></i></a>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</div>
<?php global $product;
$attributes = wc_get_attribute_taxonomies();
$s7upf_price = s7upf_get_option('s7upf_sort_by_price_product');
if(!empty($s7upf_price) || !empty($attributes)){ ?>
<div class="refine-search mb-toggle-findter">
    <h2 class="title14 color"><?php echo esc_html__('Refine your search:','fb-tech'); ?></h2>
    <a href="#" class="color close-search"><i class="icon ion-ios-close-outline"></i></a>
    <ul class="list-inline-block list-select-attr">
        <?php

        if(!empty($attributes)) {
            foreach ($attributes as $attribute) {
                $attribute_label =  $attribute->attribute_label;
                $taxonomy_filter_name = str_replace( 'pa_', '', $attribute->attribute_name );
                $_chosen_attributes   = WC_Query::get_layered_nav_chosen_attributes();
                $data_select = array();
                ?>

                <li>
                    <div class="select-box">
                        <select class="s7upf_layered_nav_<?php echo esc_attr($taxonomy_filter_name); ?>">
                             <?php
                            $terms = get_terms('pa_'.$attribute->attribute_name);
                            $any_label  =  sprintf( __( 'Any %s', 'fb-tech' ), $attribute->attribute_name );

                            if(!empty($terms)){?>
                                <option value=""><?php echo esc_attr($any_label);?></option>
                               <?php
                                $data_select['none'] =  preg_replace( '%\/page\/[0-9]+%', '', str_replace( array( '&amp;', '%2C' ), array( '&', ',' ), esc_js( add_query_arg( 'filtering', '1', remove_query_arg( array( 'page', 'filter_' . $taxonomy_filter_name ) ) ) ) ) );
                                foreach ($terms as $term){
                                    $current_values = isset( $_chosen_attributes[ $term->taxonomy ]['terms'] ) ? $_chosen_attributes[ $term->taxonomy ]['terms'] : array();
                                    $option_is_set  = in_array( $term->slug, $current_values ); ?>
                                    <option value="<?php echo esc_attr( $term->slug ) ?>"  <?php echo selected( $option_is_set, true, false ) ?> > <?php echo esc_html( $term->name )?></option>
                                <?php
                                    $data_select[$term->slug] =  preg_replace( '%\/page\/[0-9]+%', '', str_replace( array( '&amp;', '%2C' ), array( '&', ',' ), esc_js( add_query_arg( 'filtering', '1', remove_query_arg( array( 'page', 'filter_' . $taxonomy_filter_name ) ) ) ) ) ) . "&filter_" . esc_js( $taxonomy_filter_name ) . "=".$term->slug;
                                }
                            } ?>
                        </select>
                        <div class="hidden data-select" data-select="<?php echo esc_attr(json_encode($data_select)); ?>"></div>
                    </div>
                </li>
                <?php
            }
        }
        ?>
        <?php

        $prices = s7upf_get_filtered_price();
        $min    = floor( $prices->min_price );
        $max    = ceil( $prices->max_price );
        if(!empty($s7upf_price)){
        $array_price = explode(' ',$s7upf_price);
        $data_select = array(); ?>
        <li>
            <div class="select-box">
                <select class="s7upf_layered_nav_gia">
                    <?php
                    $option_is_set_price= false;
                    if(is_array($array_price)) {
                        ?>
                        <option  value="<?php echo esc_attr($min)?>-<?php echo esc_attr($max)?>"><?php echo esc_html__('Price','fb-tech');?></option>
                        <?php
                        $data_select[$min.'-'.$max] =  preg_replace( '%\/page\/[0-9]+%', '', str_replace( array( '&amp;', '%2C' ), array( '&', ',' ), esc_js( add_query_arg( 'filtering', '1', remove_query_arg( array( 'page', 'min_price', 'max_price' ) ) ) ) ) ) . "&min_price=". $min."&max_price=". $max;
                        foreach ($array_price as $value) {
                            $array_min_max = explode('-',$value);
                            if(isset($_GET['min_price']) && isset($_GET['max_price'])){

                                if($_GET['min_price'] == $array_min_max[0] and $_GET['max_price'] == $array_min_max[1])
                                $option_is_set_price = true;
                                else $option_is_set_price = false;
                            } ?>
                            <option value="<?php echo esc_attr( $value ) ?>" <?php echo selected( $option_is_set_price, true, false ) ?>> <?php echo esc_html( $value )?></option>

                        <?php
                            $data_select[$value] =  preg_replace( '%\/page\/[0-9]+%', '', str_replace( array( '&amp;', '%2C' ), array( '&', ',' ), esc_js( add_query_arg( 'filtering', '1', remove_query_arg( array( 'page', 'min_price', 'max_price' ) ) ) ) ) ) . "&min_price=". $array_min_max[0]."&max_price=". $array_min_max[1];
                        }

                    } ?>
                </select>

                <div class="hidden data-select" data-select="<?php echo esc_attr(json_encode($data_select)); ?>"></div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
<?php }