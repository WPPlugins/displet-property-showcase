<?php
	global $displetps_option;
	if ( $displetps_option['images_color'] === 'green' ) {
		$navigation_background_color = '78c653';
	}
	else if ( $displetps_option['images_color'] === 'red' ) {
		$navigation_background_color = 'f3383e';
	}
	else if ( $displetps_option['images_color'] === 'orange' ) {
		$navigation_background_color = 'f68226';
	}
	else {
		$navigation_background_color = '559fd3';
	}
	if ( $displetps_option['images_color'] === 'green' ) {
		$photo_banner_background_color = '69bc48';
	}
	else if ( $displetps_option['images_color'] === 'red' ) {
		$photo_banner_background_color = 'f13136';
	}
	else if ( $displetps_option['images_color'] === 'orange' ) {
		$photo_banner_background_color = 'f47121';
	}
	else {
		$photo_banner_background_color = 'dea035';
	}
?>
<style type="text/css">
/* Custom Color Scheme */
body .displet-custom-color-scheme .displet-highlight-color,
body .displet-custom-color-scheme .displet-highlight-color *{
	color: <?php echo $displetps_option['highlight_color']; ?> !important;
}

body .displet-custom-color-scheme .displet-highlight-background-color-hover:hover{
	background-color: <?php echo $displetps_option['highlight_color']; ?> !important;
}

body .displet-custom-color-scheme .displet-dark-highlight-color,
body .displet-custom-color-scheme .displet-dark-highlight-color *{
	color: <?php echo $displetps_option['dark_highlight_color']; ?> !important;
}

body .displet-custom-color-scheme .displet-dark-highlight-background-color{
	background-color: <?php echo $displetps_option['dark_highlight_color']; ?> !important;
}

body .displet-custom-color-scheme .displet-dark-highlight-border-top{
	border-top: 1px solid <?php echo $displetps_option['dark_highlight_color']; ?> !important;
}

body #displet-showcase-header.displet-custom-color-scheme .displet-navigation a:hover,
body #displet-showcase-header.displet-custom-color-scheme .displet-navigation a.displet-active{
	background: #<?php echo $navigation_background_color; ?> url('<?php echo plugins_url('displet-property-showcase/css') ?>/images/<?php echo $displetps_option['images_color']; ?>/navigationahovback.png') 0px 0px repeat-x !important;
}

body #displet-showcase-content.displet-custom-color-scheme .displet-more-photos a{
	background: url('<?php echo plugins_url('displet-property-showcase/css') ?>/images/<?php echo $displetps_option['images_color']; ?>/morephotosleft.png') 0px 0px no-repeat !important;
}

body #displet-showcase-content.displet-custom-color-scheme .displet-photo-banner{
	background: url('<?php echo plugins_url('displet-property-showcase/css') ?>/images/<?php echo $displetps_option['images_color']; ?>/photobannerbottomright.png') right bottom no-repeat !important;
}

body #displet-showcase-content.displet-custom-color-scheme .displet-photo-banner-inner{
	background: url('<?php echo plugins_url('displet-property-showcase/css') ?>/images/<?php echo $displetps_option['images_color']; ?>/photobannerleft.png') 0px 0px repeat-y !important;
}

body #displet-showcase-content.displet-custom-color-scheme .displet-photo-banner-inner div{
	background-color: #<?php echo $photo_banner_background_color; ?> !important;
}

body #displet-showcase-content.displet-custom-color-scheme .displet-photo-slideshow-pager a.active::after,
body #displet-showcase-content.displet-custom-color-scheme .displet-photo-slideshow-pager a:hover::after{
	box-shadow: inset 0px 0px 0px 2px <?php echo $displetps_option['highlight_color']; ?> !important;
}
</style>