$(function () {

    var Wish = Backbone.Model.extend({
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


    var WishList = Backbone.Collection.extend({
        model: Wish,
        url: "http://localhost/AdvancedServerCW2/api/wish",

        claimed_wishes: function () {
            return this.where({taken: true});
        },

        remaining_wishes: function () {
            return this.where({taken: false});
        },

        /*comparator: function (item1, item2) {
         console.log(item1.attributes.priorityVal -  item2.attributes.priorityVal)
         console.log(item1.attributes.priorityVal + " " +  item2.attributes.priorityVal)
         return ((item1.attributes.priorityVal - item2.attributes.priorityVal));
         },*/

        parse: function (response) {
            response.forEach(function (element) {
                element.taken = !!+element.taken;
                element.priorityVal = (element.priority === "would" ? 2 : (element.priority === "could" ? 1 : 3));

            });

            function compare(a, b) {
                return a.priorityVal - b.priorityVal;
            }

            response.sort(compare);

            return response;
        }
    });

    var wish_list = new WishList;

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
            this.$el.toggleClass("done", this.model.get("taken"));
            this.inputSet = this.$(".edit_box :input");
            return this;
        },

        toggleDone: function () {
            this.model.claim_wish();
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


    var AppView = Backbone.View.extend({
        el: $("#todoapp"),
        statsTemplate: _.template($("#stats-template").html()),
        events: {
            "keyup #new-todo-title": "makeVisible",
            "keypress #new-todo-url": "createOnEnter",
            "click #clear-completed": "clearCompleted"
            /*"click #toggle-all": "toggleAllComplete"*/
        },

        initialize: function () {
            this.input = this.$("#new-todo-title");
            this.allCheckbox = this.$("#toggle-all")[0];

            this.listenTo(wish_list, "add", this.addOne);
            this.listenTo(wish_list, "all", this.render);

            this.footer = this.$("footer");
            this.main = $("#main");

            wish_list.fetch({data: $.param({owner_id: this.$("#new-todo-owner").val()})});

        },

        render: function () {
            var taken_size = wish_list.claimed_wishes().length;
            var remaining_size = wish_list.remaining_wishes().length;

            if (wish_list.length) {
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
            var view = new TodoView({model: todo});
            this.$("#todo-list").append(view.render().el);
        },

        /*addAll: function () {
         wish_list.each(this.addOne, this);
         },*/

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

            wish_list.create({
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

        },

        clearCompleted: function () {
            _.invoke(wish_list.claimed_wishes(), "destroy");
            return false;
        }
    });

    var App = new AppView;
}());