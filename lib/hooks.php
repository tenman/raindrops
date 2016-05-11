<?php
/**
 * Filter and actions for Raindrops theme
 *
 *
 * @package Raindrops
 * @since Raindrops 0.948
 */
add_action( 'after_setup_theme', 'raindrops_theme_setup' );

if ( !function_exists( 'raindrops_theme_setup' ) ) {

    function raindrops_theme_setup() {
        global $raindrops_wp_version, $raindrops_extend_galleries;

		if ( $raindrops_extend_galleries == true ){

			add_filter( 'use_default_gallery_style', '__return_false' );
		}else{

			add_filter( 'use_default_gallery_style', '__return_true' );
		}
        /**
         *
         *
         *
         *
         *
         */
        add_action( 'load-themes.php', 'raindrops_install_navigation' );
        /**
         *
         *
         *
         *
         *
         */
		if( is_admin() && isset($_GET['post']) && !empty($_GET['post'])){
			$raindrops_post_id = absint( $_GET['post'] );
			add_editor_style( array('editor-style.css', esc_url( add_query_arg( array('action'=>'raindrops_editor_styles','id'=> $raindrops_post_id ), admin_url( 'admin-ajax.php' ) ) ) ) );
		} else {
			add_editor_style( array('editor-style.css', esc_url( add_query_arg( 'action','raindrops_editor_styles', admin_url( 'admin-ajax.php' ) ) ) ) ) ;
		}
        /**
         *
         *
         *
         *
         * thanks ison
         */
        add_filter( 'wp_page_menu_args', 'raindrops_page_menu_args' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'comment_form_default_fields', 'raindrops_comment_form' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_meta_key', 'raindrops_filter_explode_meta_keys', 10, 2 );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'body_class', 'raindrops_add_body_class' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'comment_form_field_comment', 'raindrops_custom_remove_aria_required' );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_meta_key', 'raindrops_filter_explode_meta_keys', 10, 2 );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_title', 'raindrops_fallback_title', 10, 2 );
        /**
         *
         *
         *
         *
         *
         */
        add_filter( 'the_content', 'raindrops_ie_height_expand_issue' );
        /**
         *
         *
         *
         * 	@since 1.100
         */
        add_filter( 'widget_text', 'raindrops_ie_height_expand_issue' );
        /**
         *
         *
         *
         *
         *
         */
        add_action( 'admin_init', 'raindrops_options_init' );
        /**
         *
         *
         *
         *
         *
         */
		add_theme_support( 'title-tag' );
        /**
         *
         *
         *
         *
         * @since 0.956
         */
        add_action( 'wp_enqueue_scripts', 'raindrops_enqueue_comment_reply' );
        /**
         *
         *
         *
         *
         * @since 0.956
         */
        add_action( 'customize_controls_print_styles', 'raindrops_customize_controls_print_styles' );
        /**
         * @1.304 commentout add_shortcode
         * This setting will removed ver 1.305
         *
         *
         * @since 0.964 ?
         */
        //add_filter( 'widget_text', 'do_shortcode' );
        /**
         *
         *
         *
         * @since 0.992
         */
        add_action( 'wp_head', 'raindrops_mobile_meta' );
        /**
         * Switch elements from div to figure when doctype html5
         *
         *
         * @since 1.003
         */
        add_filter( 'img_caption_shortcode', 'raindrops_img_caption_shortcode_filter', 10, 3 );
        /**
         * Archive link title add string 'Archives ' for for screen reader
         *
         *
         * @since 1.008
         */
        add_filter( 'get_archives_link', 'raindrops_accessible_titled' );
        /**
         *
         *
         *
         * @since 1.008
         */
		/* @1.336 */

		add_filter( 'the_category', 'raindrops_remove_category_rel' );

		/* 1.336 need check */

		add_filter( 'image_send_to_editor', 'raindrops_remove_category_rel' );

        /**
         *
         *
         *
         * @since 1.136
         */
        add_filter( 'theme_mod_header_textcolor', 'raindrops_filter_header_text_color' );
        /**
         *
         *
         *
         * @since 1.211
         */
        add_action( 'wp_footer', 'raindrops_status_bar' );
        /*
         *
         *
         *
         * @since 1.217
         */
        add_filter( 'query_vars', 'raindrops_extend_query' );
        /**
         *
         *
         *
         *
         * @since 1.220
         */
        add_filter( 'raindrops_base_font_size', 'raindrops_base_font_size' );
        /**
         *
         *
         *
         *
         * @since 1.229
         */
        add_filter( 'widget_tag_cloud_args', 'raindrops_widget_tag_cloud_args' );
        /**
         *
         *
         *
         *
         * @since 1.233
         */

        add_filter( 'sidebars_widgets', 'raindrops_widget_ids' );
        add_filter( 'the_content', 'raindrops_remove_wrong_p_before', 9 );
        add_filter( 'the_content', 'raindrops_remove_wrong_p', 11 );
        /**
         *
         *
         *
         *
         * @since 1.234
         */
        if ( is_admin() ) {

            add_action( 'load-post.php', 'raindrops_call_custom_css' );
            add_action( 'load-post-new.php', 'raindrops_call_custom_css' );
        }
        /**
         *
         *
         *
         *
         * @since 1.238
         */
         add_action( 'widgets_init', 'raindrops_register_recent_post_group_by_category' );
         add_action( 'widgets_init', 'raindrops_register_pinup_entry_Widget' );
        /**
         *
         *
         *
         *
         * @since 1.246
         */
		add_filter( 'embed_oembed_html', 'raindrops_oembed_filter', 99, 4 );
		add_action( 'save_post', 'raindrops_transient_update' );
		add_action( 'edit_term', 'raindrops_transient_update' );
		add_action( 'wp_enqueue_scripts', 'raindrops_load_small_device_helper' );
		/**
         *
         * @since 1.261
         */
		add_filter( 'wp_headers', 'raindrops_wp_headers', 10, 2 );
		/**
         *
         * @since 1.270
         */
		add_action( 'widgets_init', 'raindrops_register_extend_archive_Widget' );
		add_filter( 'shortcode_atts_playlist', 'raindrops_play_list_add_atts', 10, 3 );
		add_action( 'wp_enqueue_scripts', 'raindrops_add_complementary_color' );
		add_filter( 'tiny_mce_before_init', 'raindrops_tiny_mce_before_init' );
		add_action( 'wp_ajax_raindrops_editor_styles', 'raindrops_editor_styles_callback' );
		add_action( 'wp_ajax_nopriv_raindrops_editor_styles', 'raindrops_editor_styles_callback' );
		add_filter( 'raindrops_color_type_style_buffer', 'raindrops_pinup_entry_style' );
		add_filter( 'raindrops_month_list_post_count','raindrops_month_list_count');

		/**
		 * @since 1.272
		 */
		add_action( 'wp_head', 'raindrops_add_header_archive_description' );
		/**
		 * @since 1.276
		 */
		add_filter( 'raindrops_fallback_title', 'raindrops_strip_escaped_title',99 );
		/**
		 * @since 1.278
		 */

		add_filter( 'the_content', 'raindrops_excerpt_with_html' );
		add_filter('embed_oembed_html','raindrops_oembed_result', 11, 3);

		/**
		 * since 1.278
		 */
		add_action( 'raindrops_prepend_entry_content','raindrops_excerpt_id');
		add_filter( 'raindrops_the_excerpt', 'raindrops_excerpt_after_link',10,2 );
		add_filter( 'raindrops_html_excerpt_with_elements', 'raindrops_excerpt_after_link',10,2 );

		add_filter( 'raindrops_header_image_contents','raindrops_custom_header_image_contents');
		add_filter( 'raindrops_site_title_class', 'raindrops_custom_site_title_class' );
		add_filter( 'raindrops_embed_meta_css', 'raindrops_custom_site_title_style' );
		add_filter( 'raindrops_embed_meta_pre', 'raindrops_apply_google_font_import_rule_for_site_title' );
		add_filter( 'raindrops_embed_meta_pre', 'raindrops_apply_google_font_import_rule_for_primary_menu' );
		add_filter( 'raindrops_embed_meta_css', 'raindrops_apply_google_font_styles_for_site_title' );
		add_filter( 'raindrops_embed_meta_css', 'raindrops_apply_google_font_styles_for_primary_menu' );
		/* move from functions.php
		 * @since 1,289
		 */
		add_action( 'load-post.php', array( 'RaindropsPostHelp', 'init' ) );
		add_action( 'load-post-new.php', array( 'RaindropsPostHelp', 'init' ) );
		add_action( 'load-themes.php', array( 'RaindropsPostHelp', 'init' ) );
		add_action( 'load-theme-editor.php', array( 'RaindropsPostHelp', 'init' ) );

		if( 'details' == raindrops_warehouse_clone( 'raindrops_col_setting_type' ) ){
			add_action( 'raindrops_pre_part_header-front', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_part_header-xhtml', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_part_header', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_index.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_date.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_page.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_single.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_search.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_404.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_list-of-post.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_category.php', 'raindrops_filter_page_column_control' );
			add_action( 'raindrops_pre_author.php', 'raindrops_filter_page_column_control' );
			/**
			 * @since 1.297
			 */
			add_action( 'raindrops_external_css_pre', 'raindrops_filter_page_column_control' );
		}

		/*
		 * @since 1.295
		 */
		add_filter( 'raindrops_embed_meta_css', 'raindrops_customizer_hide_post_author' );
		add_filter( 'raindrops_embed_meta_css', 'raindrops_customizer_hide_post_date' );
		add_filter( 'raindrops_embed_meta_css', 'raindrops_customizer_hide_default_category' );
		add_filter( 'raindrops_entry_title_class', 'raindrops_customizer_add_article_title_css_class' );
		add_filter( 'excerpt_length', 'raindrops_excerpt_length',99 );
		/**
		 * @since 1.307
		 */
		add_filter( 'press_this_suggested_html', 'raindrops_press_this_add_class' );
		add_filter( 'get_comment_author_link', 'raindrops_recent_comments_avatar', 10,  3 );
		/**
		 * @since 1.308
		 */
		add_filter( 'raindrops_embed_meta_pre', 'raindrops_apply_google_font_import_rule_for_article_title' );
		add_filter( 'raindrops_embed_meta_css', 'raindrops_apply_google_font_styles_for_article_title' );
		/**
		 * @since 1.328
		 */
		add_filter('the_content', 'raindrops_link_text_filter' );
		/**
		 * @since 1.330
		 */
		add_filter ( 'editor_stylesheets', 'raindrops_localize_style_add' );
		/**
		 * @since 1.336
		 */
		add_filter( 'the_password_form', 'raindrops_post_password_form_html5' );
		add_filter( 'raindrops_embed_meta_css', 'raindrops_color_pallet_tagcloud' );
		/**
		 * @since 1.343
		 */
		add_filter('media_send_to_editor', 'raindrops_pdf_send_to_editor', 10, 3 );
		/**
		 * @since 1.345
		 * moved from functions.php
		 * priority change from 10 to 11
		 * conflict Responsive Image (WordPress4.4)
		 */
		add_filter( 'the_content', 'raindrops_chat_filter',11 );
		/**
		 * @since 1.348
		 */
		add_filter('the_content', 'raindrops_automatic_modal_rel_rev' );
		/*
		 * @since 1.353
		 */
		global $wp_embed;
		add_filter( 'widget_text', array( $wp_embed, 'autoembed' ), 9 );
		/*
		 * @since 1.356
		 */
		add_filter( 'author_link','esc_url' );
		add_filter( 'attachment_link','esc_url' );
		add_filter( 'site_url','esc_url');

		/*
		 * @since 1.405
		 */
		add_action( 'admin_enqueue_scripts', 'raindrops_widget_page_style' );
		add_action('sidebar_admin_page','raindrops_widget_style_description');
    }
}
?>