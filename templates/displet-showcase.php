<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width"/>
	<title>
		<?php wp_title( ' | ', true, 'right' ); ?>
	</title>
	<?php wp_head(); ?>
</head>
<body id="displet-showcase" <?php body_class( displetps_get_default_styles_class() ); ?>>
	<div class="displet-margin">
		<div class="displet-wrapper">
			<?php displetps_get_template_part( 'displet-showcase-header' ); ?>
			<?php displetps_get_template_part( 'displet-showcase-content' ); ?>
		</div>
		<?php displetps_get_template_part( 'displet-showcase-footer' ); ?>
	</div>
	<?php wp_footer(); ?>
</body>
</html>