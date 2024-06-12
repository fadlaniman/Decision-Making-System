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
                                <li class="breadcrumb-item"><a href="#">Ideal</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container py-3">
                        <h5>Nilai Solusi Ideal</h5>
                        <table id="example2" class="table table-bordered table-hover bg-white">
                            <tbody>
                                <?php
                                // Initialize arrays to store the ideal and negative-ideal solutions
                                $idealSolution = [];
                                $negativeIdealSolution = [];

                                // Initialize arrays to store the normalized values for all alternatives
                                $normalizedValues = [];

                                // Iterate over each alternative
                                foreach ($alternatif as $a) {
                                    $normalizedValues[$a[0]] = [];
                                    foreach ($kriteria as $k) {
                                        $value = 0;
                                        $score = 0;
                                        $bobot = $k[3] / 10;  // Assuming $k[3] contains the weight of the criterion

                                        // Calculate the sum of squares for the normalization
                                        foreach ($data as $row) {
                                            if ($row[2] == $k[0]) {
                                                $value += $row[1] ** 2;
                                            }
                                        }

                                        // Calculate the normalized score for the current alternative and criterion
                                        foreach ($data as $row) {
                                            if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                                $score = $row[1];
                                                $normalizedScore = $score / sqrt($value) * $bobot;
                                                $normalizedValues[$a[0]][$k[0]] = $normalizedScore;

                                                // Update ideal and negative-ideal solutions
                                                if ($k[2] == 'cost') {
                                                    if (!isset($idealSolution[$k[0]]) || $normalizedScore < $idealSolution[$k[0]]) {
                                                        $idealSolution[$k[0]] = $normalizedScore;
                                                    }
                                                    if (!isset($negativeIdealSolution[$k[0]]) || $normalizedScore > $negativeIdealSolution[$k[0]]) {
                                                        $negativeIdealSolution[$k[0]] = $normalizedScore;
                                                    }
                                                } else if ($k[2] == 'benefit') {
                                                    if (!isset($idealSolution[$k[0]]) || $normalizedScore > $idealSolution[$k[0]]) {
                                                        $idealSolution[$k[0]] = $normalizedScore;
                                                    }
                                                    if (!isset($negativeIdealSolution[$k[0]]) || $normalizedScore < $negativeIdealSolution[$k[0]]) {
                                                        $negativeIdealSolution[$k[0]] = $normalizedScore;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                                // Display the ideal solution
                                echo '<tr>';
                                echo '<th>' . 'A+' . '</th>';
                                foreach ($kriteria as $k) {
                                    echo '<td>' . (isset($idealSolution[$k[0]]) ? $idealSolution[$k[0]] : '') . '</td>';
                                }
                                echo '</tr>';

                                // Display the negative-ideal solution
                                echo '<tr>';
                                echo '<th>' . 'A-' . '</th>';
                                foreach ($kriteria as $k) {
                                    echo '<td>' . (isset($negativeIdealSolution[$k[0]]) ? $negativeIdealSolution[$k[0]] : '') . '</td>';
                                }
                                echo '</tr>';
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