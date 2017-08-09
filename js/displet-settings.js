jQuery(document).ready(function($){
	function displetpropertyshowcase_go_to_tab(tab_number){
		if (tab_number) {
			$('.displet-tab.active').removeClass('active');
			$('.displet-tab[for="' + tab_number + '"]').addClass('active');
			$('.displet-fieldset').hide();
			$('.displet-fieldset[for="' + tab_number + '"]').show();
		}
	}

	// Init
	$('.wrap form h3').addClass('displet-tab');
	$('.wrap form fieldset h3').removeClass('displet-tab');
	var i = 1;
	var tab_html = '';
	$('.displet-tab').each(function() {
		$(this).attr('for', i);
		$(this);
		tab_html += $(this).wrap('<span></span>').parent('span').html();
		$(this).empty().hide();
		i++;
	});
	$('.wrap form').prepend(tab_html);
	$('.displet-tab').first().addClass('active');
	var i = 1;
	$('.displet-fieldset').each(function() {
		$(this).attr('for', + i);
		i++;
	}).hide().first().show();
	$('.displet-tab').click(function(){
		displetpropertyshowcase_go_to_tab($(this).attr('for'));
	});

	// Error messages
	var error_messages = $('#message .setting-error-message');
	if (error_messages.length) {
		error_messages.each(function() {
			var error_setting = $(this).attr('title');
			$("label[for='" + error_setting + "']").addClass('displet-error');
			$("input[id='" + error_setting + "']").addClass('displet-error');
		});
		var first_error_setting = error_messages.first().attr('title');
		var tab = $("input[id='" + first_error_setting + "']").parents('.displet-fieldset').attr('for');
		displetpropertyshowcase_go_to_tab(tab);
	}

	// Photo Upload
	$('.displet-media-select').click(function() {
		tb_show('Upload a logo', 'media-upload.php?type=image&TB_iframe=true&post_id=0', false);
		var the_for = $(this).attr('for');
		window.send_to_editor = function(html) {
			var image_class = $('img', html).attr('class');
			if (image_class.indexOf('wp-image-') !== -1) {
				var image_matches = image_class.match(/wp-image-([\d]+)/);
				if (image_matches && image_matches[1]) {
					$('.displet-media-value[for="' + the_for + '"]').val(image_matches[1]);
					var image_url = $('img', html).attr('src');
					if (image_url) {
    					$('.displet-media-thumbnail[for="' + the_for + '"]').attr('src', image_url);
    					$('.displet-media-thumbnail[for="' + the_for + '"]').show();
					}
				}
			}
			tb_remove();
		}
		return false;
	});
	$('.displet-media-remove').click(function(){
		var the_for = $(this).attr('for');
		$('.displet-media-value[for="' + the_for + '"]').val('');
    	$('.displet-media-thumbnail[for="' + the_for + '"]').hide();
    	$('.displet-media-remove[for="' + the_for + '"]').hide();
	});

});

jQuery(document).ready(function($) {
});