<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	// First execution of function where will load library form_validation to all function in Controller
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	// Function load view with several view in folder Data
	public function index() {
		$this->load->view('Data/header');
		$this->load->view('Data/nav');
		$this->load->view('Data/content');
		$this->load->view('Data/footer');
	}

	// Function load data from the database with showing in the datatable
	// When using AJAX function type post to call the function with parameter
	// Data from datatables default parameter
	public function ambilData() {
		$data = array();
		// get every rows from database
		$dataBarang = $this->MData->getRows($_POST);
		// number of data Identifier start with 1
		$i = $_POST['start'];
		// for each array dataBarang alias barang repeat every barang in index array
		foreach ($dataBarang as $barang) {
			$i++;
			// fill variable btnEdit and btnHapus, with the data-id attribut from the database, for used identifier every row
			$btnEdit = '<button type="button" id="editData" class="btn btn-info" data-toggle="modal" data-target="#modalData" data-id="'.$barang->id_barang.'"> Edit </button>';
			$btnHapus = '<button type="button" id="showHapus" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus" data-id="'.$barang->id_barang.'"> Hapus </button>';
			// fill array data with every data from database will and show in datatable
			$data[] = array($i.'.', $barang->barang, $barang->harga, $btnEdit.$btnHapus);
		}

		// Send the response output from server to the client with every data which will be used
		$output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->MData->countAll(),
            'recordsFiltered' => $this->MData->countFiltered($_POST),
            'data' => $data
        );
		// Convert output to json format
        echo json_encode($output);
	}

	// Function tambah, used add data to database with type method post
	public function tambah() {
		// Get the every data from the form client
		$barang = $this->input->post('barang');
		$harga = (int)$this->input->post('harga');

		// Set Rules of the validation form
		$this->form_validation->set_rules('barang', 'barang', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');

		// IF error show the response to the client 1
		if ($this->form_validation->run()=== FALSE){
			echo -1;
		}
		
		// if not error
		else {
			$data = array(
					'barang' => $barang,
					'harga' => $harga,
			);

			// added data to database with parameter data
			$tambah = $this->MData->tambah($data);
			// IF tambah success send the response 1
			if ($tambah) {
				echo 1;
			}
			// IF not success send the response 0
			else {
				echo 0;
			}
		}
	}

	// Function update with method post
	public function update() {
		// Get every data from form client
		$id_barang = (int)$this->input->post('id_barang');
		$barang = $this->input->post('barang');
		$harga = (int)$this->input->post('harga');

		// Set Rules form_validation
		$this->form_validation->set_rules('barang', 'barang', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');

		// IF there is error on form validation send 1
		if ($this->form_validation->run()=== FALSE){
			echo -1;
		}
		// IF NOT Error 
		else {
			$id_barang = array('id_barang' => $id_barang);
			$data = array(
					'barang' => $barang,
					'harga' => $harga,
			);
			// Updates data in database with new data from the client
			$update = $this->MData->update($data, $id_barang);
			// IF success update send the client 1
			if ($update) {
				echo 1;
			}
			// IF NOT success send the cleint 0
			else {
				echo 0;
			}
		}
	}

	// Function hapus, where can deleted row from database with id parameter
	public function hapus() {
		// Get id_barang and deleted form database
		$id_barang = (int)$this->input->post('id_barang');
		// IF id_barang equals 0 send the client -1
		if ($id_barang==0) {
			echo -1;
		}
		// IF not equals 0 
		else {
			$id_barang = array('id_barang' => $id_barang);
			// Do Delete data from database
			$hapus = $this->MData->hapus($id_barang);
			// IF Suceess send the client 1
			if ($hapus) {
				echo 1;
			}
			// IF NOT success send the client 0
			else {
				echo 0;
			}
		}
	}

}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */