<?php

class DispletPropertyShowcaseSettings extends DispletPropertyShowcase {
	protected static $page_slug = 'displet-property-showcase-options';

	public static function get_sections() {
		return array(
			'general-start-tab' => 'General',
			'general' => 'General',
			'single' => 'Single Property',
			'archive' => 'Archive',
			'general-end-tab' => '',
			'spw-start-tab' => 'Showcase',
			'spw' => 'Showcase',
			'spw-end-tab' => '',
		);
	}

	public static function get_choices() {
		global $displetpropertyshowcase_option_choices;
		if ( empty( $displetpropertyshowcase_option_choices ) ) {
			$displetpropertyshowcase_option_choices['pages_array'] = array(
				'None' => false,
			);
			$pages = get_pages();
			if ( !empty( $pages ) ) {
				foreach ( $pages as $page ) {
					$displetpropertyshowcase_option_choices['pages_array'][ $page->post_title ] = $page->ID;
				}
			}
			$displetpropertyshowcase_option_choices['templates'] = array(
				'Default Template' => 'page.php',
			);
			$templates = get_page_templates();
			$displetpropertyshowcase_option_choices['templates'] = array_merge( $displetpropertyshowcase_option_choices['templates'], $templates );
		}
		return $displetpropertyshowcase_option_choices;
	}

	public static function get_options() {
		$options = array();
		$choices = self::get_choices();

		// General
		$options[] = array(
			'section' => 'general',
			'id' => 'color_scheme',
			'title' => 'Color Scheme',
			'type' => 'select2',
			'choices' => array(
				'Blue' => 'blue',
				'Green' => 'green',
				'Red' => 'red',
				'Orange' => 'orange',
				'Custom' => 'custom',
			),
		);

		$options[] = array(
			'section' => 'general',
			'id' => 'images_color',
			'title' => 'Image Color Scheme',
			'type' => 'select2',
			'choices' => array(
				'Blue' => 'blue',
				'Green' => 'green',
				'Red' => 'red',
				'Orange' => 'orange',
			),
		);

		$options[] = array(
			'section' => 'general',
			'id' => 'highlight_color',
			'title' => 'Highlight Color',
			'type' => 'text',
			'class' => 'colorpicker',
		);

		$options[] = array(
			'section' => 'general',
			'id' => 'dark_highlight_color',
			'title' => 'Dark Highlight Color',
			'type' => 'text',
			'class' => 'colorpicker',
		);

		// Single
		$options[] = array(
			'section' => 'single',
			'id' => 'single_template_filename',
			'title' => 'Page Template',
			'type' => 'select2',
			'choices' => $choices['templates'],
		);

		// Archive
		$options[] = array(
			'section' => 'archive',
			'id' => 'archive_template_filename',
			'title' => 'Page Template',
			'type' => 'select2',
			'choices' => $choices['templates'],
		);

		$options[] = array(
			'section' => 'archive',
			'id' => 'archive_title',
			'title' => 'Page Title',
			'type' => 'text',
			'class' => 'nohtml',
			'std' => 'Properties',
		);

		// Showcase
		$options[] = array(
			'section' => 'spw',
			'id' => 'logo_id',
			'title' => 'Logo',
			'type' => 'image',
		);

		$options[] = array(
			'section' => 'spw',
			'id' => 'headshot_id',
			'title' => 'Headshot',
			'type' => 'image',
		);

		$options[] = array(
			'section' => 'spw',
			'id' => 'name',
			'title' => 'Name',
			'type' => 'text',
			'class' => 'nohtml',
		);

		$options[] = array(
			'section' => 'spw',
			'id' => 'phone_number',
			'title' => 'Phone',
			'type' => 'text',
			'class' => 'nohtml',
		);

		$options[] = array(
			'section' => 'spw',
			'id' => 'email_address',
			'title' => 'Email',
			'type' => 'text',
			'class' => 'email',
		);

		$options[] = array(
			'section' => 'spw',
			'id' => 'website_url',
			'title' => 'Website URL',
			'type' => 'text',
			'class' => 'url',
		);

		$options[] = array(
			'section' => 'spw',
			'id' => 'office_address',
			'title' => 'Office Address',
			'type' => 'textarea',
		);

		// Example fields
		/*
		$options[] = array(
			'section' => 'general',
			'id' => '_txt_input',
			'title' => 'Text Input - Some HTML OK!',
			'desc' => 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.',
			'type' => 'text',
			'std' => 'Some default value'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_nohtml_txt_input',
			'title' => 'No HTML!',
			'desc' => 'A text input field where no html input is allowed.',
			'type' => 'text',
			'std' => 'Some default value',
			'class' => 'nohtml'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_numeric_txt_input',
			'title' =>  'Numeric Input',
			'desc' =>  'A text input field where only numeric input is allowed.',
			'type' => 'text',
			'std' => '123',
			'class' => 'numeric'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_multinumeric_txt_input',
			'title' =>  'Multinumeric Input',
			'desc' =>  'A text input field where only multible numeric input (i.e. comma separated numeric values) is allowed.',
			'type' => 'text',
			'std' => '123,234,345',
			'class' => 'multinumeric'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_url_txt_input',
			'title' =>  'URL Input',
			'desc' =>  'A text input field which can be used for urls.',
			'type' => 'text',
			'std' => 'http://wp.tutsplus.com',
			'class' => 'url'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_email_txt_input',
			'title' =>  'Email Input',
			'desc' =>  'A text input field which can be used for email input.',
			'type' => 'text',
			'std' => 'email@email.com',
			'class' => 'email'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_multi_txt_input',
			'title' =>  'Multi-Text Inputs',
			'desc' =>  'A group of text input fields',
			'type' => 'multi-text',
			'choices' => array( 'Text input 1' . '|txt_input1', 'Text input 2' . '|txt_input2', 'Text input 3' . '|txt_input3', 'Text input 4' . '|txt_input4'),
			'std' => ''
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_txtarea_input',
			'title' =>  'Textarea - HTML OK!',
			'desc' =>  'A textarea for a block of text. HTML tags allowed!',
			'type' => 'textarea',
			'std' => 'Some default value'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_nohtml_txtarea_input',
			'title' =>  'No HTML!',
			'desc' =>  'A textarea for a block of text. No HTML!',
			'type' => 'textarea',
			'std' => 'Some default value',
			'class' => 'nohtml'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_allowlinebreaks_txtarea_input',
			'title' =>  'No HTML! Line breaks OK!',
			'desc' =>  'No HTML! Line breaks allowed!',
			'type' => 'textarea',
			'std' => 'Some default value',
			'class' => 'allowlinebreaks'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_inlinehtml_txtarea_input',
			'title' =>  'Some Inline HTML ONLY!',
			'desc' =>  'A textarea for a block of text.
			Only some inline HTML
			(&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;strong&gt;, &lt;abbr&gt;, &lt;acronym&gt;, &lt;blockquote&gt;, &lt;cite&gt;, &lt;code&gt;, &lt;del&gt;, &lt;q&gt;, &lt;strike&gt;)
			is allowed!',
			'type' => 'textarea',
			'std' => 'Some default value',
			'class' => 'inlinehtml'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_select_input',
			'title' =>  'Select (type one)',
			'desc' =>  'A regular select form field',
			'type' => 'select',
			'choices' => array('1', '2', '3'),
			'std' => '3'
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_select2_input',
			'title' =>  'Select (type two)',
			'desc' =>  'A select field with a label for the option and a corresponding value.',
			'type' => 'select2',
			'choices' => array(
				'Option 1' => 1,
				'Option 2' => 2,
				'Option 3' => 3
			),
			'std' => 2
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_checkbox_input',
			'title' =>  'Checkbox',
			'desc' =>  'Some Description',
			'type' => 'checkbox',
			'std' => 1
		);
		$options[] = array(
			'section' => 'general',
			'id' => '_multicheckbox_inputs',
			'title' =>  'Multi-Checkbox',
			'desc' =>  'Some Description',
			'type' => 'multi-checkbox',
			'choices' => array(
				'Checkbox 1' => 'chckbx1',
				'Checkbox 2' => 'chckbx2',
				'Checkbox 3' => 'chckbx3',
				'Checkbox 4' => 'chckbx4'
			),
			'std' => array(
				1,
				0,
				1,
				1
			)
		);
		//*/
		return $options;
	}

	public static function get_page_url() {
		return admin_url( 'admin.php?page=' . self::$page_slug );
	}

	public static function get_settings() {
		return array(
			'displetpropertyshowcase_option_name' => self::$option,
			'displet_page_title' => 'Displet Property Showcase Options',
			'displet_page_sections' => DispletPropertyShowcaseSettings::get_sections(),
			'displet_page_fields' => DispletPropertyShowcaseSettings::get_options(),
		);
	}

	public static function create_field( $args = array() ) {
		extract( $args );
		$field_args = array(
			'type' => $type,
			'id' => $id,
			'desc' => $desc,
			'std' => $std,
			'choices' => $choices,
			'label_for' => $id,
			'class' => $class,
		);
		add_settings_field( $id, $title, array( 'DispletPropertyShowcaseSettings', 'field_callback' ), __FILE__, $section, $field_args );
	}

	public static function register_settings() {
		$settings_output = DispletPropertyShowcaseSettings::get_settings();
		$displetpropertyshowcase_option_name = $settings_output['displetpropertyshowcase_option_name'];
		register_setting(
			$displetpropertyshowcase_option_name,
			$displetpropertyshowcase_option_name,
			array( 'DispletPropertyShowcaseSettings', 'validate_callback' )
		);
		if ( !empty( $settings_output['displet_page_sections'] ) ) {
			foreach ( $settings_output['displet_page_sections'] as $id => $title ) {
				add_settings_section( $id, $title, array( 'DispletPropertyShowcaseSettings', 'section_callback' ), __FILE__ );
			}
		}
		if ( !empty( $settings_output['displet_page_fields'] ) ) {
			foreach ( $settings_output['displet_page_fields'] as $option ) {
				DispletPropertyShowcaseSettings::create_field( $option );
			}
		}
	}

	public static function enqueue() {
		wp_enqueue_style(
			self::$slug . '-settings-styles',
			self::get_plugin_url( 'css/displet-settings.css' )
		);
		wp_enqueue_script(
			self::$slug . '-settings-scripts',
			self::get_plugin_url( 'js/displet-settings.js' ),
			array( 'jquery', 'media-upload', 'thickbox' )
		);
		wp_enqueue_style( 'thickbox' );
	}

	public static function add_menu() {
		$displet_settings_page = add_menu_page(
			'Displet Tools',
			'Displet Tools',
			'displet_view_leads',
			'displettools-uid-slug',
			'displetretsidx_settings_page_fn',
			self::get_plugin_url( 'css/images/displet-icon.png' ),
			76
		);
		if ( $displet_settings_page ) {
			$displet_settings_page = add_submenu_page(
				'displettools-uid-slug',
				self::$name,
				self::$name,
				'manage_options',
				self::$page_slug,
				array( 'DispletPropertyShowcaseSettings', 'settings_page_callback' )
			);
			remove_submenu_page( 'displettools-uid-slug', 'displettools-uid-slug' );
			add_action( 'load-' . $displet_settings_page, array( 'DispletPropertyShowcaseSettings', 'enqueue' ) );
		}
	}

	public static function section_callback( $args ) {
		if ( strpos( $args['id'], '-start-tab' ) !== false ) {
			echo '<fieldset class="displet-fieldset">';
		}
		else if ( strpos( $args['id'], '-end-tab' ) !== false ) {
			echo '</fieldset>';
		}
	}

	public static function field_callback( $args = array() ) {
		extract( $args );
		$settings_output = DispletPropertyShowcaseSettings::get_settings();
		$displetpropertyshowcase_option_name = $settings_output['displetpropertyshowcase_option_name'];
		$options = get_option( $displetpropertyshowcase_option_name );
		if ( !isset( $options[ $id ] ) && 'type' != 'checkbox' ) {
			$options[ $id ] = $std;
		}
		$field_class = ( $class != '' ) ? ' ' . $class : '';
		switch ( $type ) {
			case 'text':
				$options[ $id ] = stripslashes( $options[ $id ] );
				$options[ $id ] = esc_attr( $options[ $id ] );
				echo "<input class='regular-text$field_class' type='text' id='$id' name='" . $displetpropertyshowcase_option_name . "[$id]' value='$options[$id]' />";
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
			case "multi-text":
				foreach($choices as $item) {
					$item = explode("|",$item);
					$item[0] = esc_html__($item[0]);
					if (!empty($options[$id])) {
						foreach ($options[$id] as $option_key => $option_val){
							if ($item[1] == $option_key) {
								$value = $option_val;
							}
						}
					} else {
						$value = '';
					}
					echo "<span>$item[0]:</span> <input class='$field_class' type='text' id='$id|$item[1]' name='" . $displetpropertyshowcase_option_name . "[$id|$item[1]]' value='$value' /><br/>";
				}
				echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
			break;
			case 'textarea':
				$options[$id] = stripslashes($options[$id]);
				$options[$id] = esc_html( $options[$id]);
				echo "<textarea class='textarea$field_class' type='text' id='$id' name='" . $displetpropertyshowcase_option_name . "[$id]' rows='5' cols='30'>$options[$id]</textarea>";
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
			case 'select':
				echo "<select id='$id' class='select$field_class' name='" . $displetpropertyshowcase_option_name . "[$id]'>";
					foreach($choices as $item) {
						$value 	= esc_attr($item);
						$item 	= esc_html($item);

						$selected = ($options[$id]==$value) ? 'selected="selected"' : '';
						echo "<option value='$value' $selected>$item</option>";
					}
				echo "</select>";
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
			case 'select2':
				echo "<select id='$id' class='select$field_class' name='" . $displetpropertyshowcase_option_name . "[$id]'>";
				foreach($choices as $label => $value) {
					$label = esc_html($label);
					$selected = ($options[$id]==$value) ? 'selected="selected"' : '';
					echo "<option value='$value' $selected>$label</option>";
				}
				echo "</select>";
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
			case 'checkbox':
				echo "<input class='checkbox$field_class' type='checkbox' id='$id' name='" . $displetpropertyshowcase_option_name . "[$id]' value='1' " . checked( $options[$id], 1, false ) . " />";
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
			case "multi-checkbox":
				$i = 0;
				foreach($choices as $label => $value) {
					$label = esc_html($label);
					$checked = '';
				    if (isset($options[$id][$value])) {
						if ($options[$id][$value] == 'true') {
				   			$checked = 'checked="checked"';
						}
					}
					else if (!empty($std[$i])){
						$checked = 'checked="checked"';
					}
					echo "<input class='checkbox$field_class' type='checkbox' id='$id|$value' name='" . $displetpropertyshowcase_option_name . "[$id|$value]' value='1' $checked /> $label <br/>";
					$i++;
				}
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
			case 'image':
				$photo = wp_get_attachment_image_src($options[$id], 'thumbnail');
				echo  '<img class="displet-media-thumbnail" ';
				$display = '';
				if (!empty($photo[0])) {
					echo 'src="' . $photo[0] . '"';
				}
				else{
					$display = 'style="display: none;"';
					echo $display;
				}
				echo ' for="' . $id . '" /><input type="hidden" id="' . $id . '" name="' . $displetpropertyshowcase_option_name . '[' . $id . ']' . '" class="displet-media-value" value="' . esc_html($options[$id]) . '" for="' . $id . '" /><input type="button" class="displet-media-select button" value="Select Image" for="' . $id . '" /><input type="button" class="displet-media-remove button" value="Remove Image" for="' . $id . '" ' . $display . '/>';
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
		}
	}

	public static function settings_page_callback() {
		$settings_output = DispletPropertyShowcaseSettings::get_settings();
		?>
			<div class="wrap">
				<div class="icon32" id="icon-options-general"></div>
				<h2><?php echo $settings_output['displet_page_title']; ?></h2>

				<form action="options.php" method="post">
					<?php
						settings_fields($settings_output['displetpropertyshowcase_option_name']);
						do_settings_sections(__FILE__);
					?>
					<p class="submit">
						<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					</p>
				</form>
			</div>
		<?php
	}

	public static function validate_callback($input) {
		$valid_input = array();
		$settings_output = DispletPropertyShowcaseSettings::get_settings();
		$options = $settings_output['displet_page_fields'];
		foreach ($options as $option) {
			switch ($option['type']) {
				case 'text':
					switch ($option['class']) {
						case 'numeric':
							$input[$option['id']] = trim($input[$option['id']]);
							$valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : 'Expecting a Numeric value!';
							if (is_numeric($input[$option['id']]) == false) {
								add_settings_error($option['id'], 'displetpropertyshowcase_txt_numeric_error', 'Expecting a numeric value!', 'error');
							}
						break;
						case 'multinumeric':
							$input[$option['id']] = trim($input[$option['id']]);
							if ($input[$option['id']] !=''){
								$valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : 'Expecting comma separated numeric values';
							}
							else {
								$valid_input[$option['id']] = $input[$option['id']];
							}
							if ($input[$option['id']] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1) {
								add_settings_error($option['id'], 'displetpropertyshowcase_txt_multinumeric_error', 'Expecting comma separated numeric values!', 'error');
							}
						break;
						case 'nohtml':
							$input[$option['id']] = sanitize_text_field($input[$option['id']]);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
						case 'url':
							$input[$option['id']] = trim($input[$option['id']]);
							$valid_input[$option['id']] = esc_url_raw($input[$option['id']]);
						break;
						case 'email':
							$input[$option['id']] = trim($input[$option['id']]);
							if ($input[$option['id']] != ''){
								$valid_input[$option['id']] = (is_email($input[$option['id']])!== false) ? $input[$option['id']] : 'Invalid email! Please re-enter!';
							}
							else if ($input[$option['id']] == ''){
								$valid_input[$option['id']] = 'This setting field cannot be empty! Please enter a valid email address.';
							}
							if (is_email($input[$option['id']])== false || $input[$option['id']] == '') {
								add_settings_error($option['id'], 'displetpropertyshowcase_txt_email_error', 'Please enter a valid email address.', 'error');
							}
						break;
						default:
							$allowed_html = array(
								'a' => array(
									'href' => array(),
									'title' => array()
								),
								'b' => array(),
								'em' => array(),
								'i' => array(),
								'strong' => array()
							);
							$input[$option['id']] = trim($input[$option['id']]);
							$input[$option['id']] = force_balance_tags($input[$option['id']]);
							$input[$option['id']] = wp_kses( $input[$option['id']], $allowed_html);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
					}
				break;
				case "multi-text":
					unset($textarray);
					$text_values = array();
					foreach ($option['choices'] as $k => $v) {
						$pieces = explode("|", $v);
						$text_values[] = $pieces[1];
					}
					foreach ($text_values as $v ) {
						if (!empty($input[$option['id'] . '|' . $v])) {
							switch ($option['class']) {
								case 'numeric':
									$input[$option['id'] . '|' . $v] = trim($input[$option['id'] . '|' . $v]);
									$input[$option['id'] . '|' . $v] = (is_numeric($input[$option['id'] . '|' . $v])) ? $input[$option['id'] . '|' . $v] : '';
								break;
								default:
									$input[$option['id'] . '|' . $v] = sanitize_text_field($input[$option['id'] . '|' . $v]);
									$input[$option['id'] . '|' . $v] = addslashes($input[$option['id'] . '|' . $v]);
								break;
							}
							$textarray[$v] = $input[$option['id'] . '|' . $v];

						}
						else {
							$textarray[$v] = '';
						}
					}
					if (!empty($textarray)) {
						$valid_input[$option['id']] = $textarray;
					}
				break;
				case 'textarea':
					switch ( $option['class'] ) {
						case 'inlinehtml':
							$input[$option['id']] = trim($input[$option['id']]);
							$input[$option['id']] = force_balance_tags($input[$option['id']]);
							$input[$option['id']] = addslashes($input[$option['id']]);
							$valid_input[$option['id']] = wp_filter_kses($input[$option['id']]);
						break;
						case 'nohtml':
							$input[$option['id']] = sanitize_text_field($input[$option['id']]);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
						case 'allowlinebreaks':
							$input[$option['id']] = wp_strip_all_tags($input[$option['id']]);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
						default:
							$allowed_html = array(
								'a' => array(
									'href' => array(),
									'title' => array()
								),
								'b' => array(),
								'blockquote' => array(
									'cite' => array()
								),
								'br' => array(),
								'dd' => array(),
								'dl' => array(),
								'dt' => array(),
								'em' => array(),
								'i' => array(),
								'li' => array(),
								'ol' => array(),
								'p' => array(),
								'q' => array(
									'cite' => array()
								),
								'strong' => array(),
								'ul' => array(),
								'h1' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								),
								'h2' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								),
								'h3' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								),
								'h4' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								),
								'h5' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								),
								'h6' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								)
							);
							$input[$option['id']] = trim($input[$option['id']]);
							$input[$option['id']] = force_balance_tags($input[$option['id']]);
							$input[$option['id']] = wp_kses($input[$option['id']], $allowed_html);
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
					}
				break;
				case 'select':
					$valid_input[$option['id']] = (in_array($input[$option['id']], $option['choices']) ? $input[$option['id']] : '');
				break;
				case 'select2':
					$valid_input[$option['id']] = in_array($input[$option['id']], $option['choices']) ? $input[$option['id']] : '';
				break;
				case 'checkbox':
					if (!isset($input[$option['id']])) {
						$input[$option['id']] = null;
					}
					$valid_input[$option['id']] = ($input[$option['id']] == 1 ? 1 : 0);
				break;
				case 'multi-checkbox':
					unset($checkboxarray);
					$check_values = array();
					foreach ($option['choices'] as $label => $value) {
						$check_values[] = $value;
					}
					foreach ($check_values as $v) {
						if (!empty($input[$option['id'] . '|' . $v])) {
							$checkboxarray[$v] = 'true';
						}
						else {
							$checkboxarray[$v] = 'false';
						}
					}
					if (!empty($checkboxarray)) {
						$valid_input[$option['id']] = $checkboxarray;
					}
				break;
				case 'image':
					$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
					$valid_input[$option['id']] = sanitize_text_field($input[$option['id']]);
				break;

			}
		}
		return $valid_input;
	}
}

add_action('admin_menu', array('DispletPropertyShowcaseSettings', 'add_menu'));
add_action('admin_init', array('DispletPropertyShowcaseSettings', 'register_settings'));

?>