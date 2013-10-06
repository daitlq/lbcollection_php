window.BookEditView = Backbone.View.extend({

	events: {
		"change"        : "change",
        "click .save"   : "updateBook"
    },
	
	initialize: function() {
		debug('Initializing Book Edit View');
	},

	render: function() {
		$(this.el).html(this.template(this.model.toJSON()));
		return this;
    },
	
	change: function(event) {
        // Remove any existing alert message
        utils.hideAlert();

        // Apply the change to the model
        var target = event.target;
        var change = {};
        change[target.name] = target.value;
        this.model.set(change);

        // Run validation rule (if any) on changed item
        var check = this.model.validateItem(target.id);
        if (check.isValid === false) {
            utils.addValidationError(target.id, check.message);
        } else {
            utils.removeValidationError(target.id);
        }
    },
	
	updateBook: function() {
		this.model.save(null, {
			success: function (model) {
				utils.showAlert('Success!', 'Book saved successfully', 'alert-success');
				window.location.href = "#books/" + model.id;
			},
			error: function () {
				utils.showAlert('Error', 'An error occurred while trying to delete this item', 'alert-error');
			}
		});
	}
});