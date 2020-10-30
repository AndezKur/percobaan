<!-- Begin Page Content -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="mb-4 text-gray-800"><?= $judul; ?></h3>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Informasi Nota</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="noinvoice"><strong>No. Invoice</strong></label>
                        <input class="form-control" name="noinvoice" id="noinvoice" style="cursor:no-drop" value="php0829739386737" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kasire"><strong>Kasir</strong></label>
                        <input class="form-control" name="kasire" id="kasire" style="cursor:no-drop" value="admin-jastipku" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tgltransaksi"><strong>Tanggal Transaksi</strong></label>
                        <input class="form-control tgltransaksi" name="tgltransaksi" id="tgltransaksi" value="<?= date("Y-m-d"); ?>">
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Informasi Customer</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nohpcs" class="col-md-3 col-form-label"><strong>Cari Customer</strong></label>
                        <div class="col-md-6 mb-2">
                            <input class="form-control" type="text" name="nohpcs" id="nohpcs" placeholder="No. Hp atau Nama CS" autofocus>
                        </div>
                        <div class="col-md-3">
                            <a href="" class="buton buton-primary" title="Cari CS" data-toggle="modal" data-target="#caricsModal" id="caricust"><i class="fas fa-search"></i></a>
                            <a href="" class="btn btn-info" title="Ulangi"><i class="fas fa-sync"></i></a>
                        </div>
                    </div>
                    <div id="pesane">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="namacs"><strong>Nama</strong></label>
                            <input class="form-control" name="namacs" id="namacs" style="cursor:no-drop" placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="namacs"><strong>No.Hp Customer</strong></label>
                            <input class="form-control" name="nohpcustomer" id="nohpcustomer" placeholder="" style="cursor:no-drop" readonly>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-7">
                            <label for="alamatcs"><strong>Alamat</strong></label>
                            <textarea name="alamatcs" class="form-control" id="alamatcs" rows="3" placeholder="" style="cursor:no-drop" readonly></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="statuscs"><strong>Status CS:</strong></label>
                            <select class="form-control mb-2" name="statuscs" id="statuscs" name="statuscs">
                                <option value="" disabled selected style="display:none;">Pilih Status</option>
                                <option value="Umum">Umum</option>
                                <option value="Dropship">Dropship</option>
                                <option value="Reseller">Reseller</option>
                            </select>
                            <a href="" class="btn btn-success" id="next" name="next">Lanjut</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





</div>
<!-- /.container-fluid -->

</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="caricsModal" tabindex="-1" role="dialog" aria-labelledby="caricsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="caricsModal">Cari Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnbatalcs1">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive-xl table-bordered p-3 mb-0">
                <table class="table table-hover p-1" id="dataTableCS" width="100%" cellspacing="0">
                    <th scope="col">No. Handphone</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="buton buton-primary .closemodal" data-dismiss="modal" id="btnbatalcs2">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>date/dist/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script>
    $.noConflict();
    jQuery(document).ready(function($) {
        $("#tgltransaksi").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        $('#nohpcs').keyup(function() {
            let data = $('#nohpcs').val();
            console.log(data);

            if (data == "") {
                $('#namacs').val("");
                $('#alamatcs').val("");
                $('#nohpcustomer').val("");
            } else {

                $.ajax({
                    url: "<?= base_url('transaksi/ambildtcustomer'); ?>",
                    data: "nohpne=" + data,
                    dataType: "json",
                    type: "post",
                    success: function(datane) {
                        console.log(datane);
                        if (datane == null) {
                            $('#pesane').html('<p class ="text-danger"><i class="fas fa-exclamation-circle"></i> Data Customer Tidak Ditemukan </p>');
                            $('#namacs').val("");
                            $('#alamatcs').val("");
                            $('#nohpcustomer').val("");
                        } else {
                            $('#namacs').val(datane.nama);
                            $('#alamatcs').val(datane.alamat);
                            $('#nohpcustomer').val(datane.id_telp);
                            //$('#nohpcs').attr('readonly', true);
                            $('div#pesane').find('.text-danger').remove().find('.fas fa-exclamation-circle').remove();
                        }

                    }
                });
            }


        });

        $('#caricust').click(function() {
            var datacustomer = $('#dataTableCS').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('barang/ambildata'); ?>",
                    "type": "GET",
                    "data": function(data) {
                        data.brand = $('#brandbarang option:selected').val();
                    }
                },
                "columnDefs": [{
                    "targets": [11],
                    "orderable": false,
                }],
                "language": {
                    "infoEmpty": "Data tidak ditemukan",
                    "lengthMenu": "Tampil _MENU_ Data Per Halaman",
                    "zeroRecords": "Maaf Data Tidak Ditemukan",
                    "processing": "Memproses...",
                    "search": "Cari :",
                    "info": "Tampil _TOTAL_ Data",
                    "infoFiltered": "(Filter Dari _MAX_ Total Data)",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "scrollY": '50vh',
                "scrollX": true,
                "scrollCollapse": true
            });
        });
    });
</script>