<?php

require(APPPATH . '/libraries/REST_Controller.php');
require(APPPATH . '/libraries/Format.php');


class Api extends \Restserver\Libraries\REST_Controller
{

    /**
     *
     */
    function wish_get()
    {
        $username = $this->get('owner_id');
        if (!$username) {
            $this->response("No List specified", 400);
            exit;
        }

        $result = $this->wish_model->get_wish($username);
        if ($result) {
            $this->response($result, 200);
            exit;
        } else {
            $this->response("Invalid username", 404);
            exit;
        }
    }


    /**
     *
     */
    function wish_post()
    {
        $title = $this->post('title');
        $price = $this->post('price');
        $url = $this->post('url');
        $priority = $this->post('priority');
        $username = $this->post('owner_id');

        if (!$title || !$price || !$url || !$username || !$priority) {
            $this->response("Enter complete wish information to save", 400);

        } else {
            $result = $this->wish_model->add_wish(
                array("title" => $title, "price" => $price, "url" => $url, "priority" => $priority, "owner_id" => $username));

            if ($result === 0) {
                $this->response("Wish information could not be saved. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }
    }


    /**
     *
     */
    function wish_put()
    {
        $title = $this->put('title');
        $price = $this->put('price');
        $url = $this->put('url');
        $priority = $this->put('priority');
        $wish_id = $this->put('id');

        if (!$title || !$price || !$url || !$priority || !$wish_id) {
            $this->response("Enter complete wish information to update", 400);
        } else {
            $result = $this->wish_model->update($wish_id,
                array("title" => $title, "price" => $price, "url" => $url, "priority" => $priority));

            if ($result === 0) {
                $this->response("Wish information could not be updated. Try again.", 404);
            } else {
                $this->response("success", 200);
            }
        }

    }


    /**
     * @param $id
     */
    function wish_delete($id)
    {
        if (!$id) {
            $this->response("Parameter missing", 404);
        }

        if ($this->wish_model->delete_wish($id)) {
            $this->response("Success", 200);
        } else {
            $this->response("Failed", 400);
        }
    }

}