define([
	"jquery",
	"underscore"
], function($, _){
	"use strict";

	var defaultActions = {
		MainApp: 		undefined,

		// Initialize
		// ------------------------------------------------------------------------

		initialize: function(MainApp) {
			this.MainApp = MainApp;

			// Call defaults
			this.def();
		},

		// Email string checker
		// ------------------------------------------------------------------------

		checkEmail: function(value) {
			return (! /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i.test(value)) ?
				false : true;
		},

		// Default actions
		// ------------------------------------------------------------------------

		def: function() {
			var self = this,
				debouncedResize;


			if ($('.jscrollpane').length) {
				$('.jscrollpane').jScrollPane({autoReinitialise: true});
			}

			// Modal Default
			// ------------------------------------------------------------------------

			// Newsletter
			$('.search-container').on('click', 'a.newsletter', function(e) {
				var $self 			= $(this),
					$modalContainer = $('<div />', {'class' : 'modal-container-default'})
									  .append($('<div />', {'class' : 'modal-overlay'})),
					contentTemplate = $('script#newsletter').text(),
					template 		= '';
				e.preventDefault();

				if ($self.hasClass('active')) { return false; }

				// Template
				template = _.template(contentTemplate);
				template = $('<div />', {html: template});

				template.find('.modal-newsletter').css({
					right 	: ($self.offset().left + $self.outerWidth()) * -1,
					top 	: ($self.offset().top + $self.outerHeight()) + 8
				});

				$modalContainer.on('click', '.btn.close', function(e) {
					e.preventDefault();

					$modalContainer.find('.modal-overlay').trigger('click')
				});


				$('body').append($modalContainer.prepend(template.html()));
				$self.addClass('active');


				$modalContainer.on('click', '.modal-overlay', function() {
					$('.modal-container-default').remove();

					$self.removeClass('active');
				});
			});

			// Login
			$('.search-container').on('click', 'a.login', function(e) {
				var $self 			= $(this),
					$modalContainer = $('<div />', {'class' : 'modal-container-default'})
									  .append($('<div />', {'class' : 'modal-overlay'})),
					contentTemplate = $('script#login').text(),
					template 		= '';
				e.preventDefault();

				if ($self.hasClass('active')) { return false; }

				// Template
				template = _.template(contentTemplate);
				template = $('<div />', {html: template});

				template.find('.modal-login').css({
					right 	: ($self.offset().left + $self.outerWidth()) * -1,
					top 	: ($self.offset().top + $self.outerHeight()) + 8
				});

				$modalContainer.on('click', '.btn.close', function(e) {
					e.preventDefault();

					$modalContainer.find('.modal-overlay').trigger('click')
				});


				$('body').append($modalContainer.prepend(template.html()));
				$self.addClass('active');


				$modalContainer.on('click', '.modal-overlay', function() {
					$('.modal-container-default').remove();

					$self.removeClass('active');
				});



				// ------------------------------------------------------------------------

				$modalContainer.on('click', 'a.lost-password', function(e) {
					e.preventDefault();

					contentTemplate = $('script#lost-password').text();
					template        = _.template(contentTemplate);

					$modalContainer.find('.modal-overlay').before(template);
				});

				// ------------------------------------------------------------------------
			});
		},

		// Open Modal
		// ------------------------------------------------------------------------

		openModal: function(options) {
			var $popupContainer = $('<div />', {'class': 'modal-container'}),
				$popupBlock     = $('<div />', {'class': 'modal-block'}),
				$popupOverlay 	= $('<div />', {'class': 'modal-overlay'}),
				$popupClose 	= $('<span />', {'class': 'modal-close', 'html': '&times;'}),
				$popupBody 		= $('<div />', {'class': 'modal-body'}),

				self 		    = this,
				$element 		= undefined,
				options 		= options || {
										closeBtn : true,
										border   : true,
										text  	 : undefined,
										html  	 : undefined,
										onLoad   : undefined,
										onClose  : undefined
								  };

			if (_.isUndefined(options.closeBtn))
			{ options.closeBtn = true; }

			// Set popUp
			// ------------------------------------------------------------------------

			if (! _.isUndefined(options.text))
			{ $popupBody.append('<p>' + options.text + '</p>'); }

			if (! _.isUndefined(options.html))
			{ $popupBody.append(options.html); }

			if (options.border)
			{ $popupBlock.addClass('modal-bordered'); }

			$popupClose.bind('click', function(e) {
				e.preventDefault();
				self.closePopUp();
			});

			$popupContainer.on('click', '.modal-overlay', function(e) {
				self.closePopUp();
			});

			if (! options.closeBtn) {
				$popupClose.hide();
			}

			// Create pop up
			// ------------------------------------------------------------------------

			$popupBlock.append($popupClose).append($popupBody);
			$popupContainer.append($popupBlock).append($popupOverlay);
			$popupContainer.data('options', options);

			// already exists? remove previous then append new one
			if ($('.modal-container').length)
			{ $('.modal-container').remove(); }

			$('body').append($popupContainer);

			// Bind escape key
			// ------------------------------------------------------------------------

			$('body').unbind('keyup');
			$('body').bind('keyup', function(e) {
				if (e.keyCode == 27) {
					$popupHeader.find('.modal-close').trigger('click');
				}
			});



			// Has onLoad callback?
			// ------------------------------------------------------------------------

			if (! _.isUndefined(options.onLoad) && _.isFunction(options.onLoad)) {
				options.onLoad($popupContainer);
			}
		},

		closePopUp: function() {
			var $popupContainer  = $('.modal-container'),
				$popupBlock 	 = $popupContainer.find('.modal-block'),
				options 		 = $popupContainer.data('options');

			$popupContainer.remove();

			// Rebind default escape key bind
			// ------------------------------------------------------------------------

			$('body').unbind('keyup');


			// Has onClose callback?
			// ------------------------------------------------------------------------

			if (! _.isUndefined(options.onClose) && _.isFunction(options.onClose)) {
				options.onClose($popupContainer);
			}
		}
	};

	return defaultActions;

});