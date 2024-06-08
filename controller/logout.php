<?php
$_SESSION['username'] = null;
if ($_SESSION['username'] == null) {
    header('location: http://localhost/spk/views/login.php');
}
