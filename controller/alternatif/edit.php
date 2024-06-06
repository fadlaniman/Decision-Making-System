<?php include '../../model/connection.php';
$id = $_GET['id'];
$nama = $_POST['nama'];

try {
    $result = $con->query("UPDATE alternatif
    SET nama = '$nama'
    WHERE id = '$id'");
    header('location: http://localhost/spk/views/alternatif.php');
} catch (Exception $e) {
    return $e;
}
