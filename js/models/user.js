var app = app || {};

app.User = Backbone.Model.extend({
    url: "http://localhost/AdvancedServerCW2/api/authenticate",
    defaults: function () {
        return {
            name: "default_title",
            username: "default_url",
            password: "",
            wish_list_name: '',
            wish_list_description: "could"
        };
    }
});

