<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 22-Jan-19
 * Time: 10:30 AM
 */
class Wish_model extends CI_Model
{
    /**
     * @param $username
     * @return int
     */
    public function get_wish($username)
    {
        $this->db->select();
        $this->db->from('wishes');
        $this->db->where('owner_id', $username);
        //$this->db->order_by("priority", "desc");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }


    /**
     * @param $data
     * @return bool
     */
    public function add_wish($data)
    {
        if ($this->db->insert('wishes', $data)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update_wish($id, $data)
    {
        $this->db->where('id', $id);

        if ($this->db->update('wishes', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete_wish($id)
    {
        $this->db->where('id', $id);

        if ($this->db->delete('wishes')) {
            return true;
        } else {
            return false;
        }
    }

}