<?php

class DispletPropertyShowcasePages extends DispletPropertyShowcase {
	protected static $_model = array(
		'is_archive' => false,
		'is_single' => false,
		'is_spw' => false,
		'is_unbranded_spw' => false,
		'permalink' => false,
		'query_vars' => array(
			'page' => false,
			'showcase' => false,
		),
	);

	public static function build_page_model() {
		self::set_query_vars();
		self::determine_pages();
	}

	private static function determine_pages() {
		if ( self::is_single() ) {
			if ( self::is_spw() ) {
				self::$_model['is_spw'] = true;
				if ( self::is_unbranded_spw() ) {
					self::$_model['is_unbranded_spw'] = true;
				}
			}
			self::$_model['is_single'] = true;
		}
		else if ( self::is_archive() ) {
			self::$_model['is_archive'] = true;
		}
	}

	private static function is_archive() {
		if ( is_post_type_archive( self::$cpt_slug ) ) {
			return true;
		}
		return false;
	}

	private static function is_single() {
		if ( is_singular( self::$cpt_slug ) ) {
			return true;
		}
		return false;
	}

	private static function is_spw() {
		if ( self::$_model['query_vars']['showcase'] === true || self::$_model['query_vars']['showcase'] === 'unbranded' ) {
			return true;
		}
		return false;
	}

	private static function is_unbranded_spw() {
		if ( self::$_model['query_vars']['showcase'] === 'unbranded' ) {
			return true;
		}
		return false;
	}

	public static function maybe_filter_body_class( $classes ) {
		if ( ( self::$_model['is_single'] && !self::$_model['is_spw'] ) || self::$_model['is_archive'] ) {
			if ( self::$_model['is_single'] ) {
				$classes_to_remove = array(
					'single',
				);
				$template = self::$_options['single_template_filename'];
			}
			else if ( self::$_model['is_archive'] ) {
				$classes_to_remove = array(
					'archive',
					'post-type-archive',
				);
				$template = self::$_options['archive_template_filename'];
			}
			foreach ( $classes_to_remove as $class ) {
				$key = array_search( $class, $classes );
				if ( !empty( $key ) || $key === 0 ) {
					unset( $classes[ $key ] );
				}
			}
			if ( $template === 'page.php' ) {
				$template_class = 'page-template-default';
			}
			else {
				$template_class = 'page-template-' . sanitize_html_class( str_replace( '.', '-', $template ) );
			}
			$classes_to_add = array(
				'page',
				'page-template',
				$template_class,
				basename( $template, '.php' ),
			);
			return array_merge( $classes_to_add, $classes );
		}
		return $classes;
	}

	public static function maybe_filter_post_thumbnail() {
		if ( ( self::$_model['is_single'] && !self::$_model['is_spw'] ) || self::$_model['is_archive'] ) {
			add_filter( 'get_post_metadata', array( 'DispletPropertyShowcasePages', 'maybe_remove_post_thumbnail' ), true, 4 );
		}
	}

	public static function maybe_remove_post_thumbnail( $metadata, $object_id, $meta_key, $single ) {
		if ( isset( $meta_key ) && '_thumbnail_id' === $meta_key && in_the_loop() && !self::has_referral_function( array( 'get_sidebar', 'get_header', 'get_footer' ) ) ) {
        	return false;
		}
		return $metadata;
	}

	private static function set_query_vars() {
		self::$_model['query_vars']['page'] = get_query_var( 'paged' );
		self::$_model['query_vars']['showcase'] = get_query_var( 'showcase' );
	}
}

?>