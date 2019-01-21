//see detail -> official example
//http://backbonejs.org/docs/todos.html
//http://backbonejs.org/examples/todos/index.html

$(function () {
    //Define Model
    var Todo = Backbone.Model.extend({
        defaults: function () {
            return {
                title: "no title...",
                url: "",
                price: 0,
                priority: "",
                done: false,
                order: Todos.nextOrder(),
            };
        },
        toggle: function () {
            this.save({done: !this.get("done")});
        }
    });

    //Model Collection
    var TodoList = Backbone.Collection.extend({
        model: Todo,
        url: "http://localhost/AdvancedServerCW2/index.php/Welcome/wishList",
        //localStorage: new Backbone.LocalStorage("todos-backbone"),
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
        comparator: 'order'
    });
    var Todos = new TodoList;

    //Model View & event action
    var TodoView = Backbone.View.extend({
        tagName: "tr",
        template: _.template($("#item-template").html()),
        events: {
            "click .toggle": "toggleDone",
            "dblclick .view": "edit",
            "click a.destroy": "clear",
            "keypress .edit": "updateOnEnter",
            //"blur .edit": "close",
            "blur .edit_box": "close"
        },
        initialize: function () {
            this.listenTo(this.model, "change", this.render);
            this.listenTo(this.model, "destroy", this.remove);
        },
        render: function () {
            this.$el.html(this.template(this.model.toJSON()));
            this.$el.toggleClass("done", this.model.get("done"));
            //this.input = this.$(".edit");
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
            //var value = this.input.val();

            var arr = [];
            this.inputSet.each(function(e){
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

    //Make Application
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

            this.listenTo(Todos, "add", this.addOne);
            this.listenTo(Todos, "reset", this.addAll);
            this.listenTo(Todos, "all", this.render);

            this.footer = this.$("footer");
            this.main = $("#main");

            Todos.fetch();
            console.log("letssee");
            console.log(Todos);
        },

        render: function () {
            var done = Todos.done().length;
            var remaining = Todos.remaining().length;

            if (Todos.length) {
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
            Todos.each(this.addOne, this);
        },

        makeVisible: function () {
            console.log(this.input.val() === "");

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

            Todos.create({title: this.input.val(), price: this.$("#new-todo-price").val(),
                priority: this.$("#new-todo-priority").val(), url: this.$("#new-todo-url").val()});

            this.input.val("");
            this.$("#new-todo-price").val("");
            this.$("#new-todo-priority").val("");
            this.$("#new-todo-url").val("");

            this.makeVisible();
        },
        clearCompleted: function () {
            _.invoke(Todos.done(), "destroy");
            return false;
        },

        toggleAllComplete: function () {
            var done = this.allCheckbox.checked;
            Todos.each(function (todo) {
                todo.save({"done": done});
            });
        }

    });
    var App = new AppView;

}());