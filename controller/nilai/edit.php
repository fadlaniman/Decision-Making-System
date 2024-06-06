<?php include '../../model/connection.php';
$id = $_GET['id'];
$nilai = $_POST['nilai'];
$kriteria = $_POST['kriteria'];
$alternatif = $_POST['alternatif'];
try {
    foreach ($kriteria as $index => $k) {
        $result = $con->query("UPDATE nilai
    SET nilai = '$nilai[$index]', criteria_id = '$k', alternatif_id = '$alternatif'
    WHERE alternatif_id = 'intval($id)'");
    }
    header('location: http://localhost/spk/views/nilai.php');
} catch (Exception $e) {
    $_SESSION['message'] = 'gagal';
    echo $e;
}
