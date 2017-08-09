<?php

class DispletPropertyShowcaseArchive extends DispletPropertyShowcasePages {
	protected static $_posts_per_page = 6;

	public static function get_next_properties_url() {
		if ( !empty( self::$_model['query_vars']['page'] ) ) {
			$next_page = self::$_model['query_vars']['page'] + 1;
		}
		else {
			$next_page = 2;
		}
		$url = trailingslashit( self::$_model['permalink'] ) . 'page/' . $next_page;
		return $url;
	}

	public static function get_previous_properties_url() {
		$url = trailingslashit( self::$_model['permalink'] );
		if ( !empty( self::$_model['query_vars']['page'] ) && self::$_model['query_vars']['page'] > 2 ) {
			$previous_page = self::$_model['query_vars']['page'] - 1;
			$url .= 'page/' . $previous_page;
		}
		return $url;
	}

	private static function get_offset() {
		if ( !empty( self::$_model['query_vars']['page'] ) ) {
			self::$_model['offset'] = ( self::$_model['query_vars']['page'] - 1 ) * self::$_posts_per_page;
		}
		else {
			self::$_model['offset'] = 0;
		}
	}

	private static function get_posts() {
		self::$_model['posts'] = get_posts( array(
			'post_type' => self::$cpt_slug,
			'posts_per_page' => self::$_posts_per_page,
			'offset' => self::$_model['offset'],
		) );
		self::$_model['posts_index'] = 0;
	}

	private static function get_posts_count() {
		$count = wp_count_posts( self::$cpt_slug );
		self::$_model['count'] = $count->publish;
	}

	public static function has_next_properties_url() {
		if ( self::$_model['count'] > self::$_model['offset'] + self::$_posts_per_page - 1 ) {
			return true;
		}
		return false;
	}

	public static function has_previous_properties_url() {
		if ( self::$_model['offset'] > 0 ) {
			return true;
		}
		return false;
	}

	public static function maybe_build_page_model() {
		if ( self::$_model['is_archive'] ) {
			self::get_offset();
			self::get_posts();
			self::get_posts_count();
			self::set_permalink();
		}
	}

	public static function maybe_filter_posts( $query ) {
		if ( !is_admin() && $query->is_main_query() && is_post_type_archive( self::$cpt_slug ) ) {
			$query->set( 'posts_per_page', 1 );
		}
	}

	public static function maybe_use_archive_template() {
		if ( self::$_model['is_archive'] ) {
			add_filter( 'template_include', array( 'DispletPropertyShowcaseArchive', 'use_archive_template' ) );
			add_filter( 'the_content', array( 'DispletPropertyShowcaseArchive', 'replace_page_content' ) );
			add_filter( 'the_title', array( 'DispletPropertyShowcaseArchive', 'replace_page_title' ) );
		}
	}

	public static function replace_page_content( $content ) {
		if ( in_the_loop() && !self::is_nested_function( 'replace_page_content' ) ) {
			remove_filter( 'the_title', array( 'DispletPropertyShowcaseArchive', 'replace_page_title' ) );
			remove_filter( 'get_post_metadata', array( 'DispletPropertyShowcasePages', 'maybe_remove_post_thumbnail' ), true, 4 );
			return self::get_template_part( 'displet-archive', self::$_model );
		}
		return $content;
	}

	public static function replace_page_title( $title ) {
		if ( in_the_loop() ) {
			return self::$_options['archive_title'];
		}
		return $title;
	}

	private static function set_permalink() {
		self::$_model['permalink'] = home_url( self::$cpt_url_slug );
	}

	public static function use_archive_template() {
		if ( !empty( self::$_options['archive_template_filename'] ) ) {
			$template = preg_replace( '/.php$/', '', self::$_options['archive_template_filename'] );
		}
		else{
			$template = 'page';
		}
		get_template_part( $template );
	}
}

?>