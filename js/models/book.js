window.Book = Backbone.Model.extend({

	urlRoot: "api/index.php/books",

	defaults: {
		id: null,
		title: "",
		category: "",
		author: "",
		publisher: "",
		language: "",
		publication_date: "",
		description: ""
	},
	
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

	url: "api/index.php/books",

	findByTitle: function(key) {
		var url = (key == '') ? 'api/index.php/books' : "api/index.php/books/search/" + key;
		debug('findByTitle: ' + key);
		var self = this;
		$.ajax({
			url: url,
			dataType: "json",
			success: function(data) {
				debug("search success: " + data.length);
				self.reset(data);
			}
		});
	}
});