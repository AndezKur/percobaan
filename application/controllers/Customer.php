<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Semua_hal', 'sh');
    }
    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $data['title'] = "Jastipku | Data Customer";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['judul'] = "Data Customer";
        $data['menujdl'] = "Data Customer";
        $data['customer'] = $this->sh->getcustomerall();

        $this->form_validation->set_rules('nohp', 'No. HP', 'required|trim|numeric|is_unique[data_customer.id_telp]|max_length[15]|min_length[11]', [
            'required' => 'No. Handphone Wajib Di isi!',
            'numeric' => 'No. Handphone harus angka!',
            'is_unique' => 'No. Handphone sudah terdaftar!',
            'max_length' => 'No.Handphone maksimal 15 nomor!',
            'min_length' => 'No. Handphone minimal 11 nomor!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat Wajib Diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/topbar');
            $this->load->view('customer/index');
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_telp' => $this->input->post('nohp', true),
                'nama' => ucwords(htmlspecialchars($this->input->post('nama'))),
                'alamat' => ucwords(htmlspecialchars($this->input->post('alamat')))
            ];
            $this->db->insert('data_customer', $data);
            $this->session->set_flashdata('message', $this->input->post('nama') . ' Berhasil Ditambahkan');
            redirect('customer');
        }
    }

    public function hapus($telpid)
    {
        $datanama = $this->sh->getcustomerbyid($telpid);
        $this->sh->hapusdatacustomer($telpid);
        $this->session->set_flashdata('message', $datanama['nama'] . ' Berhasil DiHapus');
        redirect('customer');
    }
    public function ambilubahcs()
    {
        $id_telp = $this->input->post('id_telp');
        $datacs = $this->sh->getCustomerbyid($id_telp);

        echo json_encode($datacs);
    }

    public function ubahdata()
    {
        $data = ['success' => false, 'message' => array()];
        $this->form_validation->set_rules('ubahnohp', 'No. HP', 'required|trim|numeric|max_length[15]|min_length[11]', [
            'required' => 'No. Handphone Wajib Di isi!',
            'numeric' => 'No. Handphone harus angka!',
            'max_length' => 'No.Handphone maksimal 15 nomor!',
            'min_length' => 'No.Handphone minimal 11 nomor!'
        ]);
        $this->form_validation->set_rules('ubahnama', 'Nama', 'required|trim', [
            'required' => 'Nama Wajib Diisi!'
        ]);
        $this->form_validation->set_rules('ubahalamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat Wajib Diisi!'
        ]);
        $this->form_validation->set_error_delimiters('<p class ="text-danger pt-1"><i class="fas fa-exclamation-circle"></i> ', '</p>');

        if ($this->form_validation->run()) {
            $data['success'] = true;
            $id = $this->input->post('id', true);
            $array = [
                'id_telp' => $this->input->post('ubahnohp', true),
                'nama' => ucwords($this->input->post('ubahnama', true)),
                'alamat' => ucwords($this->input->post('ubahalamat', true))
            ];
            $this->sh->ubahcustomercs($id, $array);
        } else {
            foreach ($_POST as $key => $value) {
                $data['message'][$key] = form_error($key);
            }
        }
        echo json_encode($data);
    }

    public function pindahubahdata()
    {
        $kata = $this->input->post('kata');
        $this->session->set_flashdata('message', $kata);
        echo json_encode($kata);
    }
}
