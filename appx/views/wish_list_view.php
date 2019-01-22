
<div class="container">
    <div id="todoapp">
        <header>
            <span class="row"><h1 class="display-3"><?php echo $this->session->wishlist ?></h1>  <p class="lead"><?php echo $this->session->name ?></p></span>

            <h3>
                <?php echo $this->session->description ?>

            </h3>

            <hr/>


            <div id="new-data">
                <form>

                    <input id="new-todo-title" class="form-control" type="text" placeholder="What do you wish?"/>
                    <input id="new-todo-price" class="new-data-item form-control hidden" type="text" placeholder="How much is it?" />
                    <input id="new-todo-priority" class="new-data-item form-control hidden" type="text" placeholder="How important is it?"/>
                    <input id="new-todo-url" class="new-data-item form-control hidden" type="text" placeholder="Where to get it (URL)?"/>

                    <input id="new-todo-owner" class="hidden" value="<?php echo $this->session->username ?>">

                </form>
            </div>

            <hr/>
        </header>

        <section id="main" style="display: block;">
            <input id="toggle-all" type="checkbox"/>
            <label for="toggle-all">Mark all as taken</label>
            <ul id="todo-list"></ul>
        </section>

        <footer style="display: block;">
            <div class="todo-count"><b>2</b> wishes to be taken</div>
        </footer>
    </div>
</div>



<script type="text/template" id="item-template">
    <div class="view">
        <input class="toggle" type="checkbox" <%= done ? 'checked="checked"' : '' %> />
        <label><%- title %></label>
        <br/>
        <label><%- price %></label>
        <br/>
        <label><%- priority %></label>
        <br/>
        <label><%- url %></label>
        <a class="destroy"></a>
    </div>
    <!--<input class="edit" type="text" value="<%- title %>"/>-->

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


<script src="<?php echo base_url(); ?>/js/wish_list.js"></script>

