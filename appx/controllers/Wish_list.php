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
            $ret = strtr($encrypt_username, array('+' => '.', '=' => '-', '/' => '~'));
            $this->load->view('wish_list_view', array('encrypt_username' => $ret));
        }
    }

    /**
     * The sharing wishlist controller
     *
     * @param $identifier identifier to view just sharable page
     */
    public function share($identifier)
    {
        if (!$this->authlib->is_loggedin()) {
            $string = strtr(
                $identifier,
                array(
                    '.' => '+',
                    '-' => '=',
                    '~' => '/'
                )
            );

            $username = $this->encryption->decrypt($string);
            $user_data = $this->user_model->user_details($username);

            $session_data = array(
                'username' => $username,
                'name' => $user_data['name'],
                'wish_list_name' => $user_data['wishlist_name'],
                'wish_list_description' => $user_data['wishlist_description']
            );

            $this->session->set_userdata($session_data);
        }

        $this->load->view('header');
        $this->load->view('wish_list_share_view');
    }
}