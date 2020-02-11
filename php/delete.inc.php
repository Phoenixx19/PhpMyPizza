<?php
require('connect.inc.php');//orderdel
$id = $_POST['id'];
$sql = 'DELETE FROM orders WHERE id='.$id;

if ($conn->query($sql)) {
    header('Location: ../serve.php');
}
else
    header('Location: ../errors/db.php');
$conn->close();
