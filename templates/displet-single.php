<div id="displet-single" class="<?php displetps_the_default_styles_class(); ?>">
	<div id="displet-showcase-header" class="<?php displetps_the_default_styles_class(); ?> <?php displetps_the_color_scheme_class(); ?>">
		<?php if ( displetps_has_menu() ) : ?>
			<div class="displet-navigation displet-group">
				<?php displetps_the_menu(); ?>
			</div>
		<?php endif; ?>
	</div>
	<?php displetps_get_template_part( 'displet-showcase-content' ); ?>
</div>