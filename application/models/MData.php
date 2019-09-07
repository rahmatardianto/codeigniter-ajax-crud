<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MData extends CI_Model {
    private $table = 'barang'; // table yang digunakan
    private $order = array('id_barang', 'desc'); // Agar yang terakhir ditambahkan ditampilkan awal
    private $column_search = array('barang', 'harga'); // Agar yang terakhir ditambahkan ditampilkan awal

    public function tambah($data) {
        $hasil = $this->db->insert($this->table, $data);
        return $hasil;
    }

    public function update($data, $where) {
    	$hasil = $this->db->update($this->table, $data, $where);
        return $hasil;
    }

    public function hapus($where) {
        $hasil = $this->db->delete($this->table, $where);
        return $hasil;
    }

    // Source https://www.codexworld.com/codeigniter-datatables-server-side-processing/
    // Modification in _get_datatables_query and getRows

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
    */
    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->order_by($this->order[0], $this->order[1]);
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
    */
    public function countAll(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
    */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
    */
    private function _get_datatables_query($postData){
        $this->db->from($this->table);
        $i = 0;

        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
    }
}

/* End of file MData.php */
/* Location: ./application/models/MData.php */