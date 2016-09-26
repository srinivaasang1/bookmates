<?php

/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 15/04/2016
 * Time: 4:57 PM
 *
 * The class handles Reading Events Listing
 */
class ListEvent extends CI_Controller
{
    public $per_page = 10;
//    public $calendarCriteria;
//    public $locationCriteria;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel');
        $this->load->library(['pagination']);
    }

    /*
     * Index handles event information display.
     */
    public function index()
    {
        // unset sessions of click information retrieved from List View Page, and other session data.
        $this->unsetSessionData();
        if(isset($_SESSION['isClicked'])){
            $this->session->unset_userdata('isClicked');
        }
        $dayconstraint = "";

        //The following codes set pagination for event display
        $config = [];
        $config["base_url"] = base_url().'index.php/ListEvent/index';
        $total_row = $this->HomeModel->countAll();

        $config["total_rows"] = $total_row;
        $config["per_page"] = $this->per_page;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = floor($config["total_rows"]/$config["per_page"]);

        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        //bootstrap
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);


        if($this->uri->segment(3)){
            $offset = ($this->uri->segment(3)-1)*$config["per_page"] ;
        }
        else{
            $offset = 0;
        }


        $eventsdata ['eventList'] = $this->HomeModel->getData($config["per_page"],$offset);
        $eventsdata['dayconstraint']= $dayconstraint;
        $eventsdata['links']= $this->pagination->create_links();
        $eventsdata['totalRow'] = $total_row;



        $this->load->view('navbar');
        $this->load->view('listEventsView',$eventsdata);
        $this->load->view('footer');

    }

    /*
     * The method is called when search criteria box location is ticked and search button in listEventsView is pressed.
     */
    public function searchByLocation(){

//        $this->unsetSessionDate();
//        $this->setSessionData();

        $dayconstraint="";

        $searchKeyword = $this->HomeModel->keyword_session_handler($this->input->get_post('searchKeyword', TRUE));
        //get search key words
//        if($this->input->post("searchKeyword")){
//            $searchKeyword = $this->input->post("searchKeyword");
//        }else{
//            $searchKeyword="NIL";
//        }
//        $searchKeyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $searchKeyword;
//        $searchKeydate = $this->input->post('');

        $config = [];

        $config["base_url"] = site_url('ListEvent/searchByLocation');
        $total_row = $this->HomeModel->countRowsForLocationSearch($searchKeyword);
        $config["total_rows"] = $total_row;

        $config["per_page"] = $this->per_page;
        $config['num_links'] =floor($config["total_rows"]/$config["per_page"]);
        $config['use_page_numbers'] = TRUE;

        $config["uri_segment"] = 3;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        //bootstrap
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $offset = ($this->uri->segment(3)-1)*$config["per_page"] ;
        }
        else{
            $offset = 0;
        }
        //get event list

        $eventsdata ['eventList'] = $this->HomeModel->getDataWithLocation($config["per_page"],$offset,$searchKeyword);

//        if($eventsdata['eventList']){
//            json_encode($eventsdata['eventList']);
//        }else{
//            json_encode(array('error'=>true));
//        }

        $eventsdata['links']= $this->pagination->create_links();
        $eventsdata['keyword'] = $searchKeyword;
        $eventsdata['dayconstraint']= $dayconstraint;
        $eventsdata['totalRow'] = $total_row;
        $this->load->view('navbar');
        $this->load->view('listEventsView',$eventsdata);
        $this->load->view('footer');
    }

    /*
     * The method is called when search criteria box calendar is ticked and search button in listEventsView is pressed.
     */
    public function searchByCalendar(){
//            $this->unsetSessionDate();
//            $this->setSessionData();

            if(isset($_SESSION['searchKeyword'])){
                $this->session->unset_userdata('searchKeyword');
            }

            $dayconstraint = $this->HomeModel->timeconstraint_session_handler($this->input->get_post('timecon', TRUE));
            //get search key words

            $config = [];

            $config["base_url"] = site_url('ListEvent/searchByCalendar');
            $total_row = $this->HomeModel->countByCalendarDay($dayconstraint);
            $config["total_rows"] = $total_row;

            $config["per_page"] = $this->per_page;
            $config['num_links'] =floor($config["total_rows"]/$config["per_page"]);
            $config['use_page_numbers'] = TRUE;

            $config["uri_segment"] = 3;
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            //bootstrap
            // integrate bootstrap pagination
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            if($this->uri->segment(3)){
                $offset = ($this->uri->segment(3)-1)*$config["per_page"] ;
            }
            else{
                $offset = 0;
            }
            //get event list
//            $dateConstraint = $this->input->post('timecon');
            $eventsdata ['eventList'] = $this->HomeModel->searchByCalendarDay($config["per_page"],$offset,$dayconstraint);
            $eventsdata['links']= $this->pagination->create_links();
            $eventsdata['dayconstraint']= $dayconstraint;
            $eventsdata['totalRow'] = $total_row;
//            //set hidden input
//            if (strlen($this->input->post('timecon'))==0){
//
//            }
            $this->load->view('navbar');
            $this->load->view('listEventsView',$eventsdata);
            $this->load->view('footer');

    }
    /*
     * The method is called when search criteria box location and calender are ticked and search button in listEventsView is pressed.
     */
    public function searchByLocationAndDay(){
//
        //get the location key word and calendar day constraint
        $location = $this->input->post('searchKeyword',TRUE);
        $calendarDay =$this->input->post('timecon',TRUE);


        $this->calendarCriteria=$this->HomeModel->timeconstraint_session_handler($calendarDay);
        $this->locationCriteria=$this->HomeModel->keyword_session_handler($location);
        $config = [];

        $config["base_url"] = site_url('ListEvent/searchByLocationAndDay');
        $total_row = $this->HomeModel->countRowsForLocationAndDaySearch($this->locationCriteria,$this->calendarCriteria);

        $config["total_rows"] = $total_row;

        $config["per_page"] = $this->per_page;
        $config['num_links'] =5;
//        $config['num_links'] =floor($config["total_rows"]/$config["per_page"]);
        $config['use_page_numbers'] = TRUE;

        $config["uri_segment"] = 3;
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        //bootstrap
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $offset = ($this->uri->segment(3)-1)*$config["per_page"] ;
        }
        else{
            $offset = 0;
        }
        //get event list

        $eventsdata ['eventList'] = $this->HomeModel->getDataWithLocationAndDay($config["per_page"],$offset,$this->locationCriteria,$this->calendarCriteria);

        $eventsdata['links']= $this->pagination->create_links();
        $eventsdata['keyword'] = $this->locationCriteria;
        $eventsdata['dayconstraint']= $this->calendarCriteria;
        $eventsdata['totalRow']= $total_row;
        $this->load->view('navbar');
        $this->load->view('listEventsView',$eventsdata);
        $this->load->view('footer');
    }

    /*
     * Search button triggers this function to run
     */
    public function searchWithCriteria(){


        //change default message for required rule
        $this->unsetSessionData();
        $this->setSessionData();


        if(isset($_SESSION['searchKeyword']) && isset($_SESSION['timecon'])){
            $this->searchByLocationAndDay();
        }else if(isset($_SESSION['searchKeyword']) && isset($_SESSION['timecon'])==FALSE){
            $this->searchByLocation();
        }else if(isset($_SESSION['searchKeyword'])==FALSE && isset($_SESSION['timecon'])){
            $this->searchByCalendar();
        }
    }

    /*
     * This is a local method used to set session data
     */
   private function setSessionData(){
        $criteria = $this->input->post('criteria');
        $location = $this->input->post('searchKeyword',TRUE);
        $calendarDay =$this->input->post('timecon',TRUE);

        if(count($criteria)==2){
            $this->calendarCriteria=$this->HomeModel->timeconstraint_session_handler($calendarDay);
            $this->locationCriteria=$this->HomeModel->keyword_session_handler($location);
        }else if(count($criteria)==1){
            if($criteria[0]=='calendarDay'){
                $this->calendarCriteria=$this->HomeModel->timeconstraint_session_handler($calendarDay);
            }else{
                $this->locationCriteria=$this->HomeModel->keyword_session_handler($location);
            }
        }
    }

    /*
     * This is a local method used to remove existing sessions
     */
    private function unsetSessionData(){
        if(isset($_SESSION['searchKeyword'])){
            $this->session->unset_userdata('searchKeyword');
        }
        if(isset($_SESSION['timecon'])){
            $this->session->unset_userdata('timecon');
        }

    }

}