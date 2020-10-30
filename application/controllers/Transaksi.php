<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $data['title'] = "Jastipku | Transaksi";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['judul'] = "Transaksi";
        $data['menujdl'] = "Data Transaksi";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('transaksi/index');
        $this->load->view('template/footer', $data);
    }

    public function ambildtcustomer()
    {
        $nohp = $this->input->post('nohpne', true);

        $this->db->limit(1);
        $this->db->like('id_telp', $nohp, 'both');
        $this->db->or_like('nama', $nohp, 'both');
        $data = $this->db->get('data_customer')->row_array();

        echo json_encode($data);
    }
}
