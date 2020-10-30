<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Jastipku <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin anda mau keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" untuk keluar dari sesi ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="buton buton-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/swl/sweetalert2.all.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/myscript.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>
<!-- script tampil customer dengan datatables-->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "columns": [null,
                null,
                null,
                null, {
                    "orderable": false
                }
            ],
            "language": {
                "infoEmpty": "Data tidak ditemukan",
                "lengthMenu": "Tampil _MENU_ Data Per Halaman",
                "zeroRecords": "Maaf Data Tidak Ditemukan",
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
</script>


<!-- script batal tambah dan ubah data customer dikosongkan-->
<script type="text/javascript">
    //Script khusus Data Customer
    $(document).ready(function() {
        $("#btnbataltambah1").click(function() {
            /* Single line Reset function executes on click of Reset Button */
            $("#formtambahcustomer")[0].reset();
        });
        $("#btnbataltambah2").click(function() {
            /* Single line Reset function executes on click of Reset Button */
            $("#formtambahcustomer")[0].reset();
        });
    });
    //Flash data berhasil tambah data customer
    const msg = $('.flashdatamsg').data('message');
    if (msg) {
        Swal.fire(
            'Data Customer',
            msg,
            'success'
        )
    }
    //Hapus data customer
    $('.tombol-hapuscustomer').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data customer tersebut akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FD2D9E',
            cancelButtonColor: '#858796',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });

    //ubah data customer
    function submit(data) {
        console.log(data);
        $.ajax({
            type: "POST",
            data: 'id_telp=' + data,
            url: '<?= base_url() . "customer/ambilubahcs" ?>',
            dataType: 'json',
            success: function(hasil) {
                console.log(hasil);
                $('[name=id]').val(hasil.id);
                $('[name=ubahnohp]').val(hasil.id_telp);
                $('[name=ubahnama]').val(hasil.nama);
                $('[name=ubahalamat]').val(hasil.alamat);
            }
        });
    }

    //jika tombol ubah data customer di klik
    $('#formubahcustomer').submit(function(e) {
        e.preventDefault();
        var me = $(this);

        $.ajax({
            url: '<?= base_url() . "customer/ubahdata" ?>',
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.success == true) {
                    var kata = 'Berhasil Diubah';
                    $.ajax({
                        url: '<?= base_url() . "customer/pindahubahdata" ?>',
                        type: 'post',
                        data: 'kata=' + kata,
                        dataType: 'json',
                        success: function(hasil) {
                            document.location.href = '<?= base_url("customer"); ?>';
                        }

                    });
                } else {
                    $.each(data.message, function(key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-ubah')
                            .find('.text-danger').remove().find('.fas fa-exclamation-circle').remove();
                        element.after(value);
                    });
                }

            }
        });
    });

    //button batal ubah ditekan
    $("#btnbatalubahcs1").click(function() {
        /* Single line Reset function executes on click of Reset Button */
        $('#formubahcustomer').find('.text-danger').remove().find('.fas fa-exclamation-circle').remove();
    });
    $("#btnbatalubahcs2").click(function() {
        /* Single line Reset function executes on click of Reset Button */
        $('#formubahcustomer').find('.text-danger').remove().find('.fas fa-exclamation-circle').remove();
    });
</script>
</body>

</html>