define([
	// Defaults
	"jquery",
	"underscore",
	"default_actions"
], function($, _, defActions){
	"use strict";

	// Applications
	// ------------------------------------------------------------------------

	var App = {
		defaultActions: defActions,

		// Initialize
		// ------------------------------------------------------------------------

		initialize: function() {

			// Initialize default actions
			// ------------------------------------------------------------------------

			defActions.initialize(this);

			// Call the controller base on data-app="current page" at #main-container
			// ------------------------------------------------------------------------

			var callController = $('.main-container').data('app');
			if (callController) {
				require(['controllers/' + callController], function(Controller) {
					Controller.initialize();
				});
			}
		}
	};

	return App;
});