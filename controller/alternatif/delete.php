<?php include '../../model/connection.php';
$id = $_GET['id'];
try {
    $result = $con->query("DELETE FROM alternatif WHERE id='$id'");
    header('location: http://localhost/spk/views/alternatif.php');
} catch (Exception $e) {
    header('location: http://localhost/spk/views/alternatif.php');
}
