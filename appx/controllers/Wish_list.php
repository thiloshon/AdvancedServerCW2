<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 21-Jan-19
 * Time: 6:31 PM
 */
class Wish_list extends CI_Controller
{
    public function index()
    {
        $is_loggedin = $this->authlib->is_loggedin();

        if ($is_loggedin === false) {
            $this->load->view('auth_view', array('errmsg' => ""));
        } else {
            $this->load->view('wish_list_view');
        }
    }
}