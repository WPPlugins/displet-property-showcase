<?php

/*
Plugin Name: Displet Property Showcase
Description: This plugin allows you to easily create beautiful, responsive single property websites. Showcase your properties' images in as high a resolution as you like, include maps, video walk throughs, school information, & more! Select from multiple color schemes.
Version: 1.1.7
Author: Displet
Author URI: http://displet.com/
*/

class DispletPropertyShowcase {
	protected static $_options;
	protected static $admin_option = 'displetpropertyshowcase_admin_options';
	protected static $cpt_slug = 'displet_prop_shwcase';
	protected static $cpt_url_slug = 'properties';
	protected static $name = 'Displet Property Showcase';
	protected static $_numeric_fields = array(
		'displetpropertyshowcase_price',
		'displetpropertyshowcase_bedrooms',
		'displetpropertyshowcase_bathrooms',
		'displetpropertyshowcase_size',
	);
	protected static $option = 'displetpropertyshowcase_options';
	protected static $slug = 'displet-property-showcase';
	protected static $_slugs = array(
		'option_version' => 'displetpropertyshowcase_version',
	);
	protected static $tax_slug = 'displet_prop_shwcase_status';
	protected static $version = '1.1.7';

	public static function add_help_page() {
		add_submenu_page(
			'edit.php?post_type=' . self::$cpt_slug,
			'Help',
			'Help',
			'edit_posts',
			'displet_property_showcase_help_page',
			array( 'DispletPropertyShowcase', 'include_help_page' )
		);
	}

	public static function add_image_sizes() {
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'displet-property-showcase-headshot', 116, 116, true );
			add_image_size( 'displet-property-showcase-logo', 300, 126 );
			add_image_size( 'displet-property-showcase-property-info', 500, 391, true );
			add_image_size( 'displet-property-showcase-photos', 920, 9999 );
			add_image_size( 'displet-property-showcase-thumbnails', 284, 230, true );
		}
	}

	public static function add_meta_boxes(){
		add_meta_box(
			'displetpropertyshowcase_meta_fields_section',
			'Property Data',
			array('DispletPropertyShowcase', 'include_meta_fields'),
			self::$cpt_slug
		);
	}

	public static function add_theme_support() {
		add_theme_support( 'post-thumbnails' );
	}

	public static function enqueue() {
		wp_enqueue_script(
			self::$slug . '-scripts',
			self::get_plugin_url( 'js/' . self::$slug . '.js' ),
			array( 'jquery' ),
			self::$version
		);
		wp_enqueue_style(
			self::$slug . '-styles',
			self::get_plugin_url( 'css/' . self::$slug . '.css' ),
			false,
			self::$version
		);
		wp_enqueue_style( 'ultra-font', 'http://fonts.googleapis.com/css?family=Ultra' );
		wp_enqueue_style( 'oswald-font', 'http://fonts.googleapis.com/css?family=Oswald:400,700' );
	}

	public static function enqueue_admin() {
		wp_enqueue_script(
			self::$slug . '-admin-scripts',
			self::get_plugin_url( 'js/' . self::$slug . '-admin.js' ),
			array( 'jquery', 'wp-color-picker' ),
			self::$version
		);
		wp_enqueue_style(
			self::$slug . '-admin-styles',
			self::get_plugin_url( 'css/' . self::$slug . '-admin.css' ),
			false,
			self::$version
		);
		wp_enqueue_style( 'wp-color-picker' );
	}

	protected static function get_attached_images( $numberposts = -1 ) {
		if ( is_singular( self::$cpt_slug ) ) {
			global $post;
			$photos = get_children( array(
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'numberposts' => $numberposts,
				'orderby' => 'menu_order',
				'order' => 'ASC',
			) );
			return $photos;
		}
		return false;
	}

	public static function get_formatted_address() {
		global $post;
		if ( get_post_type( $post ) == self::$cpt_slug ) {
			if ( !empty( $post->displetpropertyshowcase_address ) ) {
				$address = $post->displetpropertyshowcase_address;
				if ( !empty( $post->displetpropertyshowcase_city ) ) {
					$address .= ', ' . $post->displetpropertyshowcase_city;
					if ( !empty( $post->displetpropertyshowcase_state ) ) {
						$address .= ', ' . $post->displetpropertyshowcase_state;
					}
					if ( !empty( $post->displetpropertyshowcase_zip ) ) {
						$address .= ' ' . $post->displetpropertyshowcase_zip;
					}
				}
				return $address;
			}
		}
		return false;
	}

	protected static function get_integer_value( $string ) {
		$number = preg_replace( '/[^0-9.]/', '', $string );
		return intval( $number );
	}

	public static function get_phone_url( $phone_number ) {
		if ( !empty( $phone_number ) ) {
			return 'tel:+1' . preg_replace( '/[\D]/', '', $phone_number );
		}
	}

	public static function get_photo_slideshow_html() {
		$photos = self::get_attached_images();
		if ( !empty( $photos ) ) {
			$slideshow_html = '<div class="displet-photo-slideshow"><ul>';
			$pager_html = '<div class="displet-photo-slideshow-pager">';
			$data_slide_index = 0;
			foreach ( $photos as $photo ) {
				$slideshow_html .= '<li>' . wp_get_attachment_image( $photo->ID, 'displet-property-showcase-photos' ) . '</li>';
				$pager_html .= '<div><a href="javascript:;" data-slide-index="' . $data_slide_index . '">' . wp_get_attachment_image( $photo->ID, 'displet-property-showcase-thumbnails' ) . '</a></div>';
				$data_slide_index++;
			}
			$slideshow_html .= '</ul><div class="displet-photo-slideshow-previous"></div><div class="displet-photo-slideshow-next"></div></div>';
			$pager_html .= '</div>';
			return $slideshow_html . $pager_html;
		}
	}

	protected static function get_option( $option_slug = false ) {
		if ( empty( $option_slug ) ) {
			$option_slug = self::$option;
		}
		$option = get_option( $option_slug );
		if ( !empty( $option ) ) {
			return self::stripslashes_deep( $option );
		}
		return array();
	}

	public static function get_plugin_url( $path = '' ) {
		return plugins_url( self::$slug . '/' . $path );
	}

	public static function get_status_names() {
		global $post;
		return wp_get_post_terms( $post->ID, self::$tax_slug, array(
			'fields' => 'names',
		) );
	}

	public static function get_template_part( $slug, $model = false ) {
		$theme_dir = get_stylesheet_directory();
		if ( file_exists( $theme_dir . '/' . $slug . '.php' ) ) {
			$template_path = $theme_dir . '/' . $slug . '.php';
		}
		else {
			$template_path = dirname( __FILE__ ) . '/templates/' . $slug . '.php';
		}
		if ( !empty( $model ) ) {
			global $displetps_template;
			$displetps_template = $model;
			return self::render_template( $template_path, $model );
		}
		else {
			require( $template_path );
			DispletPropertyShowcasePages::maybe_filter_post_thumbnail();
		}
	}

	protected static function get_template_part_by_path( $slug, $path = '' ) {
		require( dirname( __FILE__ ) . '/' . trailingslashit( $path ) . $slug . '.php' );
	}

	public static function get_unprefixed_url ( $url ) {
		if ( !empty( $url ) ) {
			return str_replace( array( 'https://', 'http://' ), '',  $url );
		}
	}

	public static function globalize_admin_option() {
		global $displetps_admin_option;
		$displetps_admin_option = self::get_option( self::$admin_option );
	}

	public static function globalize_option() {
		global $displetps_option;
		self::$_options = self::get_option();
		$displetps_option = self::$_options;
	}

	public static function has_any_post_meta_fields( $fields ) {
		if ( !empty( $fields ) && is_array( $fields ) ) {
			global $post;
			foreach ( $fields as $field ) {
				if ( !empty( $post->{ $field } ) ) {
					return true;
				}
			}
		}
		return false;
	}

	public static function has_attached_image() {
		$photos = self::get_attached_images( 1 );
		if ( !empty( $photos ) ) {
			return true;
		}
		return false;
	}

	public static function has_featured_image() {
		global $post;
		if ( has_post_thumbnail( $post->ID ) ) {
			return true;
		}
		return false;
	}

	protected static function has_referral_function( $function ) {
		$debug = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
		foreach( $debug as $trace ) {
			$functions[] = $trace["function"];
		}
		if ( is_array( $function ) ) {
			foreach ( $function as $func ) {
				if ( in_array( $func, $functions ) ) {
					return true;
				}
			}
		}
		else if ( in_array( $function, $functions ) ) {
			return true;
		}
		return false;
	}

	public static function has_status() {
		$status = self::get_status_names();
		if ( !empty( $status ) ) {
			return true;
		}
		return false;
	}

	protected static function get_all_property_showcase_posts() {
		return get_posts( array(
			'post_type' => self::$cpt_slug,
			'posts_per_page' => -1,
			'post_status' => 'any',
		) );
	}

	public static function include_help_page() {
		self::get_template_part_by_path( 'displet-help-page' );
	}

	public static function include_meta_fields( $post ){
		wp_nonce_field( 'save_meta_fields_nonce', 'displetpropertyshowcase_custom_nonce' );
		$output = '';
		$displetpropertyshowcase_headline = get_post_meta( $post->ID, 'displetpropertyshowcase_headline', true );
		$displetpropertyshowcase_address = get_post_meta( $post->ID, 'displetpropertyshowcase_address', true );
		$displetpropertyshowcase_city = get_post_meta( $post->ID, 'displetpropertyshowcase_city', true );
		$displetpropertyshowcase_state = get_post_meta( $post->ID, 'displetpropertyshowcase_state', true );
		$displetpropertyshowcase_zip = get_post_meta( $post->ID, 'displetpropertyshowcase_zip', true );
		$displetpropertyshowcase_price = get_post_meta( $post->ID, 'displetpropertyshowcase_price', true );
		$displetpropertyshowcase_subdivision = get_post_meta( $post->ID, 'displetpropertyshowcase_subdivision', true );
		$displetpropertyshowcase_bedrooms = get_post_meta( $post->ID, 'displetpropertyshowcase_bedrooms', true );
		$displetpropertyshowcase_bathrooms = get_post_meta( $post->ID, 'displetpropertyshowcase_bathrooms', true );
		$displetpropertyshowcase_size = get_post_meta( $post->ID, 'displetpropertyshowcase_size', true );
		$displetpropertyshowcase_virtual_tour_url = get_post_meta( $post->ID, 'displetpropertyshowcase_virtual_tour_url', true );
		$displetpropertyshowcase_video_url = get_post_meta( $post->ID, 'displetpropertyshowcase_video_url', true );
		$displetpropertyshowcase_elementary_school = get_post_meta( $post->ID, 'displetpropertyshowcase_elementary_school', true );
		$displetpropertyshowcase_middle_school = get_post_meta( $post->ID, 'displetpropertyshowcase_middle_school', true );
		$displetpropertyshowcase_junior_high_school = get_post_meta( $post->ID, 'displetpropertyshowcase_junior_high_school', true );
		$displetpropertyshowcase_high_school = get_post_meta( $post->ID, 'displetpropertyshowcase_high_school', true );
		$displetpropertyshowcase_school_district = get_post_meta( $post->ID, 'displetpropertyshowcase_school_district', true );
		$displetpropertyshowcase_school_description_header = get_post_meta( $post->ID, 'displetpropertyshowcase_school_description_header', true );
		$displetpropertyshowcase_school_description = get_post_meta( $post->ID, 'displetpropertyshowcase_school_description', true );
		$output .= '<p><strong>Headline</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_headline" name="displetpropertyshowcase_headline" value="' . esc_attr( $displetpropertyshowcase_headline ) . '"/>';
		$output .= '<p><strong>Address</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_address" name="displetpropertyshowcase_address" value="' . esc_attr( $displetpropertyshowcase_address ) . '"/>';
		$output .= '<p><strong>City</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_city" name="displetpropertyshowcase_city" value="' . esc_attr( $displetpropertyshowcase_city ) . '"/>';
		$output .= '<p><strong>State</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_state" name="displetpropertyshowcase_state" value="' . esc_attr( $displetpropertyshowcase_state ) . '"/>';
		$output .= '<p><strong>Zip</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_zip" name="displetpropertyshowcase_zip" value="' . esc_attr( $displetpropertyshowcase_zip ) . '"/>';
		$output .= '<p><strong>Price</strong></p>';
		$output .= '$<input type="text" id="displetpropertyshowcase_price" name="displetpropertyshowcase_price" value="' . esc_attr( $displetpropertyshowcase_price ) . '"/>';
		$output .= '<p><strong>Subdivision</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_subdivision" name="displetpropertyshowcase_subdivision" value="' . esc_attr( $displetpropertyshowcase_subdivision ) . '"/>';
		$output .= '<p><strong>Bedrooms</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_bedrooms" name="displetpropertyshowcase_bedrooms" value="' . esc_attr( $displetpropertyshowcase_bedrooms ) . '"/>';
		$output .= '<p><strong>Bathrooms</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_bathrooms" name="displetpropertyshowcase_bathrooms" value="' . esc_attr( $displetpropertyshowcase_bathrooms ) . '"/>';
		$output .= '<p><strong>Size</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_size" name="displetpropertyshowcase_size" value="' . esc_attr( $displetpropertyshowcase_size ) . '"/>';
		$output .= '<p><strong>Virtual Tour URL</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_virtual_tour_url" name="displetpropertyshowcase_virtual_tour_url" value="' . esc_attr( $displetpropertyshowcase_virtual_tour_url ) . '"/>';
		$output .= '<p><strong>Video URL</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_video_url" name="displetpropertyshowcase_video_url" value="' . esc_attr( $displetpropertyshowcase_video_url ) . '"/>';
		$output .= '<p><strong>Elementary School</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_elementary_school" name="displetpropertyshowcase_elementary_school" value="' . esc_attr( $displetpropertyshowcase_elementary_school ) . '"/>';
		$output .= '<p><strong>Middle School</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_middle_school" name="displetpropertyshowcase_middle_school" value="' . esc_attr( $displetpropertyshowcase_middle_school ) . '"/>';
		$output .= '<p><strong>Junior High School</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_junior_high_school" name="displetpropertyshowcase_junior_high_school" value="' . esc_attr( $displetpropertyshowcase_junior_high_school ) . '"/>';
		$output .= '<p><strong>High School</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_high_school" name="displetpropertyshowcase_high_school" value="' . esc_attr( $displetpropertyshowcase_high_school ) . '"/>';
		$output .= '<p><strong>School District</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_school_district" name="displetpropertyshowcase_school_district" value="' . esc_attr( $displetpropertyshowcase_school_district ) . '"/>';
		$output .= '<p><strong>School Description Header</strong></p>';
		$output .= '<input type="text" id="displetpropertyshowcase_school_description_header" name="displetpropertyshowcase_school_description_header" value="' . esc_attr( $displetpropertyshowcase_school_description_header ) . '"/>';
		$output .= '<p><strong>School Description</strong></p>';
		$output .= '<textarea id="displetpropertyshowcase_school_description" name="displetpropertyshowcase_school_description">' . esc_attr( $displetpropertyshowcase_school_description ) . '</textarea>';
		echo $output;
	}

	private static function insert_default_statuses() {
		wp_insert_term( 'Coming Soon', self::$tax_slug );
		wp_insert_term( 'Just Listed', self::$tax_slug );
		wp_insert_term( 'Pocket Listing', self::$tax_slug );
		wp_insert_term( 'Under Contract', self::$tax_slug );
		wp_insert_term( 'Sold', self::$tax_slug );
	}

	protected static function is_nested_function( $function ) {
		$debug = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
		foreach( $debug as $trace ) {
			$functions[] = $trace["function"];
		}
		$values = array_count_values( $functions );
		if ( in_array( $function, $functions ) && $values[ $function ] > 1 ) {
			return true;
		}
		return false;
	}

	public static function maybe_flush_rewrite_rules() {
		global $displetps_admin_option;
		if ( !empty( $displetps_admin_option['flush_rewrite_rules'] ) ) {
			flush_rewrite_rules();
			$displetps_admin_option['flush_rewrite_rules'] = false;
			update_option( self::$admin_option, $displetps_admin_option );
		}
	}

	public static function maybe_insert_default_statuses() {
		global $displetps_admin_option;
		if ( !empty( $displetps_admin_option['insert_default_statuses'] ) ) {
			self::insert_default_statuses();
			$displetps_admin_option['insert_default_statuses'] = false;
			update_option( self::$admin_option, $displetps_admin_option );
		}
	}

	public static function maybe_print_custom_color_scheme_styles() {
		if ( self::$_options['color_scheme'] === 'custom' ) {
			self::get_template_part_by_path( 'displet-custom-color-scheme', 'css' );
		}
	}

	public static function print_javascript_variables(){
		self::get_template_part_by_path( 'displet-javascript-variables', 'js' );
	}

	public static function register_post_types() {
		define( 'EP_DISPLET_SHOWCASE', 67108864 );
		register_post_type( self::$cpt_slug, array(
			'labels' => array(
				'name' => 'Properties',
				'singular_name' => 'Property',
				'add_new_item' => 'Add New Property',
				'edit_item' => 'Edit Property',
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies' => array( self::$tax_slug ),
			'rewrite' => array(
				'slug' => self::$cpt_url_slug,
				'ep_mask' => EP_DISPLET_SHOWCASE,
			),
		));
		add_rewrite_endpoint( 'showcase', EP_DISPLET_SHOWCASE );
	}

	public static function register_taxonomies() {
		register_taxonomy( self::$tax_slug, self::$cpt_slug, array(
			'labels' => array(
				'name' => 'Statuses',
				'singular_name' => 'Status',
				'add_new_item' => 'Add New Status',
			),
			'hierarchical' => true,
		) );
	}

	private static function render_template( $path, &$model ) {
		if ( file_exists( $path ) ) {
			ob_start();
			include $path;
			$output = ob_get_contents();
			ob_end_clean();
			DispletPropertyShowcasePages::maybe_filter_post_thumbnail();
			return trim( $output );
		}
	}

	public static function save_meta_fields( $post_id ) {
		if ( $_POST['post_type'] != self::$cpt_slug || !current_user_can( 'edit_post', $post_id ) ) return;
		if ( !isset( $_POST['displetpropertyshowcase_custom_nonce'] ) || !wp_verify_nonce( $_POST['displetpropertyshowcase_custom_nonce'], 'save_meta_fields_nonce' ) ) return;
		if ( isset( $_REQUEST['displetpropertyshowcase_headline'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_headline', sanitize_text_field( $_POST['displetpropertyshowcase_headline'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_address'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_address', sanitize_text_field( $_POST['displetpropertyshowcase_address'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_city'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_city', sanitize_text_field( $_POST['displetpropertyshowcase_city'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_state'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_state', sanitize_text_field( $_POST['displetpropertyshowcase_state'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_zip'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_zip', sanitize_text_field( $_POST['displetpropertyshowcase_zip'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_subdivision'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_subdivision', sanitize_text_field( $_POST['displetpropertyshowcase_subdivision'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_price'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_price', sanitize_text_field( $_POST['displetpropertyshowcase_price'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_bedrooms'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_bedrooms', sanitize_text_field( $_POST['displetpropertyshowcase_bedrooms'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_bathrooms'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_bathrooms', sanitize_text_field( $_POST['displetpropertyshowcase_bathrooms'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_size'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_size', sanitize_text_field( $_POST['displetpropertyshowcase_size'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_virtual_tour_url'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_virtual_tour_url', sanitize_text_field( $_POST['displetpropertyshowcase_virtual_tour_url'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_video_url'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_video_url', sanitize_text_field( $_POST['displetpropertyshowcase_video_url'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_elementary_school'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_elementary_school', sanitize_text_field( $_POST['displetpropertyshowcase_elementary_school'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_middle_school'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_middle_school', sanitize_text_field( $_POST['displetpropertyshowcase_middle_school'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_junior_high_school'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_junior_high_school', sanitize_text_field( $_POST['displetpropertyshowcase_junior_high_school'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_high_school'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_high_school', sanitize_text_field( $_POST['displetpropertyshowcase_high_school'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_school_district'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_school_district', sanitize_text_field( $_POST['displetpropertyshowcase_school_district'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_school_description_header'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_school_description_header', sanitize_text_field( $_POST['displetpropertyshowcase_school_description_header'] ) );
		}
		if ( isset( $_REQUEST['displetpropertyshowcase_school_description'] ) ) {
			update_post_meta( $_POST['post_ID'], 'displetpropertyshowcase_school_description', sanitize_text_field( $_POST['displetpropertyshowcase_school_description'] ) );
		}
		foreach ( self::$_numeric_fields as $field ) {
			if ( isset( $_REQUEST[ $field ] ) ) {
				update_post_meta( $_POST['post_ID'], $field . '_value', self::get_integer_value( sanitize_text_field( $_POST[ $field ] ) ) );
			}
		}
	}

	private static function stripslashes_deep( $value ) {
    	$value = is_array( $value ) ? array_map( array( 'DispletPropertyShowcase', 'stripslashes_deep' ), $value ) : stripslashes( $value );
    	return $value;
	}

	public static function trigger_default_statuses_insertion() {
		$option = self::get_option( self::$admin_option );
		$option['insert_default_statuses'] = true;
		update_option( self::$admin_option, $option );
	}

	public static function trigger_flush_rewrite_rules() {
		$option = get_option( self::$admin_option );
		$option['flush_rewrite_rules'] = true;
		update_option( self::$admin_option, $option );
	}
}

register_activation_hook( __FILE__, array( 'DispletPropertyShowcase', 'trigger_default_statuses_insertion' ) );
register_activation_hook( __FILE__, array( 'DispletPropertyShowcase', 'trigger_flush_rewrite_rules' ) );

require_once( 'displet-requires.php' );

?>