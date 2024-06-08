<?php include '../../model/connection.php';
$nilai = $_POST['nilai'];
$kriteria = $_POST['kriteria'];
$alternatif = $_POST['alternatif'];
try {
    foreach ($kriteria as $index => $k) {
        $con->query("INSERT INTO nilai (nilai, criteria_id, alternatif_id) VALUES ('$nilai[$index]', '$k', '$alternatif')");
    }
    header('location: http://localhost/spk/views/nilai.php');
} catch (Exception $e) {
    header('location: http://localhost/spk/views/nilai.php');
}
