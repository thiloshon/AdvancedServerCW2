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

    /**
     * Logging in logic.
     * @param e
     */
    login: function (e) {
        e.preventDefault();

        if (this.$("#uname").val() == '' ||  this.$("#pword").val() == ''){
            swal("Empty Fields!", "Please fill all!", "error");
        } else {
            app.user = new app.User({username: this.$("#uname").val(), password: this.$("#pword").val()});

            app.user.save(null, {
                success: function () {
                    window.location.replace('http://localhost/AdvancedServerCW2/wish_list');
                },
                error: (function (e) {
                    swal("Incorrect Password!", "Please try again!", "error");
                })
            });
        }
    }
});
