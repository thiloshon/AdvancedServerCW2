<?php

/**
 *
 */
class Authlib
{
    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('user_model');
    }


    /**
     * @param $name
     * @param $user
     * @param $pwd
     * @param $conf_pwd
     * @return string
     */
    public function register($name, $user, $pwd, $conf_pwd, $wishlist, $wishlist_desc)
    {
        if ($name == '' || $user == '' || $pwd == '' || $conf_pwd == '' || $wishlist == '' || $wishlist_desc == '') {
            return 'Missing Fields';
        }

        if (strlen($pwd) < 7) {
            return "Password too short!";

        }

        if ($conf_pwd != $pwd) {
            return "Passwords do not match";
        }

        return $this->ci->user_model->register($name, $user, $pwd, $wishlist, $wishlist_desc);
    }


    /**
     * @param $user
     * @param $pwd
     * @return bool
     */
    public function login($user, $pwd)
    {
        if ($user == '' || $pwd == '') {
            return false;
        }
        return $this->ci->user_model->login($user, $pwd);
    }


    /**
     * @return mixed
     */
    public function is_loggedin()
    {
        return $this->ci->user_model->is_loggedin();
    }

}



