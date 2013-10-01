/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 7/24/13
 * Time: 9:37 AM
 * Description: Kioo jquery plugin. Contains generic functions that can be used throughout the site.
 */

Number.prototype.numberFormat = function(decPlaces, decSeparator, thouSeparator) {
	var n = this,
		decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
		decSeparator = decSeparator == undefined ? "." : decSeparator,
		thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
		sign = n < 0 ? "-" : "",
		i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
		j = i.length > 3 ? i.length % 3 : 0;
	return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};

String.prototype.truncate = function(length, minLength){
	var realText = this;
	if(realText.length >= length)return realText;

	var text = realText.substr(0, length);
	if(!minLength) minLength = 3;

	if(realText.substr(length, 1).match(/[\d|a-z|A-Z]/g)){
		var lastSpace = text.lastIndexOf(" ");
		if(lastSpace == -1){ // no space
			return text.substr(0, minLength) + "...";
		}
		else return text.substr(0, lastSpace) + "...";
	}

	return text + "...";
};

String.prototype.ucword = function(){
	return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

// Display errors inside ".tips" element inside a form having ".validate" selector,
// as well as attaching error items into input elements.
function displayError(data, instanceName){
	if (data.error != null) {
		var tips = $('form.validate .tips');
		tips.html('').removeClass('error').removeClass('success').hide();
		tips.html(data.error).addClass('error').fadeIn();
	}
	if (data.errorAttributes != null) {
		attachErrors(data.errorAttributes, instanceName);
	}
}

// Attaches errors.
// Use instanceName when input names are like instanceName["fieldName"].
function attachErrors(errors, instanceName) {
	// reset border color of all inputs inside this form
	// If input is hidden field chances are there may be another input with the same id somewhere in the page.
	// To clean all (correct) inputs from red border color, add .mainFormWrapper to the parent element that acts like a form tag.
	if (errors.length > 0) {
		$('[name="'+errors[0].attribute+'"]').parent().find('input').css('border-color', '');
		$('form.validate').find('input').css('border-color', '');
	}
	for($i=0;$i<errors.length;$i++) {
		var error = errors[$i];
		var input = $('[name="'+error.attribute+'"]');
		if (instanceName != null) {
			input = $('[name="'+instanceName+'['+error.attribute+']"]');
			if(input.length == 0){
				input = $('[name="'+instanceName+error.attribute+'"]');
			}
		}
		if (input.attr('type') == 'hidden') {
//			$('#'+instance+'_'+error.attribute).css('border-color', 'red').validationEngine('showPrompt', error.message, 'error', 'topLeft', true);
		}
		else {
			input.css('border-color', 'red').validationEngine('showPrompt', error.message, 'error', 'topLeft', true);
		}
	}
}
(function($) {
	$.kioo = {
		// array of currently active dialogs, each item contains an associative array of id and url, i.e.
		// [{id: 'kDialog-1', url: 'http://something.com'}]
		// You can quickly get a dialog by key or url using their respective functions.
		// Show / hide created dialog with $.kioo.getDialogByKey(xxx).dialog('open') / dialog('hide').
		_dialogs: [],

		truncate: function(text, count, moreText) {
			if (typeof(count) == 'undefined') {
				count = 80;
			}
			if (typeof(moreText) == 'undefined') {
				moreText = '...';
			}
			if (text.length <= count) {
				return text;
			}
			else {
				return $.trim(text).substring(0, count)
					.split(" ").slice(0, -1).join(" ") + moreText;
			}
		},
		// Alert a dialog message
		alert: function(content, title){
			$("#alertDialog").html(content);
			if(!title) title = "";
			$("#alertDialog").dialog("option", "title", title);
			$("#alertDialog").dialog("open");
		},

		confirm: function(content, title, callbackYes, callbackNo){
			$("#confirmDialog").html(content);
			if(!title) title = "";
			$("#confirmDialog").dialog("option", "title", title);
			$("#confirmDialog").dialog("option", "buttons", [
				{text: "Yes", click: function(){
					if(callbackYes) callbackYes();
					$(this).dialog("close");
				}},
				{text: "No", click: function(){
					if(callbackNo) callbackNo();
					$(this).dialog("close");
				}}
			]);
			$("#confirmDialog").dialog("open");
		},

		getDialogByUrl: function(url) {
			var dialogEl = null;
			$.each(this._dialogs, function(index, value) {
				if (typeof(value) != 'undefined' && value.url == url) {
					dialogEl = $('#'+value.id);
					if (dialogEl.length == 0) {
						$.kioo._dialogs.splice(index, 1);
						dialogEl = null;
					}
					if (dialogEl != null && typeof(andRemove) != 'undefined' && andRemove) {
						$.kioo._dialogs.splice(index, 1);
					}
				}
			});
			return dialogEl;
		},
		// Pass true to andRemove to remove from _dialogs.
		getDialogByKey: function(key, andRemove) {
			var dialogEl = null;
			$.each(this._dialogs, function(index, value) {
				if (typeof(value) != 'undefined' && value.id == key) {
					dialogEl = $('#'+value.id);
					if (dialogEl.length == 0) {
						$.kioo._dialogs.splice(index, 1);
						dialogEl = null;
					}
					if (dialogEl != null && typeof(andRemove) != 'undefined' && andRemove) {
						$.kioo._dialogs.splice(index, 1);
					}
				}
			});
			return dialogEl;
		},
		// Since $(el).dialog('destroy') doesn't actually destroy the element,
		// destroy it with this method.
		destroyDialog: function(key) {
			var dialog = this.getDialogByKey(key, true);
			if (dialog) {
				dialog.dialog('close');
				dialog.dialog('destroy');
				dialog.remove();
			}
		},
		destroyDialogByUrl: function(url) {
			var dialog = this.getDialogByUrl(url, true);
			if (dialog) {
				dialog.dialog('close');
				dialog.dialog('destroy');
				dialog.remove();
			}
		},
		// Opens up dialog from given url. Callback(this) is called after content called.
		// For this method to run successfully, page must have dialog template element having element with class "content" in it, i.e.:
		// <div id="dialogTemplate"><div class="content"></div></div>
		// Calls to similar url with item from this._dialogs will replace it with new item.
		// opt values:
		// modal: true to show this with overlay background. (default true)
		// reload: true to reload content, false to use element stored in _dialogs
		// title: You can set title by either of two methods:
		//        - by passing title param to opt,
		//        - by having element with class "dialogTitle" within content.
		// fixedHeight: true to have overflow: hidden on content.
		// content: Used to pass content in dialog. Notes:
		// To show content in dialog instead of url, use: dialog(opt, callback) while passing content parameter in opt:
		// $.kioo.dialog({content: '<p>hello</p>'});
		dialog: function(url, opt, callback)
		{
			if (typeof(url) == 'object') {
				opt = url;
				url = null;
			}
			if (opt != null) {
				if (opt.modal == null) {
					opt.modal = true;
				}
			}
			else {
				opt = {modal: true};
			}

			var dialogEl = null;
			if (url != null) {
				dialogEl = this.getDialogByUrl(url);
			}
			var cache = true;
			if (dialogEl == null) {
				dialogEl = $('#dialogTemplate').clone();
				var id = 'kDialog-'+this._dialogs.length;
				dialogEl.attr('id', id);
				this._dialogs[this._dialogs.length] = {id: id, url: url};
				dialogEl.appendTo($('body'));
				cache = false;
			}

			var fillContent = function() {
				$(this).css({
					'max-height': dialogEl.dialog("option","maxHeight"),
					'overflow-y': 'auto'
				});

				var width = $(this).outerWidth() + 25;
				if (opt != null) {
					if (opt.width != null) {
						width = opt.width;
					}
				}
				dialogEl.dialog("option", "width", width);
				if (typeof(callback) == 'function') {
					callback($(this).closest('.ui-dialog-content'));
				}
			};

			if (typeof(opt.fixedHeight) != 'undefined' && opt.fixedHeight) {
				dialogEl.css('overflow', 'hidden');
			}

			if (url != null && (cache == false || opt.reload)) {
				dialogEl.find('.content').load(url, fillContent);
			}
			else {
				// fill content with direct html instead of from url.
				if (url == null) {
					if (opt.content == null) {
						opt.content = '';
					}
					dialogEl.find('.content').html(opt.content);
					fillContent();
				}
				// end
			}

			dialogEl.dialog(opt);
		}
	};
})(jQuery);

$(document).ready(function(){
	$("#baseDialog").dialog({
		autoOpen: false,
		modal : true
	});

	$("#alertDialog").dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		buttons: {
			"Ok" : function(){
				$(this).dialog("close");
			}
		},
		close: function(){
			$(this).html("");
		}
	});

	$("#confirmDialog").dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		buttons: {
			"Yes" : function(){
				$(this).dialog("close");
			},
			"No" : function(){
				$(this).dialog("close");
			}
		},
		close: function(){
			$(this).html("");
		}
	});

	//data-toggle (window)
	$("[data-toggle=window]").not("initialized").addClass("initialized").click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		window.open(url);
	});

	$(document).on("click", ".formError", function(){
		$(this).remove();
	});
});
