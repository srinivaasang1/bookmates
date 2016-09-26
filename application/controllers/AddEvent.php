<?php
/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 1/04/2016
 * Time: 2:42 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class AddEvent extends CI_Controller {
    // Load page for Add Event
    public function index(){
        $this->load->view('navbar');
        $this->load->view('addEventView');
        $this->load->view('footer');
        $this->load->helper('date');
    }

    /**
     * This function designed to handle submission of an event, i.e. Publish a Reading Event. It firstly validation rules
     * of submission, such as no fields can be empty upon submission. Then it encodes error message in json format and transfer
     * the message back to AJAX in the AddEventView.
     *
     */
    public function submission(){

        $this->load->library('form_validation');
        // Including Validation Library
        // Displaying Errors In Div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $eventPostingRules = [
            [   'field'=>'time',
                'label'=>'Time',
                'rules'=>'required',
            ],
            [   'field'=>'title',
                'label'=>'Book Title',
                'rules'=>'required|trim|min_length[1]'
            ],
            [   'field'=>'location',
                'label'=>'Location',
                'rules'=>'required'
            ],
            [   'field'=>'name',
                'label'=>'Reader Name',
                'rules'=>'required|trim|min_length[1]|max_length[30]'
            ],
            [   'field'=>'email',
                'label'=>'Email',
                'rules'=>'required|valid_email|trim|max_length[50]'
            ]
        ];
        //change default message for required rule
//        $this->form_validation->set_rules('time', 'Time', 'callback_check_time');
        $this->form_validation->set_message('required','Please enter %s!');

        $this->form_validation->set_rules($eventPostingRules);


        if($this->form_validation->run()==FALSE){
            //show error information
            $validationRules = array(
                'time'=>form_error('time'),
                'title'=>form_error('title'),
                'location'=>form_error('location'),
                'name'=>form_error('name'),
                'email'=>form_error('email')
            );

//            $this->load->view('addEventView');

            echo json_encode($validationRules);
        } else{
            $this->load->model('addEventModel');
            $event_id = $this->addEventModel->insert_event();

//            if($result){
//                redirect('SuccessMessage/index', 'refresh');
//
//            }
//            if(isset($_SESSION['detailEventID'])){
//                $this->session->unset_userdata('detailEventID');
//            }
            $this->session->set_userdata('detailEventID', $event_id);
//            $this->session->set_userdata('detailUserID', $user_id);
//            $_SESSION['detailEventID'] = $event_id;

            echo json_encode(['success'=>'Your reading event was successfully submitted!']);
        }
    }

    /**
     * The function is used to search book detail information by title. It retrieves book title from view, and passes the
     * title on to google book api, before the detail information of books are encoded in json and returned to AJAX in addEventView page.
     */
    public function user_data_submit() {
        $data = array(
            'booktitle' => $this->input->post('booktitle1')
        );
        $url = "https://www.googleapis.com/books/v1/volumes?q=".$data['booktitle']."&orderBy=relevance&projection=lite";
        $page = file_get_contents($url);
        $data1 = json_decode($page, true);
        echo json_encode($data1['items']);

    }
}
















