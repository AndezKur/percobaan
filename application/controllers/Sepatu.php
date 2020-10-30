<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sepatu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_sepatu', 'sp');
    }
    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $data['title'] = "Jastipku | Data Sepatu";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['judul'] = "Sepatu";
        $data['menujdl'] = "Data Barang";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('sepatu/index');
        $this->load->view('template/footer', $data);
    }
    public function ambildata()
    {
        //$brand = $this->input->post('brand');
        //if ($brand == 'All') {
        //  $data = $this->sp->getallsepatu();
        //} else {
        //  $data = $this->sp->getallbrand($brand);
        //}
        $list = $this->sp->get_datatables();
        $data = array();
        $no = intval($_GET['start']);
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->id_barcode;
            $row[] = $field->short_desc;
            $row[] = $field->size_desc;
            $row[] = $field->gender;
            $row[] = 'Rp ' . number_format($field->harga_beli, 0, ".", ".");
            $row[] = 'Rp ' . number_format($field->harga_jual, 0, ".", ".");
            $row[] = $field->harga_reseller;
            $row[] = $field->stok;
            $row[] = $field->brand;
            if ($field->status == 1) {
                $row[] = '<span class="badge badge-success p-2">Tersedia</span>';
            } else {
                $row[] = '<span class="badge badge-danger p-2">Habis</span>';
            }
            $row[] = '<a href="" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#ubahcustomerModal" title="Update"><i class="fas fa-pen"></i></a>
            <a href="" class="btn btn-outline-danger btn-sm tombol-hapuscustomer" id="tmblhapusdtcs" title="Hapus"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_GET['draw']),
            "recordsTotal" => $this->sp->count_all(),
            "recordsFiltered" => $this->sp->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
