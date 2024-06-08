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
                                <li class="breadcrumb-item"><a href="#">Normalisasi(R)</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container py-3">
                        <h5>Normalisasi Matriks ('R)</h5>
                        <table id="example2" class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <?php
                                    $index = 1;
                                    echo '<th></th>';
                                    foreach ($kriteria as $k) : ?>
                                        <th><?= 'C' . $index++ ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                foreach ($alternatif as $a) {
                                    echo '<tr>';
                                    echo '<td>' . 'A' . $index++ . '</td>';
                                    foreach ($kriteria as $k) {
                                        $value = 0;
                                        $score = 0;
                                        $found = false;
                                        foreach ($data as $row) {
                                            if ($row[2] == $k[0]) {
                                                $value += $row[1] ** 2;
                                            }
                                            if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                                $score += $row[1];
                                                $found = true;
                                            }
                                        }
                                        if (!$found) {
                                            echo '<td></td>';
                                        } else {
                                            echo '<td>' . $score / sqrt($value) . '</td>';
                                        }
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
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