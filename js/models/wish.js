var app = app || {};

app.Wish = Backbone.Model.extend({
    defaults: function () {
        return {
            title: "default_title",
            url: "default_url",
            price: -9,
            priority: "could",
            priorityVal: 0,
            taken: false,
            owner_id: "default_username"
        };
    },

    claim_wish: function () {
        this.save({taken: !this.get("taken")});
    }
});