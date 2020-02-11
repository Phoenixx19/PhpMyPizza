<?php

require('connect.inc.php');

$id = $_POST['id'];

$sql = 'INSERT INTO c_orders SELECT * FROM orders WHERE orders.id='.$id.';';
$sql.= 'DELETE FROM orders WHERE id='.$id.';';

if ($conn->multi_query($sql)) {
    header('Location: ../control/');
} else {
    header('Location: ../errors/db.php');
}

?>
