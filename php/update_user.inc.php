<?php
    require('./connect.inc.php');
    $id = $_POST['id'];

    $sqlcheck = "SELECT * FROM users WHERE id=".$_POST['id'];
    $resultcheck = $conn->query($sqlcheck); $sql = "";
    if ($resultcheck->num_rows > 0) {
        while ($rowcheck = $resultcheck->fetch_assoc()) {
            //level check and set
            if($rowcheck['level'] === $_POST['level']) {
                $sql .= "";
            } else {
                $sql .= "UPDATE `my_gf0`.`users` SET `level` = '".$_POST['level']."' WHERE `users`.`id` = ".$id."; ";
            }

            //name check and set
            if($rowcheck['name'] === $_POST['usrname']) {
                $sql .="";
            } else {
                $sql .= "UPDATE `my_gf0`.`users` SET `name` = '".$_POST['usrname']."' WHERE `users`.`id` = ".$id."; ";
            }

            //surname check and set
            if($rowcheck['surname'] === $_POST['usrsurname']) {
                $sql .= "";
            } else {
                $sql .= "UPDATE `my_gf0`.`users` SET `surname` = '".$_POST['usrsurname']."' WHERE `users`.`id` = ".$id."; ";
            }

            //username check and set
            if($rowcheck['username'] === $_POST['usrusername']) {
                $sql .= "";
            } else {
                $sql .= "UPDATE `my_gf0`.`users` SET `username` = '".$_POST['usrusername']."' WHERE `users`.`id` = ".$id."; ";
            }

            //password mess
            if ($_POST['usrpassword'] == NULL) {
                $sql .= "";
            } else {
                $password = md5($_POST['usrpassword']);
                if ($rowcheck['psw'] == $password) {
                    $sql .= "";
                } else {
                    $sql .= "UPDATE `my_gf0`.`users` SET `psw` = '".$password."' WHERE `users`.`id` = ".$id."; ";
                }
            }
        }
    }

    $result = $conn->multi_query($sql);
    echo '<head><meta http-equiv="refresh" content="0;url='.$_POST["r_url"].'"></head>';
?>