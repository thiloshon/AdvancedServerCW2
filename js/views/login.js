var app = app || {};

app.LoginView = Backbone.View.extend({
    el: $("#login_panel"),

    initialize: function () {
    },

    render: function () {
    },

    events: {
        "click #login-submit": "login"
    },

    login: function (e) {
        e.preventDefault();

        app.user = new app.User({username: this.$("#uname").val(), password: this.$("#pword").val()});

        app.user.save(null, {
            success: function () {
                window.location.replace('http://localhost/AdvancedServerCW2/wish_list');
            },
            error: (function (e) {
                alert('Login error. Try again');
            })
        });
    }
});
