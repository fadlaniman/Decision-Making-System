<?php include '../../model/connection.php';
$id = $_GET['id'];
try {

    $result = $con->query("DELETE FROM criteria WHERE id='$id'");
    header('location: http://localhost/spk/views/kriteria.php');
} catch (Exception $e) {
    header('location: http://localhost/spk/views/kriteria.php');
}
