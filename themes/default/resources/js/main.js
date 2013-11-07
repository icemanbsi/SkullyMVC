require.config({
	waitSeconds: 200,
	paths: {
		"jquery": 				"vendor/jquery-1.9.0.min",
		"underscore": 			"vendor/underscore-AMD-1.4.4",
		"backbone": 			"vendor/backbone-AMD-1.0.0",
		"async": 				"vendor/async",

		// Defaults
		"plugins": 				"plugins",
		"default_actions": 		"defaultActions"
	},
	shim: {
		"plugins": 				{ deps: ["jquery"] },
		"default_actions": 		{ deps: ["jquery"] }
	}
});

require(["app", "plugins"], function(MainApp) {
	MainApp.initialize();
});