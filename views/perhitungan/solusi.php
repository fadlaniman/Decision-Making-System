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
                                <li class="breadcrumb-item"><a href="#">Jarak</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container py-3">
                        <h5>Jarak Solusi Ideal</h5>
                        <table id="example2" class="table table-bordered table-hover bg-white">
                            <tbody>
                                <?php
                                // Initialize arrays to store the ideal and negative-ideal solutions
                                $idealSolution = [];
                                $negativeIdealSolution = [];

                                // Initialize arrays to store the normalized values for all alternatives
                                $normalizedValues = [];

                                // Step 1: Normalize the decision matrix
                                foreach ($kriteria as $k) {
                                    $sum = 0;
                                    foreach ($data as $row) {
                                        if ($row[2] == $k[0]) {
                                            $sum += $row[1] ** 2;
                                        }
                                    }
                                    if ($sum > 0) {
                                        foreach ($alternatif as $a) {
                                            foreach ($data as $row) {
                                                if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                                    $normalizedValues[$a[0]][$k[0]] = $row[1] / sqrt($sum);
                                                }
                                            }
                                        }
                                    }
                                }

                                // Step 2: Multiply by the criteria weights
                                $weightedMatrix = [];
                                foreach ($alternatif as $a) {
                                    foreach ($kriteria as $k) {
                                        if (isset($normalizedValues[$a[0]][$k[0]])) {
                                            $weightedMatrix[$a[0]][$k[0]] = $normalizedValues[$a[0]][$k[0]] * ($k[3] / 10);
                                        }
                                    }
                                }

                                // Step 3: Determine the ideal and negative-ideal solutions
                                foreach ($kriteria as $k) {
                                    $column = array_column($weightedMatrix, $k[0]);
                                    if (!empty($column)) {
                                        if ($k[2] == 'benefit') {
                                            $idealSolution[$k[0]] = max($column);
                                            $negativeIdealSolution[$k[0]] = min($column);
                                        } else {
                                            $idealSolution[$k[0]] = min($column);
                                            $negativeIdealSolution[$k[0]] = max($column);
                                        }
                                    }
                                }

                                // Step 4: Calculate the separation measures
                                $separationFromIdeal = [];
                                $separationFromNegativeIdeal = [];
                                foreach ($alternatif as $a) {
                                    $sumIdeal = 0;
                                    $sumNegativeIdeal = 0;
                                    foreach ($kriteria as $k) {
                                        if (isset($weightedMatrix[$a[0]][$k[0]])) {
                                            $sumIdeal += ($weightedMatrix[$a[0]][$k[0]] - $idealSolution[$k[0]]) ** 2;
                                            $sumNegativeIdeal += ($weightedMatrix[$a[0]][$k[0]] - $negativeIdealSolution[$k[0]]) ** 2;
                                        }
                                    }
                                    if ($sumIdeal > 0) {
                                        $separationFromIdeal[$a[0]] = sqrt($sumIdeal);
                                    }
                                    if ($sumNegativeIdeal > 0) {
                                        $separationFromNegativeIdeal[$a[0]] = sqrt($sumNegativeIdeal);
                                    }
                                }

                                // Display the separation measures for each alternative
                                foreach ($alternatif as $a) {
                                    echo '<tr>';
                                    echo '<th>' . 'D+' . '</th>';
                                    echo '<td>' . (isset($separationFromIdeal[$a[0]]) ? $separationFromIdeal[$a[0]] : '') . '</td>';
                                    echo '<th>' . 'D-' . '</th>';
                                    echo '<td>' . (isset($separationFromNegativeIdeal[$a[0]]) ? $separationFromNegativeIdeal[$a[0]] : '') . '</td>';
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