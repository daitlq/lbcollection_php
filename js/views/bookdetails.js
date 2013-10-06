window.BookView = Backbone.View.extend({

	initialize: function() {
		debug('Initializing Book Details View');
	},

	render: function() {
		$(this.el).html(this.template(this.model.toJSON()));
		return this;
    }
});