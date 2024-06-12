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
                                <li class="breadcrumb-item"><a href="#">Peringkat</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container py-3">
                        <h5>Hasil Akhir</h5>
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
                                    foreach ($alternatif as $a) {
                                        foreach ($data as $row) {
                                            if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                                $normalizedValues[$a[0]][$k[0]] = $row[1] / sqrt($sum);
                                            }
                                        }
                                    }
                                }

                                // Step 2: Multiply by the criteria weights
                                $weightedMatrix = [];
                                foreach ($alternatif as $a) {
                                    foreach ($kriteria as $k) {
                                        $weightedMatrix[$a[0]][$k[0]] = isset($normalizedValues[$a[0]][$k[0]]) ? $normalizedValues[$a[0]][$k[0]] * ($k[3] / 10) : null;
                                    }
                                }

                                // Step 3: Determine the ideal and negative-ideal solutions
                                foreach ($kriteria as $k) {
                                    $column = array_filter(array_column($weightedMatrix, $k[0]), fn ($value) => !is_null($value)); // Remove null values
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
                                    $hasValue = false;
                                    foreach ($kriteria as $k) {
                                        if (isset($weightedMatrix[$a[0]][$k[0]]) && !is_null($weightedMatrix[$a[0]][$k[0]])) {
                                            $sumIdeal += ($weightedMatrix[$a[0]][$k[0]] - $idealSolution[$k[0]]) ** 2;
                                            $sumNegativeIdeal += ($weightedMatrix[$a[0]][$k[0]] - $negativeIdealSolution[$k[0]]) ** 2;
                                            $hasValue = true;
                                        }
                                    }
                                    if ($hasValue) {
                                        $separationFromIdeal[$a[0]] = sqrt($sumIdeal);
                                        $separationFromNegativeIdeal[$a[0]] = sqrt($sumNegativeIdeal);
                                    } else {
                                        $separationFromIdeal[$a[0]] = null;
                                        $separationFromNegativeIdeal[$a[0]] = null;
                                    }
                                }

                                // Calculate preference values and prepare for ranking
                                $preferenceValues = [];
                                foreach ($alternatif as $a) {
                                    if (isset($separationFromIdeal[$a[0]]) && !is_null($separationFromIdeal[$a[0]])) {
                                        $preferenceValues[$a[0]] = $separationFromNegativeIdeal[$a[0]] / ($separationFromIdeal[$a[0]] + $separationFromNegativeIdeal[$a[0]]);
                                    } else {
                                        $preferenceValues[$a[0]] = null;
                                    }
                                }

                                // Sort alternatives by preference value
                                arsort($preferenceValues);

                                // Assign ranks
                                $rank = 1;
                                $previousValue = null;
                                $ranking = [];
                                foreach ($preferenceValues as $altId => $value) {
                                    if ($value !== $previousValue) {
                                        $previousValue = $value;
                                        $ranking[$altId] = $rank;
                                    } else {
                                        $ranking[$altId] = $rank - 1;
                                    }
                                    $rank++;
                                }
                                // Display the results with ranking
                                $index = 1;
                                echo '<tr>';
                                echo '<th>No</th>';
                                echo '<th>Alternatif</th>';
                                echo '<th>Nilai</th>';
                                echo '<th>Keterangan</th>';
                                echo '</tr>';
                                foreach ($alternatif as $a) {
                                    if (isset($separationFromIdeal[$a[0]]) && !is_null($separationFromIdeal[$a[0]])) {
                                        $sumPreference = $separationFromNegativeIdeal[$a[0]] / ($separationFromIdeal[$a[0]] + $separationFromNegativeIdeal[$a[0]]);
                                        echo '<tr>';
                                        echo '<td>' . $index++ . '</td>';
                                        echo '<td>' . $a[1] . '</td>';
                                        echo '<td>' . $sumPreference . '</td>';
                                        echo '<td>' . 'Peringkat Ke-' .   $ranking[$a[0]] . '</td>'; // Rank
                                        echo '</tr>';
                                    } else {
                                        echo '<tr>';
                                        echo '<td>' . $index++ . '</td>';
                                        echo '<td>' . $a[1] . '</td>';
                                        echo '<td></td>';
                                        echo '<td></td>';
                                        echo '</tr>';
                                    }
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