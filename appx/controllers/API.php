<?php

require(APPPATH . '/libraries/REST_Controller.php');


class Api extends \Restserver\Libraries\REST_Controller
{

//API - client sends isbn and on valid isbn book information is sent back
    function wishByWishlist_get()
    {
        $wishlist_id = $this->get('wishlist_id');
        if (!$wishlist_id) {
            $this->response("No List specified", 400);
            exit;
        }

        $result = $this->wish_model->getWish($wishlist_id);
        if ($result) {
            $this->response($result, 200);
            exit;
        } else {
            $this->response("Invalid Wishlist ID", 404);
            exit;
        }
    }

//API - create a new book item in database.
    function addWish_post()
    {
        $name = $this->post('title');
        $price = $this->post('price');
        $url = $this->post('url');
        $priority = $this->post('priority');
        $wishlist_id = $this->post('wishlist_id');

        if (!$name || !$price || !$url || !$wishlist_id || !$priority) {
            $this->response("Enter complete wish information to save", 400);
        } else {
            $result = $this->wish_model->add(
                array("title" => $name, "price" => $price, "url" => $url, "priority" => $priority, "wishlist_id" => $wishlist_id));

            if ($result === 0) {
                $this->response("Wish information could not be saved. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }
    }

    //API - update a book
    function updateWish_put()
    {
        $name = $this->put('title');
        $price = $this->put('price');
        $url = $this->put('url');
        $priority = $this->put('priority');
        $wish_id = $this->put('wish_id');

        if (!$name || !$price || !$url || !$priority || !$wish_id) {
            $this->response("Enter complete wish information to update", 400);
        } else {
            $result = $this->book_model->update($wish_id, array("title" => $name, "price" => $price, "url" => $url, "priority" => $priority));
            if ($result === 0) {
                $this->response("Wish information could not be updated. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }
    }

    //API - delete a book
    function deleteBook_delete()
    {
        $id = $this->delete('wish_id');
        if (!$id) {
            $this->response("Parameter missing", 404);
        }
        if ($this->book_model->delete($id)) {
            $this->response("Success", 200);
        } else {
            $this->response("Failed", 400);
        }
    }
}