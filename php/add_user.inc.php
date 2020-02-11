<?php
    require('./connect.inc.php');

    $usrname = $_POST['usrname'];
    $usrsurname = $_POST['usrsurname'];
    $usrusername = $_POST['usrusername'];
    $usrpassword = $_POST['usrpassword'];
    $usrcheck = $_POST['usrcheck'];
    $usrphoto = $_POST['usrphoto'];
    $usrlvl = $_POST['usrlvl'];

    // if these values are null the query does not work.
    if ($usrusername == NULL || $usrpassword == NULL || $usrlvl == NULL) {
        echo '<head><meta http-equiv="refresh" content="0;url=../errors/db.php"></head>';
        die();
    }
    
    // md5 encryption
    $usrpassword = md5($usrpassword);

    //random picture
    if ($usrcheck == true || $usrphoto == NULL) {
        $usrphoto = "https://picsum.photos/".rand(175, 400);
    }

    $sql = "INSERT INTO `my_gf0`.`users` (`id`, `name`, `surname`, `username`, `psw`, `photo_url`, `level`, `registered`)
            VALUES (NULL, '".$usrname."', '".$usrsurname."', '".$usrusername."', '".$usrpassword."', '".$usrphoto."', '".$usrlvl."', CURRENT_TIMESTAMP);";
    $result = $conn->query($sql);

    echo '<head><meta http-equiv="refresh" content="0;url='.$_POST["r_url"].'"></head>';
?>