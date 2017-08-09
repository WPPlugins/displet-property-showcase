<div id="displet-showcase-header" class="<?php displetps_the_default_styles_class(); ?> <?php displetps_the_color_scheme_class(); ?>">
	<?php if ( !displetps_is_unbranded() ) : ?>
		<div class="displet-group">
			<?php if ( displetps_has_headshot() ) : ?>
				<div class="displet-headshot displet-right displet-480-show">
					<?php displetps_the_headshot(); ?>
				</div>
			<?php endif; ?>
			<?php if ( displetps_has_logo() ) : ?>
				<a href="<?php echo home_url(); ?>" class="displet-logo displet-left<?php if ( displetps_has_headshot() ) echo ' displet-with-headshot'; ?>">
					<?php displetps_the_logo(); ?>
				</a>
			<?php endif; ?>
			<?php if ( displetps_has_headshot() ) : ?>
				<div class="displet-headshot displet-left displet-480-hide">
					<?php displetps_the_headshot(); ?>
				</div>
			<?php endif; ?>
			<?php if ( displetps_has_phone() || displetps_has_email() || displetps_has_website() ) : ?>
				<div class="displet-banner displet-right">
					<div class="displet-banner-interior">
						<?php if ( displetps_has_phone() ) : ?>
							<div class="displet-phone">
								<a class="displet-light-color" href="<?php displetps_the_phone_url(); ?>">
									<div>
										<?php displetps_the_phone(); ?>
									</div>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( displetps_has_email() ) : ?>
							<div class="displet-email">
								<a class="displet-highlight-color" href="<?php displetps_the_email_url(); ?>">
									<div>
										<?php displetps_the_email(); ?>
									</div>
								</a>
							</div>
						<?php endif; ?>
						<?php if ( displetps_has_website() ) : ?>
							<div class="displet-website">
								<a class="displet-highlight-color" href="<?php displetps_the_website_url(); ?>">
									<div>
										<?php displetps_the_website(); ?>
									</div>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ( displetps_has_menu() ) : ?>
		<div class="displet-navigation displet-group">
			<?php displetps_the_menu(); ?>
		</div>
	<?php endif; ?>
</div>