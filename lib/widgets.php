<?php
/**
 * recent_post_group_by_category_widget
 * 
 * 
 * 
 */
if ( !class_exists( 'recent_post_group_by_category_widget' ) ) {

    class recent_post_group_by_category_widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                    'recent-post-groupby-cat', __( 'Category New Post [Raindrops]', 'Raindrops' ), array( 'description' => __( 'Show latest posts that were grouped for each category', 'Raindrops' ), )
            );
        }

        public function widget( $args, $instance ) {

            $title               = apply_filters( 'widget_title', $instance['title'] );
            $count               = $instance['count'];
            $raindrops_cat_items = $instance['category'];

            echo $args['before_widget'];

            if ( !empty( $title ) ) {

                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
            }

            $raindrops_args = array( 'posts_per_page' => -1, 'post__status' => 'publish', 'raindrops_cat_items' => $raindrops_cat_items );

            echo raindrops_display_recent_post_group_by_category( $count, $raindrops_args );

            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form( $instance ) {

            if ( isset( $instance['title'] ) ) {

                $title = $instance['title'];
            } else {

                $title = __( "Category What's New", 'Raindrops' );
            }
            if ( isset( $instance['count'] ) && is_numeric( $instance['count'] ) ) {

                $count = $instance['count'];
            } else {

                $count = 3;
            }
            if ( isset( $instance['category'] ) && is_array( $instance['category'] ) ) {

                $checked_array = $instance['category'];
            } else {

                $category_default = get_option( 'default_category' );
                $checked_array = array( $category_default );
            }
            ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'Raindrops' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php esc_html_e( 'Show Items Counts', 'Raindrops' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo absint( $count ); ?>">
            </p>
            <h4><?php esc_html_e( 'Select Categories', 'Raindrops' ); ?></h4>
            <div style="border:1px solid #ddd;margin-bottom:1em;padding:1em;">
                <?php
                $categories = get_terms( 'category' );

                $check_list = '<div style="display:inline-block;padding:.5em;">'
                        . '<input type="checkbox" name="%1$s" id="%3$s" value="%2$d" %5$s>'
                        . '<label for="%3$s">%4$s</label></div>';
                
                if ( isset(  $categories ) && is_array( $categories ) ) {
                    foreach ( $categories as $category ) {
                        if ( is_object( $category ) && isset( $category->term_id ) && isset( $category->name ) ) {
                            
                            printf( $check_list, 
                                    $this->get_field_name( 'category' ) . '[]', 
                                    $category->term_id, 
                                    $this->get_field_id( $category->name ) . '[]', 
                                    $category->name, 
                                    $this->raindrops_checked( $checked_array, $category->term_id )
                            );
                        }
                    }
                }
                echo '</div>';
            }

            function raindrops_checked( $haystack, $current ) {
                if ( is_array( $haystack ) && in_array( $current, $haystack ) ) {

                    $current  = $haystack = 1;
                }
                return checked( $haystack, $current, false );
            }

            public function update( $new_instance, $old_instance ) {
                $category_default = get_option( 'default_category' );
                $category_default = array( $category_default );

                $instance             = array();
                $instance['title']    = (!empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
                $instance['count']    = (!empty( $new_instance['count'] ) ) ? absint( $new_instance['count'] ) : 3;
                $instance['category'] = (!empty( $new_instance['category'] ) ) ? $new_instance['category'] : $category_default;
                return $instance;
            }

        }

    }
    /**
     * 
     * 
     * 
     * @since 1.234
     */
    if ( !function_exists( 'register_recent_post_group_by_category' ) ) {

        function register_recent_post_group_by_category() {

            register_widget( 'recent_post_group_by_category_widget' );
        }

    }
    /**
     * 
     * 
     * 
     * @since 1.234
     */
    if ( !function_exists( 'raindrops_category_id2name' ) ) {

        function raindrops_category_id2name( $str ) {

            $id = ( int ) $str;
            return get_cat_name( $id );
        }

    }
    /**
     * 
     * 
     * 
     * @since 1.234
     */
    if ( !function_exists( 'raindrops_reset_val' ) ) {

        function raindrops_reset_val( $str ) {

            return 0;
        }

    }
    /**
     * 
     * 
     * 
     * @since 1.234
     */
    if ( !function_exists( 'compare_capital_lower_not_distinguish' ) ) {

        function compare_capital_lower_not_distinguish( $a, $b ) {

            return strcasecmp( $a, $b );
        }

    }
    /**
     * 
     * 
     * 
     * @since 1.234
     */
    if ( !function_exists( 'raindrops_get_post_array_group_by_category' ) ) {

        function raindrops_get_post_array_group_by_category( $limit_posts = 5, $args = array() ) {

            global $post;

            $category_ids = array_map( 'raindrops_category_id2name', get_all_category_ids() );
            $category_ids = array_flip( $category_ids );
            $category_ids = array_map( 'raindrops_reset_val', $category_ids );

            if ( empty( $args ) ) {

                query_posts( array( 'posts_per_page' => -1, 'post__status' => 'publish' ) );
            } else {

                query_posts( $args );
            }

            if ( have_posts() ) {

                while ( have_posts() ) {

                    the_post();

                    if ( isset( $args['raindrops_cat_items'] ) ) {

                        foreach ( $args['raindrops_cat_items'] as $key => $val ) {

                            $term = get_term( $val, 'category' );
                            if ( empty( $result[$term->name] ) || count( $result[$term->name] ) < $limit_posts ) {

                                if ( in_category( $term->name ) ) {

                                    $result[$term->name][$post->ID] = $post->ID;
                                }
                            }
                        }
                    } else {

                        $categories = get_the_category();
                        //var_dump( $categories );      

                        foreach ( $categories as $key => $val ) {

                            if ( empty( $result[$val->name] ) || count( $result[$val->name] ) < $limit_posts ) {

                                $result[$val->name][$post->ID] = $post->ID;
                            }
                        }
                    }
                }
            }
            wp_reset_query();

            uksort( $result, "compare_capital_lower_not_distinguish" );

            return apply_filters( 'raindrops_get_post_array_group_by_category', $result );
        }

    }
    /**
     * 
     * 
     * 
     * @since 1.234
     */
    if ( !function_exists( 'raindrops_display_recent_post_group_by_category' ) ) {

        function raindrops_display_recent_post_group_by_category( $limit_posts = 5, $args = array() ) {

            $raindrops_get_post_array_group_by_category = raindrops_get_post_array_group_by_category( $limit_posts, $args );

            $raindrops_date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );

            $result         = apply_filters( 'raindrops_display_recent_post_group_by_category_before', '' );
            $wrap_html      = '<ul class="xoxo">%1$s</ul>';
            $category_title = '<li><h3 class="post-group_by-category-title"><a href="%1$s">%2$s</a></h3><ul>';
            $entry_item     = '<li><a href="%1$s">%3$s</a><p><span title="%4$s">%2$s</span> </p>';
            $entry_item     = '<li>'
                    . '<a href="%1$s" class="post-group_by-category-entry-title">%3$s</a>'
                    . '<%4$s class="entry-date updated post-group-by-category-time" %5$s>%2$s</%4$s>'
                    . '<span class="author vcard">'
                    . ' <a class="url fn n post-group_by-category-author" href="%6$s" rel="vcard:url">%7$s</a>'
                    . '</span>';
            $loop_end_html  = '</li></ul></li>';


            foreach ( $raindrops_get_post_array_group_by_category as $key => $vals ) {

                $cat_id = get_cat_ID( $key );

                if ( !empty( $vals ) ) {

                    $result .= sprintf( $category_title, get_category_link( $cat_id ), $key );
                }

                foreach ( $vals as $val ) {
                    $permalink      = esc_url( get_permalink( $val ) );
                    $date           = get_the_time( $raindrops_date_format, $val );
                    $title          = get_the_title( $val );
                    $time_element   = raindrops_doctype_elements( 'span', 'time', false );
                    $attribute_time = raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false );
                    $author         = raindrops_blank_fallback( get_the_author(), 'Somebody' );
                    $author         = wp_kses( $author, array() );
                    $author_link    = get_author_posts_url( get_the_author_meta( 'ID' ) );
                    $author_link    = esc_url( $author_link );

                    $result .= sprintf( $entry_item, $permalink, $date, $title, $time_element, $attribute_time, $author_link, $author );
                }
                $result .= $loop_end_html;
            }

            $result = sprintf( $wrap_html, $result );
            return apply_filters( 'raindrops_display_recent_post_group_by_category', $result );
        }

    }