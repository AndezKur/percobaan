<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_sepatu extends CI_Model
{
    var $table = 'data_barang';
    var $column_order = array('id_barcode', 'short_desc', 'size_desc', 'gender', 'harga_beli', 'harga_jual', 'harga_reseller', 'stok', 'brand', 'status');
    var $column_search = array('id_barcode', 'short_desc', 'size_desc', 'gender', 'harga_beli', 'harga_jual', 'harga_reseller', 'stok', 'brand', 'status');
    var $order = array('id' => 'asc');
    private function _get_datatables_query()
    {
        $dt = $_GET['brand'];
        if ($dt != "All") {

            $this->db->where('brand', $dt);
        }
        //add custom filter here
        $this->db->where('jenis_barang', 'Sepatu');
        $this->db->from('data_barang');
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
        $this->db->where('jenis_barang', 'Sepatu');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getdata($postData = null)
    {
        $response = array();

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        $searchBrand = $postData['brands'];

        //mulai search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = "(id_barcode like '%" . $searchValue . "%' or short_desc like '%" . $searchValue . "%' or
            size_desc like '%" . $searchValue . "%' or gender like '%" . $searchValue . "%' or harga_beli like '%" . $searchValue . "%'
            or harga_jual like '%" . $searchValue . "%' or harga_reseller like '%" . $searchValue . "%' or stok like '%" . $searchValue . "%' or brand like '%" . $searchValue . "%' or status like '%" . $searchValue . "%')";
        }
        if ($searchBrand != 'All') {
            $search_arr[] = " brand='" . $searchBrand . "'";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        //hitung total records
        $this->db->select('count(*) as allcount');
        $this->db->where('jenis_barang', 'Sepatu');
        $records = $this->db->get('data_barang')->result();
        $totalRecords = $records[0]->allcount;

        //hitung dengan filter
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->where('jenis_barang', 'Sepatu');
        $records = $this->db->get('data_barang')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        $this->db->select('*');
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->where('jenis_barang', 'Sepatu');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('data_barang')->result();
        $data = array();

        foreach ($records as $record) {

            $data[] = array(
                'id_barcode' => $record->id_barcode,
                'short_desc' => $record->short_desc,
                'size_desc' => $record->size_desc,
                'gender' => $record->gender,
                'harga_beli' => $record->harga_beli,
                'harga_jual' => $record->harga_jual,
                'harga_reseller' => $record->harga_reseller,
                'stok' => $record->stok,
                'brand' => $record->brand,
                'status' => $record->status,
                'aksi' => ""
            );
        }
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data" => $data
        );
        return $response;
    }


    public function getallsepatu()
    {
        $this->db->where('jenis_barang', 'Sepatu');
        $query = $this->db->get('data_barang');
        return $query->result_array();
    }
    public function getallbrand($brand)
    {
        $this->db->where('brand', $brand);
        $this->db->where('jenis_barang', 'Sepatu');
        $query = $this->db->get('data_barang');
        return $query->result_array();
    }
}
