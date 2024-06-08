<?php include '../../model/connection.php';
$id = $_GET['id'];
$nilai = $_POST['nilai'];
$kriteria = $_POST['kriteria'];
try {
    foreach ($kriteria as $index => $k) {
        $con->query("UPDATE nilai
    SET nilai = '$nilai[$index]'
    WHERE alternatif_id = '$id' AND criteria_id = '$k'");
    }
    header('location: http://localhost/spk/views/nilai.php');
} catch (Exception $e) {
    echo $e->getMessage();
}
