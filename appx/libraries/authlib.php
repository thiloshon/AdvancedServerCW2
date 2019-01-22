<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 04-Nov-18
 * Time: 6:39 PM
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
    public function register($name, $user, $pwd, $conf_pwd)
    {
        if ($name == '' || $user == '' || $pwd == '' || $conf_pwd == '') {
            return 'Missing Fields';
        }

        if ($conf_pwd != $pwd) {
            return "Passwords do not match";
        }

        return $this->ci->user_model->register($name, $user, $pwd);
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



