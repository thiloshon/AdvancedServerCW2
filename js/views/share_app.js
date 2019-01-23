var app = app || {};

app.ShareAppView = Backbone.View.extend({
    el: $("#shareWish"),
    statsTemplate: _.template($("#stats-template-share").html()),

    initialize: function () {
        this.allCheckbox = this.$("#toggle-all-share")[0];

        this.listenTo(app.wish_list_share, "add", this.addOne);
        this.listenTo(app.wish_list_share, "all", this.render);

        this.footer = this.$("footer-share");
        this.main = $("#main-share");

        app.wish_list_share.fetch({data: $.param({owner_id: this.$("#new-todo-owner").val()})});

    },

    render: function () {
        var taken_size = app.wish_list_share.claimed_wishes().length;
        var remaining_size = app.wish_list_share.remaining_wishes().length;

        if (app.wish_list_share.length) {
            this.main.show();
            this.footer.show();
            this.footer.html(this.statsTemplate({done: taken_size, remaining: remaining_size}));
        } else {
            this.main.hide();
            this.footer.hide();
        }

        this.allCheckbox.checked = !remaining_size;
    },

    addOne: function (todo) {
        var view = new app.ShareView({model: todo});
        this.$("#todo-list-share").append(view.render().el);
    },
});