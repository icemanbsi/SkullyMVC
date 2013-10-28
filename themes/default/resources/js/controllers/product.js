define([
	"jquery",
	"underscore",
	"backbone",
	"app"
], function($, _, Backbone, MainApp){
	"use strict";

	// Model
	// ------------------------------------------------------------------------

	var Model = Backbone.Model.extend({
		contentTemplate : '<figure><img src="<%= model.get(\'img\') %>" alt=""></figure> <div class="modal-content"> <div class="modal-lang lang-opened" data-lang="chinese"> <header><h1><%= model.get(\'title\') %></h1></header> <article class="text"><%= model.get(\'description\') %></article> <footer><a href="<%= model.get(\'info_url\') %>">公司介紹</a><a data-lang="english">English</a></footer> </div> <div class="modal-lang" data-lang="english"> <header><h1><%= model.get(\'english_title\') %></h1></header> <article class="text"><%= model.get(\'english_description\') %></article> <footer><a href="<%= model.get(\'info_url\') %>">公司介紹</a><a data-lang="chinese">Chinese</a></footer> </div> </div>',

		initialize: function() {
		},

		openModal: function() {
			var self 	 = this,
				template = '';

			template = _.template(this.contentTemplate, {model: this});

			MainApp.defaultActions.openModal({
				border 	: true,
				html	: template,
				onLoad 	: function($container) {
					$container.find('footer').on('click', 'a[data-lang]', function(e) {
						e.preventDefault();

						$container.find('.modal-lang.lang-opened').removeClass('lang-opened');
						$container.find('.modal-lang[data-lang="'+$(this).data('lang')+'"]').addClass('lang-opened');
					});
				}
			});
		}
	});

	// Collection
	// ------------------------------------------------------------------------

	var Collection = Backbone.Collection.extend({
		model: Model,

		initialize: function() {
		},

		parse: function(response) {
			return response.model;
		},

		render: function($element, callback) {
			var view = new View({el: $element, collection: this});

			view.render(callback);
		}
	});

	// Applications
	// ------------------------------------------------------------------------

	var App = {
		$sidebarContainer : undefined,
		$blockContainer   : undefined,
		collection        : undefined,

		initialize: function() {
			var self = this;

			// Initialize variables
			// ------------------------------------------------------------------------

			this.$sidebarContainer = $('.sidebar');
			this.$blockContainer   = $('.product-list-block');
			this.collection  	   = new Collection();

			if (! _.isUndefined(products) && ! _.isEmpty(products)) {
				this.collection.reset(products);
			}


			// Bind Functions
			// ------------------------------------------------------------------------

			this.defActions();
		},

		defActions: function() {
			var self = this;

			// Sidebar listener
			// ------------------------------------------------------------------------

			this.$sidebarContainer.find('.company').on('click', 'li.parent > a', function(e) {
				var $self = $(this);

				if (! $self.next('.sub-block').length) { return true; }
				else { e.preventDefault(); }

				$self.toggleClass('active');

				//if ($self.hasClass('on-slide')) { return false; }

				// ------------------------------------------------------------------------

				// $self.addClass('on-slide');
				// if ($self.hasClass('active')) {
				// 	$self.next('.sub-block').slideUp(function() {
				// 		$self.removeClass('on-slide');
				// 		$self.removeClass('active');

				// 		$(this).data('jsp').destroy();
				// 		$(this).css({'display': 'none'});
				// 	});
				// } else {
				// 	$self.addClass('active');
				// 	$self.next('.sub-block').slideDown(function() {
				// 		$self.removeClass('on-slide');


				// 		$(this).jScrollPane({autoReinitialise: true});
				// 	});
				// }
			});


			// Product listener
			// ------------------------------------------------------------------------

			this.$blockContainer.on('click', 'a[data-product]', function(e) {
				var $self = $(this),
					model;
				e.preventDefault();

				model = self.collection.findWhere({id: $self.data('product')});
				if (_.isUndefined(model)) {
					alert('Product not found');
					return false;
				}

				model.openModal();
			});
		}
	};

	// Initialize
	// ------------------------------------------------------------------------

	var initialize = function() {
		App.initialize();
	};

	return { initialize: initialize };

});