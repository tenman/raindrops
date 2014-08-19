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
 /**
  * 
  * 
  * 
  * @since 1.238
  */
if ( !function_exists( 'register_raindrops_pinup_entry_Widget' ) ) {

    function register_raindrops_pinup_entry_Widget() {

        register_widget( 'raindrops_pinup_entry_Widget' );
    }

}

class raindrops_pinup_entry_Widget extends WP_Widget {

    function __construct() {

        $widget_ops = array(
            'classname'   => 'raindrops-pinup-entries',
            'description' => esc_html__( 'Display Pinup entries', 'Raindrops' )
        );
        parent::WP_Widget( false, esc_html__( 'Pinup entries [Raindrops]', 'Raindrops' ), $widget_ops );
        wp_reset_query();
    }

    function widget( $args, $instance ) {

        extract( $args );
        echo $before_widget;

        if ( preg_match( '!,!', $instance['id'] ) ) {

            $instance['id'] = explode( ',', $instance['id'] );
            $count          = count( $instance['id'] );
            $num            = rand( 0, $count - 1 );
            $instance['id'] = $instance['id'][$num];
        }
        if ( isset( $instance['inline_style'] ) ) {

            $style = str_replace( PHP_EOL, '', $instance['inline_style'] );
            echo '<div style="' . $style . '">';
        } else {

            echo '<div>';
        }
        if ( $instance['content'] == 'content' || $instance['content'] == 'excerpt' ) {

            $posts = get_posts( array( 'include' => absint( $instance['id'] ), 'post_type' => sanitize_key( $instance['type'] ) ) );

            $html_title = '<h2 class="title" id="approach-%1$s"><a href="%2$s">%3$s</a></h2>';

            foreach ( $posts as $post ) {
                setup_postdata( $post );

                printf( $html_title, absint( $post->ID ), esc_url( get_permalink( $post->ID ) ), get_the_title( $post->ID ) );

                if ( isset( $instance['content'] ) and $instance['content'] == 'excerpt' ) {

                    the_excerpt();
                } else {

                    $more_link_text = esc_html__( 'Continue&nbsp;reading ', 'Raindrops' ) . '<span class="meta-nav">&rarr;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'Raindrops' ) . get_the_ID() . '</span>';
                    the_content( $more_link_text );
                }
            }

            wp_reset_postdata();
        }

        if ( $instance['content'] == 'attachment' ) {

            $args            = array(
                'post_type'   => 'attachment',
                'numberposts' => -1,
                'post_status' => 'public',
                'post_parent' => $instance['id']
            );
            $attachments     = get_posts( $args );
            $attachments_num = count( $attachments );
            if ( $attachments_num > 1 ) {
                $attachment_key = rand( 0, $attachments_num - 1 );

                $post = $attachments[$attachment_key];
            } elseif ( $attachments_num == 1 ) {
                $post = $attachments[0];
            } else {
                
            }
            if ( $attachments_num > 0 ) {
                setup_postdata( $post );


                $html = '<a href="%1$s" class="approach-image">%2$s</a>';

                printf( $html, get_permalink( $instance['id'] ), wp_get_attachment_image( $post->ID, apply_filters('raindrops_pinup_image_size', 'medium', get_the_ID() ) ) );

                $html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s">%1$s</h2>';

                printf( $html, get_the_title( $instance['id'] ), absint( $instance['id'] ) );

                wp_reset_postdata();
            }
        }

        if ( $instance['content'] == 'featured' ) {


            if ( has_post_thumbnail( $instance['id'] ) ) {

                $html = '<a href="%1$s" class="approach-image">%2$s</a>';

                printf( $html, esc_url( get_permalink( $instance['id'] ) ), get_the_post_thumbnail( $instance['id'], apply_filters('raindrops_pinup_image_size', 'medium', get_the_ID() ) ) );

                $html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s">%1$s</h2>';

                printf( $html, get_the_title( $instance['id'] ), absint( $instance['id'] ) );
            } else {

                $html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s"><a href="%3$s" class="approach-image">%1$s</a></h2>';

                printf( $html, get_the_title( $instance['id'] ), absint( $instance['id'] ), escurl( get_permalink( $instance['id'] ) ) );
            }
        }

        echo '</div>';
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {

        $instance['id']           = strip_tags( stripslashes( $new_instance['id'] ) );
        $instance['content']      = strip_tags( stripslashes( $new_instance['content'] ) );
        $instance['type']         = strip_tags( stripslashes( $new_instance['type'] ) );
        $instance['inline_style'] = strip_tags( stripslashes( $new_instance['inline_style'] ) );

        return $instance;
    }

    function form( $instance ) {
        $id      = get_theme_mod( 'id' );
        $content = get_theme_mod( 'content' );
        $type    = get_theme_mod( 'type' );

        if ( isset( $instance['id'] ) ) {

            $id = esc_attr( $instance['id'] );
        }
        if ( isset( $instance['content'] ) ) {

            $content = esc_attr( $instance['content'] );

            $raindrops_content_checked = checked( $instance['content'], "content", false );
            $puddele_excerpt_checked   = checked( $instance['content'], "excerpt", false );
        }
        if ( isset( $instance['type'] ) ) {

            $type = esc_attr( $instance['type'] );
        }

        if ( isset( $instance['inline_style'] ) ) {

            $style = esc_textarea( $instance['inline_style'] );
        } else {
            $style = '';
        }

        if ( empty( $raindrops_content_checked ) && empty( $puddele_excerpt_checked ) ) {

            $checked_default = "checked='checked'";
        } else {

            $checked_default = "";
        }

        $raindrops_html = '<h4>%1$s</h4><p><label for="%2$s">%3$s<input class="widefat" id="%4$s" name="%5$s" type="text" value="%6$s" /></label></p>';

        printf( $raindrops_html, esc_html__( 'Post ID', 'Raindrops' ), esc_attr( $this->get_field_id( 'id' ) ), esc_html__( 'Comma separated IDs[Randum Displayed]', 'Raindrops' ), esc_attr( $this->get_field_id( 'id' ) ), esc_attr( $this->get_field_name( 'id' ) ), esc_html( $id )
        );

        $raindrops_html = '<h4>%1$s</h4><ul><li><label><input type="radio" id="%2$s" name="%3$s" value="%7$s" %4$s %5$s />%6$s</label></li>';

        printf( $raindrops_html, esc_html__( 'Post Type', 'Raindrops' ), esc_attr( $this->get_field_id( 'type' ) ), esc_attr( $this->get_field_name( 'type' ) ), checked( $type, "post", false ), $checked_default, esc_html__( 'Post:', 'Raindrops' ), 'post'
        );

        $raindrops_html = '<li><label ><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li></ul>';

        printf( $raindrops_html, esc_attr( $this->get_field_id( 'type' ) ), esc_attr( $this->get_field_name( 'type' ) ), checked( $type, "page", false ), esc_html__( 'Page', 'Raindrops' ), 'page'
        );

        $raindrops_html = '<h4>%1$s</h4><ul><li><label><input type="radio" id="%2$s" name="%3$s" value="%7$s" %4$s %5$s />%6$s</label></li>';

        printf( $raindrops_html, esc_html('Content Type', 'Raindrops'), esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "content", false ), $checked_default, esc_html__( 'Content:', 'Raindrops' ), 'content');

        $raindrops_html = '<li><label"><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li>';

        printf( $raindrops_html, esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "excerpt", false ), esc_html__( 'Excerpt:', 'Raindrops' ), 'excerpt'
        );

        $raindrops_html = '<li><label><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li>';

        printf( $raindrops_html, esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "attachment", false ), esc_html__( 'Attachment IMG:', 'Raindrops' ), 'attachment'
        );

        $raindrops_html = '<li><label><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li></ul>';

        printf( $raindrops_html, esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "featured", false ), esc_html__( 'Featured IMG', 'Raindrops' ), 'featured'
        );

        $raindrops_html = '<label><h4>Style</h4><textarea id="%1$s" name="%2$s" style="width:320px;max-widht:100%;margin-bottom:2em;display:block;" rows="8">%3$s</textarea></label><br />';

        printf( $raindrops_html, esc_attr( $this->get_field_id( 'inline_style' ) ), esc_attr( $this->get_field_name( 'inline_style' ) ), $style );
    }

}

?>