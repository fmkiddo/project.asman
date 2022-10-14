/**
 * 
 */
var basePath = $(location).attr ('origin') + "/assets-manager";
var	modalSize = {
	"xlarge"		: "modal-xl",
	"large"			: "modal-lg",
	"medium"		: "modal-md",
	"small"			: "modal-sm",
	"xsmall"		: "modal-xs"
},	messageType = {
	"ok"			: 0,
	"yesno"			: 1,
	"yesnocancel"		: 2,
	"okcancel"		: 3
};
var $locale	= $(location).attr ('href').replace (basePath + '/', '').split ('/')[0];
var $doclocale = {};

Object.freeze (basePath);
Object.freeze (modalSize);
Object.freeze (messageType);

$.base_url = function (fix='') {
	var curr_url = $(location).attr ('href'),
		exploded = curr_url.split ("/");
	
	var base_url = basePath;
	if (fix.length > 0) base_url += '/' + fix;
	return base_url; 
};

$.showMessageDialog = function (title, message, name, size, type) {
	var pageModal	= $('body').find ('div#page-modal'),
		modalDialog	= pageModal.find ('div.modal-dialog'),
		modalTitle	= pageModal.find ('.modal-title'),
		modalBody	= pageModal.find ('.modal-body'),
		modalFooter	= pageModal.find ('.modal-footer'),
		json		= {
			"trigger"	: "dialog-button",
			"data"		: type
		};
		
	$.ajax ({
		"url"			: $.base_url ($locale + '/api/get'),
		"method"		: "put",
		"data"			: JSON.stringify (json),
		"dataType"		: "json",
		"contentType"		: "application/json"
	}).done (function (result) {
		if (result.status == 200) {
			pageModal.attr ('aria-labelledby', name);
			modalDialog.addClass (size);
			modalTitle.text (title);
			modalBody.text (message);
			
			$.each (result.returndata, function (k, v) {
				$('<button/>', {
					"type"			: "button",
					"name"			: k,
					"text"			: v.text,
					"class"			: v.class,
				}).appendTo (modalFooter);
			});
			pageModal.modal ('show');
		}
	}).fail (function () {
		
	});
};

$(document).ready (function () {

	$.onEnterKeyDown = function () {};
	
	$.fn.checkFormValidity = function () {
		if ($(this).is ('form'))
			return this[0].checkValidity ();
		return false;
	};
	
	$('form input').keydown (function (evt) {
		if (evt.keyCode == 13) {
			evt.preventDefault ();
			$.onEnterKeyDown ();
			return false;
		}
	});
	
	$.fn.disableForm = function () {
		if ($(this).is ('form')) {
			$(this).find (':input').each (function () {
				$(this).prop ('readonly', true);
			});
			
			$(this).find (':button').each (function () {
				$(this).prop ('disabled', true);
			});
		}
	};
	
	$.fn.enableForm = function () {
		if ($(this).is ('form')) {
			$(this).find (':input').each (function () {
				$(this).prop ('readonly', false);
			});
			
			$(this).find (':button').each (function () {
				$(this).prop ('disabled', false);
			});
		}
	};
	
	$.fn.clearForm = function () {
		var $this = $(this);
		if (!$this.is ('form'))
			console.log ('Error! not a form!');
		else {
			var inputs = $this.find (':input');
			$.each (inputs, function () {
				$(this).val ('');
			});
		}
	};
	
	$.fn.validateForm = function () {
		var $this = $(this);
		if (!$this.is ('form')) {
			console.log ('Error! not a form');
			return false;
		} else {
			var valid = true;
			var inputs = $this.find ('input');
			$.each (inputs, function () {
				var $el = $(this);
				if ($el.prop ('required') && $el.val ().length == 0) valid = false;
				if (!valid) return false;
			});
			return valid;
		}
	};
	
	$(function () {
		$('[data-toggle="tooltip"]').tooltip ({
			'placement'	: 'bottom',
			'trigger'	: 'hover'
		});
	});
	
	$(function () {
		var body = $('body');
		
		$('<div/>', {
			"class": "modal fade",
			"id": "page-modal",
			"role": "dialog",
			"aria-labelledby": "",
			"aria-hidden": "true"
		}).appendTo (body);
		
		$('<div/>', {
			"class": "modal-dialog",
			"role": "document"
		}).appendTo (body.find ('div#page-modal'));
		
		$('<div/>', {
			"class": "modal-content"
		}).appendTo (body.find ('div#page-modal').find ('div.modal-dialog'));
		
		$('<div/>', {
			"class": "modal-header"
		}).appendTo (body.find ('div#page-modal').find ('div.modal-content'));
		
		$('<div/>', {
			"class": "modal-body"
		}).appendTo (body.find ('div#page-modal').find ('div.modal-content'));
		
		$('<div/>', {
			"class": "modal-footer"
		}).appendTo (body.find ('div#page-modal').find ('div.modal-content'));
		
		$('<h5/>', {
			"class": "modal-title"
		}).appendTo (body.find ('div#page-modal').find ('div.modal-header'));
		
		$('<button/>', {
			"type": "button",
			"class": "close",
			"data-dismiss": "modal",
			"aria-label": "close"
		}).appendTo (body.find ('div#page-modal').find ('div.modal-header'));
		
		$('<span/>', {
			"aria-hidden": "true",
			"html": "&times;"
		}).appendTo (body.find ('div#page-modal').find ('button.close'));
		
		body.find ('div.modal').on ('hidden.bs.modal', function (evt) {
			var modal = $('body').find ('div#page-modal');
			modal.attr ('aria-labelledby', '');
			$modalDialog = modal.find ('.modal-dialog');
			$modalDialog.removeClass ();
			$modalDialog.addClass ('modal-dialog');
			modal.find ('.modal-title').empty ();
			modal.find ('.modal-body').empty ();
			modal.find ('.modal-footer').empty ();
		});
	});
});
