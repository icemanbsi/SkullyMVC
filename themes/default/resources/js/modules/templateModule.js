define([
	"jquery", 
	"underscore",
	"backbone",
	"app",
	"text!templates/templateName.html"
], function($, _, Backbone, MainApp){
	"use strict";

	// View
	// ------------------------------------------------------------------------
	
	var View = Backbone.View.extend({
		render: function(callback) {
			var self = this;

			// Has callback?
			// ------------------------------------------------------------------------

			if (_.isFunction(callback)) {
				callback(self.el)
			}

			return this;
		}
	});

	// Model
	// ------------------------------------------------------------------------
	
	var Model = Backbone.Model.extend({
		initialize: function() {
			console.debug('Model Loaded');
		}
	});

	// Collection
	// ------------------------------------------------------------------------
	
	var Collection = Backbone.Collection.extend({
		model: Model,

		initialize: function() {
			console.debug('Collection loaded');
		},

		parse: function(response) {
			return response.model;
		},

		render: function($element, callback) {
			var view = new View({el: $element, collection: this});

			view.render(callback);
		}
	});



	return  {
		model: 		Model,
		collection: Collection,
		view: 		View
	};
	
});