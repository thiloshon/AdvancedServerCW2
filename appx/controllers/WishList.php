<?php

/**
 * Created by IntelliJ IDEA.
 * User: Thiloshon
 * Date: 21-Jan-19
 * Time: 6:31 PM
 */
class WishList extends CI_Controller
{
    public function index()
    {

        $this->load->view('wishListView');
    }

}