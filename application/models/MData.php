<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MData extends CI_Model {

	public function baca($table) {
        $hasil = $this->db->get($table);
        return $hasil->result_array();
    }

    public function cekData($table, $where) {
    	$hasil = $this->db->get_where($table, $where);
    	return $hasil->num_rows();
    }

    public function tambah($table, $data) {
        $hasil = $this->db->insert($table, $data);
        return $hasil;
    }

    public function update($table, $data, $where) {
    	$hasil = $this->db->update($table, $data, $where);
        return $hasil;
    }

    public function hapus($table, $where) {
        $hasil = $this->db->delete($table, $where);
        return $hasil;
    }
}

/* End of file MData.php */
/* Location: ./application/models/MData.php */