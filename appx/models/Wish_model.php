<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 22-Jan-19
 * Time: 10:30 AM
 */
class Wish_model extends CI_Model
{
    public function getWish($wishlist_id)
    {
        $this->db->select();
        $this->db->from('wishes');
        $this->db->where('wishlist_id', $wishlist_id);
        $this->db->order_by("priority", "desc");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }

    }


    public function deleteWish($id){
        $this->db->where('id', $id);
        if($this->db->delete('wishes')){
            return true;
        }else{
            return false;
        }

    }


    public function add($data){
        if($this->db->insert('wishes', $data)){
            return true;
        }else{
            return false;
        }
    }

    //API call - update a book record
    public function update($id, $data){
        $this->db->where('id', $id);
        if($this->db->update('wishes', $data)){
            return true;
        }else{
            return false;
        }
    }

}