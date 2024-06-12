<?php
include '../index.php';
include '../controller/nilai/read.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include '../views/layout/navbar.php'; ?>
        <?php include '../views/layout/sidebar.php'; ?>
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
                                <li class="breadcrumb-item"><a href="#">Nilai</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Nilai</h3>
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Create</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th style="width: 25%;">Alternatif</th>
                                                <?php
                                                $index = 1;
                                                foreach ($kriteria as $k) {
                                                    echo '<th style="width: ' . 50 / count($kriteria) . '%">' . $k[1] . '</th>';
                                                }
                                                ?>
                                                <th style="width: 20%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 1;
                                            foreach ($alternatif as $a) {
                                                $hasData = false;
                                                foreach ($kriteria as $k) {
                                                    foreach ($data as $row) {
                                                        if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                                            $hasData = true;
                                                            break 2; // Break out of both inner loops
                                                        }
                                                    }
                                                }
                                                if ($hasData) {
                                                    echo '<tr>';
                                                    echo '<td>' . $index++ . '</td>';
                                                    echo '<td>' . $a[1] . '</td>';
                                                    foreach ($kriteria as $k) {
                                                        $found = false;
                                                        foreach ($data as $row) {
                                                            if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                                                $found = true;
                                                                echo '<td>' . $row[1] . '</td>';
                                                                break;
                                                            }
                                                        }
                                                        if (!$found) {
                                                            echo '<td></td>';
                                                        }
                                                    }
                                                    echo '<td>';
                                                    echo '<a href="http://localhost/spk/controller/nilai/edit.php?id=' . $a[0] . '" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal' . $a[0] . '">Edit</a> ';
                                                    echo '<a href="http://localhost/spk/controller/nilai/delete.php?id=' . $a[0] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\');">Delete</a>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <!-- Modal for creating new data -->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Create New Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="http://localhost/spk/controller/nilai/create.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="bobot">Alternatif</label>
                                        <select class="form-control" id="alternatif" name="alternatif" required>
                                            <option value="">Pilih Alternatif</option>
                                            <?php
                                            foreach ($alternatif as $a) {
                                                echo "<option value='$a[0]'>$a[1]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                    $index = 1;
                                    foreach ($kriteria as $k) {
                                        echo '<div class="form-group">
                                            <label for="nilai' . $k[0] . '">C' . $index++ . '</label>
                                            <input type="number" class="form-control" name="kriteria[]" value="' . $k[0] . '" hidden>
                                            <input type="number" class="form-control" id="nilai' . $k[0] . '" name="nilai[]" step="0.1" required>
                                            </div>';
                                    }
                                    ?>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal for edit new data -->
                <?php
                foreach ($alternatif as $a) {
                    echo '<div class="modal fade" id="editModal' . $a[0] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="http://localhost/spk/controller/nilai/edit.php?id=' . $a[0] . '" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="alternatif">Alternatif</label>
                                <input type="text" class="form-control" value="' . $a[1] . '" readonly>
                                <input type="text" class="form-control" id="alternatif" name="alternatif" value="' . $a[0] . '" hidden>
                            </div>';
                    $index = 1;
                    foreach ($kriteria as $k) {
                        $value = null;
                        foreach ($data as $row) {
                            if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                $value = $row[1];
                                break;
                            }
                        }
                        echo '<div class="form-group">
                                    <label for="nilai' . $k[1] . '">C' . $index++ . '</label>
                                    <input type="number" class="form-control" name="kriteria[]" value="' . $k[0] . '" hidden>
                                    <input type="number" class="form-control" id="nilai' . $k[1] . '" name="nilai[]" value="' . $value . '" step="0.1" required>
                             </div>';
                    }

                    echo '<div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
                }
                ?>
            </section>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <div>
            <?php include '../views/layout/footer.php'; ?>
        </div>
        <!-- ./wrapper -->
    </div>

    <!-- jQuery -->
    <script src="assets/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/assets/dist/js/adminlte.min.js"></script>
</body>