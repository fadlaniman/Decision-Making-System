<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="/spk/views/assets/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SPK (TOPSIS)</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/spk/views/assets/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php session_start();
                                            echo $_SESSION['username'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="http://localhost/spk/views/home.php" class="nav-link <?php echo $current_page == 'home.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/spk/views/kriteria.php" class="nav-link <?php echo $current_page == 'kriteria.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Kriteria
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/spk/views/alternatif.php" class="nav-link <?php echo $current_page == 'alternatif.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Alternatif
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost/spk/views/nilai.php" class="nav-link <?php echo $current_page == 'nilai.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Nilai
                        </p>
                    </a>
                </li>
                <li class="nav-item <?php echo $current_page == 'home.php' || $current_page == 'kriteria.php' || $current_page == 'alternatif.php' || $current_page == 'nilai.php' ? '' : 'menu-open'; ?>">
                    <a href="#" class="nav-link <?php echo $current_page == 'home.php' || $current_page == 'kriteria.php' || $current_page == 'alternatif.php' || $current_page == 'nilai.php' ? '' : 'active'; ?>">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                            Perhitungan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="http://localhost/spk/views/perhitungan/data.php" class="nav-link <?php echo $current_page == 'data.php' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Nilai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/spk/views/perhitungan/normalisasi(R).php" class="nav-link <?php echo $current_page == 'normalisasi(R).php' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Normalisasi Matriks ('R)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/spk/views/perhitungan/normalisasi(Y).php" class="nav-link <?php echo $current_page == 'normalisasi(Y).php' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Normalisasi Matriks ('Y)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/spk/views/perhitungan/ideal.php" class="nav-link <?php echo $current_page == 'ideal.php' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nilai Solusi Ideal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/spk/views/perhitungan/solusi.php" class="nav-link <?php echo $current_page == 'solusi.php' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Solusi Ideal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/spk/views/perhitungan/preferensi.php" class="nav-link <?php echo $current_page == 'preferensi.php' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nilai Bobot Preferensi (V)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/spk/views/perhitungan/rank.php" class="nav-link <?php echo $current_page == 'rank.php' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peringkat</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="http://localhost/spk/controller/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>