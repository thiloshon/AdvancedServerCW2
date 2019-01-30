var app = app || {};


app.ShareView = Backbone.View.extend({
    tagName: "li",
    template: _.template($("#item-template-share").html()),

    events: {
        "click #claim-123": "claimTrigger"
    },

    initialize: function () {
        this.listenTo(this.model, "change", this.render);
        this.listenTo(this.model, "destroy", this.remove);
    },

    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        this.$el.toggleClass("done", this.model.get("taken"));
        return this;
    },

    claimTrigger : function (e) {
        e.preventDefault();
        console.log("Trigged");
        console.log(e);
    }
});