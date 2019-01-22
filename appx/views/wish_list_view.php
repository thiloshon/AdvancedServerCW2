<!DOCTYPE html>
<html>
<head>
    <title>History Example</title>

    <link rel="stylesheet" href="../css/style.css">

    <script src="https://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="https://rawgit.com/jashkenas/underscore/1.5.2/underscore-min.js" type="text/javascript"></script>
    <script src="https://rawgit.com/jashkenas/backbone/1.0.0/backbone-min.js" type="text/javascript"></script>
    <script src="https://rawgit.com/jeromegn/Backbone.localStorage/v1.1.6/backbone.localStorage.js" type="text/javascript"></script>
    <script src="https://rawgit.com/douglascrockford/JSON-js/master/json2.js" type="text/javascript"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>

<div class="container">
    <div id="todoapp">
        <header>
            <h1>Todos by Backbone.js</h1>
            <p>By: <?php echo $this->session->name ?> </p>

            <div id="new-data">
                <form>

                    <input id="new-todo-title" class="form-control" type="text" placeholder="What do you wish?"/>
                    <input id="new-todo-price" class="new-data-item form-control hidden" type="text" placeholder="How much is it?" />
                    <input id="new-todo-priority" class="new-data-item form-control hidden" type="text" placeholder="How important is it?"/>
                    <input id="new-todo-url" class="new-data-item form-control hidden" type="text" placeholder="Where to get it (URL)?"/>

                    <input id="new-todo-owner" class="hidden" value="<?php echo $this->session->username ?>">

                </form>
            </div>
        </header>

        <section id="main" style="display: block;">
            <input id="toggle-all" type="checkbox"/>
            <label for="toggle-all">Mark all as complete</label>
            <ul id="todo-list"></ul>
        </section>

        <footer style="display: block;">
            <div class="todo-count"><b>2</b> items left</div>
        </footer>
    </div>
</div>





</body>

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
    <a id="clear-completed">Clear <%= done %> completed <%= done == 1 ? 'item' : 'items' %></a>
    <% } %>
    <div class="todo-count"><b><%= remaining %></b> <%= remaining == 1 ? 'item' : 'items' %> left</div>
</script>


<script src="../js/wishlist.js"></script>

</html>