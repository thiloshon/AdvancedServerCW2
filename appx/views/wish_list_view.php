<div class="container">
    <div id="todoapp">
        <header>
            <span class="row">
                <h1 class="display-3">
                    <?php echo $this->session->wish_list_name ?>
                </h1>
                <p class="lead">
                    <?php echo $this->session->name ?>
                </p>
            </span>
            <h3>
                <?php echo $this->session->wish_list_description ?>
            </h3>
            <hr/>

            <div id="new-data">
                <form>
                    <input id="new-todo-title" class="form-control" type="text" placeholder="What do you wish?"/>
                    <input id="new-todo-price" class="new-data-item form-control hidden" type="text"
                           placeholder="How much is it?"/>
                    <input id="new-todo-priority" class="new-data-item form-control hidden" type="text"
                           placeholder="How important is it?"/>
                    <input id="new-todo-url" class="new-data-item form-control hidden" type="text"
                           placeholder="Where to get it (URL)?"/>
                    <input id="new-todo-owner" class="hidden" value="<?php echo $this->session->username ?>">
                </form>
            </div>
            <hr/>
        </header>

        <section id="main">
            <input id="toggle-all" type="checkbox" hidden/>
            <ul id="todo-list"></ul>
        </section>

        <p>Share your wish list with friends:
            <a href="<?php echo base_url(); ?>wish_list/share/<?php echo $this->session->username ?>">
                <?php echo base_url(); ?>wish_list/share/<?php echo $this->session->username ?>
            </a>
        </p>

        <div id="place_holder"></div>

        <footer style="display: block;">
            <div class="todo-count"><b>2</b> wishes to be taken</div>
        </footer>
    </div>
</div>


<script type="text/template" id="item-template">
    <div class="view">
        <input class="toggle" type="checkbox" <%= taken ? 'checked="checked"' : '' %> />

        <label><%- title %></label> <br/>
        <label><%- price %> $</label> <br/>
        <label><%- priority === 'must' ? "Must Have" : (priority === 'would' ? "Would be Nice to Have" : "If You Can")
            %></label> <br/>
        <label><a href="<%- url %>"><%- url %></a></label>

        <a class="destroy"></a>
    </div>

    <div class="edit_box">
        <input class="edit_elem" type="text" value="<%- title %>"/>
        <input class="edit_elem" type="text" value="<%- price %>"/>
        <input class="edit_elem" type="text" value="<%- priority %>"/>
        <input class="edit_elem" type="text" value="<%- url %>"/>
    </div>
</script>

<script type="text/template" id="stats-template">
    <% if (done) { %>
    <a id="clear-completed">Clear <%= done %> taken <%= done == 1 ? 'wish' : 'wishes' %></a>
    <% } %>

</script>

<script type="text/template" id="user-template">
    <div>
        <p>LOLO <%- wish_list_name %> </p>
    </div>

</script>


<script src="<?php echo base_url(); ?>/js/models/wish.js"></script>
<script src="<?php echo base_url(); ?>/js/collections/wishes.js"></script>
<script src="<?php echo base_url(); ?>/js/views/wishes.js"></script>
<script src="<?php echo base_url(); ?>/js/views/app.js"></script>
<script src="<?php echo base_url(); ?>/js/app.js"></script>


<!--<script src="<?php /*echo base_url(); */ ?>/js/wish_list.js"></script>-->

