<?php include '../../model/connection.php';
$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];
$bobot = $_POST['bobot'];
$jenis = $_POST['jenis'];

try {
    $result = $con->query("INSERT INTO criteria (nama, keterangan, bobot, jenis) VALUES ('$nama', '$keterangan', '$bobot', '$jenis')");
    header('location: http://localhost/spk/views/kriteria.php');
} catch (Exception $e) {
    $_SESSION['message'] = 'Data sudah ada';
    header('location: http://localhost/spk/views/kriteria.php');
}
