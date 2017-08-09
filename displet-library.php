<?php

/**
 * @param: $slug: filename without '.php' of a PHP file
 * @return: print: require
 */
function displetps_get_template_part( $slug ) {
	DispletPropertyShowcase::get_template_part( $slug );
}

/**
 * @return: CSS class
 */
function displetps_get_default_styles_class() {
	return 'displet-property-showcase-styles';
}

/**
 * @return: print: CSS class
 */
function displetps_the_default_styles_class() {
	echo 'displet-property-showcase-styles';
}

/**
 * @return: print: CSS class
 */
function displetps_the_color_scheme_class() {
	global $displetps_option;
	if ( !empty( $displetps_option['color_scheme'] ) ) {
		$color_scheme = $displetps_option['color_scheme'];
	}
	else {
		$color_scheme = 'blue';
	}
	echo 'displet-' . $color_scheme . '-color-scheme';
}

/**
 * @return: boolean
 */
function displetps_is_unbranded() {
	return DispletPropertyShowcaseSPW::is_unbranded_spw();
}

/**
 * @return: boolean
 */
function displetps_has_logo() {
	global $displetps_option;
	if ( !empty( $displetps_option['logo_id'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: HTML markup (img)
 */
function displetps_the_logo() {
	global $displetps_option;
	$image = wp_get_attachment_image_src( $displetps_option['logo_id'], 'displet-property-showcase-logo' );
	if ( !empty( $image[0] ) ) {
		echo '<img src="' . $image[0] . '"/>';
	}
}

/**
 * @return: boolean
 */
function displetps_has_headshot() {
	global $displetps_option;
	if ( !empty( $displetps_option['headshot_id'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: HTML markup (img)
 */
function displetps_the_headshot() {
	global $displetps_option;
	$image = wp_get_attachment_image_src( $displetps_option['headshot_id'], 'displet-property-showcase-headshot' );
	if ( !empty( $image[0] ) ) {
		echo '<img src="' . $image[0] . '"/>';
	}
}

/**
 * @return: boolean
 */
function displetps_has_phone() {
	global $displetps_option;
	if ( !empty( $displetps_option['phone_number'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetps_has_phone_url() {
	displetps_has_phone();
}

/**
 * @return: print: text
 */
function displetps_the_phone() {
	global $displetps_option;
	echo $displetps_option['phone_number'];
}

/**
 * @return: print: url
 */
function displetps_the_phone_url() {
	global $displetps_option;
	echo DispletPropertyShowcase::get_phone_url( $displetps_option['phone_number'] );
}

/**
 * @return: boolean
 */
function displetps_has_email() {
	global $displetps_option;
	if ( !empty( $displetps_option['email_address'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetps_has_email_url() {
	displetps_has_email();
}

/**
 * @return: print: text
 */
function displetps_the_email() {
	global $displetps_option;
	echo $displetps_option['email_address'];
}

/**
 * @return: print: url
 */
function displetps_the_email_url() {
	global $displetps_option;
	echo 'mailto:' . $displetps_option['email_address'];
}

/**
 * @return: boolean
 */
function displetps_has_website() {
	global $displetps_option;
	if ( !empty( $displetps_option['website_url'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetps_has_website_url() {
	displetps_has_website();
}

/**
 * @return: print: text
 */
function displetps_the_website() {
	global $displetps_option;
	echo DispletPropertyShowcase::get_unprefixed_url( $displetps_option['website_url'] );
}

/**
 * @return: print: url
 */
function displetps_the_website_url() {
	global $displetps_option;
	echo $displetps_option['website_url'];
}

/**
 * @return: boolean
 */
function displetps_has_menu() {
	$menu_items = 0;
	if ( displetps_has_property_info_section() ) {
		$menu_items++;
	}
	if ( displetps_has_photos_section() ) {
		$menu_items++;
	}
	if ( displetps_has_video_section() ) {
		$menu_items++;
	}
	if ( displetps_has_map_section() ) {
		$menu_items++;
	}
	if ( displetps_has_schools_section() ) {
		$menu_items++;
	}
	if ( $menu_items > 1 ) {
		return true;
	}
	return false;
}

/**
 * @return: print: HTML markup (ul > li > a)
 */
function displetps_the_menu() {
	$output = '<ul>';
	if ( displetps_has_property_info_section() ) {
		$output .= '<li><a class="displet-active" href="#property-info">Property Info</a></li>';
	}
	if ( displetps_has_photos_section() ) {
		$output .= '<li><a href="#photos">Photos</a></li>';
	}
	if ( displetps_has_video_section() ) {
		$output .= '<li><a href="#video">Video</a></li>';
	}
	if ( displetps_has_map_section() ) {
		$output .= '<li><a href="#map">Map</a></li>';
	}
	if ( displetps_has_schools_section() ) {
		$output .= '<li><a href="#schools">Schools</a></li>';
	}
	$output .= '</ul>';
	echo $output;
}

/**
 * @return: boolean
 */
function displetps_has_property_info_section() {
	$meta_fields = array(
		'displetpropertyshowcase_address',
		'displetpropertyshowcase_city',
		'displetpropertyshowcase_state',
		'displetpropertyshowcase_zip',
		'displetpropertyshowcase_subdivision',
		'displetpropertyshowcase_price',
		'displetpropertyshowcase_bedrooms',
		'displetpropertyshowcase_bathrooms',
		'displetpropertyshowcase_size',
		'displetpropertyshowcase_virtual_tour_url',
	);
	if ( DispletPropertyShowcase::has_any_post_meta_fields( $meta_fields ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS class
 */
function displetps_the_property_info_section_class() {
	echo 'displet-property-info-section displet-section';
}

/**
 * @return: boolean
 */
function displetps_has_photos_section() {
	return displetps_has_photos();
}

/**
 * @return: print: CSS class
 */
function displetps_the_photos_section_class() {
	echo 'displet-photos-section displet-section';
}

/**
 * @return: boolean
 */
function displetps_has_video_section() {
	return displetps_has_video();
}

/**
 * @return: print: CSS class
 */
function displetps_the_video_section_class() {
	echo 'displet-video-section displet-section';
}

/**
 * @return: boolean
 */
function displetps_has_map_section() {
	$meta_fields = array(
		'displetpropertyshowcase_address',
	);
	if ( DispletPropertyShowcase::has_any_post_meta_fields( $meta_fields ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS class
 */
function displetps_the_map_section_class() {
	echo 'displet-map-section displet-section';
}

/**
 * @return: boolean
 */
function displetps_has_schools_section() {
	$meta_fields = array(
		'displetpropertyshowcase_elementary_school',
		'displetpropertyshowcase_middle_school',
		'displetpropertyshowcase_junior_high_school',
		'displetpropertyshowcase_high_school',
		'displetpropertyshowcase_school_district',
		'displetpropertyshowcase_school_description',
	);
	if ( DispletPropertyShowcase::has_any_post_meta_fields( $meta_fields ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS class
 */
function displetps_the_schools_section_class() {
	echo 'displet-schools-section displet-section';
}

/**
 * @return: boolean
 */
function displetps_has_photo() {
	if ( DispletPropertyShowcase::has_featured_image() ) {
		return true;
	}
	return false;
}

/**
 * @return: print: HTML markup (img)
 */
function displetps_the_photo() {
	$size = DispletPropertyShowcaseSPW::is_spw() ? 'displet-property-showcase-property-info' : 'displet-property-showcase-photos';
	the_post_thumbnail( $size );
}

/**
 * @return: boolean
 */
function displetps_has_photos() {
	if ( DispletPropertyShowcaseSPW::has_attached_image() ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetps_has_photos_url() {
	displetps_has_photos();
}

/**
 * @return: print: url
 */
function displetps_the_photos_url() {
	echo '#photos';
}

/**
 * @return: boolean
 */
function displetps_has_headline() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_headline ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_headline() {
	global $post;
	echo $post->displetpropertyshowcase_headline;
}

/**
 * @return: boolean
 */
function displetps_has_address() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_address ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_address() {
	global $post;
	echo $post->displetpropertyshowcase_address;
}

/**
 * @return: boolean
 */
function displetps_has_city() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_city ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_city() {
	global $post;
	echo $post->displetpropertyshowcase_city;
}

/**
 * @return: boolean
 */
function displetps_has_state() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_state ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_state() {
	global $post;
	echo $post->displetpropertyshowcase_state;
}

/**
 * @return: boolean
 */
function displetps_has_zip() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_zip ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_zip() {
	global $post;
	echo $post->displetpropertyshowcase_zip;
}

/**
 * @return: boolean
 */
function displetps_has_status() {
	return DispletPropertyShowcase::has_status();
}

/**
 * @return: print: text
 */
function displetps_the_status() {
	$statuses = DispletPropertyShowcase::get_status_names();
	if ( !empty( $statuses ) ) {
		echo implode( ', ' , $statuses );
	}
}

/**
 * @return: boolean
 */
function displetps_has_price() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_price ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_price() {
	global $post;
	echo $post->displetpropertyshowcase_price;
}

/**
 * @return: boolean
 */
function displetps_has_subdivision() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_subdivision ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_subdivision() {
	global $post;
	echo $post->displetpropertyshowcase_subdivision;
}

/**
 * @return: boolean
 */
function displetps_has_bedrooms() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_bedrooms ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_bedrooms() {
	global $post;
	echo $post->displetpropertyshowcase_bedrooms;
}

/**
 * @return: boolean
 */
function displetps_has_bathrooms() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_bathrooms ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_bathrooms() {
	global $post;
	echo $post->displetpropertyshowcase_bathrooms;
}

/**
 * @return: boolean
 */
function displetps_has_size() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_size ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_size() {
	global $post;
	echo $post->displetpropertyshowcase_size;
}

/**
 * @return: boolean
 */
function displetps_has_virtual_tour() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_virtual_tour_url ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetps_has_virtual_tour_url() {
	displetps_has_virtual_tour_url();
}

/**
 * @return: print: text
 */
function displetps_the_virtual_tour_url() {
	global $post;
	echo $post->displetpropertyshowcase_virtual_tour_url;
}

/**
 * @return: boolean
 */
function displetps_has_description() {
	global $post;
	if ( !empty( $post->post_content ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_description() {
	global $post;
	echo apply_filters( 'the_content', $post->post_content );
}

/**
 * @return: boolean
 */
function displetps_has_photo_slideshow() {
	return displetps_has_photos();
}

/**
 * @return: print: HTML markup (div.displet-photo-slideshow > (ul > li > img, div.displet-photo-slideshow-previous > a, div.displet-photo-slideshow-next > a), div.displet-photo-slideshow-pager > div > a > img)
 */
function displetps_the_photo_slideshow() {
	echo DispletPropertyShowcase::get_photo_slideshow_html();
}

/**
 * @return: boolean
 */
function displetps_has_video() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_video_url ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_video() {
	global $post;
	echo apply_filters( 'the_content', $post->displetpropertyshowcase_video_url );
}

/**
 * @return: print: CSS id
 */
function displetps_the_map_id() {
	echo 'displetpropertyshowcase_showcase_map_canvas';
}

/**
 * @return: boolean
 */
function displetps_has_elementary_school() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_elementary_school ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_elementary_school() {
	global $post;
	echo $post->displetpropertyshowcase_elementary_school;
}

/**
 * @return: boolean
 */
function displetps_has_middle_school() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_middle_school ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_middle_school() {
	global $post;
	echo $post->displetpropertyshowcase_middle_school;
}

/**
 * @return: boolean
 */
function displetps_has_junior_high_school() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_junior_high_school ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_junior_high_school() {
	global $post;
	echo $post->displetpropertyshowcase_junior_high_school;
}

/**
 * @return: boolean
 */
function displetps_has_high_school() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_high_school ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_high_school() {
	global $post;
	echo $post->displetpropertyshowcase_high_school;
}

/**
 * @return: boolean
 */
function displetps_has_school_district() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_school_district ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_school_district() {
	global $post;
	echo $post->displetpropertyshowcase_school_district;
}

/**
 * @return: boolean
 */
function displetps_has_school_description_header() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_school_description_header ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_school_description_header() {
	global $post;
	echo $post->displetpropertyshowcase_school_description_header;
}

/**
 * @return: boolean
 */
function displetps_has_school_description() {
	global $post;
	if ( !empty( $post->displetpropertyshowcase_school_description ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_school_description() {
	global $post;
	echo apply_filters( 'the_content', $post->displetpropertyshowcase_school_description );
}

/**
 * @return: boolean
 */
function displetps_has_office_address() {
	global $displetps_option;
	if ( !empty( $displetps_option['office_address'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_office_address() {
	global $displetps_option;
	echo nl2br( $displetps_option['office_address'] );
}

/**
 * @return: boolean
 */
function displetps_has_name() {
	global $displetps_option;
	if ( !empty( $displetps_option['name'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetps_the_name() {
	global $displetps_option;
	echo $displetps_option['name'];
}

/**
 * @return: boolean
 */
function displetps_have_properties() {
	global $displetps_template;
	if ( !empty( $displetps_template['posts'][ $displetps_template['posts_index'] ] ) ) {
		return true;
	}
	else if ( $displetps_template['posts_index'] === count( $displetps_template['posts'] ) ) {
		$displetps_template['posts_index'] = 0;
		wp_reset_postdata();
		wp_reset_query();
	}
	return false;
}

/**
 * @return: boolean
 */
function displetps_the_property() {
	global $post;
	global $displetps_template;
	$post = $displetps_template['posts'][ $displetps_template['posts_index'] ];
	$displetps_template['posts_index']++;
}

/**
 * @return: boolean
 */
function displetps_has_pagination() {
	global $displetps_template;
	if ( !empty( $displetps_template['count'] ) && $displetps_template['count'] > 6 ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetps_has_previous_properties_url() {
	return DispletPropertyShowcaseArchive::has_previous_properties_url();
}

/**
 * @return: print: URL
 */
function displetps_the_previous_properties_url() {
	echo DispletPropertyShowcaseArchive::get_previous_properties_url();
}

/**
 * @return: print: URL
 */
function displetps_has_next_properties_url() {
	return DispletPropertyShowcaseArchive::has_next_properties_url();
}

/**
 * @return: print: URL
 */
function displetps_the_next_properties_url() {
	echo DispletPropertyShowcaseArchive::get_next_properties_url();
}

?>