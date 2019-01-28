var app = app || {};

var WishList = Backbone.Collection.extend({
    initialize: function (models, options) {
        this.model = options.model ,
            this.url = options.url
    },

    claimed_wishes: function () {
        return this.where({taken: true});
    },

    remaining_wishes: function () {
        return this.where({taken: false});
    },

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

app.wish_list = new WishList([], {model: app.Wish, url: 'http://localhost/AdvancedServerCW2/api/wish'});

app.wish_list.comparator =  function (wish) {
    return (wish.get('priority'));
};

app.wish_list_share = new WishList([], {model: app.Wish, url: 'http://localhost/AdvancedServerCW2/api/wish'});