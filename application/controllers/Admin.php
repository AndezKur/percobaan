<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }


        $data['title'] = 'Jastipku | Dashboard';
        $data['judul'] = 'Dashboard';
        $data['menujdl'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin/index');
        $this->load->view('template/footer');
    }
}
