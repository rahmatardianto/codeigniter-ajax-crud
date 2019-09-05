<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index() {
		$this->load->view('Data/header');
		$this->load->view('Data/nav');
		$this->load->view('Data/content');
		$this->load->view('Data/footer');
	}
	
}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */