<?php
/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 04-Nov-18
 * Time: 6:56 PM
 */

?>

<h3>Login for ECWM604</h3>

<form action="http://localhost/AdvancedServerCW2/auth/authenticate" method="POST">

    username:
    <input type="text" name="uname" length="10" size="10"> <br>

    password:
    <input type="password" name="pword" length="15" size="30"> <br>

    <input type=submit value="Login!">
</form>

<span style="color: red"><?php echo $errmsg ?></span>
