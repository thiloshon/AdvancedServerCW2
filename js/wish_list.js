$(function () {

    var Wish = Backbone.Model.extend({
        defaults: function () {
            return {
                title: "default_title",
                url: "default_url",
                price: -9,
                priority: "could",
                done: false,
                owner_id: "default_username",
                order: wish_list.nextOrder(),
            };
        },

        toggle: function () {
            this.save({done: !this.get("done")});
        }
    });


    var WishList = Backbone.Collection.extend({
        model: Wish,
        url: "http://localhost/AdvancedServerCW2/api/wish",

        done: function () {
            return this.where({done: true});
        },

        remaining: function () {
            return this.without.apply(this, this.done());
        },

        nextOrder: function () {
            if (!this.length) return 1;
            return this.last().get("order") + 1;
        },

        comparator: 'order',

        parse: function (response) {
            response.forEach(function (element) {
                element.done = !!+element.done;
            });
            return response;
        }
    });


    var TodoView = Backbone.View.extend({
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
            this.$el.toggleClass("done", this.model.get("done"));
            this.inputSet = this.$(".edit_box :input");
            return this;
        },

        toggleDone: function () {
            this.model.toggle();
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

    var wish_list = new WishList;

    var AppView = Backbone.View.extend({
        el: $("#todoapp"),
        statsTemplate: _.template($("#stats-template").html()),
        events: {
            "keyup #new-todo-title": "makeVisible",
            "keypress #new-todo-url": "createOnEnter",
            "click #clear-completed": "clearCompleted",
            "click #toggle-all": "toggleAllComplete"
        },

        initialize: function () {
            this.input = this.$("#new-todo-title");
            this.allCheckbox = this.$("#toggle-all")[0];

            this.listenTo(wish_list, "add", this.addOne);
            this.listenTo(wish_list, "reset", this.addAll);
            this.listenTo(wish_list, "all", this.render);

            this.footer = this.$("footer");
            this.main = $("#main");

            wish_list.fetch({data: $.param({owner_id: this.$("#new-todo-owner").val()})});
        },

        render: function () {
            var done = wish_list.done().length;
            var remaining = wish_list.remaining().length;

            if (wish_list.length) {
                this.main.show();
                this.footer.show();
                this.footer.html(this.statsTemplate({done: done, remaining: remaining}));
            } else {
                this.main.hide();
                this.footer.hide();
            }

            this.allCheckbox.checked = !remaining;
        },

        addOne: function (todo) {
            var view = new TodoView({model: todo});
            this.$("#todo-list").append(view.render().el);
        },

        addAll: function () {
            wish_list.each(this.addOne, this);
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

            wish_list.create({
                title: this.input.val(), price: this.$("#new-todo-price").val(),
                priority: this.$("#new-todo-priority").val(), url: this.$("#new-todo-url").val(),
                owner_id: this.$("#new-todo-owner").val()
            });

            this.input.val("");
            this.$("#new-todo-price").val("");
            this.$("#new-todo-priority").val("");
            this.$("#new-todo-url").val("");

            this.makeVisible();
        },

        clearCompleted: function () {
            _.invoke(wish_list.done(), "destroy");
            return false;
        },

        toggleAllComplete: function () {
            var done = this.allCheckbox.checked;
            wish_list.each(function (todo) {
                todo.save({"done": done});
            });
        }
    });

    var App = new AppView;
}());