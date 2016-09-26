<?php

/**
 * Class Terms handles terms and Conditions page
 */
class Terms extends CI_Controller {

    public function index() {
        $this->load->view('navbar');
        $this->load->view('termsconditions1');
        $this->load->view('footer');
    }
}
?>
