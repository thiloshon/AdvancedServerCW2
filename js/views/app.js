var app = app || {};

app.AppView = Backbone.View.extend({
    el: $("#todoapp"),
    statsTemplate: _.template($("#stats-template").html()),
    events: {
        "keyup #new-todo-title": "makeVisible",
        "keypress #new-todo-url": "createOnEnter",
        "click #clear-completed": "clearCompleted",
        "click #logout-btn": "logout"
    },

    initialize: function () {
        this.input = this.$("#new-todo-title");
        this.allCheckbox = this.$("#toggle-all")[0];

        this.listenTo(app.wish_list, "add", this.addOne);
        this.listenTo(app.wish_list, "all", this.render);
        //this.listenTo(app.wish_list, "sort", this.render);

        this.footer = this.$("footer");
        this.main = $("#main");

        app.wish_list.fetch({
            data: $.param({owner_id: this.$("#new-todo-owner").val()}),
            error: (function (e) {
                alert(' Service request failure: ' + e);
            })
        });

    },

    render: function () {
        var taken_size = app.wish_list.claimed_wishes().length;
        var remaining_size = app.wish_list.remaining_wishes().length;

        if (app.wish_list.length) {
            this.main.show();
            this.footer.show();
            this.footer.html(this.statsTemplate({done: taken_size, remaining: remaining_size}));
        } else {
            this.main.hide();
            this.footer.hide();
        }

        this.allCheckbox.checked = !remaining_size;
    },

    addOne: function (wish) {
        var view = new app.WishView({model: wish});
        this.$("#todo-list").append(view.render().el);
    },

    makeVisible: function () {

        if (this.input.val() === "") {
            $(".new-data-item").addClass("hidden");
            $(".new-data-item").removeClass("focused");
        } else {
            $(".new-data-item").addClass("focused");
            $(".new-data-item").removeClass("hidden");
        }
    },

    createOnEnter: function (e) {
        if (e.keyCode != 13) return;
        if (!this.input.val()) return;

        var temp_priority = this.$("#new-todo-priority").val();

        if(this.input.val() === '' || this.$("#new-todo-price").val() === '' || temp_priority === '' || this.$("#new-todo-url").val() === ''){
            alert("Missing Values");
        } else {
            app.wish_list.create({
                title: this.input.val(),
                price: this.$("#new-todo-price").val(),
                priority: temp_priority,
                url: this.$("#new-todo-url").val(),
                owner_id: this.$("#new-todo-owner").val(),
                priorityVal: (temp_priority === "would" ? 2 : (temp_priority === "could" ? 1 : 3))
            });

            this.input.val("");
            this.$("#new-todo-price").val("");
            this.$("#new-todo-priority").val("");
            this.$("#new-todo-url").val("");

            this.makeVisible();
        }


    },

    logout: function (e) {
        e.preventDefault();
        window.location.replace('http://localhost/AdvancedServerCW2/auth/logout');
    }
});