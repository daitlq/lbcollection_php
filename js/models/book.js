window.Book = Backbone.Model.extend({

	urlRoot: "api/index.php/books",

	initialize: function () {
	}
});

window.BookCollection = Backbone.Collection.extend({

	model: Book,

	url: "api/index.php/books"

});