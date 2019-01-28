<?php

/**
 *
 */
class User_model extends CI_Model
{

    /**
     * @param $name
     * @param $username
     * @param $password
     * @param $wishlist
     * @param $wishlist_desc
     * @return null|string
     */
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

    /**
     * @param $username
     * @param $password
     * @return bool
     */
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

    public function user_details($username)
    {
        $this->db->where(array('username' => $username));
        $res = $this->db->get('users', array('name'));
        if ($res->num_rows() != 1) {
            return false;
        }

        return $res->row_array();
    }

    //SESSION
    /**
     * @return bool
     */
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