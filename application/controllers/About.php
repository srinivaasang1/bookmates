<?php
// About Us Controller
   class About extends CI_Controller {
      public function index() {
         $this->load->view('navbar');
         $this->load->view('about-usView');
         $this->load->view('footer');

      }
   }
?>
