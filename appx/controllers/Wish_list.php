<?php

/**
 * Class Wish_list to manage wish list
 */
class Wish_list extends CI_Controller
{

    /**
     * Landing page
     */
    public function index()
    {
        $is_loggedin = $this->authlib->is_loggedin();
        $this->load->view('header');

        if ($is_loggedin === false) {
            $this->load->view('auth_view_bb', array('errmsg' => ""));
        } else {
            $encrypt_username = $this->encryption->encrypt($this->session->username);
            $encrypt_username = str_replace("/", "%2F", $encrypt_username);

            $this->load->view('wish_list_view', array('encrypt_username' => $encrypt_username));
        }
    }

    /**
     * The sharing wishlist controller
     *
     * @param $identifier Username to view just sharable page
     */
    public function share($identifier)
    {
        $username = $this->encryption->decrypt($identifier);
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