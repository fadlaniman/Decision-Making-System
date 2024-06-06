<?php include '../model/connection.php';

$result = $con->query('SELECT * FROM alternatif');
$data = $result->fetch_all();
