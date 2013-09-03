window.Router = Backbone.Router.extend({

	routes: {
		"": "home",
		"contact": "contact",
		"books": "getListBook"
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
	},
	
	getListBook: function() {
		if (!this.bookListView) {
			this.bookListView = new BookListView();
			this.bookListView.render();
		}
		$("#main-content").html(this.bookListView.el);
	}
});

var mapTemplates = {
	"BaseView"			: "BaseView.html",
	"HomeView"			: "HomeView.html",
	"ContactView"		: "ContactView.html",
	"BookListView"		: "books/BookListView.html"
};

templateLoader.load(["BaseView", "HomeView", "ContactView", "BookListView"],
	function () {
		app = new Router();
		Backbone.history.start();
	}
);