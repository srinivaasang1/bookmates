<?php

/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 28/04/2016
 * Time: 3:38 PM
 *
 * The class is a controller handling Successful Joining Message
 */
class JoinSuccess extends CI_Controller
{
    public function index() {
        $this->load->view('navbar');
        $this->load->view('joinSuccessView');
        $this->load->view('footer');
    }
}