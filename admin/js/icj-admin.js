(function( $ ) {
	'use strict';

	$(document).ready(function() {

		document.getElementById('editor').style.fontSize='14px';

		var headerEditor, footerEditor;
		
		$('.icj_editor').each(function(i) {

			var editor = ace.edit(this);
			editor.setTheme("ace/theme/github");
			editor.session.setMode("ace/mode/html");

			if ($(this).hasClass('header')) {
				headerEditor = editor;
				if (ICJ.settings != null) {
					editor.setValue(ICJ.settings.header, 1);
				}
			}
			else {
				footerEditor = editor;
				if (ICJ.settings != null) {
					editor.setValue(ICJ.settings.footer, 1);
				}
			}
		});

		$('.icj_dashboard form').submit(function(e) {
			e.preventDefault();

			var self = $(this);
			var submitButton = $('input[type="submit"]', self);
			var loader = $('.loader_container');

			submitButton.prop('disabled', true);
			loader.show();

			$.ajax(ICJ.ajaxurl, {
				method: "POST", 
				dataType: "json", 
				data: {
					action: ICJ.action, 
					icj_field: $('input[name="icj_field"]', self).val(), 
					header: headerEditor.getValue(), 
					footer: footerEditor.getValue()
				}
			})
			.done(function(data) {

				submitButton.prop('disabled', false);
				loader.hide();

				new Noty({
					type: 'success',
					layout: 'topRight',
					text: data.message, 
					timeout: 3500
				}).show();
			})
			.fail(function(data, textStatus, xhr) {

				var response = data.responseJSON;

				submitButton.prop('disabled', false);
				loader.hide();
				
				new Noty({
					type: 'error',
					layout: 'topRight',
					text: response.message, 
					timeout: 3500
				}).show();
			});
		});
	});

})( jQuery );
