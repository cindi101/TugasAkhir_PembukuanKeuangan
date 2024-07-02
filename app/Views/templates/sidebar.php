<!-- Page Aside-->
<aside class="aside bg-white">

    <div class="simplebar-wrapper">
        <div data-pixr-simplebar>
            <div class="pb-6">
                <!-- Mobile Logo-->
                <div class="d-flex d-xl-none justify-content-between align-items-center border-bottom aside-header">
                    <a class="navbar-brand lh-1 border-0 m-0 d-flex align-items-center" href="<?= base_url() ?>">
                        <div class="d-flex align-items-center">
                            <span class="fw-black text-uppercase tracking-wide fs-6 lh-1">Pembukuan</span>
                        </div>
                    </a>
                    <i class="ri-close-circle-line ri-lg close-menu text-muted transition-all text-primary-hover me-4 cursor-pointer"></i>
                </div>
                <!-- / Mobile Logo-->

                <ul class="list-unstyled mb-6">

                    <!-- Dashboard Menu Section-->
                    <li class="menu-section mt-2">General</li>
                    <li class="menu-item">
                        <a class="d-flex align-items-center" href="<?= base_url('pages') ?>">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                    <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                    <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                    <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                    </rect>
                                    <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </span>
                            <span class="menu-link <?= $link == 'home' ? 'active' : '' ?>">
                                Dashboard
                                <span class="badge bg-success-faded text-success pb-1 ms-2 align-middle rounded-pill">Home</span>
                            </span>
                        </a>
                    </li>
                    <?php if (session('level') == 'admin gudang') { ?>
                        <li class="menu-item">
                            <a class="d-flex align-items-center" href="<?= base_url() ?>master/jenis_barang">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'jenis_barang' ? 'active' : '' ?>">
                                    Jenis Barang
                                </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center" href="<?= base_url() ?>master/kategori_barang">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'kategori_barang' ? 'active' : '' ?>">
                                    Kategori Barang
                                </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center" href="<?= base_url() ?>master/satuan_barang">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'satuan_barang' ? 'active' : '' ?>">
                                    Satuan Barang
                                </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center" href="<?= base_url() ?>master/user">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'user' ? 'active' : '' ?>">
                                    User
                                </span>
                            </a>
                        </li>
                        <!-- / Dashboard Menu Section-->
                    <?php } ?>

                    <!-- Pages Menu Section-->
                    <?php if (session('logged_in') != '') { ?>
                        <li class="menu-section mt-4">Master Data</li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center <?= $link == 'barang' ? 'active' : '' ?>" href="<?= base_url() ?>data/barang">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'barang' ? 'active' : '' ?>">
                                    Data Barang
                                </span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if (session('level') == 'admin toko') { ?>
                        <!-- Pages Menu Section-->
                        <li class="menu-section mt-4">Transaksi</li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center <?= $link == 'pengeluaran' ? 'active' : '' ?>" href="<?= base_url() ?>transaksi/pengeluaran">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'pengeluaran' ? 'active' : '' ?>">
                                    Pengeluaran
                                </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center <?= $link == 'penjualan' ? 'active' : '' ?>" href="<?= base_url() ?>transaksi/penjualan">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'penjualan' ? 'active' : '' ?>">
                                    Penjualan
                                    <!-- <span class="badge bg-success-faded text-success pb-1 ms-2 align-middle rounded-pill">beta</span> -->
                                </span></a>
                        </li>

                        <!-- Pages Menu Section-->
                        <li class="menu-section mt-4">Laporan</li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center <?= $link == 'pertanggal' ? 'active' : '' ?>" href="<?= base_url() ?>laporan/pertanggal">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'pertanggal' ? 'active' : '' ?>">
                                    Per Tanggal
                                </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="d-flex align-items-center <?= $link == 'perperiode' ? 'active' : '' ?>" href="<?= base_url() ?>laporan/perperiode">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-100">
                                        <rect fill-opacity=".5" fill="currentColor" x="3" y="3" width="7" height="7"></rect>
                                        <rect fill="currentColor" x="14" y="3" width="7" height="7"></rect>
                                        <rect fill-opacity=".5" fill="currentColor" x="14" y="14" width="7" height="7">
                                        </rect>
                                        <rect fill="currentColor" x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </span>
                                <span class="menu-link <?= $link == 'perperiode' ? 'active' : '' ?>">
                                    Per Periode
                                </span>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>

</aside> <!-- / Page Aside-->