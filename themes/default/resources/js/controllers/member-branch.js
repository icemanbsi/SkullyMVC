define([
	"jquery",
	"underscore",
	"app"
], function($, _, MainApp){
	"use strict";

	// Applications
	// ------------------------------------------------------------------------

	var App = {
		$container: undefined,

		initialize: function() {
			// Initialize variables
			// ------------------------------------------------------------------------

			this.$container = $('.branch-list');

			// Bind functions
			// ------------------------------------------------------------------------

			this.defActions();
		},

		defActions: function() {
			var self = this;

			// Bind MAP
			// ------------------------------------------------------------------------

			this.$container.on('click', '.map', function(e) {
				var $self = $(this);
				e.preventDefault();

				MainApp.defaultActions.openModal({
					border: true,
					html: $('<div />', {'id': 'gmaps'}),
					onLoad: function($container) {
						self.openMap($self);
					}
				});

			});
		},

		openMap: function($element) {
			var self = this,
				lat  = $element.data('lat'),
				lng  = $element.data('long'),
				add  = $element.data('address'),
				req  = [],
				func, mapOpt, map, marker;

			// No data?
			if (_.isUndefined(lat) && _.isUndefined(lng) && _.isUndefined(add)) { return false; }

			if (! _.isUndefined(add) && ! _.isEmpty(add)) {
				func = function() {
					$.get('http://maps.googleapis.com/maps/api/geocode/json?address='+add+'&sensor=true', function(googleResult) {
						lat = googleResult.results[0].geometry.location.lat;
						lng = googleResult.results[0].geometry.location.lng;

						mapOpt = {
							center: new google.maps.LatLng(lat, lng),
							zoom: 16,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};

						map    = new google.maps.Map(document.getElementById('gmaps'), mapOpt);

						marker = new google.maps.Marker({
							position: new google.maps.LatLng(lat, lng),
							map: map,
							animation: google.maps.Animation.DROP
						});
					});
				}
			} else {
				func = function() {
					mapOpt = {
						center: new google.maps.LatLng(lat, lng),
						zoom: 16,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};

					map    = new google.maps.Map(document.getElementById('gmaps'), mapOpt);

					marker = new google.maps.Marker({
						position: new google.maps.LatLng(lat, lng),
						map: map,
						animation: google.maps.Animation.DROP
					});
				}
			}

			// ------------------------------------------------------------------------

			require(['async!//maps.google.com/maps/api/js?v=3&sensor=false'], func);

		}
	};

	// Initialize
	// ------------------------------------------------------------------------

	var initialize = function() {
		App.initialize();
	};

	return { initialize: initialize };

});