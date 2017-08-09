<div id="displet-archive" class="<?php displetps_the_default_styles_class(); ?> <?php displetps_the_color_scheme_class(); ?>">
	<div class="displet-group">
		<?php if ( displetps_have_properties() ) : while ( displetps_have_properties() ) : displetps_the_property(); ?>
			<div class="displet-property displet-left">
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="displet-image" href="<?php the_permalink(); ?>" title="<?php displetps_has_address() ? displetps_the_address() : the_title(); ?>">
						<?php the_post_thumbnail( 'displet-property-showcase-thumbnails' ); ?>
					</a>
				<?php endif; ?>
				<div class="displet-details displet-group">
					<a class="displet-more displet-right displet-dark-highlight-border-top displet-dark-highlight-background-color displet-highlight-background-color-hover" href="<?php the_permalink(); ?>">
						Details
					</a>
					<div class="displet-address displet-dark-color">
						<?php if ( displetps_has_address() ) : ?>
							<?php displetps_the_address(); ?>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</div>
					<?php if ( displetps_has_city() || displetps_has_zip() || displetps_has_state() ) : ?>
						<div class="displet-city-state-zip displet-dark-color">
							<?php displetps_the_city(); ?><?php if ( displetps_has_city() && displetps_has_state() ) echo ','; ?>
							<?php displetps_the_state(); ?>
							<?php displetps_the_zip(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<?php if ( displetps_has_pagination() ) : ?>
		<div class="pagination displet-group">
			<?php if ( displetps_has_previous_properties_url() ) : ?>
				<a class="displet-left" href="<?php displetps_the_previous_properties_url(); ?>">
					Previous
				</a>
			<?php endif; ?>
			<?php if ( displetps_has_next_properties_url() ) : ?>
				<a class="displet-right" href="<?php displetps_the_next_properties_url(); ?>">
					Next
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>