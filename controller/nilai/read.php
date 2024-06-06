<?php include '../model/connection.php';
$result = $con->query('SELECT nilai.id, nilai.nilai, criteria.id, criteria.nama, alternatif.id, alternatif.nama, criteria.jenis FROM nilai
INNER JOIN criteria ON nilai.criteria_id=criteria.id INNER JOIN alternatif ON nilai.alternatif_id=alternatif.id ORDER BY alternatif.nama, criteria.nama');
$kriteria = $con->query('SELECT id, nama, jenis, bobot FROM criteria')->fetch_all();
$alternatif = $con->query('SELECT id, nama FROM alternatif')->fetch_all();
$data = $result->fetch_all();
