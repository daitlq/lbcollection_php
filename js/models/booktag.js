window.Tag = Backbone.Model.extend({

	urlRoot: "api/index.php/tags",

	initialize: function() {
	}
});

window.TagCollection = Backbone.Collection.extend({

	model: Tag,

	url: "api/index.php/tags"
});

window.BookTag = Backbone.Model.extend({

	urlRoot: "api/index.php/booktag",

	initialize: function() {
	}
});

window.BookTagCollection = Backbone.Collection.extend({

	model: BookTag,

	url: "api/index.php/booktag",

	findByBook: function(key) {
		var url = (key == '') ? 'api/index.php/booktag' : "api/index.php/booktag/searchByBook/" + key;
		//debug('findTagsByBookID: ' + key);
		var self = this;
		$.ajax({
			url: url,
			dataType: "json",
			success: function(data) {
				//debug("search success: " + data.length);
				self.reset(data);
			}
		});
	}
});