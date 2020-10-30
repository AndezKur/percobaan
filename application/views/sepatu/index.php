<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->

    <div class="row mb-3">
        <div class="col-lg-9">
            <h3 class="mb-4 text-gray-800">Data <?= $judul; ?></h3>
            <div class="flashdatamsg" id="flashdatamsg" data-message="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="form-row">
                <div class="col-lg-3">
                    <a href="" class="buton buton-primary" data-toggle="modal" data-target="#tambahsepatuModal"><i class="fas fa-plus"></i> Tambah Sepatu</a>
                </div>
                <div class="form-inline col-lg-6">
                    <label for="brandsepatu" class="mr-2">Brand : </label>
                    <select class="form-control brandsepatu" id="brandsepatu">
                        <option value="All" selected>All</option>
                        <option value="Adidas">Adidas</option>
                        <option>Asics</option>
                        <option>Skechers</option>
                        <option>New Balance</option>
                        <option>Airwalk</option>
                        <option>Piero</option>
                        <option>Specs</option>
                        <option>Staccato</option>
                        <option>Diadora</option>
                        <option>Converse</option>
                        <option>Crocs</option>
                        <option>Oakley</option>
                        <option>Astec</option>
                        <option>Brooks</option>
                        <option>Nike</option>
                        <option>New Era</option>
                        <option>UA</option>
                        <option>Hoka</option>
                        <option>Disney</option>
                        <option>Energetics</option>
                        <option>Puma</option>
                    </select>
                </div>
            </div>
            <?= form_error('nohp', '<div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>', '</div>'); ?>
        </div>
    </div>
    <div class="card mb-3">
        <div class="table-responsive-xl table-bordered p-3 mb-0">
            <table class="table table-hover p-1" id="dataTablesepatu" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Barcode</th>
                        <th scope="col">Nama Deskripsi</th>
                        <th scope="col">Size Deskripsi</th>
                        <th scope="col">Gender</th>
                        <th scope="col" width="20%">Harga Beli</th>
                        <th scope="col" width="20%">Harga Jual</th>
                        <th scope="col" width="10%">Harga Reseller</th>
                        <th scope="col" width="5%">Stok</th>
                        <th scope="col">Brand</th>
                        <th scope="col" width="8%">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!--Modal -->


<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahsepatuModal" tabindex="-1" role="dialog" aria-labelledby="tambahsepatuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahsepatuModal">Tambah Data Sepatu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnbatalsepatu2">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer'); ?>" method="post" id="formtambahcustomer">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nohp"><strong>No. Handphone</strong></label>
                        <input type="text" class="form-control" id="nohp" name="nohp" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label for="nama"><strong>Nama</strong></label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Customer">
                    </div>
                    <div class="form-group">
                        <label for="alamat"><strong>Alamat</strong></label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Alamat Lengkap"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="provinsi"><strong>Provinsi</strong></label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Contoh(Jawa Tengah)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnbatalsepatu1">Batal</button>
                    <button type="submit" id="tambahdatasepatu" class="buton buton-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        //var brand = $('#brandsepatu :selected').val();
        //tampildatasp(brand);
        var sepatutable = $('#dataTablesepatu').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('sepatu/ambildata'); ?>",
                "type": "GET",
                "data": function(data) {
                    data.brand = $('#brandsepatu :selected').val();
                }
            }
        });
        $('#brandsepatu').change(function() {
            sepatutable.draw();
        });
    });


    function tampildatasp(x) {
        $.ajax({
            url: "<?= base_url('sepatu/ambildata') ?>",
            method: "POST",
            data: "brand=" + x,
            dataType: "JSON",
            success: function(data) {
                let baris = '';
                if (data.length == 0) {
                    baris += '<tr align="center" >' +
                        '<td colspan="11">' + 'Data tidak ditemukan' + '</td>' +
                        '</tr>';
                } else {
                    for (let i = 0; i < data.length; i++) {
                        baris += '<tr>' +
                            '<td>' + data[i].id_barcode + ' </td>' +
                            '<td>' + data[i].short_desc + ' </td>' +
                            '<td>' + data[i].size_desc + ' </td>' +
                            '<td>' + data[i].gender + ' </td>' +
                            '<td>' + data[i].harga_beli + ' </td>' +
                            '<td>' + data[i].harga_jual + ' </td>' +
                            '<td>' + data[i].harga_reseller + ' </td>' +
                            '<td>' + data[i].stok + ' </td>' +
                            '<td>' + data[i].brand + ' </td>' +
                            '<td>' + data[i].status + ' </td>' +
                            '<td><a href="" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#ubahcustomerModal"><i class="fas fa-pen"></i></a></td>' +
                            '</tr>';
                    }
                }
                console.log(data);
                $('#isisepatu').html(baris);
            }

        });
    }
</script>