window.Book = Backbone.Model.extend({

	urlRoot: "api/index.php/books",

	initialize: function() {
		this.validators = {};

		this.validators.title = function(value) {
			return value.length > 0 ? {isValid: true} : {isValid: false, message: "You must enter a title"};
		}
	},
	
	validateItem: function(key) {
		return (this.validators[key]) ? this.validators[key](this.get(key)) : {isValid: true};
	}
});

window.BookCollection = Backbone.Collection.extend({

	model: Book,

	url: "api/index.php/books"

});