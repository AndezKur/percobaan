<div class="container my-5">

    <!-- Outer Row -->
    <div class="row justify-content-center my-5">
        <div class="col-lg-4 my-4">
            <div class="card o-hidden border-0 shadow-lg my-auto">
                <div class="card-body p-1">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/') ?>img/logo/log1.png" class="mx-auto mb-2" style="width:100px;height:100 px;">
                                    <h1 class="h4 text-gray-900 mb-4">Jastipku</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>" autofocus>
                                        <div id="pesan"> </div>
                                        <?= form_error('username', '<small class="text-danger pl-3"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user password-form" id="password" name="password" placeholder="Password">
                                        <small class="pl-3"><input type="checkbox" class="checkbox-form"> Show Password</small>
                                        <br>
                                        <?= form_error('password', '<small class="text-danger pl-3"><i class="fas fa-exclamation-circle"></i> ', '</small>') ?>
                                    </div>

                                    <button type="submit" class="buton buton-primary buton-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>