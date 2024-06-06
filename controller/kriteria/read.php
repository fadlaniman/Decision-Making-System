<?php include '../model/connection.php';

$result = $con->query('SELECT * FROM criteria');
$data = $result->fetch_all();
