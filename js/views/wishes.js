var app = app || {};


app.WishView = Backbone.View.extend({
    tagName: "li",
    template: _.template($("#item-template").html()),
    events: {
        "click .toggle": "toggleDone",
        "dblclick .view": "edit",
        "click a.destroy": "clear",
        "keypress .edit": "updateOnEnter",
        "blur .edit_box": "close"
    },

    initialize: function () {
        this.listenTo(this.model, "change", this.render);
        this.listenTo(this.model, "destroy", this.remove);
    },

    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        this.$el.toggleClass("done", this.model.get("taken"));
        this.inputSet = this.$(".edit_box :input");
        return this;
    },

    /**
     * Function for claiming the wish
     */
    toggleDone: function () {
        this.model.claim_wish();
    },

    /**
     * Operations to edit an item
     */
    edit: function () {
        this.$el.addClass("editing");
        this.$el.find(".edit_box").addClass("editing");
    },

    /**
     * adding element while closing text fileds.
     */
    close: function () {
        var arr = [];
        this.inputSet.each(function (e) {
            arr.push(this.value);
        });

        if (!arr[0]) {
            this.clear();
        } else {
            this.model.save({title: arr[0], price: arr[1], priority: arr[2], url: arr[3]});
            this.$el.removeClass("editing");
            this.$el.find(".edit_box").removeClass("editing");
        }
    },

    updateOnEnter: function (e) {
        if (e.keyCode == 13) this.close();
    },

    clear: function () {
        this.model.destroy({
            success: function(model, response){
                swal("Deleted wish!",'', "success");
            }
        });

    }
});


app.UserView = Backbone.View.extend({
    tagName: "div",
    template: _.template($("#user-template").html()),

    initialize: function () {

    },

    render: function () {
        this.$el.html(this.template(app.user.toJSON()));
        return this;
    }
});