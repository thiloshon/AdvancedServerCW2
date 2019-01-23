<div class="container login-container">

    <div class="row">

        <div class="col-md-6 login-form-1">
            <h3>Welcome to Wish-esque!!! <br/> Login</h3>
            <form action="http://localhost/AdvancedServerCW2/auth/authenticate" method="POST">
                <div class="form-group">
                    <input name="uname" type="text" class="form-control" placeholder="Your Username" value="" />
                </div>
                <div class="form-group">
                    <input name="pword" type="password" class="form-control" placeholder="Your Password" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Login" />
                </div>
            </form>



        </div>

        <div class="col-md-6 login-form-2">
            <h3>Register <br/> and create new wish lists</h3>

            <form action="http://localhost/AdvancedServerCW2/auth/create_account" method="POST">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" value="" />
                </div>
                <div class="form-group">
                    <input type="text" name="uname" class="form-control" placeholder="Your Username" value="" />
                </div>
                <div class="form-group">
                    <input type="password" name="pword" class="form-control" placeholder="Your Password" value="" />
                </div>
                <div class="form-group">
                    <input type="password" name="conf_pword" class="form-control" placeholder="Reconfirm Password" value="" />
                </div>

                <hr/>

                <div class="form-group">
                    <input type="text" name="wishlist_name"  class="form-control" placeholder="Name your Wish list" value="" />
                </div>

                <div class="form-group">
                    <input type="text" name="wishlist_desc"  class="form-control" placeholder="Add a description" value="" />
                </div>


                <hr/>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Create Wishlist" />
                </div>

            </form>
        </div>

        <span style="color: red"><?php echo $errmsg ?></span>

    </div>
</div>
