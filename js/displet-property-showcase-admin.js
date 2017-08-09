jQuery(document).ready(function($){
	$('#displet-help-page a').click(function(ev){
		if (this.hash){
			$('html,body').animate({scrollTop:$(this.hash).offset().top - 40}, 400);
		}
	});
	$('#displet-help-page .displet-image').click(function(){
		if ($(this).hasClass('displet-active')) {
			$(this).removeClass('displet-active');
		}
		else{
			$(this).addClass('displet-active');
		}
	});
	var color_scheme_element = $('#color_scheme', '.displet-tools_page_displet-property-showcase-options');
	var color_picker_elements = $('.colorpicker', '.displet-tools_page_displet-property-showcase-options');
	var images_color_element = $('#images_color', '.displet-tools_page_displet-property-showcase-options');
	var color_picker_rows = color_picker_elements.parent('td').parent('tr');
	if ( color_scheme_element.val() !== 'custom' ) {
		color_picker_rows.hide();
		images_color_element.hide();
	}
	color_picker_elements.wpColorPicker();
	color_scheme_element.bind('change', function(){
		if ( this.value === 'custom' ) {
			color_picker_rows.show();
			images_color_element.show();
		}
		else{
			color_picker_rows.hide();
			images_color_element.hide();
		}
	});
});