<?php

/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 11/04/2016
 * Time: 5:12 PM
 *
 * The class handles Create Event Success Message
 */
class SuccessMessage extends CI_Controller
{
    public function index() {
        $this->load->view('navbar');
        $this->load->view('formSuccessView');
        $this->load->view('footer');
    }
}