<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18/11/2016
 * Time: 9:18 SA
 */
if ( !class_exists('WC_Product') ) {
    return;
}

if(!class_exists('S7upf_Widget_Product_filter')) {
    class S7upf_Widget_Product_filter extends WC_Widget
    {
        static function _init()
        {
            add_action('widgets_init', array(__CLASS__, '_add_widget'));
        }

        static function _add_widget()
        {
            register_widget('S7upf_Widget_Product_filter');
        }

        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->widget_cssclass = 'woocommerce widget widget-filter mb-filer-selection';
            $this->widget_description = esc_html__('Shows a custom attribute in a widget which lets you narrow down the list of products when viewing product categories.', 'fb-tech');
            $this->widget_id = 's7upf_product_filter';
            $this->widget_name = esc_html__('S7up Filter Products', 'fb-tech');

            parent::__construct();
        }

        /**
         * Updates a particular instance of a widget.
         *
         * @see WP_Widget->update
         *
         * @param array $new_instance
         * @param array $old_instance
         *
         * @return array
         */
        public function update($new_instance, $old_instance)
        {
            $this->init_settings();

            return parent::update($new_instance, $old_instance);
        }

        public function form($instance)
        {
            $this->init_settings();

            parent::form($instance);
        }

        /**
         * Init settings after post types are registered.
         */
        public function init_settings()
        {
            $attribute_array = array();
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            if ($attribute_taxonomies) {
                foreach ($attribute_taxonomies as $key=>$tax) {
                    if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) {
                        $attribute_array['s7upf_'.$tax->attribute_name]=array(
                            'type' => 'checkbox',
                            'std' => $tax->attribute_name,
                            'label' => $tax->attribute_label,
                        );
                    }
                }
            }
            $category_array = array();
            $tags = get_terms('product_cat');
            if(is_array($tags) && !empty($tags)){
                foreach ($tags as $tag) {
                    $category_array['s7upf_cart_'.$tag->slug]=array(
                        'type' => 'checkbox',
                        'std' => $tag->slug,
                        'label' => $tag->name,
                    );
                }
            }
            $this->settings = array_merge(array(
                'title' => array(
                    'type' => 'text',
                    'std' => esc_html__('Filter by', 'fb-tech'),
                    'label' => esc_html__('Title widget', 'fb-tech')
                ),

                'filter_price' => array(
                    'type' => 'checkbox',
                    'std' => 1,
                    'label' => esc_html__('Show filter price', 'fb-tech')
                ),
            
                'title_attribute' => array(
                    'type' => 's7uplabel',
                    'label' => esc_html__('Select attribute filter', 'fb-tech')
                ),

            ),$attribute_array,
                array(
                    'title_attribute_hide' => array(
                        'type' => 's7uplabel',
                        'label' => esc_html__('Hide/show attribute label', 'fb-tech')
                    ),
                   'hide_attribute_label' => array(
                        'type' => 'checkbox',
                        'std' => 0,
                        'label' => esc_html__('Hide attribute label', 'fb-tech')
                    ),
                   'class_css' => array(
                        'type' => 'text',
                        'label' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'fb-tech')
                    )
                )
            );
        }

        /**
         * Output widget.
         *
         * @see WP_Widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget($args, $instance)
        { global $post;

            if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) &&  !strpos($post->post_content, '[s7upf_products')) {
                return;
            }
            echo wp_kses_post($args['before_widget']);
            if ( ! empty( $instance['title'] ) ) {
                echo wp_kses_post($args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            extract($instance); ?>
            <div class="widget-content <?php if(!empty($class_css)) echo esc_attr($class_css); ?>">
                <?php if($filter_price == 1){
                    global $wp;
                    if ( '' === get_option( 'permalink_structure' ) ) {
                        $form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
                    } else {
                        $form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
                    }?>

                    <div class="filter-price">
                        <?php  $min_max = s7upf_get_price_arange();
                        if(!empty($_GET['min_price'])) $min = $_GET['min_price']; else $min = $min_max['min'];
                        if(!empty($_GET['max_price'])) $max = $_GET['max_price']; else $max = $min_max['max']; ?>
                        <form method="get" action="<?php echo esc_url($form_action)?>">

                            <div class="range-filter">
                                <ul class="list-inline-block">
                                    <li><div class="amount"></div></li>
                                    <li><button type="submit" class="btn-filter-price shop-button bg-color"><?php echo esc_html__('Filter','fb-tech'); ?></button></li>
                                </ul>
                                <div class="input-filter">
                                    <input type="text" class="hide" id="min_price" name="min_price" value="<?php echo esc_attr($min)?>" />
                                    <input type="text" class="hide" id="max_price" name="max_price" value="<?php echo esc_attr($max)?>" />
                                </div>
                                <div>
                                    <?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price' ), '', true ); ?>
                                </div>


                                <div class="slider-range" data-currentmin="<?php echo esc_attr($min)?>" data-currentmax="<?php echo esc_attr($max)?>" data-pricemin="<?php echo esc_attr($min_max['min'])?>" data-pricemax="<?php echo esc_attr($min_max['max'])?>" data-currencysymbol="<?php echo esc_attr(get_woocommerce_currency_symbol()); ?>"></div>
                            </div>
                        </form>
                    </div>

                <?php } ?>
                    <div class="mb-filter-attribute">
                        <?php
                        if ($attribute_taxonomies) {
                            foreach ($attribute_taxonomies as $key=>$value) {
                                $taxonomy = isset( $instance['s7upf_'.$value->attribute_name] ) ?  $instance['s7upf_'.$value->attribute_name]  : '';

                                if($taxonomy == 1){ ?>
                                    <?php
                                    $terms = get_terms("pa_".$value->attribute_name);
                                    $term_current = '';
                                    if(isset($_GET['filter_'.$value->attribute_name])) $term_current = $_GET['filter_'.$value->attribute_name];

                                    if($term_current != '') $term_current = explode(',', $term_current); else $term_current = array();
                                    ?>
                                    <div class="filter-attribute-content">
                                        <?php if($hide_attribute_label !== 1){?>
                                            <h3 class="title14 title-attribute_label"><?php echo esc_attr($value->attribute_label); ?></h3>
                                        <?php
                                        }
                                        switch ($value->attribute_type){
                                            case 'image':?>
                                                <ul class="list-inline-block  style-attribute-type-<?php echo esc_attr($value->attribute_type); ?>">
                                                    <?php foreach ($terms as $term){
                                                        $class_color =  $class_white_color = '';
                                                        $st_term_id =  $term->term_id;
                                                        $color_id = get_term_meta( $st_term_id,'', 'term-image', true);

                                                        if(is_object($term)){
                                                            if(in_array($term->slug, $term_current))
                                                                $active = 'active';
                                                            else $active = '';
                                                            if(!empty($color_id['image'][0])){

                                                                echo '<li><a class="'.esc_attr($class_white_color).' '.esc_attr($active).' '.esc_attr($class_color).'" href="'.esc_url(s7upf_get_key_url('filter_'.$value->attribute_name,$term->slug)).'">
                                                                       <img src="'.$color_id['image'][0].'">
                                                                   </a></li>';

                                                            }

                                                        }
                                                        ?>

                                                    <?php } ?>
                                                </ul>
                                                <?php
                                                break;
                                            case 'color': ?>
                                                <ul class="list-inline-block filter-attr list-attr-color style-attribute-type-<?php echo esc_attr($value->attribute_type); ?>">
                                                    <?php foreach ($terms as $term){
                                                        $class_color =  $class_white_color = '';
                                                        $st_term_id =  $term->term_id;
                                                        $color_id = get_term_meta( $st_term_id,'', 'term-color', true);

                                                        if(is_object($term)){
                                                            if(in_array($term->slug, $term_current))
                                                                $active = 'active';
                                                            else $active = '';
                                                            if(!empty($color_id['color'][0])){
                                                                $white_color = array('#fff','#ffffff');

                                                                if(in_array(strtolower($color_id['color'][0]), $white_color)) $class_white_color = 'border';
                                                                $class_color = S7upf_Assets::build_css('background:'.$color_id['color'][0].';');
                                                                echo '<li><a class="'.esc_attr($class_white_color).' '.esc_attr($active).' '.esc_attr($class_color).'" href="'.esc_url(s7upf_get_key_url('filter_'.$value->attribute_name,$term->slug)).'"></a></li>';

                                                            }

                                                        }
                                                        ?>

                                                    <?php } ?>
                                                </ul>
                                                <?php
                                                break;
                                            case 'label': ?>
                                                <ul class="list-none style-attribute-type-<?php echo esc_attr($value->attribute_type); ?>">
                                                    <?php foreach ($terms as $term){
                                                        $st_term_id =  $term->term_id;
                                                        $term_label = get_term_meta( $st_term_id,'', 'term-label', true);

                                                        if(is_object($term)){
                                                            if(in_array($term->slug, $term_current))
                                                                $active = 'active';
                                                            else $active = '';
                                                            if(!empty($term_label['label'][0])){

                                                                echo '<li><a class="'.esc_attr($active).'" href="'.esc_url(s7upf_get_key_url('filter_'.$value->attribute_name,$term->slug)).'">
                                                                       '.$term_label['label'][0].'
                                                                   </a></li>';

                                                            }

                                                        }
                                                        ?>

                                                    <?php } ?>
                                                </ul>
                                                <?php
                                                break;
                                            default :  ?>
                                                <ul class="list-none  filter-attr filter-attr-default style-attribute-type-default">
                                                    <?php foreach ($terms as $term){
                                                        if(is_object($term)){
                                                            if(in_array($term->slug, $term_current))
                                                                $active = 'active';
                                                            else $active = '';
                                                            if(!empty($term->name)){

                                                                echo '<li><a class="'.esc_attr($active).'" href="'.esc_url(s7upf_get_key_url('filter_'.$value->attribute_name,$term->slug)).'">
                                                                       '.$term->name.'
                                                                   <span class="silver">('.$term->count.')</span></a></li>';

                                                            }

                                                        }
                                                        ?>

                                                    <?php } ?>
                                                </ul>
                                                <?php
                                                break;
                                        }
                                        ?>

                                    </div>

                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
            </div>

            <?php
            echo wp_kses_post($args['after_widget']);
        }

        protected function get_filtered_price() {
            global $wpdb, $wp_the_query;

            $args       = $wp_the_query->query_vars;
            $tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
            $meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

            if ( ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
                $tax_query[] = array(
                    'taxonomy' => $args['taxonomy'],
                    'terms'    => array( $args['term'] ),
                    'field'    => 'slug',
                );
            }

            foreach ( $meta_query as $key => $query ) {
                if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
                    unset( $meta_query[ $key ] );
                }
            }

            $meta_query = new WP_Meta_Query( $meta_query );
            $tax_query  = new WP_Tax_Query( $tax_query );

            $meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
            $tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

            $sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
            $sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
            $sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
					AND {$wpdb->posts}.post_status = 'publish'
					AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND price_meta.meta_value > '' ";
            $sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

            return $wpdb->get_row( $sql );
        }
        protected function get_current_taxonomy() {
            return is_tax() ? get_queried_object()->taxonomy : '';
        }

        /**
         * Return the currently viewed term ID.
         * @return int
         */
        protected function get_current_term_id() {
            return absint( is_tax() ? get_queried_object()->term_id : 0 );
        }

        /**
         * Return the currently viewed term slug.
         * @return int
         */
        protected function get_current_term_slug() {
            return absint( is_tax() ? get_queried_object()->slug : 0 );
        }

        /**
         * Show dropdown layered nav.
         * @param  array $terms
         * @param  string $taxonomy
         * @param  string $query_type
         * @return bool Will nav display?
         */
        protected function layered_nav_dropdown( $terms, $taxonomy, $query_type ) {
            $found = false;

            if ( $taxonomy !== $this->get_current_taxonomy() ) {
                $term_counts          = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
                $_chosen_attributes   = WC_Query::get_layered_nav_chosen_attributes();
                $taxonomy_filter_name = str_replace( 'pa_', '', $taxonomy );

                echo '<select class="dropdown_layered_nav_' . esc_attr( $taxonomy_filter_name ) . '">';
                echo '<option value="">' . sprintf( esc_html__( 'Any %s', 'fb-tech' ), wc_attribute_label( $taxonomy ) ) . '</option>';

                foreach ( $terms as $term ) {

                    // If on a term page, skip that term in widget list
                    if ( $term->term_id === $this->get_current_term_id() ) {
                        continue;
                    }

                    // Get count based on current view
                    $current_values    = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();
                    $option_is_set     = in_array( $term->slug, $current_values );
                    $count             = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

                    // Only show options with count > 0
                    if ( 0 < $count ) {
                        $found = true;
                    } elseif ( 'and' === $query_type && 0 === $count && ! $option_is_set ) {
                        continue;
                    }

                    echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( $option_is_set, true, false ) . '>' . wp_kses_post( $term->name ) . '</option>';
                }

                echo '</select>';

                wc_enqueue_js( "
				jQuery( '.dropdown_layered_nav_". esc_js( $taxonomy_filter_name ) . "' ).change( function() {
					var slug = jQuery( this ).val();
					location.href = '" . preg_replace( '%\/page\/[0-9]+%', '', str_replace( array( '&amp;', '%2C' ), array( '&', ',' ), esc_js( add_query_arg( 'filtering', '1', remove_query_arg( array( 'page', 'filter_' . $taxonomy_filter_name ) ) ) ) ) ) . "&filter_". esc_js( $taxonomy_filter_name ) . "=' + slug;
				});
			" );
            }

            return $found;
        }

        /**
         * Get current page URL for layered nav items.
         * @return string
         */
        protected function get_page_base_url( $taxonomy ) {
            if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
                $link = esc_url(home_url('/'));
            } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
                $link = get_post_type_archive_link( 'product' );
            } elseif ( is_product_category() ) {
                $link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
            } elseif ( is_product_tag() ) {
                $link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
            } else {
                $link = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            }

            // Min/Max
            if ( isset( $_GET['min_price'] ) ) {
                $link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
            }

            if ( isset( $_GET['max_price'] ) ) {
                $link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
            }

            // Orderby
            if ( isset( $_GET['orderby'] ) ) {
                $link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
            }

            /**
             * Search Arg.
             * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
             */
            if ( get_search_query() ) {
                $link = add_query_arg( 's', rawurlencode( htmlspecialchars_decode( get_search_query() ) ), $link );
            }

            // Post Type Arg
            if ( isset( $_GET['post_type'] ) ) {
                $link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
            }

            // Min Rating Arg
            if ( isset( $_GET['min_rating'] ) ) {
                $link = add_query_arg( 'min_rating', wc_clean( $_GET['min_rating'] ), $link );
            }

            // All current filters
            if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
                foreach ( $_chosen_attributes as $name => $data ) {
                    if ( $name === $taxonomy ) {
                        continue;
                    }
                    $filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
                    if ( ! empty( $data['terms'] ) ) {
                        $link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
                    }
                    if ( 'or' == $data['query_type'] ) {
                        $link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
                    }
                }
            }

            return $link;
        }

        /**
         * Count products within certain terms, taking the main WP query into consideration.
         * @param  array $term_ids
         * @param  string $taxonomy
         * @param  string $query_type
         * @return array
         */
        protected function get_filtered_term_product_counts( $term_ids, $taxonomy, $query_type ) {
            global $wpdb;

            $tax_query  = WC_Query::get_main_tax_query();
            $meta_query = WC_Query::get_main_meta_query();

            if ( 'or' === $query_type ) {
                foreach ( $tax_query as $key => $query ) {
                    if ( $taxonomy === $query['taxonomy'] ) {
                        unset( $tax_query[ $key ] );
                    }
                }
            }

            $meta_query      = new WP_Meta_Query( $meta_query );
            $tax_query       = new WP_Tax_Query( $tax_query );
            $meta_query_sql  = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
            $tax_query_sql   = $tax_query->get_sql( $wpdb->posts, 'ID' );

            // Generate query
            $query           = array();
            $query['select'] = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
            $query['from']   = "FROM {$wpdb->posts}";
            $query['join']   = "
			INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
			INNER JOIN {$wpdb->terms} AS terms USING( term_id )
			" . $tax_query_sql['join'] . $meta_query_sql['join'];
            $query['where']   = "
			WHERE {$wpdb->posts}.post_type IN ( 'product' )
			AND {$wpdb->posts}.post_status = 'publish'
			" . $tax_query_sql['where'] . $meta_query_sql['where'] . "
			AND terms.term_id IN (" . implode( ',', array_map( 'absint', $term_ids ) ) . ")
		";
            $query['group_by'] = "GROUP BY terms.term_id";
            $query             = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
            $query             = implode( ' ', $query );
            $results           = $wpdb->get_results( $query );

            return wp_list_pluck( $results, 'term_count', 'term_count_id' );
        }

        /**
         * Show list based layered nav.
         * @param  array $terms
         * @param  string $taxonomy
         * @param  string $query_type
         * @return bool Will nav display?
         */
        protected function layered_nav_list( $terms, $taxonomy, $query_type ) {
            // List display

            $term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
            $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
            $found              = false;

            foreach ( $terms as $term ) {
                $current_values    = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();
                $option_is_set     = in_array( $term->slug, $current_values );
                $count             = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

                // skip the term for the current archive
                if ( $this->get_current_term_id() === $term->term_id ) {
                    continue;
                }

                // Only show options with count > 0
                if ( 0 < $count ) {
                    $found = true;
                } elseif ( 'and' === $query_type && 0 === $count && ! $option_is_set ) {
                    continue;
                }

                $filter_name    = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
                $current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();
                $current_filter = array_map( 'sanitize_title', $current_filter );

                if ( ! in_array( $term->slug, $current_filter ) ) {
                    $current_filter[] = $term->slug;
                }

                $link = $this->get_page_base_url( $taxonomy );

                // Add current filters to URL.
                foreach ( $current_filter as $key => $value ) {
                    // Exclude query arg for current term archive term
                    if ( $value === $this->get_current_term_slug() ) {
                        unset( $current_filter[ $key ] );
                    }

                    // Exclude self so filter can be unset on click.
                    if ( $option_is_set && $value === $term->slug ) {
                        unset( $current_filter[ $key ] );
                    }
                }

                if ( ! empty( $current_filter ) ) {
                    $link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

                    // Add Query type Arg to URL
                    if ( $query_type === 'or' && ! ( 1 === sizeof( $current_filter ) && $option_is_set ) ) {
                        $link = add_query_arg( 'query_type_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) ), 'or', $link );
                    }
                }

                $class = $option_is_set ? 'chosen' : '';
                echo '<div class="checkbox filter_checkbox">
                    <label class="'.$class.'">
                        
                        <input class="i-check" type="checkbox" data-url="' . esc_url(apply_filters('woocommerce_layered_nav_link', $link)) . '" />'.$term->name.'<span class="category-filters-amount">('.$count.')</span>
                       
                    </label>
                </div>';

            }

            return $found;
        }
        /**
         * Show size based layered nav.
         * @param  array $terms
         * @param  string $taxonomy
         * @param  string $query_type
         * @return bool Will nav display?
         */
        protected function layered_nav_size( $terms, $taxonomy, $query_type ) {
            // List display

            $term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
            $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
            $found              = false;
            echo '<div class="btn-group btn-group-sizes category-accordion-sizes filter_checkbox" data-toggle="buttons">';
            foreach ( $terms as $term ) {
                $current_values    = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();
                $option_is_set     = in_array( $term->slug, $current_values );
                $count             = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

                // skip the term for the current archive
                if ( $this->get_current_term_id() === $term->term_id ) {
                    continue;
                }

                // Only show options with count > 0
                if ( 0 < $count ) {
                    $found = true;
                } elseif ( 'and' === $query_type && 0 === $count && ! $option_is_set ) {
                    continue;
                }

                $filter_name    = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
                $current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();
                $current_filter = array_map( 'sanitize_title', $current_filter );

                if ( ! in_array( $term->slug, $current_filter ) ) {
                    $current_filter[] = $term->slug;
                }

                $link = $this->get_page_base_url( $taxonomy );

                // Add current filters to URL.
                foreach ( $current_filter as $key => $value ) {
                    // Exclude query arg for current term archive term
                    if ( $value === $this->get_current_term_slug() ) {
                        unset( $current_filter[ $key ] );
                    }

                    // Exclude self so filter can be unset on click.
                    if ( $option_is_set && $value === $term->slug ) {
                        unset( $current_filter[ $key ] );
                    }
                }

                if ( ! empty( $current_filter ) ) {
                    $link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

                    // Add Query type Arg to URL
                    if ( $query_type === 'or' && ! ( 1 === sizeof( $current_filter ) && $option_is_set ) ) {
                        $link = add_query_arg( 'query_type_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) ), 'or', $link );
                    }
                }

                $class = $option_is_set ? 'chosen' : '';
                echo '<label class="btn '.$class.'">
                            <input class="i-check" type="checkbox" data-url="' . esc_url(apply_filters('woocommerce_layered_nav_link', $link)) . '" />'.$term->name.'
                          </label>';

            }
            echo '</div>';
            return $found;
        }

        /**
         * @param $terms
         * @param $taxonomy
         * @param $query_type
         * @return bool
         */
        protected function layered_nav_color( $terms, $taxonomy, $query_type ) {
            // List display
            $term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
            $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
            $found              = false;
            echo '<div class="btn-group btn-group-colors category-accordion-colors st-filter-color  filter_checkbox" data-toggle="buttons">';
            foreach ( $terms as $term ) {
                $current_values    = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();
                $option_is_set     = in_array( $term->slug, $current_values );
                $count             = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;


                // skip the term for the current archive
                if ( $this->get_current_term_id() === $term->term_id ) {
                    continue;
                }

                // Only show options with count > 0
                if ( 0 < $count ) {
                    $found = true;
                } elseif ( 'and' === $query_type && 0 === $count && ! $option_is_set ) {
                    continue;
                }

                $filter_name    = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
                $current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();
                $current_filter = array_map( 'sanitize_title', $current_filter );

                if ( ! in_array( $term->slug, $current_filter ) ) {
                    $current_filter[] = $term->slug;
                }

                $link = $this->get_page_base_url( $taxonomy );

                // Add current filters to URL.
                foreach ( $current_filter as $key => $value ) {
                    // Exclude query arg for current term archive term
                    if ( $value === $this->get_current_term_slug() ) {
                        unset( $current_filter[ $key ] );
                    }

                    // Exclude self so filter can be unset on click.
                    if ( $option_is_set && $value === $term->slug ) {
                        unset( $current_filter[ $key ] );
                    }
                }

                if ( ! empty( $current_filter ) ) {
                    $link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

                    // Add Query type Arg to URL
                    if ( $query_type === 'or' && ! ( 1 === sizeof( $current_filter ) && $option_is_set ) ) {
                        $link = add_query_arg( 'query_type_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) ), 'or', $link );
                    }
                }
                $st_term_id =  $term->term_id;
                $color_id = get_woocommerce_term_meta( $st_term_id,'', 'phoen_color', true );
                $class = $option_is_set ? 'active' : '';
                $white_color = array('#fff','#ffffff');
                $class_white_color = '';
                if(in_array(strtolower($color_id['s7upf_product_attribute_phoen_color'][0]), $white_color))
                    $class_white_color = 'class_white_bg_color';
                if($color_id['s7upf_product_attribute_phoen_color'][0] != '') {
                    $class_css_color = S7upf_Assets::build_css('box-shadow: 0 0 0 1px '.$color_id['s7upf_product_attribute_phoen_color'][0].'; background-color:'.$color_id['s7upf_product_attribute_phoen_color'][0].';');
                    echo '<label class="btn light '.$class.' '.$class_white_color.' '.$class_css_color.'" data-color-name="white">
                            <input class="checkbox i-check" type="checkbox" data-url="' . esc_url(apply_filters('woocommerce_layered_nav_link', $link)) . '" />
                          </label>';
                }else{
                    echo '<label class="btn '.$class.'">
                            <input class="i-check" type="checkbox" data-url="' . esc_url(apply_filters('woocommerce_layered_nav_link', $link)) . '" />'.$term->name.'
                          </label>';
                }
            }
            echo '</div>';
            return $found;
        }
    }
    S7upf_Widget_Product_filter::_init();
}