var app = app || {};

var WishList = Backbone.Collection.extend({
    initialize: function (models, options) {
        this.model = options.model ,
            this.url = options.url
    },
    /*model: Wish,
     url: "http://localhost/AdvancedServerCW2/api/wish",*/

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


app.wish_list = new WishList([], {model: app.Wish, url: 'http://localhost/AdvancedServerCW2/api/wish'});
app.wish_list_share = new WishList([], {model: app.Wish, url: 'http://localhost/AdvancedServerCW2/api/wish'});