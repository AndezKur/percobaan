<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_barang', 'dbarang');
    }
    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $data['title'] = "Jastipku | Data Barang";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['jenis_brand'] = $this->db->get('barang_brand')->result_array();
        $data['jenis_barang'] = $this->db->get('barang_jenis')->result_array();
        $data['judul'] = "Data Barang";
        $data['menujdl'] = "Data Barang";
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('barang/index');
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
        $list = $this->dbarang->get_datatables();
        $data = array();
        $no = intval($_GET['start']);
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->id_barcode;
            $row[] = $field->jenisnm;
            $row[] = $field->short_desc;
            $row[] = $field->size_desc;
            $row[] = $field->gender;
            $row[] = 'Rp ' . number_format($field->harga_beli, 0, ".", ".");
            $row[] = 'Rp ' . number_format($field->harga_jual, 0, ".", ".");
            $row[] = 'Rp ' . number_format($field->harga_reseller, 0, ".", ".");
            $row[] = $field->stok;
            $row[] = $field->brandnm;
            if ($field->status == 1) {
                $row[] = '<span class="badge badge-success p-2">Tersedia</span>';
            } else {
                $row[] = '<span class="badge badge-danger p-2">Habis</span>';
            }
            $row[] = '<a href="" class="btn btn-outline-info btn-sm updatebr" data-toggle="modal" data-target="#ubahbarangModal" title="Update" id="' . $field->id . '"><i class="fas fa-pen"></i></a>
            <a href="" class="btn btn-outline-danger btn-sm tombol-hapuscustomer deletebr" id="' . $field->id . '" title="Hapus"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_GET['draw']),
            "recordsTotal" => $this->dbarang->count_all(),
            "recordsFiltered" => $this->dbarang->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


    public function tambahdata()
    {
        $data = ['success' => false, 'message' => array()];
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|trim|numeric|is_unique[data_barang.id_barcode]', [
            'required' => '*Barcode Wajib Di isi!',
            'numeric' => '*Barcode harus angka!',
            'is_unique' => '*Barcode sudah digunakan!'
        ]);
        $this->form_validation->set_rules('jenisbarang', 'Jenis Barang', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('brandbrg', 'Brand', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('namabarang', 'Nama Barang', 'required|trim', [
            'required' => '*Nama Barang Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('deskbarang', 'Deskripsi Barang', 'required|trim', [
            'required' => '*Deskripsi Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim|numeric', [
            'required' => '*Diisi!',
            'numeric' => '*Angka!'
        ]);
        $this->form_validation->set_rules('size', 'Size', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('sizedesk', 'Deskripsi Size', 'required|trim', [
            'required' => '*Deskripsi Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('hargabeli', 'Harga Beli', 'required|trim|numeric', [
            'required' => '*Wajib Diisi!',
            'numeric' => '*Harus Angka!'
        ]);
        $this->form_validation->set_rules('hargajual', 'Harga Jual', 'required|trim|numeric', [
            'required' => '*Wajib Diisi!',
            'numeric' => '*Harus Angka!'
        ]);
        $this->form_validation->set_rules('hargarslr', 'Harga Reseller', 'required|trim|numeric', [
            'required' => '*Wajib Diisi!',
            'numeric' => '*Harus Angka!'
        ]);
        $this->form_validation->set_error_delimiters('<p class ="text-danger pt-1">', '</p>');
        if ($this->form_validation->run()) {
            $data['success'] = true;
            $stok = $this->input->post('stok', true);
            if ($stok == 0) {
                $status = 0;
            } else {
                $status = 1;
            }
            $array = [
                'id_barcode' => $this->input->post('barcode', true),
                'jenis_barang' => $this->input->post('jenisbarang', true),
                'short_desc' => ucwords($this->input->post('namabarang', true)),
                'detail_desc' => ucwords($this->input->post('deskbarang', true)),
                'size' => $this->input->post('size', true),
                'size_desc' => strtoupper($this->input->post('sizedesk', true)),
                'gender' => $this->input->post('gender', true),
                'harga_beli' => $this->input->post('hargabeli', true),
                'harga_jual' => $this->input->post('hargajual', true),
                'harga_reseller' => $this->input->post('hargarslr', true),
                'stok' => $stok,
                'brand' => $this->input->post('brandbrg', true),
                'status' => $status,

            ];
            $this->dbarang->tambahdtbarang($array);
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }
        echo json_encode($data);
    }

    public function getdt()
    {
        $id = $this->input->post('id_barang', true);
        $datane = $this->dbarang->ambil_datane($id);

        echo json_encode($datane);
    }

    public function updatedatanya()
    {
        $data = ['success' => false, 'message' => array()];
        $this->form_validation->set_rules('ubahbarcode', 'Barcode', 'required|trim|numeric', [
            'required' => '*Barcode Wajib Di isi!',
            'numeric' => '*Barcode harus angka!'
        ]);
        $this->form_validation->set_rules('ubahjenisbarang', 'Jenis Barang', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahbrandbrg', 'Brand', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahgender', 'Gender', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahnamabarang', 'Nama Barang', 'required|trim', [
            'required' => '*Nama Barang Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahdeskbarang', 'Deskripsi Barang', 'required|trim', [
            'required' => '*Deskripsi Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahstok', 'Stok', 'required|trim|numeric', [
            'required' => '*Diisi!',
            'numeric' => '*Angka!'
        ]);
        $this->form_validation->set_rules('ubahsize', 'Size', 'required|trim', [
            'required' => '*Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahsizedesk', 'Deskripsi Size', 'required|trim', [
            'required' => '*Deskripsi Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahhargabeli', 'Harga Beli', 'required|trim|numeric', [
            'required' => '*Wajib Diisi!',
            'numeric' => '*Harus Angka!'
        ]);
        $this->form_validation->set_rules('ubahhargajual', 'Harga Jual', 'required|trim|numeric', [
            'required' => '*Wajib Diisi!',
            'numeric' => '*Harus Angka!'
        ]);
        $this->form_validation->set_rules('ubahhargarslr', 'Harga Reseller', 'required|trim|numeric', [
            'required' => '*Wajib Diisi!',
            'numeric' => '*Harus Angka!'
        ]);
        $this->form_validation->set_error_delimiters('<p class ="text-danger pt-1">', '</p>');

        if ($this->form_validation->run()) {
            $data['success'] = true;
            $stok = $this->input->post('ubahstok', true);
            $id = $this->input->post('ubahidbarang', true);
            if ($stok == 0) {
                $status = 0;
            } else {
                $status = 1;
            }
            $array = [
                'id_barcode' => $this->input->post('ubahbarcode', true),
                'jenis_barang' => $this->input->post('ubahjenisbarang', true),
                'short_desc' => ucwords($this->input->post('ubahnamabarang', true)),
                'detail_desc' => ucwords($this->input->post('ubahdeskbarang', true)),
                'size' => $this->input->post('ubahsize', true),
                'size_desc' => strtoupper($this->input->post('ubahsizedesk', true)),
                'gender' => $this->input->post('ubahgender', true),
                'harga_beli' => $this->input->post('ubahhargabeli', true),
                'harga_jual' => $this->input->post('ubahhargajual', true),
                'harga_reseller' => $this->input->post('ubahhargarslr', true),
                'stok' => $stok,
                'brand' => $this->input->post('ubahbrandbrg', true),
                'status' => $status,
            ];
            $this->db->where('id', $id);
            $this->db->update('data_barang', $array);
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }
        echo json_encode($data);
    }

    public function hapusbarangnya()
    {
        $id = $this->input->post('id_barange', true);
        $this->db->where('id', $id);
        $data = $this->db->delete('data_barang');

        echo json_encode($data);
    }
}
