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

</head>

<body>

<div id="todoapp">
    <header>
        <h1>Todos by Backbone.js</h1>
        <input id="new-todo" type="text" placeholder="What do you wish?"/>
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
    <input class="edit" type="text" value="<%- title %>"/>
    <input class="edit" type="text" value="<%- price %>"/>
    <input class="edit" type="text" value="<%- priority %>"/>
    <input class="edit" type="text" value="<%- url %>"/>
</script>

<script type="text/template" id="edit_box">

    <input class="edit_element" type="text" value="<%- title %>"/>
    <input class="edit_element" type="text" value="<%- price %>"/>
    <input class="edit_element" type="text" value="<%- priority %>"/>
    <input class="edit_element" type="text" value="<%- url %>"/>
</script>

<script type="text/template" id="stats-template">
    <% if (done) { %>
    <a id="clear-completed">Clear <%= done %> completed <%= done == 1 ? 'item' : 'items' %></a>
    <% } %>
    <div class="todo-count"><b><%= remaining %></b> <%= remaining == 1 ? 'item' : 'items' %> left</div>
</script>


<script src="../js/wishlist.js"></script>

</html>