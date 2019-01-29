var app = app || {};

var WishList = Backbone.Collection.extend({
    initialize: function (models, options) {
        this.model = options.model ,
            this.url = options.url
    },

    /**
     * Number of wishes fulfilled
     * @returns {*}
     */
    claimed_wishes: function () {
        return this.where({taken: true});
    },

    /**
     * Number of wishes to be fulfilled.
     * @returns {*}
     */
    remaining_wishes: function () {
        return this.where({taken: false});
    },

    /**
     * Parsing the response recieved from GET call.
     * @param response
     * @returns {*}
     */
    parse: function (response) {
        response.forEach(function (element) {
            element.taken = !!+element.taken;
        });

        return response;
    },

    comparator: 'priority'
});

app.wish_list = new WishList([], {model: app.Wish, url: 'http://admin:serverCW@localhost/AdvancedServerCW2/api/wish'});
app.wish_list_share = new WishList([], {model: app.Wish, url: 'http://admin:serverCW@localhost/AdvancedServerCW2/api/wish'});