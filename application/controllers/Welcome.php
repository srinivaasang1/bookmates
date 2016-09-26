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
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->library('pagination');

	}

	/**
	 *
     */
	public function index()
	{
		$config = [];
		$config["base_url"] = base_url().'index.php/welcome/index';
		$total_row = $this->HomeModel->countAll();

		$config["total_rows"] = $total_row;
		$config["first_page"]=1;
		$config["per_page"] = 4;
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
		$eventsdata ['eventList'] = $this->HomeModel->getData($config["per_page"],$offset,NULL);

		$eventsdata['links']= $this->pagination->create_links();
		$this->load->view('index',$eventsdata);
	}

	public function searchByLocation(){

		$config = [];


		$config["first_page"]=1;
		$config["per_page"] = 3;
		$config['use_page_numbers'] = TRUE;


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

		//get search key words
		if($this->input->post("searchKeyword")){
			$searchKeyword = $this->input->post("searchKeyword");
		}else{
			$searchKeyword="NIL";
		}
		$searchKeyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $searchKeyword;
		$config["base_url"] = site_url('Welcome/searchByLocation/$searchKeyword');
		$total_row = $this->HomeModel->countRowsForSearch($searchKeyword);
		$config["total_rows"] = $total_row;
		$config['num_links'] =floor($config["total_rows"]/$config["per_page"]);

		$this->pagination->initialize($config);
		if($this->uri->segment(4)){
			$offset = ($this->uri->segment(4)-1)*$config["per_page"] ;
		}
		else{
			$offset = 0;
		}
		//get event list

		$eventsdata ['eventList'] = $this->HomeModel->getData($config["per_page"],$offset,$searchKeyword);
		if($eventsdata['eventList']){
			json_encode($eventsdata['eventList']);
		}else{
			json_encode(array('error'=>true));
		}

		$eventsdata['links']= $this->pagination->create_links();
		$eventsdata['keyword'] = $searchKeyword;
		$this->load->view('index',$eventsdata);
	}
}























