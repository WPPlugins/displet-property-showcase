<div id="displet-showcase-footer" class="<?php displetps_the_default_styles_class(); ?> <?php displetps_the_color_scheme_class(); ?> displet-group">
	<?php if ( displetps_has_menu() ) : ?>
		<div class="displet-navigation displet-group displet-color">
			<?php displetps_the_menu(); ?>
		</div>
	<?php endif; ?>
	<?php if ( !displetps_is_unbranded() ) : ?>
		<?php if ( displetps_has_office_address() ) : ?>
			<div class="displet-address displet-left displet-light-color">
				<?php displetps_the_office_address(); ?>
			</div>
		<?php endif; ?>
		<div class="displet-align-right">
			<?php if ( displetps_has_website() ) : ?>
				<a class="displet-website displet-highlight-color" href="<?php displetps_the_website_url(); ?>">
					<?php displetps_the_website(); ?>
				</a>
			<?php endif; ?>
			<div class="displet-copyright displet-light-color">
				&copy;
				<?php if ( displetps_has_name() ) : ?>
					<?php displetps_the_name(); ?>
				<?php endif; ?>
				<?php echo date( 'Y' ); ?>.
				All Rights Reserved.
			</div>
		</div>
	<?php endif; ?>
	<div class="displet-credit">
		<span class="displet-light-color">
			Powered By
		</span>
		<a class="displet-color" href="http://displet.com/wordpress-plugins/displet-property-showcase/" target="_blank">
			Displet Property Showcase Plugin
		</a>
	</div>
</div>