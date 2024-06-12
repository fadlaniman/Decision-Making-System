<?php include '../index.php' ?>
<?php include '../controller/kriteria/read.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include '../views/layout/navbar.php' ?>
        <?php include '../views/layout/sidebar.php' ?>
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
                                <li class="breadcrumb-item"><a href="#">Kriteria</a></li>
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
                                    <h3 class="card-title">Data Kriteria</h3>
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Create</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">ID</th>
                                                <th style="width: 20%;">Nama</th>
                                                <th style="width: 35%;">Keterangan</th>
                                                <th style="width: 10%;">Bobot</th>
                                                <th style="width: 10%;">Jenis</th>
                                                <th style="width: 20%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $index = 1;
                                            foreach ($data as $dt) {
                                                echo '<tr>';
                                                echo '<td>' . $index++ . '</td>';
                                                echo '<td>' . $dt[1] . '</td>';
                                                echo '<td>' . $dt[2] . '</td>';
                                                echo '<td>' . $dt[3] / 10 . '</td>';
                                                echo '<td>' . $dt[4] . '</td>';
                                                echo '<td>';
                                                echo '<a href="http://localhost/spk/controller/nilai/edit.php?id=' . $dt[0] . '" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal' . $dt[0] . '">Edit</a> ';
                                                echo '<a href="http://localhost/spk/controller/kriteria/delete.php?id=' . $dt[0] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\');">Delete</a>';
                                                echo '</td>';
                                                echo '</tr>';
                                            } ?>
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
                            <form action="http://localhost/spk/controller/kriteria/create.php" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="bobot">Bobot</label>
                                        <input type="number" class="form-control" id="bobot" name="bobot" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="bobot">Jenis</label>
                                        <select class="form-control" id="jenis" name="jenis" required>
                                            <option value="">Pilih Jenis</option>
                                            <option value="cost">cost</option>
                                            <option value="benefit">benefit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                foreach ($data as $dt) {
                    echo '<div class="modal fade" id="editModal' . $dt[0] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">;
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Edit Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>;
                    <form action="http://localhost/spk/controller/kriteria/edit.php?id=' . $dt[0] . '" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="' . $dt[1] . '" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>' . $dt[2] . '</textarea>
                                </div>
                                    <div class="form-group">
                                        <label for="bobot">Bobot</label>
                                        <input type="text" class="form-control" id="bobot" name="bobot" value="' . $dt[3] . '" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="bobot">Jenis</label>
                                    <select class="form-control" id="jenis" name="jenis" required>
                                        <option value="' . $dt[4] . '" selected>' . $dt[4] . '</option>
                                        <option value="cost">cost</option>
                                        <option value="benefit">benefit</option>
                                    </select>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>';
                } ?>
            </section>
            <!-- /.content -->
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <div>
            <?php include '../views/layout/footer.php' ?>
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