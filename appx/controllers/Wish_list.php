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

        $this->load->view('header');

        if ($is_loggedin === false) {
            $this->load->view('auth_view', array('errmsg' => ""));
        } else {
            $this->load->view('wish_list_view');
        }
    }


    public function share($username)
    {

        $user_data = $this->user_model->user_details($username);

        $session_data = array(
            'username' => $username,
            'name' => $user_data['name'],
            'wishlist' => $user_data['wishlist_name'],
            'description' => $user_data['wishlist_description']
        );

        $this->session->set_userdata($session_data);

        $this->load->view('header');
        $this->load->view('wish_list_share_view');
    }
}