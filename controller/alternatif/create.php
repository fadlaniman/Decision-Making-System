<?php include '../../model/connection.php';
$nama = $_POST['nama'];

try {
    $result = $con->query("INSERT INTO alternatif (nama) VALUES ('$nama')");
    header('location: http://localhost/spk/views/alternatif.php');
} catch (Exception $e) {
    $_SESSION['message'] = 'Data sudah ada';
    header('location: http://localhost/spk/views/alternatif.php');
}
