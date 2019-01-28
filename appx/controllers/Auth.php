<?php

/**
 * Class Auth to perform authentication logic
 */
class Auth extends CI_Controller
{
    /**
     * Landing page controller
     */
    public function index()
    {
        $is_loggedin = $this->authlib->is_loggedin();

        if ($is_loggedin === false) {
            $this->load->view('header');
            $this->load->view('auth_view_bb', array('errmsg' => ""));
        } else {
            redirect("/wish_list");
        }
    }

    /**
     * Registration process
     */
    public function create_account()
    {
        $name = $this->input->post('name');
        $username = $this->input->post('uname');
        $password = $this->input->post('pword');
        $conf_password = $this->input->post('conf_pword');
        $wishlist_name = $this->input->post('wishlist_name');
        $wishlist_desc = $this->input->post('wishlist_desc');

        if (!($errmsg = $this->authlib->register($name, $username, $password, $conf_password, $wishlist_name, $wishlist_desc))) {
            $data['errmsg'] = '';
            $this->load->view('header');
            $this->load->view('auth_view_bb', $data);
        } else {
            $data['errmsg'] = $errmsg;
            $this->load->view('header');
            $this->load->view('auth_view_bb', $data);
        }
    }

    /**
     * Login process
     */
    public function authenticate()
    {
        $username = $this->input->post('uname');
        $password = $this->input->post('pword');
        $user = $this->authlib->login($username, $password);

        if ($user !== false) {
            $session_data = array(
                'username' => $user['username'],
                'name' => $user['name'],
                'wish_list_name' => $user['wishlist_name'],
                'wish_list_description' => $user['wishlist_description']
            );

            $this->session->set_userdata($session_data);
            redirect('/wish_list');

        } else {
            $data['errmsg'] = 'Unable to login. Please try again';
            $this->load->view('header');
            $this->load->view('auth_view_bb', $data);
        }
    }

    /**
     * Signup process
     */
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }
}