window.BookListView = Backbone.View.extend({

	initialize:function() {
		debug('Initializing Book View');
	},

	render:function() {
		$(this.el).html(this.template());
		return this;
	}
});