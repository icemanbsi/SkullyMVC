define([
	"jquery",
	"underscore",
	"backbone",
	"app"
], function($, _, Backbone, MainApp){
	"use strict";

	var appRoute = undefined;

	// Applications
	// ------------------------------------------------------------------------

	var App = {
		$container : undefined,

		initialize: function() {
			// Initialize variables
			// ------------------------------------------------------------------------

			this.$container = $('.member-detail-block');
		},

		onLoad: function(language) {
			var self = this;

			// Close section
			this.$container.find('.md-detail.md-open').removeClass('md-open');

			// Open section based on language
			this.$container.find('.md-detail[data-section="'+language+'"]').addClass('md-open');
		}
	};

	// Backbone Router
	// ------------------------------------------------------------------------

	var AppRouter = Backbone.Router.extend({
		routes: {
			// URL with hashbang fragment
			//"!/fragment": "fragmentActions"

			"(:language)": "defaultActions"
		},

		defaultActions: function(language) {
			language = language || 'chinese';
			App.onLoad(language);
		}
	});

	// Initialize
	// ------------------------------------------------------------------------

	var initialize = function() {
		appRoute = new AppRouter;

		App.initialize();

		// Start Backbone history
		// ------------------------------------------------------------------------

		Backbone.history.start();
	};

	return { initialize: initialize };

});