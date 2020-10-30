<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_barang extends CI_Model
{
    var $table = 'data_barang';
    var $column_order = array('id_barcode', 'jenis_barang', 'short_desc', 'size_desc', 'gender', 'harga_beli', 'harga_jual', 'harga_reseller', 'stok', 'brand', 'status');
    var $column_search = array('id_barcode', 'nama_jenis', 'short_desc', 'size_desc', 'gender', 'harga_beli', 'harga_jual', 'harga_reseller', 'stok', 'nama_brand', 'status');
    var $order = array('id' => 'asc');
    private function _get_datatables_query()
    {
        $dt = $_GET['brand'];
        //add custom filter here
        $this->db->select('data_barang.*,barang_brand.nama_brand as brandnm, barang_jenis.nama_jenis as jenisnm');
        $this->db->from('data_barang');
        $this->db->join('barang_brand', 'barang_brand.id=data_barang.brand');
        $this->db->join('barang_jenis', 'barang_jenis.id=data_barang.jenis_barang');
        if ($dt != "All") {
            $this->db->where('brand', $dt);
        }
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_GET['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_GET['search']['value']);
                } else {
                    $this->db->or_like($item, $_GET['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_GET['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if (intval($_GET['length']) != -1)
            $this->db->limit(intval($_GET['length']), intval($_GET['start']));
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function tambahdtbarang($data)
    {
        $this->db->insert('data_barang', $data);
    }

    public function ambil_datane($id)
    {
        $this->db->where('id', $id);
        $barang = $this->db->get('data_barang')->row_array();
        return $barang;
    }
}
