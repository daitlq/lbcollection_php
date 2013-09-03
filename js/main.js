window.Router = Backbone.Router.extend({

	routes: {
		"": "home",
		"contact": "contact"
	},

	initialize: function() {
		if (!this.baseView) {
			this.baseView = new BaseView();
			this.baseView.render();
		} else {
			this.baseView.delegateEvents(); // delegate events when the view is recycled
		}
		$("#wrap-container").html(this.baseView.el);
	},

	home: function() {
		if (!this.homeView) {
			this.homeView = new HomeView();
			this.homeView.render();
		} else {
			this.homeView.delegateEvents();
		}
		$("#main-content").html(this.homeView.el);
	},
	
	contact: function() {
		if (!this.contactView) {
			this.contactView = new ContactView();
			this.contactView.render();
		}
		$("#main-content").html(this.contactView.el);
	}
});

templateLoader.load(["BaseView", "HomeView", "ContactView"],
	function () {
		app = new Router();
		Backbone.history.start();
	}
);