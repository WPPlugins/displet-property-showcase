<?php

require_once( 'displet-hooks.php' );
require_once( 'displet-library.php' );
require_once( 'displet-property-showcase-updates.php' );

require_once( 'pages/displet-property-showcase-pages.php' ); // Parent class of /pages/*.php
require_once( 'pages/displet-property-showcase-archive.php' );
require_once( 'pages/displet-property-showcase-single.php' );
require_once( 'pages/displet-property-showcase-spw.php' );

if ( is_admin() ) {
	require_once( 'displet-settings.php' );
}

?>