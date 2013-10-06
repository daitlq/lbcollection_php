window.BookView = Backbone.View.extend({

	events: {
		"click .icon-trash"   : "deleteBook"
    },
	
	initialize: function() {
		debug('Initializing Book Details View');
	},

	render: function() {
		$(this.el).html(this.template(this.model.toJSON()));
		return this;
    },
	
	deleteBook: function (event) {
		event.stopPropagation();
        event.preventDefault();
		this.model.destroy({
			success: function() {
				alert('This book was deleted successfully!');
				window.location.href = "#books";
			}
		});
    }
});