<div class="container">
    <div id="shareWish">

        <header>
            <span class="row">
                <h1 class="display-3"><?php echo $this->session->wish_list_name ?></h1>
                <p class="lead"><?php echo $this->session->name ?></p>
            </span>

            <h3> <?php echo $this->session->wish_list_description ?> </h3>
            <hr/>
        </header>

        <section id="main-share">
            <input id="toggle-all-share" type="checkbox" hidden/>
            <input id="new-todo-owner" hidden value="<?php echo $this->session->username ?>">
            <ul id="todo-list-share"></ul>
        </section>

        <footer-share style="display: block;">
            <div class="todo-count"><b>2</b> wishes to be taken</div>
        </footer-share>
    </div>
</div>


<script type="text/template" id="item-template-share">
    <div class="view">
        <div class="toggle"/>

        <label class="<%= taken ? 'strike' : '' %>"><%- title %></label> <br/>
        <label class="<%= taken ? 'strike' : '' %>"><%- price %> $</label> <br/>
        <label class="<%= taken ? 'strike' : '' %>"><%- priority === 'must' ? "Must Have" : (priority === 'would' ?
            "Would be Nice to Have" : "If You Can") %></label> <br/>
        <label class="<%= taken ? 'strike' : '' %>"><a href="<%- url %>"><%- url %></a></label>

        <button onclick="myFunction('<%- id %>', '<%- title %>', <%- price %>, '<%- priority %>', '<%- url %>')"
                class="float-right claim-button <%= taken ? 'hidden-btn' : '' %>">Claim
        </button>

        <a class="destroy"></a>
    </div>
</script>

<script type="text/template" id="stats-template-share"></script>

<script>
    function myFunction(id, title, price, prt, url) {
        var person = prompt("Please enter your name or email to claim wish", "Dad");
        if (person != null) {
            jQuery.ajax({
                type: 'PUT',
                url: 'http://admin:serverCW@localhost/AdvancedServerCW2/api/wish',
                data: {id: id, title: title, price: price, priority: prt, url: url, taken_by: person, taken: 1},
                complete: function (data) {
                    swal("Successfully claimed wish!", "Thank You!", "success")
                        .then((value) => {
                        location.reload();
                })
                    ;
                }
            });
        }
    }
</script>

<script src="<?php echo base_url(); ?>/js/models/wish.js"></script>
<script src="<?php echo base_url(); ?>/js/collections/wishes.js"></script>

<script src="<?php echo base_url(); ?>/js/views/shareable_wish_view.js"></script>
<script src="<?php echo base_url(); ?>/js/views/shareable_wishlist_view.js"></script>

<script src="<?php echo base_url(); ?>/js/share_app.js"></script>




