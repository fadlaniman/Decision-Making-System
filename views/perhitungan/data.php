<?php
include '../../index.php';
include '../../controller/nilai/read.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include '../../views/layout/navbar.php' ?>
        <?php include '../../views/layout/sidebar.php' ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Home</li>
                                <li class="breadcrumb-item active">Perhitungan</li>
                                <li class="breadcrumb-item"><a href="#">Data</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container py-3">
                        <h5>Data Nilai Awal</h5>
                        <table id="example2" class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">No</th>
                                    <th rowspan="2" class="align-middle">Alternatif</th>
                                    <th colspan="<?= count($kriteria) ?>" class="text-center">Kriteria</th>
                                </tr>
                                <tr>
                                    <?php foreach ($kriteria as $k) : ?>
                                        <th style="width: <?= 70 / count($kriteria) ?>%;"><?= $k[1] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                foreach ($alternatif as $a) {
                                    echo '<tr>';
                                    echo '<td>' . $index++ . '</td>';
                                    echo '<td>' . $a[1] . '</td>';
                                    foreach ($kriteria as $k) {
                                        $found = false;
                                        foreach ($data as $row) {
                                            if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                                $found = true;
                                                break;
                                            }
                                        }
                                        if (!$found) {
                                            echo '<td></td>';
                                        } else {
                                            echo '<td>' . $row[1] . '</td>';
                                        }
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Bobot</th>
                                    <?php foreach ($kriteria as $k) {
                                        echo '<th>' . $k[3] / 10 . '</th>';
                                    } ?>
                                </tr>
                                <tr>
                                    <th colspan="2">Jenis</th>
                                    <?php foreach ($kriteria as $k) {
                                        echo '<th>' . $k[2] . '</th>';
                                    } ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <div>
            <?php include '../../views/layout/footer.php' ?>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="assets/assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="assets/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/assets/dist/js/demo.js"></script>
</body>