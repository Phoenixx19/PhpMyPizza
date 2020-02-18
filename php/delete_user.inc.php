<?php 
    require('./connect.inc.php');
    if (is_numeric($_POST['user']) == true) {
        $sql = "DELETE FROM users WHERE id=".$_POST['user'];
        $result=$conn->query($sql);
        echo "<script>window.location.href = '../users/';</script>";
    } else {
        echo "<script>window.location.href = '../errors/db.php';</script>";
    }
?>