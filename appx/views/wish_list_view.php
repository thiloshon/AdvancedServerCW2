<nav class="navbar navbar-expand-lg gradientColor justify-content-between">

    <div class="jumbotron">
        <span class="row">
            <h1 class="display-3">
                <?php echo $this->session->wish_list_name ?>
            </h1>
            <p class="lead">
                <?php echo $this->session->name ?>
            </p>
        </span>
        <hr class="my-4">
        <h4><?php echo $this->session->wish_list_description ?></h4>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0">
            <a id="share-btn" class="btn btn-warning my-2 my-sm-0" target="_blank"
               href="<?php echo base_url(); ?>wish_list/share/<?php echo $this->session->username ?>">
                <i class="fa fa-share-alt"></i>
            </a>
            <a class="btn btn-dark my-2 my-sm-0" href="http://localhost/AdvancedServerCW2/auth/logout">Logout</a>
        </form>
    </div>
</nav>

<div class="container">
    <div id="todoapp">

        <header>
            <div id="new-data">
                <form>
                    <br/>
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
    </div>
</div>


<script type="text/template" id="item-template">
    <div class="view">

        <input id="list-item<%- url %>" class="toggle" type="checkbox"
               style="display: none;" <%= taken ? 'checked="checked"' : '' %> />

        <label for="list-item<%- url %>"></label>
        <label><%- title %></label> <br/>
        <label><%- price %> $</label> <br/>
        <label><%- priority === 'must' ? "Must Have" : (
            priority === 'would' ? "Would be Nice to Have" : "If You Can") %>
        </label> <br/>
        <label><a href="<%- url %>"><%- url %></a></label>

        <a class="destroy"></a>
    </div>

    <div class="edit_box">
        <input class="edit_elem form-control" type="text" value="<%- title %>"/>
        <input class="edit_elem form-control" type="text" value="<%- price %>"/>
        <input class="edit_elem form-control" type="text" value="<%- priority %>"/>
        <input class="edit_elem form-control" type="text" value="<%- url %>"/>
    </div>
</script>

<script type="text/template" id="stats-template"></script>

<script type="text/template" id="user-template">
    <div>
        <p><%- wish_list_name %> </p>
    </div>
</script>

<script src="<?php echo base_url(); ?>/js/models/wish.js"></script>
<script src="<?php echo base_url(); ?>/js/collections/wishes.js"></script>
<script src="<?php echo base_url(); ?>/js/views/wishes.js"></script>
<script src="<?php echo base_url(); ?>/js/views/app.js"></script>
<script src="<?php echo base_url(); ?>/js/app.js"></script>


