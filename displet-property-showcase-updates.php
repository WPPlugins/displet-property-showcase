<?php

class DispletPropertyShowcaseUpdates extends DispletPropertyShowcase {
	protected static $_last_version;

	public static function maybe_update() {
		self::$_last_version = get_option( self::$_slugs['option_version'] );
		if ( empty( self::$_last_version ) || version_compare( self::$version, self::$_last_version, '>' ) ) {
			if ( version_compare( '1.1.6', self::$_last_version, '>' ) ) {
				self::update_to_1_1_6();
			}
			update_option( self::$_slugs['option_version'], self::$version );
		}
	}

	private static function update_to_1_1_6() {
		self::add_numeric_values_to_property_showcase_post_meta_fields();
	}

	private static function add_numeric_values_to_property_showcase_post_meta_fields() {
		$posts = self::get_all_property_showcase_posts();
		if ( !empty( $posts ) ) {
			foreach ( $posts as $post ) {
				foreach ( self::$_numeric_fields as $field ) {
					if ( !empty( $post->{$field} ) ) {
						update_post_meta( $post->ID, $field . '_value', self::get_integer_value( $post->{$field} ) );
					}
				}
			}
		}
	}
}

?>