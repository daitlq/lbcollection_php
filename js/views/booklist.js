window.BookListView = Backbone.View.extend({

	initialize: function() {
		debug('Initializing Book View');
	},

	render: function() {
		var books = this.collection.models;
		
		var length = books.length;
		var startPos = 0;
		var endPos = length;
		
		$(this.el).html(this.template());
		
		for (var i = startPos; i < endPos; i++) {
			$('.thumbnails', this.el).append(new BookListItemView({model: books[i]}).render().el);
		}
		
		return this;
	},
});

window.BookListItemView = Backbone.View.extend({

	tagName: "li",

	className: "span3",

	initialize: function() {
		this.model.bind("change", this.render, this);
		this.model.bind("destroy", this.close, this);
	},

	render: function() {
		$(this.el).html(this.template(this.model.toJSON()));
		$(".toolTipgroup a", this.el).tooltip();
		return this;
	}

});