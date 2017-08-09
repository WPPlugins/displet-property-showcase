<?php

class DispletPropertyShowcaseSingle extends DispletPropertyShowcasePages {
	public static function maybe_add_single_to_user_toolbar( $wp_admin_bar ) {
		if ( self::$_model['is_spw'] && current_user_can( 'manage_options' ) ) {
			$url = trailingslashit( self::$_model['permalink'] );
    		$wp_admin_bar->add_node(array(
    			'id' => 'displetpropertyshowcase_single_toolbar',
    			'title' => 'View Property',
    			'href' => $url,
    		));
		}
	}

	public static function maybe_add_spw_to_user_toolbar( $wp_admin_bar ) {
		if ( self::$_model['is_single'] && ( !self::$_model['is_spw'] || self::$_model['is_unbranded_spw'] ) && current_user_can( 'manage_options' ) ) {
			$url = trailingslashit( self::$_model['permalink'] ) . 'showcase';
    		$wp_admin_bar->add_node(array(
    			'id' => 'displetpropertyshowcase_spw_toolbar',
    			'title' => 'View Showcase',
    			'href' => $url,
    		));
		}
	}

	public static function maybe_add_unbranded_spw_to_user_toolbar( $wp_admin_bar ) {
		if ( self::$_model['is_single'] && !self::$_model['is_unbranded_spw'] && current_user_can( 'manage_options' ) ) {
			$url = trailingslashit( self::$_model['permalink'] ) . 'showcase/unbranded';
    		$wp_admin_bar->add_node(array(
    			'id' => 'displetpropertyshowcase_unbranded_spw_toolbar',
    			'title' => 'View Unbranded Showcase',
    			'href' => $url,
    		));
		}
	}

	public static function maybe_build_page_model() {
		if ( self::$_model['is_single'] ) {
			self::set_permalink();
		}
	}

	public static function maybe_use_single_template() {
		if ( self::$_model['is_single'] && !self::$_model['is_spw'] ) {
			add_filter( 'template_include', array( 'DispletPropertyShowcaseSingle', 'use_single_template' ) );
			add_filter( 'the_content', array( 'DispletPropertyShowcaseSingle', 'replace_page_content' ) );
		}
	}

	public static function replace_page_content( $content ) {
		if ( in_the_loop() && !self::is_nested_function( 'replace_page_content' ) ) {
			remove_filter( 'get_post_metadata', array( 'DispletPropertyShowcasePages', 'maybe_remove_post_thumbnail' ), true, 4 );
			return self::get_template_part( 'displet-single' );
		}
		return $content;
	}

	private static function set_permalink() {
		global $post;
		self::$_model['permalink'] = get_permalink( $post->ID );
	}

	public static function use_single_template() {
		global $displetps_option;
		if ( !empty( $displetps_option['single_template_filename'] ) ) {
			$template = preg_replace( '/.php$/', '', $displetps_option['single_template_filename'] );
		}
		else{
			$template = 'page';
		}
		get_template_part( $template );
	}
}

?>