<?php
/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 04-Nov-18
 * Time: 6:21 PM
 */

?>



<h3>Register for ECWM604</h3>

<form action="http://localhost/AdvancedServerCW2/auth/createaccount" method="POST">

    Enter your name:
    <input type="text" name="name" length="20" size="50"> <br>

    Choose your username:
    <input type="text" name="uname" length="10" size="10"> <br>

    Choose password:
    <input type="password" name="pword" length="15" size="30"> <br>

    Confirm password:
    <input type="password" name="conf_pword" length="15" size="30"> <br>

    <input type=submit value="Register!">
</form>

<span style="color: red"><?php echo $errmsg ?></span>
