<div id="displet-showcase-content" class="<?php displetps_the_default_styles_class(); ?> <?php displetps_the_color_scheme_class(); ?>">
	<?php if ( displetps_has_property_info_section() ) : ?>
		<div class="displet-property-info <?php displetps_the_property_info_section_class(); ?>">
			<div class="displet-address displet-480-show displet-border-color">
				<h2 class="displet-street-address displet-dark-color">
					<?php if ( displetps_has_address() ) : ?>
						<?php displetps_the_address(); ?>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</h2>
				<?php if ( displetps_has_city() || displetps_has_zip() || displetps_has_state() ) : ?>
					<h2 class="displet-city-state-zip displet-dark-color">
						<?php displetps_the_city(); ?><?php if ( displetps_has_city() && displetps_has_state() ) echo ','; ?>
						<?php displetps_the_state(); ?>
						<?php displetps_the_zip(); ?>
					</h2>
				<?php endif; ?>
			</div>
			<div class="displet-group">
				<?php if ( displetps_has_photo() ) : ?>
					<div class="displet-photo displet-right">
						<?php displetps_the_photo(); ?>
						<?php if ( displetps_has_headline() ) : ?>
							<div class="displet-photo-banner">
								<div class="displet-photo-banner-inner">
									<div>
										<?php displetps_the_headline(); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php if ( displetps_has_photos() ) : ?>
							<div class="displet-more-photos displet-light-color">
								<a href="<?php displetps_the_photos_url(); ?>">
									View More Photos
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="displet-property <?php if ( displetps_has_photo() ) echo ' displet-with-photos'; ?>">
					<div class="displet-address displet-480-hide displet-border-color">
						<h1 class="displet-street-address displet-dark-color">
							<?php if ( displetps_has_address() ) : ?>
								<?php displetps_the_address(); ?>
							<?php else : ?>
								<?php the_title(); ?>
							<?php endif; ?>
						</h1>
						<?php if ( displetps_has_city() || displetps_has_zip() || displetps_has_state() ) : ?>
							<h2 class="displet-city-state-zip displet-dark-color">
								<?php displetps_the_city(); ?><?php if ( displetps_has_city() && displetps_has_state() ) echo ','; ?>
								<?php displetps_the_state(); ?>
								<?php displetps_the_zip(); ?>
							</h2>
						<?php endif; ?>
					</div>
					<?php if ( displetps_has_subdivision() || displetps_has_price() || displetps_has_bedrooms() || displetps_has_bathrooms() || displetps_has_size() || displetps_has_virtual_tour() ) : ?>
						<div class="displet-details">
							<?php if ( displetps_has_status() ) : ?>
								<div class="displet-detail">
									<span class="displet-color">
										Status:
									</span>
									<span class="displet-dark-highlight-color">
										<?php displetps_the_status(); ?>
									</span>
								</div>
							<?php endif; ?>
							<?php if ( displetps_has_price() ) : ?>
								<div class="displet-detail">
									<span class="displet-color">
										List Price:
									</span>
									<span class="displet-dark-highlight-color">
										$<?php displetps_the_price(); ?>
									</span>
								</div>
							<?php endif; ?>
							<?php if ( displetps_has_subdivision() ) : ?>
								<div class="displet-detail">
									<span class="displet-color">
										Subdivision:
									</span>
									<span class="displet-dark-highlight-color">
										<?php displetps_the_subdivision(); ?>
									</span>
								</div>
							<?php endif; ?>
							<?php if ( displetps_has_bedrooms() || displetps_has_bathrooms() ) : ?>
								<div class="displet-detail">
									<span class="displet-color">
										<?php if ( displetps_has_bedrooms() ) : ?>
											Beds<?php if ( !displetps_has_bathrooms() ) echo ':'; ?>
										<?php endif; ?>
										<?php if ( displetps_has_bedrooms() && displetps_has_bathrooms() ) : ?>
											/
										<?php endif; ?>
										<?php if ( displetps_has_bathrooms() ) : ?>
											Baths:
										<?php endif; ?>
									</span>
									<span class="displet-dark-highlight-color">
										<?php if ( displetps_has_bedrooms() ) : ?>
											<?php displetps_the_bedrooms(); ?>
										<?php endif; ?>
										<?php if ( displetps_has_bedrooms() && displetps_has_bathrooms() ) : ?>
											/
										<?php endif; ?>
										<?php if ( displetps_has_bathrooms() ) : ?>
											<?php displetps_the_bathrooms(); ?>
										<?php endif; ?>
									</span>
								</div>
							<?php endif; ?>
							<?php if ( displetps_has_size() ) : ?>
								<div class="displet-detail">
									<span class="displet-color">
										Size:
									</span>
									<span class="displet-dark-highlight-color">
										<?php displetps_the_size(); ?>
									</span>
								</div>
							<?php endif; ?>
							<?php if ( displetps_has_virtual_tour() ) : ?>
								<div class="displet-detail">
									<span class="displet-color">
										Virtual Tour:
									</span>
									<a class="displet-dark-highlight-color" href="<?php displetps_the_virtual_tour_url(); ?>" target="_blank">
										<?php displetps_the_virtual_tour_url(); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( displetps_has_description() ) : ?>
				<div class="displet-description displet-light-color">
					<h2 class="displet-dark-color">
						About The Property
					</h2>
					<?php displetps_the_description(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ( displetps_has_photos_section() ) : ?>
		<div class="<?php displetps_the_photos_section_class(); ?>">
			<div class="displet-group">
				<?php if ( displetps_has_headline() ) : ?>
					<div class="displet-headline displet-right displet-768-hide displet-highlight-color">
						<?php displetps_the_headline(); ?>
					</div>
				<?php endif; ?>
				<div class="displet-address displet-border-color">
					<h2 class="displet-street-address displet-dark-color">
						<?php if ( displetps_has_address() ) : ?>
							<?php displetps_the_address(); ?>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</h2>
					<?php if ( displetps_has_city() || displetps_has_zip() || displetps_has_state() ) : ?>
						<h2 class="displet-city-state-zip displet-dark-color">
							<?php displetps_the_city(); ?><?php if ( displetps_has_city() && displetps_has_state() ) echo ','; ?>
							<?php displetps_the_state(); ?>
							<?php displetps_the_zip(); ?>
						</h2>
					<?php endif; ?>
				</div>
				<?php if ( displetps_has_headline() ) : ?>
					<div class="displet-headline displet-768-show displet-highlight-color">
						<?php displetps_the_headline(); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="displet-details">
				<?php if ( displetps_has_photo_slideshow() ) : ?>
					<div class="displet-slideshow displet-group">
						<?php displetps_the_photo_slideshow(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( displetps_has_video_section() ) : ?>
		<div class="<?php displetps_the_video_section_class(); ?>">
			<div class="displet-address displet-border-color">
				<h2 class="displet-street-address displet-dark-color">
					<?php if ( displetps_has_address() ) : ?>
						<?php displetps_the_address(); ?>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</h2>
				<?php if ( displetps_has_city() || displetps_has_zip() || displetps_has_state() ) : ?>
					<h2 class="displet-city-state-zip displet-dark-color">
						<?php displetps_the_city(); ?><?php if ( displetps_has_city() && displetps_has_state() ) echo ','; ?>
						<?php displetps_the_state(); ?>
						<?php displetps_the_zip(); ?>
					</h2>
				<?php endif; ?>
			</div>
			<?php if ( displetps_has_video() ) : ?>
				<div class="displet-details">
					<?php displetps_the_video(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ( displetps_has_map_section() ) : ?>
		<div class="<?php displetps_the_map_section_class(); ?>">
			<div class="displet-address displet-border-color">
				<h2 class="displet-street-address displet-dark-color">
					<?php if ( displetps_has_address() ) : ?>
						<?php displetps_the_address(); ?>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</h2>
				<?php if ( displetps_has_city() || displetps_has_zip() || displetps_has_state() ) : ?>
					<h2 class="displet-city-state-zip displet-dark-color">
						<?php displetps_the_city(); ?><?php if ( displetps_has_city() && displetps_has_state() ) echo ','; ?>
						<?php displetps_the_state(); ?>
						<?php displetps_the_zip(); ?>
					</h2>
				<?php endif; ?>
			</div>
			<div class="displet-details">
				<div id="<?php displetps_the_map_id(); ?>" class="displet-map displet-border-color"></div>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( displetps_has_schools_section() ) : ?>
		<div class="displet-schools <?php displetps_the_schools_section_class(); ?>">
			<div class="displet-address displet-border-color">
				<h2 class="displet-street-address displet-dark-color">
					<?php if ( displetps_has_address() ) : ?>
						<?php displetps_the_address(); ?>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</h2>
				<?php if ( displetps_has_city() || displetps_has_zip() || displetps_has_state() ) : ?>
					<h2 class="displet-city-state-zip displet-dark-color">
						<?php displetps_the_city(); ?><?php if ( displetps_has_city() && displetps_has_state() ) echo ','; ?>
						<?php displetps_the_state(); ?>
						<?php displetps_the_zip(); ?>
					</h2>
				<?php endif; ?>
			</div>
			<?php if ( displetps_has_elementary_school() || displetps_has_middle_school() || displetps_has_junior_high_school() || displetps_has_high_school() || displetps_has_school_district() ) : ?>
				<div class="displet-details">
					<?php if ( displetps_has_elementary_school() ) : ?>
						<div class="displet-detail displet-group">
							<span class="displet-color">
								Elementary School:
							</span>
							<span class="displet-right displet-dark-highlight-color">
								<?php displetps_the_elementary_school(); ?>
							</span>
						</div>
					<?php endif; ?>
					<?php if ( displetps_has_middle_school() ) : ?>
						<div class="displet-detail displet-group">
							<span class="displet-color">
								Middle School:
							</span>
							<span class="displet-right displet-dark-highlight-color">
								<?php displetps_the_middle_school(); ?>
							</span>
						</div>
					<?php endif; ?>
					<?php if ( displetps_has_junior_high_school() ) : ?>
						<div class="displet-detail displet-group">
							<span class="displet-color">
								Junior High School:
							</span>
							<span class="displet-right displet-dark-highlight-color">
								<?php displetps_the_junior_high_school(); ?>
							</span>
						</div>
					<?php endif; ?>
					<?php if ( displetps_has_high_school() ) : ?>
						<div class="displet-detail displet-group">
							<span class="displet-color">
								High School:
							</span>
							<span class="displet-right displet-dark-highlight-color">
								<?php displetps_the_high_school(); ?>
							</span>
						</div>
					<?php endif; ?>
					<?php if ( displetps_has_school_district() ) : ?>
						<div class="displet-detail displet-group">
							<span class="displet-color">
								School District:
							</span>
							<span class="displet-right displet-dark-highlight-color">
								<?php displetps_the_school_district(); ?>
							</span>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( displetps_has_school_description() ) : ?>
				<div class="displet-description displet-light-color">
					<?php if ( displetps_has_school_description_header() ) : ?>
						<h2 class="displet-dark-color">
							<?php displetps_the_school_description_header(); ?>
						</h2>
					<?php endif; ?>
					<?php displetps_the_school_description(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>