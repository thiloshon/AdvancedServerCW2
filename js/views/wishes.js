var app = app || {};


app.TodoView = Backbone.View.extend({
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

    toggleDone: function () {
        this.model.claim_wish();
    },

    edit: function () {
        this.$el.addClass("editing");
        this.$el.find(".edit_box").addClass("editing");
    },

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
        this.model.destroy();
    }
});