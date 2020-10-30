<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Semua_hal extends CI_Model
{
    public function getusername($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //mangambil semua Data Customer
    public function getcustomerall()
    {
        return $this->db->get('data_customer')->result_array();
    }
    //menghapus data customer
    public function hapusdatacustomer($id)
    {
        $this->db->where('id_telp', $id);
        $this->db->delete('data_customer');
    }
    //mengambil data customer by id
    public function getcustomerbyid($id)
    {
        return $this->db->get_where('data_customer', ['id_telp' => $id])->row_array();
    }
    //ubah data customer
    public function ubahcustomercs($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('data_customer', $data);
    }
}
