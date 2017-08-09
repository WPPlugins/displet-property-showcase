<?php

class DispletPropertyShowcaseSPW extends DispletPropertyShowcasePages {
	public static function add_value_to_showcase_query_var( $vars ){
		if ( isset( $vars['showcase'] ) && $vars['showcase'] === '' ) {
			$vars['showcase'] = true;
		}
		return $vars;
	}

	public static function is_spw() {
		return self::$_model['is_spw'];
	}

	public static function is_unbranded_spw() {
		return self::$_model['is_unbranded_spw'];
	}

	protected static function maybe_redirect_to_spw() {
		global $wp_query;
		if ( isset( $wp_query->query_vars['showcase'] ) ) {
			global $post;
			$url = trailingslashit( get_permalink( $post->ID ) ) . 'showcase';
			wp_safe_redirect( $url, 301 );
		}
	}

	public static function maybe_use_spw_template() {
		if ( self::is_spw() ) {
			add_filter( 'template_include', array( 'DispletPropertyShowcaseSPW', 'use_spw_template' ) );
		}
		else if ( is_singular( self::$cpt_slug ) ) {
			self::maybe_redirect_to_spw();
		}
	}

	public static function use_spw_template( $template ) {
		self::get_template_part( 'displet-showcase' );
	}
}

?>