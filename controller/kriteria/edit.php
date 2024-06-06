<?php include '../../model/connection.php';
$id = $_GET['id'];
$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];
$bobot = $_POST['bobot'];
$jenis = $_POST['jenis'];

try {
    $result = $con->query("UPDATE criteria
    SET nama = '$nama', keterangan = '$keterangan', bobot = '$bobot', jenis = '$jenis'
    WHERE id = '$id'");
    header('location: http://localhost/spk/views/kriteria.php');
} catch (Exception $e) {
    $_SESSION['message'] = 'Data sudah ada';
    header('location: http://localhost/spk/views/kriteria.php');
}
