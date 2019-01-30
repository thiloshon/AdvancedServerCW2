var app = app || {};

app.Wish = Backbone.Model.extend({
    defaults: function () {
        return {
            title: "default_title",
            url: "default_url",
            price: -9,
            priority: "could",
            taken: false,
            owner_id: "default_username",
            css_val: Math.floor(Math.random() * 10000000) + 1
        };
    },

    claim_wish: function () {
        this.save({taken: !this.get("taken")});
    }
});
