<?php include '../../model/connection.php';
$nilai = $_POST['nilai'];
$kriteria = $_POST['kriteria'];
$alternatif = $_POST['alternatif'];
try {
    foreach ($kriteria as $index => $k) {
        $result = $con->query("INSERT INTO nilai (nilai, criteria_id, alternatif_id) VALUES ('$nilai[$index]', '$k', '$alternatif')");
    }
    header('location: http://localhost/spk/views/nilai.php');
} catch (Exception $e) {
    $_SESSION['message'] = 'Data sudah ada';
    header('location: http://localhost/spk/views/nilai.php');
}
