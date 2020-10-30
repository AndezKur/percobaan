<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->

    <div class="row mb-3">
        <div class="col-lg-9">
            <h3 class="mb-4 text-gray-800"><?= $judul; ?></h3>
            <div class="flashdatamsg" id="flashdatamsg" data-message="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="form-row">
                <div class="col-lg-3">
                    <a href="" class="buton buton-primary" data-toggle="modal" data-target="#tambahbarangModal"><i class="fas fa-plus"></i> Tambah Barang</a>
                </div>
                <div class="form-inline col-lg-6">
                    <label for="brandbarang" class="mr-2">Brand : </label>
                    <select class="form-control brandbarang" id="brandbarang">
                        <option value="All">All</option>
                        <?php foreach ($jenis_brand as $brand) : ?>
                            <option value="<?= $brand['id']; ?>"><?= $brand['nama_brand']; ?></option>
                        <?php endforeach; ?>
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
            <table class="table table-hover p-1" id="dataTablebarang" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" width="10%">Barcode</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Nama Deskripsi</th>
                        <th scope="col">Size Deskripsi</th>
                        <th scope="col" width="5%">Gender</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Harga Reseller</th>
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


<!-- Modal Tambah Data -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahbarangModal" tabindex="-1" role="dialog" aria-labelledby="tambahbarangModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahbarangModal">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnbatalbarang1">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="formtambahbarang">
                <div class="modal-body">
                    <div class="form-group form-tambahbr">
                        <label for="barcode"><strong>Id. Barcode</strong></label>
                        <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Masukkan Barcode" autocomplete="off">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 form-tambahbr">
                            <label for="jenisbarang"> <strong>Jenis Barang</strong></label>
                            <select class="form-control" name="jenisbarang" id="jenisbarang">
                                <option value="" disabled selected style="display:none;">Pilih Barang</option>
                                <?php foreach ($jenis_barang as $jb) : ?>
                                    <option value="<?= $jb['id']; ?>"><?= $jb['nama_jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 form-tambahbr">
                            <label for="brandbrg"> <strong>Brand</strong></label>
                            <select class="form-control" name="brandbrg" id="brandbrg">
                                <option value="" disabled selected style="display:none;">Pilih Brand</option>
                                <?php foreach ($jenis_brand as $jr) : ?>
                                    <option value="<?= $jr['id']; ?>"><?= $jr['nama_brand']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 form-tambahbr">
                            <label for="gender"> <strong>Gender</strong></label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="" disabled selected style="display:none;">Pilih Gender</option>
                                <option value="Man">Man</option>
                                <option value="Woman">Woman</option>
                                <option value="Unisex">Unisex</option>
                                <option value="Girls">Girls</option>
                                <option value="Kids">Kids</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-tambahbr">
                        <label for="namabarang"><strong>Nama Barang</strong></label>
                        <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Contoh (ADIDAS RUN70S B96556 (Black) - 42)">
                    </div>
                    <div class="form-group form-tambahbr">
                        <label for="deskbarang"><strong>Deskripsi Barang</strong></label>
                        <textarea class="form-control" id="deskbarang" name="deskbarang" rows="2" placeholder="Deskripsi Lengkap"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2 form-tambahbr">
                            <label for="stok"><strong>Stok</strong> </label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="">
                        </div>
                        <div class="form-group col-md-3 form-tambahbr">
                            <label for="size"> <strong>Size</strong> </label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="">
                        </div>
                        <div class="form-group col-md-7 form-tambahbr">
                            <label for="sizedesk"> <strong>Deskripsi Size</strong> </label>
                            <input type="text" class="form-control" id="sizedesk" name="sizedesk" placeholder="Deskripsi Lengkap">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 form-tambahbr">
                            <label for="hargabeli"><strong>Harga Beli</strong> </label>
                            <input type="number" class="form-control" id="hargabeli" name="hargabeli" placeholder="">
                        </div>
                        <div class="form-group col-md-4 form-tambahbr">
                            <label for="hargajual"> <strong>Harga Jual</strong> </label>
                            <input type="number" class="form-control" id="hargajual" name="hargajual" placeholder="">
                        </div>
                        <div class="form-group col-md-4 form-tambahbr">
                            <label for="hargarslr"> <strong>Harga Reseller*</strong></label>
                            <input type="number" class="form-control" id="hargarslr" name="hargarslr" placeholder="" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary .closemodal" data-dismiss="modal" id="btnbatalbarang2">Batal</button>
                    <button type="submit" id="tambahdatabarang" class="buton buton-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Data-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ubahbarangModal" tabindex="-1" role="dialog" aria-labelledby="ubahbarangModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahbarangModal">Update Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnbatalubahbarang1">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="formubahbarang">
                <div class="modal-body">
                    <input type="hidden" id="ubahidbarang" name="ubahidbarang">
                    <div class="form-group form-ubahbr">
                        <label for="ubahbarcode"><strong>Id. Barcode</strong></label>
                        <input type="text" class="form-control" id="ubahbarcode" name="ubahbarcode" placeholder="Masukkan Barcode" autocomplete="off" readonly>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" value="" id="updatebarcode">
                            <label class="form-check-label" for="updatebarcode">
                                Update Barcode
                            </label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 form-ubahbr">
                            <label for="ubahjenisbarang"> <strong>Jenis Barang</strong></label>
                            <select class="form-control" name="ubahjenisbarang" id="ubahjenisbarang">
                                <option value="" disabled selected style="display:none;">Pilih Barang</option>
                                <?php foreach ($jenis_barang as $jb) : ?>
                                    <option value="<?= $jb['id']; ?>"><?= $jb['nama_jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 form-ubahbr">
                            <label for="ubahbrandbrg"> <strong>Brand</strong></label>
                            <select class="form-control" name="ubahbrandbrg" id="ubahbrandbrg">
                                <option value="" disabled selected style="display:none;">Pilih Brand</option>
                                <?php foreach ($jenis_brand as $jr) : ?>
                                    <option value="<?= $jr['id']; ?>"><?= $jr['nama_brand']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 form-ubahbr">
                            <label for="ubahgender"> <strong>Gender</strong></label>
                            <select class="form-control" name="ubahgender" id="ubahgender">
                                <option value="" disabled selected style="display:none;">Pilih Gender</option>
                                <option value="Man">Man</option>
                                <option value="Woman">Woman</option>
                                <option value="Unisex">Unisex</option>
                                <option value="Girls">Girls</option>
                                <option value="Kids">Kids</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-ubahbr">
                        <label for="ubahnamabarang"><strong>Nama Barang</strong></label>
                        <input type="text" class="form-control" id="ubahnamabarang" name="ubahnamabarang" placeholder="Contoh (ADIDAS RUN70S B96556 (Black) - 42)">
                    </div>
                    <div class="form-group form-ubahbr">
                        <label for="ubahdeskbarang"><strong>Deskripsi Barang</strong></label>
                        <textarea class="form-control" id="ubahdeskbarang" name="ubahdeskbarang" rows="2" placeholder="Deskripsi Lengkap"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2 form-ubahbr">
                            <label for="ubahstok"><strong>Stok</strong> </label>
                            <input type="number" class="form-control" id="ubahstok" name="ubahstok" placeholder="">
                        </div>
                        <div class="form-group col-md-3 form-ubahbr">
                            <label for="ubahsize"> <strong>Size</strong> </label>
                            <input type="text" class="form-control" id="ubahsize" name="ubahsize" placeholder="">
                        </div>
                        <div class="form-group col-md-7 form-ubahbr">
                            <label for="ubahsizedesk"> <strong>Deskripsi Size</strong> </label>
                            <input type="text" class="form-control" id="ubahsizedesk" name="ubahsizedesk" placeholder="Deskripsi Lengkap">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 form-ubahbr">
                            <label for="ubahhargabeli"><strong>Harga Beli</strong> </label>
                            <input type="number" class="form-control" id="ubahhargabeli" name="ubahhargabeli" placeholder="">
                        </div>
                        <div class="form-group col-md-4 form-ubahbr">
                            <label for="ubahhargajual"> <strong>Harga Jual</strong> </label>
                            <input type="number" class="form-control" id="ubahhargajual" name="ubahhargajual" placeholder="">
                        </div>
                        <div class="form-group col-md-4 form-ubahbr">
                            <label for="ubahhargarslr"> <strong>Harga Reseller*</strong></label>
                            <input type="number" class="form-control" id="ubahhargarslr" name="ubahhargarslr" placeholder="" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary .closemodal" data-dismiss="modal" id="btnbatalubahbarang2">Batal</button>
                    <button type="submit" id="ubahdatabarang" class="buton buton-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script>
    // $(document).ready(function() {
    //   var brand = $('#brandbarang option:selected').val();

    //alert(brand);
    // $('#brandbarang').change(function() {
    //   var br = $('#brandbarang option:selected').val();
    // alert(br);
    //});
    //});
    $(document).ready(function() {
        // var brand = $('#brandsepatu option:selected').val();
        //tampildatasp(brand);
        var barangtable = $('#dataTablebarang').DataTable({
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
        $('#brandbarang').change(function() {
            barangtable.draw();
        });
        $('#formtambahbarang').submit(function(a) {
            a.preventDefault();
            var barcode = $('#barcode').val();
            var jenisbarang = $('#jenisbarang option:selected').val();
            var brandbrg = $('#brandbrg option:selected').val();
            var gender = $('#gender option:selected').val();
            var namabarang = $('#namabarang').val();
            var deskbarang = $('#deskbarang').val();
            var stok = $('#stok').val();
            var size = $('#size').val();
            var sizedesk = $('#sizedesk').val();
            var hargabeli = $('#hargabeli').val();
            var hargajual = $('#hargajual').val();
            var hargarslr = $('#hargarslr').val();

            var me = $(this);
            $.ajax({
                url: '<?= base_url() . "barang/tambahdata"; ?>',
                type: 'post',
                data: 'barcode=' + barcode + '&jenisbarang=' + jenisbarang + '&brandbrg=' + brandbrg + '&gender=' + gender + '&namabarang=' + namabarang + '&deskbarang=' + deskbarang + '&stok=' + stok + '&size=' + size + '&sizedesk=' + sizedesk + '&hargabeli=' + hargabeli + '&hargajual=' + hargajual + '&hargarslr=' + hargarslr,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.success == true) {
                        $("#formtambahbarang")[0].reset();
                        $('#formtambahbarang').find('.text-danger').remove();
                        $('#tambahbarangModal').modal('hide');

                        Swal.fire(
                            'Data Barang',
                            'berhasil ditambahkan!',
                            'success'
                        )
                        barangtable.draw();

                    } else {
                        $.each(data.message, function(key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-tambahbr')
                                .find('.text-danger').remove();
                            element.after(value);
                        });
                    }

                }
            });
        });

        $('#btnbatalbarang1').click(function() {
            $("#formtambahbarang")[0].reset();
            $('#formtambahbarang').find('.text-danger').remove();
        });
        $('#btnbatalbarang2').click(function() {
            $("#formtambahbarang")[0].reset();
            $('#formtambahbarang').find('.text-danger').remove();
        });

        $('#updatebarcode').click(function() {
            if ($(this).is(':checked')) {
                $('#ubahbarcode').attr('readonly', false);
            } else {
                $('#ubahbarcode').attr('readonly', true);
            }
        });

        $(document).on('click', '.updatebr', function() {
            var id_br = $(this).attr('id');
            console.log(id_br);
            $.ajax({
                type: "POST",
                data: "id_barang=" + id_br,
                url: "<?= base_url('barang/getdt'); ?>",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#ubahidbarang').val(data.id);
                    $('#ubahbarcode').val(data.id_barcode);
                    $('#ubahjenisbarang').val(data.jenis_barang).prop('selected', true);
                    $('#ubahbrandbrg').val(data.brand).prop('selected', true);
                    $('#ubahgender').val(data.gender).prop('selected', true);
                    $('#ubahnamabarang').val(data.short_desc);
                    $('#ubahdeskbarang').val(data.detail_desc);
                    $('#ubahstok').val(data.stok);
                    $('#ubahsize').val(data.size);
                    $('#ubahsizedesk').val(data.size_desc);
                    $('#ubahhargabeli').val(data.harga_beli);
                    $('#ubahhargajual').val(data.harga_jual);
                    $('#ubahhargarslr').val(data.harga_reseller);


                }
            });

        });

        $('#formubahbarang').submit(function(a) {
            a.preventDefault();
            var ubahidbarang = $('#ubahidbarang').val();
            var ubahbarcode = $('#ubahbarcode').val();
            var ubahjenisbarang = $('#ubahjenisbarang option:selected').val();
            var ubahbrandbrg = $('#ubahbrandbrg option:selected').val();
            var ubahgender = $('#ubahgender option:selected').val();
            var ubahnamabarang = $('#ubahnamabarang').val();
            var ubahdeskbarang = $('#ubahdeskbarang').val();
            var ubahstok = $('#ubahstok').val();
            var ubahsize = $('#ubahsize').val();
            var ubahsizedesk = $('#ubahsizedesk').val();
            var ubahhargabeli = $('#ubahhargabeli').val();
            var ubahhargajual = $('#ubahhargajual').val();
            var ubahhargarslr = $('#ubahhargarslr').val();

            $.ajax({
                url: '<?= base_url('barang/updatedatanya'); ?>',
                data: 'ubahidbarang=' + ubahidbarang + '&ubahbarcode=' + ubahbarcode + '&ubahjenisbarang=' + ubahjenisbarang + '&ubahbrandbrg=' + ubahbrandbrg + '&ubahgender=' + ubahgender + '&ubahnamabarang=' + ubahnamabarang + '&ubahdeskbarang=' + ubahdeskbarang + '&ubahstok=' + ubahstok + '&ubahsize=' + ubahsize + '&ubahsizedesk=' + ubahsizedesk + '&ubahhargabeli=' + ubahhargabeli + '&ubahhargajual=' + ubahhargajual + '&ubahhargarslr=' + ubahhargarslr,
                dataType: 'json',
                type: 'post',
                success: function(data) {
                    console.log(data);
                    if (data.success == true) {
                        $("#formubahbarang")[0].reset();
                        $('#formubahbarang').find('.text-danger').remove();
                        $('#ubahbarcode').attr('readonly', true);
                        $('#ubahbarangModal').modal('hide');

                        Swal.fire(
                            'Data Barang',
                            'berhasil diperbaharui!',
                            'success'
                        )
                        barangtable.draw();

                    } else {
                        $.each(data.message, function(key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-ubahbr')
                                .find('.text-danger').remove();
                            element.after(value);
                        });
                    }
                }
            });

        });

        $(document).on('click', '.deletebr', function(e) {
            e.preventDefault();
            var id_barange = $(this).attr('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data barang tersebut akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FD2D9E',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    console.log(id_barange);
                    $.ajax({
                        url: '<?= base_url('barang/hapusbarangnya'); ?>',
                        data: 'id_barange=' + id_barange,
                        type: 'post',
                        dataType: 'json',
                        success: function(data) {
                            barangtable.draw();
                        }
                    });

                    Swal.fire(
                        'Data Barang',
                        'tersebut berhasil dihapus!',
                        'success'
                    )
                }
            })
        });
        $('#btnbatalubahbarang1').click(function() {
            $('#ubahbarcode').attr('readonly', true);
            $("#formubahbarang")[0].reset();
            $('#formubahbarang').find('.text-danger').remove();
        });
        $('#btnbatalubahbarang2').click(function() {
            $('#ubahbarcode').attr('readonly', true);
            $("#formubahbarang")[0].reset();
            $('#formubahbarang').find('.text-danger').remove();
        });
    });
</script>