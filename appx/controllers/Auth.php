<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 04-Nov-18
 * Time: 6:00 PM
 */
class Auth extends CI_Controller
{

    public function index()
    {
        $is_loggedin = $this->authlib->is_loggedin();

        if ($is_loggedin === false) {
            $this->load->view('auth_view', array('errmsg' => ""));
        } else {
            redirect('http://localhost/AdvancedServerCW2/index.php/wish_list');
        }
    }

    public function register()
    {
        $data['errmsg'] = '';
        $this->load->view('reg_view', $data);
    }

    public function login()
    {
        $data['errmsg'] = '';
        $this->load->view('login_view', $data);
    }

    public function create_account()
    {
        $name = $this->input->post('name');
        $username = $this->input->post('uname');
        $password = $this->input->post('pword');
        $conf_password = $this->input->post('conf_pword');

        if (!($errmsg = $this->authlib->register($name, $username, $password, $conf_password))) {
            $data['errmsg'] = '';
            $this->load->view('login_view', $data);
        } else {
            $data['errmsg'] = $errmsg;
            $this->load->view('reg_view', $data);
        }
    }

    public function authenticate()
    {
        $username = $this->input->post('uname');
        $password = $this->input->post('pword');
        $user = $this->authlib->login($username, $password);

        if ($user !== false) {
            $session_data = array(
                'username' => $user['username'],
                'name' => $user['name']
            );

            $this->session->set_userdata($session_data);
            redirect('/index.php/wish_list');

        } else {
            $data['errmsg'] = 'Unable to login. Please try again';
            $this->load->view('login_view', $data);
        }
    }
}