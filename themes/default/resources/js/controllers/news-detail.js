define([
	"jquery",
	"underscore",
	"app"
], function($, _, MainApp){
	"use strict";

	// Applications
	// ------------------------------------------------------------------------

	var App = {
		$relatedNewsContainer : undefined,

		initialize: function() {
			// Initialize variables
			// ------------------------------------------------------------------------

			this.$relatedNewsContainer = $('.related-news');

			// Bind functions
			// ------------------------------------------------------------------------

			this.defaultActions();
		},

		defaultActions: function() {
			var self = this;

			// Related news
			// ------------------------------------------------------------------------

			if (this.$relatedNewsContainer.length) {
				var newsLength  = this.$relatedNewsContainer.find('.rn-list li').length,
					maxNextMove = Math.ceil(newsLength / 4),
					curMove     = 1,
					nextMove 	= 1,
					width		= this.$relatedNewsContainer.width() + 15;

				this.$relatedNewsContainer.on('click', 'a.rn-pagination', function(e) {
					var $self = $(this);
					e.preventDefault();

					// on animation?
					if (self.$relatedNewsContainer.hasClass('on-animate'))
					{ return false; }


					if ($self.hasClass('rn-prev')) {
						if (curMove == 1) { nextMove = maxNextMove; }
						else { nextMove = curMove - 1; }
					} else {
						if (curMove >= maxNextMove) { nextMove = 1; }
						else { nextMove = curMove + 1; }
					}


					// Animate
					self.$relatedNewsContainer.addClass('on-animate');
					self.$relatedNewsContainer.find('.rn-list ul').animate({
						'margin-left': ((nextMove - 1) * width) * -1
					}, 300, function() {
						self.$relatedNewsContainer.removeClass('on-animate');

						curMove = nextMove;
					});
				});
			}
		}
	};

	// Initialize
	// ------------------------------------------------------------------------

	var initialize = function() {
		App.initialize();
	};

	return { initialize: initialize };

});