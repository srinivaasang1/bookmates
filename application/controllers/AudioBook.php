<?php
//controller class handling Audio Book page
   class AudioBook extends CI_Controller {
  
      public function index() { 

         $this->load->view('navbar');
         $this->load->view('audioBookView');
         $this->load->view('footer');
      }
   } 
?>
