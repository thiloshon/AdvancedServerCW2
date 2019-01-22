<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{





        //echo json_encode(array(['name' => 'Toy', 'price' => 56]));
		$this->load->view('welcome_message');
	}

	public function wishList(){

        $age = array(0=>array('title' => 'Toy', 'price' => 56,  'url' => 'https://github.com/',  'priority' => 'must-have'),
            1=>array('title' => 'Boy', 'price' => 85, 'url' => 'https://github.com/thiloshon?tab=repositories',  'priority' => 'nice-have'),
            2=>array('title' => 'Soy', 'price' => 897, 'url' => 'https://github.com/thiloshon?tab=repositories',  'priority' => 'dont-have'));


	    echo json_encode($age);
    }
}
