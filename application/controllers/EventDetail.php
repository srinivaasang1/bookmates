<?php

/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 7/04/2016
 * Time: 12:27 AM
 *
 * The class is a Controller handling event detail page
 */
class EventDetail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //configure email settings:


    }

    /*
     * Index method gets event_id from session and get event detail via event_id
     */
    public function index(){

        //get the event detail passed from index
        if(!isset($_GET['event']) || empty($_GET['event'])){
            $event_id=$_SESSION['detailEventID'];
        }else{
            $event_id = $_GET['event'];
            $_SESSION['detailEventID']=$event_id;
        }

        $this->load->model('UpdateEventDetailModel');
        $data['event'] = $this->UpdateEventDetailModel->selectEventByID(intval($event_id));

        //$data['isbn'] = $isbn;

        $this->load->view('navbar');
        $this->load->view('detailView',$data);
        $this->load->view('footer');

    }

    /*
     * The method handles joining activity of a reading event. It gets event_id and user_id from detailEventView.
     * Either success or error message will be encoded and returned to AJAX in detailEventView.
     */
    public function joinBtnPressed(){
        $event_id = $_SESSION['detailEventID'];
        $user_id=$this->input->post('hidden_userid');
        $this->load->model('UpdateEventDetailModel');
        $userEvent = $this->UpdateEventDetailModel->selectEventByID(intval($event_id));

        //detect whether the user has joined the event or not
        $isUserJoined=$this->validateForDuplicate(intval($event_id),$user_id);
        if($isUserJoined==true){
            $this->UpdateEventDetailModel->insertIntoJoinStatus(intval($event_id),$user_id);
            $this->UpdateEventDetailModel->updateNumOfParticipantsByID(intval($event_id));
            $this->sendEmail($userEvent);
            echo json_encode(['joinSuccess'=>'You have successfully joined the reading event']);
        }else{
            echo json_encode(['joinError'=>'You have already joined this reading event!']);
        }
    }
    /*
     * The following method handles duplicate joining activities.
     */
    private function validateForDuplicate($event_id, $user_id){
        return $this->UpdateEventDetailModel->getJoinStatusByUseridAndEventid($event_id,$user_id);
    }

    /*
     * The following method handles auto email sending
     */
    private function sendEmail($userevent){
        $useremail= trim($userevent->email);

        $config = Array(
//            'protocol' => 'ssmtp',
//            'smtp_host' => 'ssl://ssmtp.gmail.com',
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'amirabmates@gmail.com', // change it to yours
            'smtp_pass' => 'Bookmates2016', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'wordwrap' => TRUE
        );
//        $book = $userevent->book_title;
//        $time = $userevent->event_datetime;
//        $addr = $userevent->venue_address;
        $data['userevent']=$userevent;
        $message= "<h2>Welcome to Bookmates! Thanks for joining Bookmates reading events.</h2><br><br>
              This is to confirm the event detail you signed up for:<br><br>
              <b>Book Title: <i>$userevent->book_title </i></b><br>
              <b>Time: <i>$userevent->event_datetime </i></b><br>
              <b>Address: <i>$userevent->venue_address </i></b><br><br><br>
              <b>Have Fun!</b><br />
              <b>From Gravity With Love</b>";

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('amirabmates@gmail.com'); // change it to yours
        $this->email->to($useremail);// change it to yours
        $this->email->cc('amirabmates@gmail.com'); // change it to yours
        $this->email->subject('Thank you for joining book reading event!');
        $this->email->message($message);
        $this->email->send();
//        $this->email->set_newline("\r\n");

    }




}