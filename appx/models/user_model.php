<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 04-Nov-18
 * Time: 6:50 PM
 */
class User_model extends CI_Model
{
    public function register($name, $username, $password, $wishlist, $wishlist_desc)
    {
        $res = $this->db->get_where('users', array('username' => $username));
        if ($res->num_rows() > 0) {
            return "username already exists";
        }

        $hashpwd = sha1($password);
        $data = array('name' => $name, 'username' => $username, 'password' => $hashpwd, 'wishlist_name' => $wishlist, 'wishlist_description' => $wishlist_desc);
        $this->db->insert('users', $data);

        return null;
    }

    public function login($username, $password)
    {
        $this->db->where(array('username' => $username, 'password' => sha1($password)));
        $res = $this->db->get('users', array('name'));
        if ($res->num_rows() != 1) {
            return false;
        }

        // SESSION
        $session_id = session_id();
        $row = $res->row_array();
        $this->db->insert('logins', array('name' => $row['name'], 'session_id' => $session_id));
        // SESSION

        return $res->row_array();
    }

    //SESSION
    function is_loggedin()
    {
        $session_id = $this->session->session_id;
        $res = $this->db->get_where('logins', array('session_id' => $session_id));

        if ($res->num_rows() == 1) {
            $row = $res->row_array();
            return $row['name'];

        } else {
            return false;
        }
    }
}