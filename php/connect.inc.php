<?php
$ini = file_get_contents("../config.ini", true);
$array = parse_ini_string($ini, true);

$servername = $array['CONFIG']['hostname'];
$dBUsername = $array['CONFIG']['user'];
$dBPassword = $array['CONFIG']['password'];
$dBName = $array['CONFIG']['dbname'];

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn)
	header('Location: ../errors/db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>