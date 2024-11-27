/*
 * jQuery File Upload Demo
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global $ */

$(function () {
  'use strict';

	// Initialize the jQuery File Upload widget:
	$('#fileupload').fileupload({
	// Uncomment the following to send cross-domain cookies:
	//xhrFields: {withCredentials: true},
	// url: 'http://tennis-app.ac/courts/imageHandler/?destination=1',
	//autoUpload: false,
	});

	$('#fileupload').on('fileuploadadd', function (e, data) {
		$.each(data.files, function (index, file) {
			console.log('Added file: ' + file.name);
			data.submit();
		});
	});
	
	
	$('#fileupload').on('fileuploadcompleted fileuploaddestroyed fileuploaddestroy', function (e, data) {
		setTimeout(setImageInput, 1000);
		setTimeout(updateForm, 2000);
	});

	function setImageInput (){
		$.getJSON( $('#fileupload').fileupload('option', 'url'), function( data ) {
			if(typeof  data['files'][0] == 'undefined') {
				$('input#courtImage').val('');
			} else {
				$('input#courtImage').val(data['files'][0]['name']);
			}
		});
	};
	
	function updateForm (){
		var form = $('.courtForm.edit');
		var actionUrl = form.attr('action');
		
		if (form.length) {
			$.ajax({
				type: "POST",
				url: actionUrl,
				data: form.serialize(), // serializes the form's elements.
				dataType: 'json',
				success: function(data)
				{
				  alert(data); // show response from the php script.
				}
			});
		}
	};
	
	$(document).on('click', 'button.delete.edit', function(){
		setTimeout(updateForm, 2000);
	});
	
	

    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
      // Uncomment the following to send cross-domain cookies:
      //xhrFields: {withCredentials: true},
      url: $('#fileupload').fileupload('option', 'url'),
      dataType: 'json',
      context: $('#fileupload')[0]
    })
      .always(function () {
        $(this).removeClass('fileupload-processing');
      })
      .done(function (result) {
        $(this)
          .fileupload('option', 'done')
          // eslint-disable-next-line new-cap
          .call(this, $.Event('done'), { result: result });
      });

});