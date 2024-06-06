<?php include '../../model/connection.php';
$id = $_GET['id'];
$result = $con->query("DELETE FROM nilai WHERE alternatif_id='$id'");
header('location: http://localhost/spk/views/nilai.php');
