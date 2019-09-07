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
	
	public function ambilData() {
		$data = array();
		$dataBarang = $this->MData->getRows($_POST);

		$i = $_POST['start'];
		foreach ($dataBarang as $barang) {
			$i++;
			$btnEdit = '<button type="button" id="editData" class="btn btn-info" data-toggle="modal" data-target="#modalData" data-id="'.$barang->id_barang.'"> Edit </button>';
			$btnHapus = '<button type="button" id="showHapus" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus" data-id="'.$barang->id_barang.'"> Edit </button>';

			$data[] = array($i.'.', $barang->barang, $barang->harga, $btnEdit.$btnHapus);
		}

		$output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->MData->countAll(),
            'recordsFiltered' => $this->MData->countFiltered($_POST),
            'data' => $data
        );

        echo json_encode($output);
	}

	public function tambah() {
		$barang = $this->input->post('barang');
		$harga = $this->input->post('harga');

		$this->form_validation->set_rules('barang', 'barang', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');

		if ($this->form_validation->run()=== FALSE){
			echo -1;
		}
		
		else {
			$data = array(
					'barang' => $barang,
					'harga' => $harga,
			);

			$tambah = $this->MData->tambah('barang', $data);
			if ($tambah) {
				echo 1;
			}
			else {
				echo 0;
			}
		}
	}

}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */