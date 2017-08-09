<?php

// Init
add_action( 'init', array( 'DispletPropertyShowcase', 'add_image_sizes' ) );
add_action( 'init', array( 'DispletPropertyShowcase', 'add_theme_support' ) );
add_action( 'init', array( 'DispletPropertyShowcase', 'globalize_admin_option' ) );
add_action( 'init', array( 'DispletPropertyShowcase', 'register_post_types' ) );
add_action( 'init', array( 'DispletPropertyShowcase', 'register_taxonomies' ) );
add_action( 'init', array( 'DispletPropertyShowcaseUpdates', 'maybe_update' ) );

// Request
add_filter( 'request', array( 'DispletPropertyShowcaseSPW', 'add_value_to_showcase_query_var' ) );

// Pre Get Posts
add_action( 'pre_get_posts', array( 'DispletPropertyShowcaseArchive', 'maybe_filter_posts' ) );

// WP
add_action( 'wp', array( 'DispletPropertyShowcase', 'globalize_option' ) );
add_action( 'wp', array( 'DispletPropertyShowcasePages', 'build_page_model' ) );

// Template Redirect
add_action( 'template_redirect', array( 'DispletPropertyShowcaseArchive', 'maybe_build_page_model' ) );
add_action( 'template_redirect', array( 'DispletPropertyShowcaseArchive', 'maybe_use_archive_template' ) );
add_action( 'template_redirect', array( 'DispletPropertyShowcasePages', 'maybe_filter_post_thumbnail' ) );
add_action( 'template_redirect', array( 'DispletPropertyShowcaseSingle', 'maybe_build_page_model' ) );
add_action( 'template_redirect', array( 'DispletPropertyShowcaseSingle', 'maybe_use_single_template' ) );
add_action( 'template_redirect', array( 'DispletPropertyShowcaseSPW', 'maybe_use_spw_template' ) );

// WP Enqueue Scripts
add_action( 'wp_enqueue_scripts', array( 'DispletPropertyShowcase', 'enqueue' ) );

// WP Print Styles
add_action( 'wp_print_styles', array( 'DispletPropertyShowcase', 'maybe_print_custom_color_scheme_styles' ) );

// WP Print Scripts
add_action( 'wp_print_scripts', array( 'DispletPropertyShowcase', 'print_javascript_variables' ) );

// Body Class
add_filter( 'body_class', array( 'DispletPropertyShowcaseSingle', 'maybe_filter_body_class' ) );

// Admin Menu
add_action( 'admin_menu', array( 'DispletPropertyShowcase', 'add_help_page' ) );

// Admin Bar Menu
add_action( 'admin_bar_menu', array( 'DispletPropertyShowcaseSingle', 'maybe_add_single_to_user_toolbar' ), 999 );
add_action( 'admin_bar_menu', array( 'DispletPropertyShowcaseSingle', 'maybe_add_spw_to_user_toolbar' ), 999 );
add_action( 'admin_bar_menu', array( 'DispletPropertyShowcaseSingle', 'maybe_add_unbranded_spw_to_user_toolbar' ), 999 );

// Admin Init
add_action( 'admin_init', array( 'DispletPropertyShowcase', 'maybe_flush_rewrite_rules' ) );
add_action( 'admin_init', array( 'DispletPropertyShowcase', 'maybe_insert_default_statuses' ) );

// Admin Enqueue Scripts
add_action( 'admin_enqueue_scripts', array( 'DispletPropertyShowcase', 'enqueue_admin' ) );

// Add Meta Boxes
add_action( 'add_meta_boxes', array( 'DispletPropertyShowcase', 'add_meta_boxes' ) );

// Save Post
add_action( 'save_post', array( 'DispletPropertyShowcase', 'save_meta_fields' ) );

?>