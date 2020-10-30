<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->

    <div class="row mb-3">
        <div class="col-lg-4">
            <h3 class="mb-4 text-gray-800"><?= $judul; ?></h3>
            <div class="flashdatamsg" id="flashdatamsg" data-message="<?= $this->session->flashdata('message'); ?>"></div>
            <a href="" class="buton buton-primary" data-toggle="modal" data-target="#tambahcustomerModal"><i class="fas fa-plus"></i> Tambah Customer</a>
            <?= form_error('nohp', '<div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>', '</div>'); ?>
            <?= form_error('nama', '<div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>', '</div>'); ?>
            <?= form_error('alamat', '<div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>', '</div>'); ?>
            <?= form_error('provinsi', '<div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>', '</div>'); ?>
            <?= form_error('status', '<div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>', '</div>'); ?>
        </div>
    </div>
    <div class="card mb-3">
        <div class="table-responsive-xl table-bordered p-3 mb-0">
            <table class="table table-hover p-1" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="15%">No. Handphone</th>
                        <th scope="col" width="20%">Nama</th>
                        <th scope="col" width="50%">Alamat</th>
                        <th scope="col" width="10%">Aksi</th>
                    </tr>
                </thead>
                <?php $i = 1; ?>
                <?php foreach ($customer as $cm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $cm['id_telp']; ?></td>
                        <td><?= $cm['nama']; ?></td>
                        <td><?= $cm['alamat']; ?></td>
                        <td>
                            <a href="" class="btn btn-outline-info btn-sm" id="tmblubahdtcs" title="Ubah" data-toggle="modal" data-target="#ubahcustomerModal" onclick="submit('<?= $cm['id_telp']; ?>')"><i class="fas fa-pen"></i></a>
                            <a href="<?= base_url(); ?>customer/hapus/<?= $cm['id_telp']; ?>" class="btn btn-outline-danger btn-sm tombol-hapuscustomer" id="tmblhapusdtcs" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="tambahcustomerModal" tabindex="-1" role="dialog" aria-labelledby="tambahcustomerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahcustomerModal">Tambah Customer Baru</h5>
                <button type="button" id="btnbataltambah2" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer'); ?>" method="post" id="formtambahcustomer">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nohp"><strong>No. Handphone</strong></label>
                        <input type="text" class="form-control" id="nohp" name="nohp" placeholder="08xxxxxxxxxx" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama"><strong>Nama</strong></label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Customer">
                    </div>
                    <div class="form-group">
                        <label for="alamat"><strong>Alamat</strong></label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Alamat Lengkap"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnbataltambah1">Batal</button>
                    <button type="submit" id="tambahdatacustomer" class="buton buton-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ubahcustomerModal" tabindex="-1" role="dialog" aria-labelledby="ubahcustomerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahcustomerModal">Ubah Data Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnbatalubahcs1">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/ubahdata'); ?>" method="post" id="formubahcustomer">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group form-ubah">
                        <label for="ubahnohp"><strong>No. Handphone</strong></label>
                        <input type="text" class="form-control" id="ubahnohp" name="ubahnohp" placeholder="08xxxxxxxxxx" autocomplete="off">
                    </div>
                    <div class="form-group form-ubah">
                        <label for="ubahnama"><strong>Nama</strong></label>
                        <input type="text" class="form-control" id="ubahnama" name="ubahnama" placeholder="Nama Customer">
                    </div>
                    <div class="form-group form-ubah">
                        <label for="ubahalamat"><strong>Alamat</strong></label>
                        <textarea class="form-control" id="ubahalamat" name="ubahalamat" rows="2" placeholder="Alamat Lengkap"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnbatalubahcs2">Batal</button>
                    <button type="submit" id="ubahdatacustomer" class="buton buton-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>