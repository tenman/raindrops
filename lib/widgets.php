<?php
/**
 * raindrops_recent_post_group_by_category_widget
 *
 *
 *
 */
if ( !class_exists( 'raindrops_recent_post_group_by_category_widget' ) ) {

	class raindrops_recent_post_group_by_category_widget extends WP_Widget {

		function __construct() {
			parent::__construct(
			'recent-post-groupby-cat', esc_html__( '2.Category New Post [Raindrops]', 'raindrops' ), array( 'description' => esc_html__( 'Show latest posts that were grouped for each category', 'raindrops' ), )
			);
		}

		public function widget( $args, $instance ) {

			if ( isset( $instance[ 'title' ] ) ) {

				/**
				 * @since 1.441
				 */
				$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Archives', 'raindrops' ) : $instance['title'], $instance, $this->id_base );
			} else {

				$title = __( "Category What's New", 'raindrops' );
			}
			if ( isset( $instance[ 'count' ] ) && is_numeric( $instance[ 'count' ] ) ) {

				$count = $instance[ 'count' ];
			} else {

				$count = 3;
			}
			if ( isset( $instance[ 'category' ] ) && is_array( $instance[ 'category' ] ) ) {

				$checked_array		 = $instance[ 'category' ];
				$raindrops_cat_items = $checked_array;
			} else {

				$category_default	 = get_option( 'default_category' );
				$raindrops_cat_items = array( $category_default );
			}


			echo $args[ 'before_widget' ];

			if ( !empty( $title ) ) {

				echo $args[ 'before_title' ] . esc_html( $title ) . $args[ 'after_title' ];
			}

			$raindrops_args = array( 'posts_per_page' => -1, 'post__status' => 'publish', 'raindrops_cat_items' => $raindrops_cat_items );

			echo raindrops_display_recent_post_group_by_category( $count, $raindrops_args );

			echo $args[ 'after_widget' ];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {

			if ( isset( $instance[ 'title' ] ) ) {

				$title = $instance[ 'title' ];
			} else {

				$title = __( "Category What's New", 'raindrops' );
			}
			if ( isset( $instance[ 'count' ] ) && is_numeric( $instance[ 'count' ] ) ) {

				$count = $instance[ 'count' ];
			} else {

				$count = 3;
			}
			if ( isset( $instance[ 'category' ] ) && is_array( $instance[ 'category' ] ) ) {

				$checked_array = $instance[ 'category' ];
			} else {

				$category_default	 = get_option( 'default_category' );
				$checked_array		 = array( $category_default );
			}
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'raindrops' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php esc_html_e( 'Show Items Counts', 'raindrops' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo absint( $count ); ?>">
			</p>
			<h4><?php esc_html_e( 'Select Categories', 'raindrops' ); ?></h4>
			<div style="border:1px solid #ddd;margin-bottom:1em;padding:1em;">
				<?php
				$categories = get_terms( 'category' );

				$check_list = '<div style="display:inline-block;padding:.5em;">'
				. '<input type="checkbox" name="%1$s" id="%3$s" value="%2$d" %5$s>'
				. '<label for="%3$s">%4$s</label></div>';

				if ( isset( $categories ) && is_array( $categories ) ) {
					foreach ( $categories as $category ) {
						if ( is_object( $category ) && isset( $category->term_id ) && isset( $category->name ) ) {

							printf( $check_list, $this->get_field_name( 'category' ) . '[]', $category->term_id, $this->get_field_id( $category->name ) . '[]', $category->name, $this->raindrops_checked( $checked_array, $category->term_id )
							);
						}
					}
				}
				echo '</div>';
			}

			function raindrops_checked( $haystack, $current ) {
				if ( is_array( $haystack ) && in_array( $current, $haystack ) ) {

					$current	 = $haystack	 = 1;
				}
				if ( !is_array( $haystack ) ) {
					return checked( $haystack, $current, false );
				}
			}

			public function update( $new_instance, $old_instance ) {
				$category_default	 = get_option( 'default_category' );
				$category_default	 = array( $category_default );

				$instance				 = array();
				$instance[ 'title' ]	 = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
				$instance[ 'count' ]	 = (!empty( $new_instance[ 'count' ] ) ) ? absint( $new_instance[ 'count' ] ) : 3;
				$instance[ 'category' ]	 = (!empty( $new_instance[ 'category' ] ) ) ? $new_instance[ 'category' ] : $category_default;
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
	if ( !function_exists( 'raindrops_register_recent_post_group_by_category' ) ) {

		function raindrops_register_recent_post_group_by_category() {

			register_widget( 'raindrops_recent_post_group_by_category_widget' );
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

			$id = (int) $str;
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

			$category_ids	 = array_map( 'raindrops_category_id2name', get_terms( 'category', 'fields=ids' ) );
			$category_ids	 = array_flip( $category_ids );
			$category_ids	 = array_map( 'raindrops_reset_val', $category_ids );

			if ( empty( $args ) ) {

				query_posts( array( 'posts_per_page' => -1, 'post__status' => 'publish' ) );
			} else {

				query_posts( $args );
			}

			if ( have_posts() ) {

				while ( have_posts() ) {

					the_post();

					if ( isset( $args[ 'raindrops_cat_items' ] ) ) {

						foreach ( $args[ 'raindrops_cat_items' ] as $key => $val ) {

							$term = get_term( $val, 'category' );
							if ( isset( $term->name ) && ( empty( $result[ $term->name ] ) || count( $result[ $term->name ] ) < $limit_posts ) ) {

								if ( in_category( $term->name ) ) {

									$result[ $term->name ][ $post->ID ] = $post->ID;
								}
							}
						}
					} else {

						$categories = get_the_category();

						foreach ( $categories as $key => $val ) {

							if ( isset( $val->name ) && ( empty( $result[ $val->name ] ) || count( $result[ $val->name ] ) < $limit_posts ) ) {

								$result[ $val->name ][ $post->ID ] = $post->ID;
							}
						}
					}
				}
			}
			wp_reset_query();

			if ( empty( $result ) ) {
				return array();
			}

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

			global $raindrops_group_by_category_icon, $post;

			$raindrops_get_post_array_group_by_category = raindrops_get_post_array_group_by_category( $limit_posts, $args );

			$raindrops_date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );

			$result			 = apply_filters( 'raindrops_display_recent_post_group_by_category_before', '' );
			$wrap_html		 = '<ul class="xoxo">%1$s</ul>';
			$category_title	 = '<li class="post-group-by-category-title"><h3 class="post-group_by-category-title category-title %3$s"><a href="%1$s"><span class="cat-item cat-item-%4$s">%2$s</span></a></h3><ul>';
			$entry_item		 = '<li><a href="%1$s">%3$s</a><p><span title="%4$s">%2$s</span> </p>';

			$entry_item		 = '<li %9$s>'
			. '<a href="%1$s" class="post-group_by-category-entry-title %8$s">%3$s</a>'
			. '<%4$s class="entry-date updated post-group-by-category-time" %5$s>%2$s</%4$s>'
			. '<span class="author vcard">'
			. ' <a class="url fn n post-group_by-category-author" href="%6$s">%7$s</a>'
			. '</span></li>';
			$loop_end_html	 = '</ul></li>';

			$raindrops_group_by_category_icon = apply_filters( 'raindrops_group_by_category_icon', true );

			foreach ( $raindrops_get_post_array_group_by_category as $key => $vals ) {

				$cat_id			 = get_cat_ID( $key );
				$cat_property	 = get_category( $cat_id );
				$cat_slug		 = sanitize_html_class( $cat_property->slug );
				$cat_slug		 = apply_filters( 'raindrops_post_group_by_category_title_class', $cat_slug, $key );

				if ( !empty( $vals ) ) {

					$result .= sprintf( $category_title, get_category_link( $cat_id ), $key, $cat_slug, absint( $cat_id ) );
				}

				foreach ( $vals as $val ) {
					$permalink	 = esc_url( get_permalink( $val ) );
					$date		 = get_the_time( $raindrops_date_format, $val );
					$thumbnail	 = '';
					if ( has_post_thumbnail( $val ) && !post_password_required() && true == $raindrops_group_by_category_icon ) {

						$thumbnail .= "\n" . str_repeat( "\t", 11 ) . '<span class="h2-thumb">';
						$thumbnail .= get_the_post_thumbnail( $val, array( 48, 48 ), array( "style" => "vertical-align:middle;", "alt" => esc_attr__( 'Featured Image', 'raindrops' ) ) );
						$thumbnail .= "\n" . str_repeat( "\t", 11 ) . '</span>';
					}
					if ( !has_post_thumbnail( $val ) && !is_singular() && !post_password_required() && true == $raindrops_group_by_category_icon ) {

						$thumbnail = apply_filters( 'raindrops_title_thumbnail', $thumbnail, '<span class="h2-thumb">', '</span>' );
					}
					$entry_title_text	 = sprintf( '<span class="entry-title-text">%1$s</span>', get_the_title( $val ) );
					$title				 = apply_filters( 'raindrops_display_recent_post_group_by_category_post_thumb', $thumbnail ) . $entry_title_text;
					if ( empty( $thumbnail ) ) {
						$thumbnail_class = 'no-thumb';
					} else {
						$thumbnail_class = 'has-thumb';
					}

					$time_element	 = raindrops_doctype_elements( 'span', 'time', false );
					$attribute_time	 = raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false );
					$author			 = raindrops_blank_fallback( get_the_author(), 'Somebody' );
					$author			 = wp_kses( $author, array() );
					$author_link	 = get_author_posts_url( get_the_author_meta( 'ID' ) );
					$author_link	 = esc_url( $author_link );

					if( isset( $post->ID ) && $post->ID == $val && is_single() ) {
						$list_class = 'class="rd-current-post"';
					} else {
						$list_class = '';
					}

					$result .= sprintf( $entry_item, $permalink, $date, $title, $time_element, $attribute_time, $author_link, $author, $thumbnail_class, $list_class );
				}
				$result .= $loop_end_html;
			}

			$result = sprintf( $wrap_html, $result );
			return apply_filters( 'raindrops_display_recent_post_group_by_category', $result );
		}

	}
	/**
	 * Pinup_entry_widget
	 *
	 *
	 * @since 1.238
	 */
	if ( !function_exists( 'raindrops_register_pinup_entry_Widget' ) ) {

		function raindrops_register_pinup_entry_Widget() {

			register_widget( 'raindrops_pinup_entry_Widget' );
		}

	}

	class raindrops_pinup_entry_Widget extends WP_Widget {

		function __construct() {

			$widget_ops = array(
				'classname'		 => 'raindrops-pinup-entries',
				'description'	 => esc_html__( 'Display Pinup entries', 'raindrops' )
			);
			parent::__construct( false, esc_html__( '1.Pinup entries [Raindrops]', 'raindrops' ), $widget_ops );
			wp_reset_query();
		}

		function widget( $args, $instance ) {

			global $attachment;

			extract( $args );

			echo $before_widget;

			if ( isset( $instance[ 'display_type' ] ) && 'grid' == $instance[ 'display_type' ] ) {
/**
 * Show Grid
 */
				$pinup_entries	 = wp_parse_id_list( $instance[ 'id' ] );
				$count			 = count( $pinup_entries );

				if ( !empty( $instance[ 'title' ] ) ) {

					echo '<h2 class="widgettitle grid-pinup-title">' . $instance[ 'title' ] . '</h2>';
				}
				echo '<ul class="grid-pinup-widgets clearfix">';

				foreach ( $pinup_entries as $key => $val ) {

					$item_number = $key + 1;
					echo '<li class="grid-pinup-item item-' . $item_number . '">';

					if ( isset( $val ) && isset( $instance[ 'inline_style' ] ) && !empty( $instance[ 'inline_style' ] ) ) {

						$style	 = str_replace( PHP_EOL, '', $instance[ 'inline_style' ] );
						$style	 = wp_strip_all_tags( $style );

						echo '<div id="pinup-' . absint( $val ) . '" ' . raindrops_post_class( '', absint( $val ), false ) . ' style="' . $style . '">';
					} else {
						if ( isset( $val ) && isset( $instance[ 'inline_style' ] ) ) {
							$style	 = str_replace( PHP_EOL, '', $instance[ 'inline_style' ] );
							$style	 = wp_strip_all_tags( $style );
							echo '<div id="pinup-' . absint( $val ) . '" ' . raindrops_post_class( '', absint( $val ), false ) . ' style="' . $style . '">';
						}
					}

					if ( isset( $instance[ 'inline_style' ] ) && ( $instance[ 'content' ] == 'content' || $instance[ 'content' ] == 'excerpt' ) && !is_single( $val ) ) {

						$posts = get_posts( array( 'include' => absint( $val ), 'post_type' => sanitize_key( $instance[ 'type' ] ) ) );

						$pinup_entry_title_class = apply_filters( 'raindrops_pinup_entry_title_class', ' title pinup-entry-title ' );
						$pinup_entry_title_class = trim( $pinup_entry_title_class );
						$html_title				 = '<h2 class="' . esc_attr( $pinup_entry_title_class ) . '" id="approach-%1$s"><a href="%2$s"><span>%3$s</span></a></h2>';


						foreach ( $posts as $post ) {
							setup_postdata( $post );

							printf( $html_title, absint( $post->ID ), esc_url( get_permalink( $post->ID ) ), get_the_title( $post->ID ) );

							if ( isset( $instance[ 'content' ] ) and $instance[ 'content' ] == 'excerpt' ) {

								the_excerpt();
							} else {

								if ( isset( $post->post_content ) && !empty( $post->post_content ) ) {

									$raindrops_pinup_content = $post->post_content;

									if ( preg_match( '/<!--more[^-]*-->/u', $raindrops_pinup_content, $matches ) ) {

										list( $raindrops_pinup_content, $raindrops_pinup_sub_content ) = explode( $matches[ 0 ], $raindrops_pinup_content, 2 );

										$raindrops_pinup_content = apply_filters( 'the_content', $raindrops_pinup_content );
										$raindrops_pinup_content = apply_filters( 'raindrops_entry_content', $raindrops_pinup_content );
										$raindrops_pinup_content = str_replace( ']]>', ']]&gt;', $raindrops_pinup_content );

										echo $raindrops_pinup_content;
									} elseif ( preg_match( '/<!--nextpage-->/u', $raindrops_pinup_content, $matches ) ) {

										list( $raindrops_pinup_content, $raindrops_pinup_sub_content ) = explode( $matches[ 0 ], $raindrops_pinup_content, 2 );

										$raindrops_pinup_content = apply_filters( 'the_content', $raindrops_pinup_content );
										$raindrops_pinup_content = apply_filters( 'raindrops_entry_content', $raindrops_pinup_content );
										$raindrops_pinup_content = str_replace( ']]>', ']]&gt;', $raindrops_pinup_content );

										echo $raindrops_pinup_content;
									} else {
										$raindrops_pinup_content = get_post( absint( $post->ID ) );
										$raindrops_pinup_content = apply_filters( 'the_content', $raindrops_pinup_content->post_content );
										$raindrops_pinup_content = apply_filters( 'raindrops_entry_content', $raindrops_pinup_content );
										$raindrops_pinup_content = str_replace( ']]>', ']]&gt;', $raindrops_pinup_content );

										echo $raindrops_pinup_content;
									}
								}
							}
						}

						wp_reset_postdata();
					}

					if ( isset( $instance[ 'inline_style' ] ) && $instance[ 'content' ] == 'attachment' && !is_single( $val ) ) {

						$args		 = array(
							'post_type'		 => 'attachment',
							'numberposts'	 => -1,
							'post_status'	 => 'publish',
							'post_parent'	 => $val,
						);

						$attachments = get_posts( $args );


						$attachments_num = count( $attachments );

						if ( isset( $attachments ) && $attachments_num > 1 ) {
							$attachment_key = rand( 0, $attachments_num - 1 );

							$post = $attachments[ $attachment_key ];
						} elseif ( $attachments_num == 1 ) {
							$post = $attachments[ 0 ];
						}

						if ( isset( $attachments ) && $attachments_num > 0 ) {
							setup_postdata( $post );

							$raindrops_image_size = 'midium';

							if ( raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' ) > 25 ) {
								$raindrops_image_size = 'large';
							}

							$html = '<a href="%1$s" class="approach-image">%2$s</a>';

							$check_alt_exists = get_post_meta( $post->ID, '_wp_attachment_image_alt', true );

							if ( !empty( $check_alt_exists ) ) {

								$alt_attribute = esc_attr( $check_alt_exists );
							} else {

								$alt_attribute = wp_kses( get_the_title( $val ), array() );
							}
							$attr = array(
								'alt' => trim( $alt_attribute ),
							);

							printf( $html, get_permalink( $val ), wp_get_attachment_image( $post->ID, apply_filters( 'raindrops_pinup_image_size', $raindrops_image_size, get_the_ID() ), false, $attr ) );

							$html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s">%1$s</h2>';

							printf( $html, get_the_title( $val ), absint( $val ) );

							wp_reset_postdata();
						}
					}

					if ( isset( $instance[ 'inline_style' ] ) && $instance[ 'content' ] == 'featured' && !is_single( $val ) ) {


						if ( has_post_thumbnail( $val ) ) {

							$html = '<a href="%1$s" class="approach-image">%2$s</a>';

							$raindrops_image_size = 'midium';

							if ( raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' ) > 25 ) {

								$raindrops_image_size = 'large';
							}
							$alt_attribute = wp_kses( get_the_title( $val ), array() );

							$attr = array(
								'alt' => trim( $alt_attribute ),
							);

							printf( $html, esc_url( get_permalink( $val ) ), get_the_post_thumbnail( $val, apply_filters( 'raindrops_pinup_image_size', $raindrops_image_size, get_the_ID() ) ), $attr );

							$html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s">%1$s</h2>';

							printf( $html, get_the_title( $val ), absint( $val ) );
						} else {

							$html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s"><a href="%3$s" class="approach-image">%1$s</a></h2>';

							printf( $html, get_the_title( $val ), absint( $val ), esc_url( get_permalink( $val ) ) );
						}
					}
					if ( isset( $val ) ) {
						echo '</div>';
					}
					echo $after_widget;

					/**
					 * @since 1.413
					 * echo '</li>';
					 */
				}

				echo '</ul>';

			} else {
/**
 * Show Randum
 */
				if ( isset( $instance[ 'id' ] ) && preg_match( '!,!', $instance[ 'id' ] ) ) {

					$content_id	 = explode( ',', $instance[ 'id' ] );
					$count		 = count( $content_id );
					$num		 = rand( 0, $count - 1 );
					$content_id	 = $content_id[ $num ];
				} elseif( isset( $instance[ 'id' ] ) ) {

					$content_id	 = absint( $instance[ 'id' ] );
				}

				if ( isset( $content_id ) && isset( $instance[ 'inline_style' ] ) && !empty( $instance[ 'inline_style' ] ) ) {

					$style	 = str_replace( PHP_EOL, '', $instance[ 'inline_style' ] );
					$style	 = wp_strip_all_tags( $style );

					echo '<div id="pinup-' . absint( $content_id ) . '" ' . raindrops_post_class( '', absint( $content_id ), false ) . ' style="' . $style . '">';
				} else {
					if ( isset( $content_id ) && isset( $instance[ 'inline_style' ] ) ) {
						$style	 = str_replace( PHP_EOL, '', $instance[ 'inline_style' ] );
						$style	 = wp_strip_all_tags( $style );
						echo '<div id="pinup-' . absint( $content_id ) . '" ' . raindrops_post_class( '', absint( $content_id ), false ) . ' style="' . $style . '">';
					}
				}



				if ( isset( $instance[ 'inline_style' ] ) && ( $instance[ 'content' ] == 'content' || $instance[ 'content' ] == 'excerpt' ) && !is_single( $content_id ) ) {

					$posts = get_posts( array( 'include' => absint( $content_id ), 'post_type' => sanitize_key( $instance[ 'type' ] ) ) );

					$pinup_entry_title_class = apply_filters( 'raindrops_pinup_entry_title_class', ' title pinup-entry-title ' );
					$pinup_entry_title_class = trim( $pinup_entry_title_class );
					$html_title				 = '<h2 class="' . esc_attr( $pinup_entry_title_class ) . '" id="approach-%1$s"><a href="%2$s"><span>%3$s</span></a></h2>';


					foreach ( $posts as $post ) {
						setup_postdata( $post );

						printf( $html_title, absint( $post->ID ), esc_url( get_permalink( $post->ID ) ), get_the_title( $post->ID ) );

						if ( isset( $instance[ 'content' ] ) and $instance[ 'content' ] == 'excerpt' ) {

							the_excerpt();
						} else {

							if ( isset( $post->post_content ) && !empty( $post->post_content ) ) {

								$raindrops_pinup_content = $post->post_content;

								if ( preg_match( '/<!--more[^-]*-->/u', $raindrops_pinup_content, $matches ) ) {

									list( $raindrops_pinup_content, $raindrops_pinup_sub_content ) = explode( $matches[ 0 ], $raindrops_pinup_content, 2 );

									$raindrops_pinup_content = apply_filters( 'the_content', $raindrops_pinup_content );
									$raindrops_pinup_content = apply_filters( 'raindrops_entry_content', $raindrops_pinup_content );
									$raindrops_pinup_content = str_replace( ']]>', ']]&gt;', $raindrops_pinup_content );

									echo $raindrops_pinup_content;
								} elseif ( preg_match( '/<!--nextpage-->/u', $raindrops_pinup_content, $matches ) ) {

									list( $raindrops_pinup_content, $raindrops_pinup_sub_content ) = explode( $matches[ 0 ], $raindrops_pinup_content, 2 );

									$raindrops_pinup_content = apply_filters( 'the_content', $raindrops_pinup_content );
									$raindrops_pinup_content = apply_filters( 'raindrops_entry_content', $raindrops_pinup_content );
									$raindrops_pinup_content = str_replace( ']]>', ']]&gt;', $raindrops_pinup_content );

									echo $raindrops_pinup_content;
								} else {
									$raindrops_pinup_content = get_post( absint( $post->ID ) );
									$raindrops_pinup_content = apply_filters( 'the_content', $raindrops_pinup_content->post_content );
									$raindrops_pinup_content = apply_filters( 'raindrops_entry_content', $raindrops_pinup_content );
									$raindrops_pinup_content = str_replace( ']]>', ']]&gt;', $raindrops_pinup_content );

									echo $raindrops_pinup_content;
								}
							}
						}
					}

					wp_reset_postdata();
				}

				if ( isset( $instance[ 'inline_style' ] ) && $instance[ 'content' ] == 'attachment' && !is_single( $content_id ) ) {

					$args		 = array(
						'post_type'		 => 'attachment',
						'numberposts'	 => -1,
						'post_status'	 => 'publish',
						'post_parent'	 => $content_id
					);
					$attachments = get_posts( $args );


					$attachments_num = count( $attachments );

					if ( isset( $attachments ) && $attachments_num > 1 ) {
						$attachment_key = rand( 0, $attachments_num - 1 );

						$post = $attachments[ $attachment_key ];
					} elseif ( $attachments_num == 1 ) {
						$post = $attachments[ 0 ];
					} else {

					}

					if ( isset( $attachments ) && $attachments_num > 0 ) {
						setup_postdata( $post );

						$raindrops_image_size = 'midium';

						if ( raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' ) > 25 ) {
							$raindrops_image_size = 'large';
						}

						$html = '<a href="%1$s" class="approach-image">%2$s</a>';

						$check_alt_exists = get_post_meta( $post->ID, '_wp_attachment_image_alt', true );

						if ( !empty( $check_alt_exists ) ) {

							$alt_attribute = esc_attr( $check_alt_exists );
						} else {

							$alt_attribute = wp_kses( get_the_title( $content_id ), array() );
						}
						$attr = array(
							'alt' => trim( $alt_attribute ),
						);

						printf( $html, get_permalink( $content_id ), wp_get_attachment_image( $post->ID, apply_filters( 'raindrops_pinup_image_size', $raindrops_image_size, get_the_ID() ), false, $attr ) );

						$html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s">%1$s</h2>';

						printf( $html, get_the_title( $content_id ), absint( $content_id ) );

						wp_reset_postdata();
					}
				}

				if ( isset( $instance[ 'inline_style' ] ) && $instance[ 'content' ] == 'featured' && !is_single( $content_id ) ) {


					if ( has_post_thumbnail( $content_id ) ) {

						$html = '<a href="%1$s" class="approach-image">%2$s</a>';

						$raindrops_image_size = 'midium';

						if ( raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' ) > 25 ) {

							$raindrops_image_size = 'large';
						}
						$alt_attribute = wp_kses( get_the_title( $content_id ), array() );

						$attr = array(
							'alt' => trim( $alt_attribute ),
						);

						printf( $html, esc_url( get_permalink( $content_id ) ), get_the_post_thumbnail( $content_id, apply_filters( 'raindrops_pinup_image_size', $raindrops_image_size, get_the_ID() ) ), $attr );

						$html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s">%1$s</h2>';

						printf( $html, get_the_title( $content_id ), absint( $content_id ) );
					} else {

						$html = '<h2 class="entry-title raindrops-entrywidget-attachment-title" id="approach-%2$s"><a href="%3$s" class="approach-image">%1$s</a></h2>';

						printf( $html, get_the_title( $content_id ), absint( $content_id ), esc_url( get_permalink( $content_id ) ) );
					}
				}
				if ( isset( $content_id ) ) {
					echo '</div>';
				}
				echo $after_widget;
			}
		}

		function update( $new_instance, $old_instance ) {

			$instance[ 'title' ]		 = strip_tags( stripslashes( $new_instance[ 'title' ] ) );
			$instance[ 'id' ]			 = strip_tags( stripslashes( $new_instance[ 'id' ] ) );
			$instance[ 'content' ]		 = strip_tags( stripslashes( $new_instance[ 'content' ] ) );
			$instance[ 'type' ]			 = strip_tags( stripslashes( $new_instance[ 'type' ] ) );
			$instance[ 'display_type' ]	 = strip_tags( stripslashes( $new_instance[ 'display_type' ] ) );
			$instance[ 'inline_style' ]	 = strip_tags( stripslashes( $new_instance[ 'inline_style' ] ) );

			return $instance;
		}

		function form( $instance ) {

			global $raindrops_widget_post_types;

			if ( isset( $instance[ 'title' ] ) ) {

				$title = esc_attr( $instance[ 'title' ] );
			} else {
				$title = '';
			}
			if ( isset( $instance[ 'id' ] ) ) {

				$id = esc_attr( $instance[ 'id' ] );
			} else {
				$id = '';
			}
			if ( isset( $instance[ 'content' ] ) ) {

				$content = esc_attr( $instance[ 'content' ] );

				$raindrops_content_checked	 = checked( $instance[ 'content' ], "content", false );
				$puddele_excerpt_checked	 = checked( $instance[ 'content' ], "excerpt", false );
			} else {

				$content = 'content';
				$raindrops_content_checked	 = "checked='checked'";
				$puddele_excerpt_checked	 = "";
			}

			if ( isset( $instance[ 'type' ] ) ) {

				$type = esc_attr( $instance[ 'type' ] );
			} else {

				$type = 'post';
			}
			if ( isset( $instance[ 'display_type' ] ) ) {

				$display_type = esc_attr( $instance[ 'display_type' ] );
			} else {

				$display_type = 'grid';
			}

			if ( isset( $instance[ 'inline_style' ] ) ) {

				$style = esc_textarea( $instance[ 'inline_style' ] );
			} else {
				$style = '';
			}

			if ( empty( $raindrops_content_checked ) && empty( $puddele_excerpt_checked ) ) {

				$checked_default = "checked='checked'";
			} else {

				$checked_default = "";
			}
			$alert = '<strong style="color:red">' . esc_html__( 'Please check, incorrect value in post ID might have been set,', 'raindrops' ) . '</strong>';

			$entry_title_names = $id;
			if ( !empty( $entry_title_names ) ) {

				if ( strpos( $entry_title_names, ',' ) ) {

					$entry_title_names	 = explode( ',', $entry_title_names );
					$has_been_set_title	 = '';

					foreach ( $entry_title_names as $entry_title_name ) {

						$title_val = get_the_title( $entry_title_name );
						if ( !empty( $title_val ) ) {

							$has_been_set_title .= $title_val . '<br />';
						} else {

							$has_been_set_title .= $alert . '<br />';
						}
					}
					$entry_title_names = $has_been_set_title;
				} else {

					$entry_title_names = get_the_title( $entry_title_names );

					if ( empty( $entry_title_names ) ) {

						$entry_title_names = $alert;
					}
				}

				$raindrops_html = '<h4>%1$s</h4><p>%2$s</p>';

				printf( $raindrops_html, esc_html__( 'Posted title that has been set', 'raindrops' ), $entry_title_names );
			}
			$raindrops_html = '<h4>%1$s</h4><p><label for="%2$s">%3$s<input class="widefat" id="%4$s" name="%5$s" type="text" value="%6$s" /></label></p>';

			printf( $raindrops_html, esc_html__( 'Title', 'raindrops' ), esc_attr( $this->get_field_id( 'title' ) ), esc_html__( 'Show only Display Type: Grid', 'raindrops' ), esc_attr( $this->get_field_id( 'title' ) ), esc_attr( $this->get_field_name( 'title' ) ), esc_html( $title )
			);
			$raindrops_html = '<h4>%1$s</h4><p><label for="%2$s">%3$s<input class="widefat" id="%4$s" name="%5$s" type="text" value="%6$s" /></label></p>';

			printf( $raindrops_html, esc_html__( 'Post ID', 'raindrops' ), esc_attr( $this->get_field_id( 'id' ) ), esc_html__( 'Comma separated IDs', 'raindrops' ), esc_attr( $this->get_field_id( 'id' ) ), esc_attr( $this->get_field_name( 'id' ) ), esc_html( $id )
			);

			$raindrops_html = '<h4>%1$s</h4><ul><li><label><input type="radio" id="%2$s" name="%3$s" value="%7$s" %4$s %5$s />%6$s</label></li>';

			printf( $raindrops_html, esc_html__( 'Display Type', 'raindrops' ), esc_attr( $this->get_field_id( 'display_type' ) ), esc_attr( $this->get_field_name( 'display_type' ) ), checked( $display_type, "grid", false ), $checked_default, esc_html__( 'Grid Layout', 'raindrops' ), 'grid'
			);
			$raindrops_html = '<li><label ><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li></ul>';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'display_type' ) ), esc_attr( $this->get_field_name( 'display_type' ) ), checked( $display_type, "randum", false ), esc_html__( 'Randum Show', 'raindrops' ), 'randum' );

			$raindrops_html = '<h4>%1$s</h4><ul><li><label><input type="radio" id="%2$s" name="%3$s" value="%7$s" %4$s %5$s />%6$s</label></li>';

			printf( $raindrops_html, esc_html__( 'Post Type', 'raindrops' ), esc_attr( $this->get_field_id( 'type' ) ), esc_attr( $this->get_field_name( 'type' ) ), checked( $type, "post", false ), $checked_default, esc_html__( 'Post:', 'raindrops' ), 'post'
			);

			if ( isset( $raindrops_widget_post_types ) && !empty( $raindrops_widget_post_types ) ) {
				/**
				 * @since 1.441
				 */
				$raindrops_html = '<li><label ><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li>';

				foreach ( $raindrops_widget_post_types as $raindrops_post_type ) {

					if ( raindrops_post_type_exists( $raindrops_post_type ) ) {

						$post_type_obj = get_post_type_object( $raindrops_post_type );

						printf( $raindrops_html, esc_attr( $this->get_field_id( 'type' ) ), esc_attr( $this->get_field_name( 'type' ) ), checked( $type, $raindrops_post_type, false ), esc_html( $post_type_obj->label ), esc_attr( $raindrops_post_type ) );
					}
				}
			}

			$raindrops_html = '<li><label ><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li></ul>';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'type' ) ), esc_attr( $this->get_field_name( 'type' ) ), checked( $type, "page", false ), esc_html__( 'Page', 'raindrops' ), 'page'
			);

			$raindrops_html = '<h4>%1$s</h4><ul><li><label><input type="radio" id="%2$s" name="%3$s" value="%7$s" %4$s %5$s />%6$s</label></li>';

			printf( $raindrops_html, esc_html( 'Content Type', 'raindrops' ), esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "content", false ), $checked_default, esc_html__( 'Content:', 'raindrops' ), 'content' );

			$raindrops_html = '<li><label"><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li>';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "excerpt", false ), esc_html__( 'Excerpt:', 'raindrops' ), 'excerpt'
			);

			$raindrops_html = '<li><label><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li>';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "attachment", false ), esc_html__( 'Attachment IMG:', 'raindrops' ), 'attachment'
			);

			$raindrops_html = '<li><label><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li></ul>';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'content' ) ), esc_attr( $this->get_field_name( 'content' ) ), checked( $content, "featured", false ), esc_html__( 'Featured IMG', 'raindrops' ), 'featured'
			);

			$raindrops_html = '<label><h4>Style</h4><textarea id="%1$s" name="%2$s" class="raindrops-pinup-entry-style" rows="8">%3$s</textarea></label><br />';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'inline_style' ) ), esc_attr( $this->get_field_name( 'inline_style' ) ), $style );
		}

	}

	/**
	 * Raindrops Extend Archive Widget
	 *
	 * @since 1.270
	 */
	if ( !function_exists( 'raindrops_register_extend_archive_Widget' ) ) {

		function raindrops_register_extend_archive_Widget() {

			register_widget( 'raindrops_extend_archive_Widget' );
		}

	}

	class raindrops_extend_archive_Widget extends WP_Widget {

		public function __construct() {

			$widget_ops = array(
				'classname'		 => 'raindrops-extend-archive',
				'description'	 => esc_html__( 'Archives Extended', 'raindrops' )
			);
			parent::__construct( false, esc_html__( '3.Archives Extended [Raindrops]', 'raindrops' ), $widget_ops );
			wp_reset_query();
		}

		public function widget( $args, $instance ) {

			global $wp_locale;
			/* @1.492 Change archive count style */
			$changes = array('(' => '<span class="rd-archive-count">',')' => '</span>','&nbsp;'=> '');
			
			extract( $args );
			echo $before_widget;

			if ( isset( $instance[ 'title' ] ) ) {

				$title = $instance[ 'title' ];
			} else {

				$title = esc_html__( "Archives", 'raindrops' );
			}
			if ( !empty( $title ) ) {
				$result_html = $before_title;
				/**
				 * @since 1.441
				 */
				$result_html .= apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Archives', 'raindrops' ) : $instance['title'], $instance, $this->id_base );

				$result_html .= $after_title;
			}
			if ( isset( $instance[ 'archives_start_year' ] ) && is_numeric( $instance[ 'archives_start_year' ] ) ) {

				$archives_start_year = absint( $instance[ 'archives_start_year' ] );
			} else {
				/* year of WordPress born */
				$archives_start_year = 2003;
			}

			if ( isset( $instance[ 'group_year_month' ] ) && ( $instance[ 'group_year_month' ] == 'year' || $instance[ 'group_year_month' ] == 'month') ) {

				$group_year_month = esc_attr( $instance[ 'group_year_month' ] );
			} else {
				$group_year_month = 'year';
			}

			if ( isset( $instance[ 'show_post_count' ] ) && ( $instance[ 'show_post_count' ] == 'yes' || $instance[ 'show_post_count' ] == 'no') ) {

				if ( $instance[ 'show_post_count' ] == 'yes' ) {

					$show_post_count = true;
				}
				if ( $instance[ 'show_post_count' ] == 'no' ) {

					$show_post_count = false;
				}
			} else {

				$show_post_count = false;
			}

			$archive_strings = wp_get_archives( apply_filters( 'widget_archives_args', array(
				'type'				 => 'monthly',
				'show_post_count'	 => $show_post_count,
				'echo'				 => false,
				'format'			 => 'custom',
				'before'			 => ',' ) ) );

			$archives_array = explode( ',', $archive_strings );

			foreach ( $archives_array as $key => $each_links ) {

				if ( preg_match( '!([0-9]{4})!', $each_links, $regs ) && $regs[ 1 ] < $archives_start_year ) {
					unset( $archives_array[ $key ] );
				}
			}

			$result				 = array();
			$groups				 = $group_year_month;
			$display_start_year	 = $archives_start_year;
			$display_end_year	 = apply_filters( 'raindrops_extend_archive_widget_end_year', date( 'Y' ), $title );
			if ( $groups == 'year' ) {
				for ( $i = $display_start_year; $i < $display_end_year + 1; $i++ ) {

					foreach ( $archives_array as $key => $val ) {

						if ( preg_match( '!([0-9]{4})!', $val, $regs ) && $regs[ 1 ] == $i ) {

							$result[ $i ][ $key ] = $val;
						}
					}
				}
				krsort( $result );
			}

			if ( $groups == 'month' ) {
				for ( $i = 1; $i < 13; $i++ ) {

					foreach ( $archives_array as $key => $val ) {

						$month_name = $wp_locale->get_month( $i );

						if ( preg_match( '![^0-9]' . $month_name . '!', $val ) ) {
							$result[ $i ][ $key ] = $val;
						}
					}
				}
			}


			$result_html .= '<div class="eco-archive extent-archives by-' . esc_attr( $groups ) . '">';
			/**
			 * @1.407
			 * $result_html .= raindrops_monthly_archive_prev_next_navigation( false, true );
			 */
			/**
			* add rd-current-month-archive class
			* @1.413
			*/
			$current_month_class = '';
			if( is_month() ) {
				$current_month_of_archive	 = (int) get_query_var( 'monthnum' );
				$current_year_of_archive	 = (int) get_query_var( 'year' );
			} else {
				$current_month_of_archive	 = '';
				$current_year_of_archive	 = '';
			}

			if ( $groups == 'year' ) {

				foreach ( $result as $key => $val ) {

					$year_link	 = get_year_link( absint( $key ) );
					$year_label	 = apply_filters( 'raindrops_archive_year_label', esc_html( $key ), mktime( 0, 0, 0, is_month() ? $current_month_of_archive: 1, 1, intval( $key ) ) );
					$result_html .= sprintf( '<h3 class="year year-%2$s"><a href="%1$s">%3$s</a></h3><ul class="item year-%2$s">', $year_link, absint( $key ), $year_label );

					$month_name_before	 = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
					$month_name_after	 = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' );

					foreach ( $val as $k => $v ) {

						if ( !empty( $current_month_of_archive ) && !empty( $current_year_of_archive ) && strtotime( $current_year_of_archive.'/'. $current_month_of_archive .'/1' ) ==  strtotime( strip_tags('1 '. $v ) ) ) {
							$current_month_class = 'rd-current-month-archive';
						} else {
							$current_month_class = '';
						}

					preg_match( '!>.*[^0-9]([0-9]{1,2})[^0-9].*<!', $v, $regs );

						if ( isset( $regs[ 1 ] ) ) {

							$class	 = 'month month-' . $regs[ 1 ]. ' '. $current_month_class;
							$v		 = str_replace( $regs[ 0 ], '>' . $wp_locale->get_month( $regs[ 1 ] ) . '<', $v );
						} else {

							$class	 = trim( strtolower( wp_kses( $v, array() ) ) );
							$class	 = trim( str_replace( array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ' ', '(', ')', '&nbsp;' ), array( '', '', '', '', '', '', '', '', '', '', '-', '', '', '' ), $class ), '-' );

							$class	 = esc_attr( 'month month-' . $class . ' '. $current_month_class );
							$v		 = preg_replace( '![^/=][0-9]{4}!', '', $v );
						}

						$v = str_replace( $month_name_before, $month_name_after, $v );
						$result_html .= sprintf( '<li class="%2$s">%1$s<span class="screen-reader-text">%3$s</span></li>', $v, esc_attr( $class ), esc_html( $year_label ) );
					}
					$result_html .= '</ul>';
				}

				$result_html .= '</div>';
				$result_html = strtr($result_html, $changes );				
				echo apply_filters( 'raindrops_extend_archive_widget', $result_html );
			}

			if ( $groups == 'month' ) {

				foreach ( $result as $key => $val ) {

					$month_name = $wp_locale->get_month( $key );
					$result_html .= sprintf( '<h3 class="month month-%2$s">%1$s</h3><ul>', $month_name, esc_attr( $key ) );

					foreach ( $val as $v ) {

						if( is_month() ) {

							if (  !empty( $current_month_of_archive ) && !empty( $current_year_of_archive ) &&  strtotime( $current_year_of_archive.'/'. $current_month_of_archive .'/1' ) ==  strtotime( strip_tags('1 '. $v ) ) ) {
									$current_month_class = 'rd-current-month-archive';
							} else {
									$current_month_class = '';
							}
						}

						$result_html .= sprintf( '<li class="item item-%2$s">%1$s<span class="screen-reader-text">%3$s</span></li>', str_replace( $month_name, '', $v ), esc_attr( $key ). ' '. $current_month_class, esc_html( $month_name ) );
					}
					$result_html .= '</ul>';
				}

				$result_html = strtr($result_html, $changes );
				echo apply_filters( 'raindrops_extend_archive_widget', $result_html );
			}

			echo $after_widget;
		}

		public function form( $instance ) {

			$archives_start_year = '';
			$group_year_month	 = '';
			$show_post_count	 = '';

			if ( isset( $instance[ 'title' ] ) ) {

				$title = $instance[ 'title' ];
			} else {

				$title = esc_html__( "Archives", 'raindrops' );
			}

			if ( isset( $instance[ 'archives_start_year' ] ) ) {

				$archives_start_year = esc_attr( $instance[ 'archives_start_year' ] );
			}

			if ( isset( $instance[ 'group_year_month' ] ) ) {

				$group_year_month = esc_attr( $instance[ 'group_year_month' ] );
			}

			if ( isset( $instance[ 'show_post_count' ] ) ) {

				$show_post_count = esc_attr( $instance[ 'show_post_count' ] );
			}

			if ( empty( $instance[ 'group_year_month' ] ) && empty( $group_year_month ) ) {

				$raindrops_year_checked_default = "checked='checked'";
			} else {

				$raindrops_year_checked_default = "";
			}

			if ( empty( $instance[ 'show_post_count' ] ) && empty( $show_post_count ) ) {

				$show_post_count_checked_default = "checked='checked'";
			} else {

				$show_post_count_checked_default = "";
			}
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'raindrops' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php
			$raindrops_html = '<h4>%1$s</h4><p><label for="%2$s">%3$s<input class="widefat" id="%4$s" name="%5$s" type="text" value="%6$s" /></label></p>';

			printf( $raindrops_html, esc_html__( 'Display Archives Start Year', 'raindrops' ), esc_attr( $this->get_field_id( 'archives_start_year' ) ), esc_html__( 'Please use the 4-digit number or blank ex. 2010', 'raindrops' ), esc_attr( $this->get_field_id( 'archives_start_year' ) ), esc_attr( $this->get_field_name( 'archives_start_year' ) ), esc_html( $archives_start_year )
			);

			$raindrops_html = '<h4>%1$s</h4><ul><li><label><input type="radio" id="%2$s" name="%3$s" value="%7$s" %4$s %5$s />%6$s</label></li>';


			printf( $raindrops_html, esc_html__( 'Groop by Year, by Month', 'raindrops' ), esc_attr( $this->get_field_id( 'group_year_month' ) ), esc_attr( $this->get_field_name( 'group_year_month' ) ), checked( $group_year_month, "year", false ), $raindrops_year_checked_default, esc_html__( 'Year', 'raindrops' ), 'year'
			);

			$raindrops_html = '<li><label><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li></ul>';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'group_year_month' ) ), esc_attr( $this->get_field_name( 'group_year_month' ) ), checked( $group_year_month, "month", false ), esc_html__( 'Month', 'raindrops' ), 'month'
			);

			$raindrops_html = '<h4>%1$s</h4><ul><li><label><input type="radio" id="%2$s" name="%3$s" value="%7$s" %4$s %5$s />%6$s</label></li>';

			printf( $raindrops_html, esc_html__( 'Show Post Count', 'raindrops' ), esc_attr( $this->get_field_id( 'show_post_count' ) ), esc_attr( $this->get_field_name( 'show_post_count' ) ), checked( $show_post_count, "no", false ), $show_post_count_checked_default, esc_html__( 'No', 'raindrops' ), 'no'
			);
			$raindrops_html = '<li><label><input type="radio" id="%1$s" name="%2$s" value="%5$s" %3$s />%4$s</label></li></ul>';

			printf( $raindrops_html, esc_attr( $this->get_field_id( 'show_post_count' ) ), esc_attr( $this->get_field_name( 'show_post_count' ) ), checked( $show_post_count, "yes", false ), esc_html__( 'Yes', 'raindrops' ), 'yes'
			);
		}

		public function update( $new_instance, $old_instance ) {

			$instance[ 'archives_start_year' ]	 = strip_tags( stripslashes( $new_instance[ 'archives_start_year' ] ) );
			$instance[ 'group_year_month' ]		 = strip_tags( stripslashes( $new_instance[ 'group_year_month' ] ) );
			$instance[ 'show_post_count' ]		 = strip_tags( stripslashes( $new_instance[ 'show_post_count' ] ) );
			$instance[ 'title' ]				 = strip_tags( stripslashes( $new_instance[ 'title' ] ) );
			return $instance;
		}

	}


/**
 * Add Widget Area for Custom Post Type Single Page, After Article
 * Need Settings
 * add functions.php top like below
 * $raindrops_widget_post_types = array('product');
 * @since 1.442
 */

add_action( 'widgets_init', 'raindrops_post_type_single_widget_area_register' );
add_action( 'raindrops_after_article', 'raindrops_post_type_single_widget_area_show' );

if ( !function_exists( 'raindrops_post_type_single_widget_area_show' ) ) {

	function raindrops_post_type_single_widget_area_show() {

		global $post, $raindrops_widget_post_types;

		$post_type = get_post_type( get_the_ID() );

		if ( isset( $raindrops_widget_post_types ) && !empty( $raindrops_widget_post_types ) ) {

			foreach ( $raindrops_widget_post_types as $widget ) {

				if ( is_singular() && $post_type == $widget ) {
					$widget = esc_attr( $widget );
					if ( is_active_sidebar( $widget ) ) {
		?>
												<div class="topsidebar post-type post-type-<?php echo $widget; ?>">
													<ul>
						<?php
						raindrops_prepend_widget_sticky();
						dynamic_sidebar( $widget );
						raindrops_append_widget_sticky();
						?>
													</ul>
												</div>
												<br class="clear" />
						<?php
					}
				}
			}
		}
	}
}


if ( !function_exists( 'raindrops_post_type_single_widget_area_register' ) ) {

	function raindrops_post_type_single_widget_area_register() {
		global $post, $raindrops_widget_post_types;

		if ( !empty( $raindrops_widget_post_types ) ) {

			foreach ( $raindrops_widget_post_types as $post_type ) {

				$post_type = esc_attr( $post_type );

				register_sidebar( array(
					/* translators: 1: post type */
					'name'			 => sprintf( esc_html__('Post Type %1$s Widget', 'raindrops' ), $post_type ),
					'id'			 => $post_type,
					'before_widget'	 => '<li id="%1$s" class="%2$s widget post-type-widget post-type-' . $post_type . '" ' . raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
					'after_widget'	 => '</li>',
					'before_title'	 => '<h2 class="widgettitle post-type-title h2"><span>',
					'after_title'	 => '</span></h2>',
				) );
			}
		}
	}
}
?>