<?php
$ini = file_get_contents("../config.ini", true);
$array = parse_ini_string($ini, true);

$servername = $array['CONFIG']['hostname'];
$dBUsername = $array['CONFIG']['user'];
$dBPassword = $array['CONFIG']['password'];
$dBName = $array['CONFIG']['dbname'];

$refid_user = 0;
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$table_number = $_POST['table_number'];
$edits = $_POST['edits'];

echo $name, $quantity, $table_number, $edits;

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

$sql = 'INSERT INTO orders(refid_user,refid_menu,quantity,table_number,edits) 
VALUES('.$refid_user.','.$name.','.$quantity.','.$table_number.',"'.$edits.'");';

if ($conn->query($sql))
    header('Location: ../serve/');
else
    header('Location: ../errors/db.php');
$conn->close();