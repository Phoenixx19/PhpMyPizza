<?php
    require('../resources/functions.php');
    $arrayconf = array(
        'CONFIG' => array(
            'site' => $_POST["site"],
            'hostname' => $_POST["hostname"],
            'user' => $_POST["user"],
            'password' => $_POST["password"],
            'dbname' => $_POST["dbname"]
        ),
        'INFO' => array(
            'name' => $_POST["name"],
            'ntables' => $_POST["ntables"],
            'tax' => $_POST["taxes"],
            'cover' => $_POST["cover"]
        ),
        'LANG' => array(
            'language' => $_POST["lang"]
        ),
        'LOOKNFEEL' => array(
            'theme' => $_POST["style"]
        )
    );
    /*
     print_r($arrayconf);
     if (file_exists('../config.ini'))
        echo "esiste<br><br>";
     $ini = file_get_contents("../config.ini", true);
        $array = parse_ini_string($ini, true);
        var_dump($array);
        //print_r($array);
    */
    write_php_ini($arrayconf, '../config.ini');

    // echo '<body>
    //     <br>
    //     <div class="container-fluid">
    //         <div class="alert alert-success alert-dismissible fade show" role="alert">
    //             <strong>It worked!</strong> You will get redirected now.
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //             <span aria-hidden="true">&times;</span>
    //             </button>
    //         </div>
    //     </div>
    // </body>';

    echo '<head><meta http-equiv="refresh" content="0;url='.$_POST["redirect_url"].'"></head>';
?>
