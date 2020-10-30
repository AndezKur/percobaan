<!-- Sidebar -->
<ul class="navbar-nav bg-gray-800 sidebar sidebar-dark accordion" id="accordionSidebar" style="transition: 0.3s;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon ">
            <img src="<?= base_url('assets/') ?>img/logo/logo3.png" style="width:30px">
        </div>
        <div class="sidebar-brand-text mx-3">Jastipku</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider mb-4">
    <!-- Query menu-->
    <?php
    $main_menu = $this->db->get('user_menu')->result_array();
    ?>
    <!--Looping menu -->
    <?php foreach ($main_menu as $main) : ?>
        <!--Query Sub Menu -->
        <?php
        $sub_menu = $this->db->get_where('user_sub_menu', ['menu_id' => $main['id']]);
        ?>
        <!--periksa apakah ada sub menu -->
        <?php if ($sub_menu->num_rows() > 0) : ?>
            <!-- Nav Item - Utilities Collapse Menu -->
            <?php if ($main['title'] == $menujdl) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link collapsed pt-1" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="<?= $main['icon']; ?>"></i>
                    <span><?= $main['title']; ?></span>
                </a>
                <?php
                if ($main['title'] == $menujdl) {
                    $showe = 'collapse show';
                } else {
                    $showe = 'collapse';
                }

                ?>
                <div id="collapseUtilities" class="<?= $showe; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"><?= $main['title']; ?> :</h6>
                        <?php foreach ($sub_menu->result_array() as $sub) : ?>
                            <?php if ($judul == $sub['title']) : ?>
                                <a class="collapse-item active" href="<?= $sub['url']; ?>"><i class="<?= $sub['icon'] ?>"> </i> <?= $sub['title']; ?></a>
                            <?php else : ?>
                                <a class="collapse-item " href="<?= $sub['url']; ?>"><i class="<?= $sub['icon'] ?>"></i> <?= $sub['title']; ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                </li>
            <?php else : ?>
                <?php if ($judul == $main['title']) : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link pt-1" href="<?= base_url($main['url']); ?>">
                        <i class="<?= $main['icon']; ?>"></i>
                        <span><?= $main['title']; ?></span></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <!-- Divider -->

            <hr class="sidebar-divider mt-2">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link pt-0" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

</ul>
<!-- End of Sidebar -->