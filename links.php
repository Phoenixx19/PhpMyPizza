<head>
    <?php
        $ini = file_get_contents("./config.ini", true);
        $array = parse_ini_string($ini, true);
        //var_dump($array);
        //print_r($array);

        $servername = $array['CONFIG']['hostname'];
        $dBUsername = $array['CONFIG']['user'];
        $dBPassword = $array['CONFIG']['password'];
        $dBName = $array['CONFIG']['dbname'];

        $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

        echo '<link rel="icon" href="'.$array['CONFIG']['site'].'resources/phpmypizza.ico" type="image/x-icon">';
        echo '<title>'.$array['INFO']['name'].'</title>';

        $lang = ($array['LANG']['language']);
        if ($lang != "EN" && $lang != "IT") {
            $lang = "EN";
        }

        $inilang = file_get_contents("./resources/translations.ini", true);
        $arraylang = parse_ini_string($inilang, true);
        //var_dump($arraylang);

        require('resources/functions.php');
        $theme = theme($array['LOOKNFEEL']['theme']);

        if (isset($_COOKIE['logged-id'])) {
            $cookie = "SELECT `level` FROM `users` WHERE id=".$_COOKIE['logged-id'];
            $rescookie = $conn->query($cookie);
            if ($rescookie->num_rows == 1) {
                $check = true;
                while ($rowcookie = $rescookie->fetch_assoc()) {
                    $level = $rowcookie['level'];
                }
            }
        } else {
            $check = false;
            $level = 5;
        }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/d2ea588ed1.js" crossorigin="anonymous"></script>

    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        function pop_up(url){
            window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=no,width=480,height=670,directories=no,location=no')
        }
    </script>

    <!-- flags-icons-css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css">

    <!-- animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Nunito&display=swap');

        body {
            word-wrap: break-word;
            font-family: 'Nunito', sans-serif;
        }

        button, [type="button"], [type="reset"], [type="submit"] {
            -webkit-appearance: none;
        }

        .full-height {
        height: 100%;
        }

        form {
            margin-block-end: 0;
        }

        h3 {
            margin: 0;
        }

        h4 {
            margin-bottom: 1rem;
        }

        p {
            margin-bottom: 0.75rem;
        }

        hr {
            margin-top: 2.5rem;
            margin-bottom: 2.5rem;
        }

        table {
            margin-bottom: 0!important;
        }

        .p-3 {
            padding: 0!important;
        }

        .mb-5 {
            margin-bottom: 1.5rem!important;
        }

        .modal-body {
            padding-top: 0;
            padding-bottom: 0;
        }

        .default-grad {
            width: 75%;
            height: 0;
            padding:37.5% 0;
            margin: 0.5rem;
            background: linear-gradient(to top right, #ffffff 20%, #28a745 80%);
        }

        .blue-grad {
            width: 75%;
            height: 0;
            padding:37.5% 0;
            margin: 0.5rem;
            background: linear-gradient(to top right, #ffffff 20%, #007bff 80%);
        }
        .yellow-grad {
            width: 75%;
            height: 0;
            padding:37.5% 0;
            margin: 0.5rem;
            background: linear-gradient(to top right, #ffffff 20%, #ffc107 80%);
        }
        .dark-grad {
            width: 75%;
            height: 0;
            padding:37.5% 0;
            margin: 0.5rem;
            background: linear-gradient(to top right, #343a40 20%, #28a745 80%);
        }

        .sticky-top {
            top: 1rem;
        }

        .jumbotron {
            margin-left: 1rem;
            margin-right: 1rem;
            padding-top: 2rem;
            padding-right: 3rem;
            padding-bottom: 2rem;
            padding-left: 3rem;
        }

        body.modal-open .background-container{
        -webkit-filter: blur(4px);
        -moz-filter: blur(4px);
        -o-filter: blur(4px);
        -ms-filter: blur(4px);
        filter: blur(4px);
        filter: url("https://gist.githubusercontent.com/amitabhaghosh197/b7865b409e835b5a43b5/raw/1a255b551091924971e7dee8935fd38a7fdf7311/blur".svg#blur);
        filter:progid:DXImageTransform.Microsoft.Blur(PixelRadius='4');
        }

        .settings::-webkit-scrollbar {
          width: 0.8rem;
        }

        .settings::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .settings::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 15px;
        }

        .settings::-webkit-scrollbar-thumb:hover {
            background: #888;
            border-radius: 15px;
        }

        .settings::-webkit-scrollbar-thumb:active {
            background: #555;
            border-radius: 15px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #f5f5f5;
        }
    </style>

    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand background-container" href="../" title="<?php echo $arraylang[$lang]['home']; ?>">
            <img src="../resources/phpmypizza.ico" width="30" height="30" class="d-inline-block align-top" alt="">
            <?php echo ($array['INFO']['name']); ?>
        </a>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 background-container">
            <?php if(isset($_COOKIE['logged-id'])) {
                echo '<li class="nav-item'; if(basename($_SERVER['PHP_SELF']) == 'control.php'){echo 'active';} echo '">
                    <a class="nav-link" href="../control/" style="padding-left: 12; padding-right: 12;">
                        <i class="fas fa-tasks"></i>&nbsp;&nbsp;'.$arraylang[$lang]['control'].'
                    </a>
                </li>
                <li class="nav-item'; if(basename($_SERVER['PHP_SELF']) == 'bill.php'){echo 'active';} echo'">
                    <a class="nav-link" href="../bill/" style="padding-left: 12; padding-right: 12;">
                        <i class="fas fa-file-invoice-dollar"></i>&nbsp;&nbsp;'.$arraylang[$lang]['bill'].'
                    </a>
                </li>';
                }
                if ($level==0) {
                echo '
                <li class="nav-item '; if(basename($_SERVER['PHP_SELF']) == 'users.php'){echo 'active';} echo '">
                    <a class="nav-link" href="../users/" style="padding-left: 12; padding-right: 12;">
                        <i class="fas fa-user-tag"></i>&nbsp;'.$arraylang[$lang]['users'].'
                    </a>
                </li>';
                    }
                ?>
                <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'menu.php'){echo 'active';} ?>">
                    <a class="nav-link" href="/menu"><i class="fas fa-book-open"></i>&nbsp;Menu</a>
                </li>
                <?php if(isset($_COOKIE['logged-id'])) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="" onclick="pop_up(\'../serve/\');" style="padding-left: 12; padding-right: 12;">
                        <i class="fas fa-utensils"></i>&nbsp;&nbsp;'.$arraylang[$lang]['serve'].'
                        </a>
                    </li>';
                }
                if ($level == 0 || $level == 1) {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="../settings/" data-toggle="modal" data-target="#settings">
                            <i class="fas fa-wrench"></i>&nbsp;&nbsp;'.$arraylang[$lang]['settings'].'
                        </a>
                    </li>';
                }
                ?>
            </ul>
        </div>

        <div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="settings" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content shadow p-3 mb-5" style="border: none;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $arraylang[$lang]['settings']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../php/save.inc.php" method="post">
                    <input type="text" name="redirect_url" value="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" style="display: none;">
                    <div class="modal-body break-text settings" style="max-height: calc(100vh - 300px); overflow-y: auto;">
                    <div class="row">
                    <div class="col-sm-4">
                        <nav class="navbar sticky-top navbar-light bg-light" id="navbar-left" style="margin-top: 1rem; border-radius: 0.3rem;">
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link font-weight-bold text-<?php echo $theme; ?>" href="#appearance"><?php echo ($arraylang[$lang]['appearance']); ?>&nbsp;&nbsp;<i class="fas fa-swatchbook"></i></a>
                                <nav class="nav nav-pills flex-column">
                                    <a class="nav-link text-<?php echo $theme; ?> ml-4" href="#title-lang"><?php echo ($arraylang[$lang]['lang']); ?></a>
                                    <a class="nav-link text-<?php echo $theme; ?> ml-4" href="#title-theme"><?php echo ($arraylang[$lang]['theme']); ?></a>
                                </nav>
                                <a class="nav-link font-weight-bold text-<?php echo $theme; ?>" href="#config"><?php echo $arraylang[$lang]['config']; ?>&nbsp;&nbsp;<i class="fas fa-cog"></i></a>
                                <nav class="nav nav-pills flex-column">
                                    <a class="nav-link text-<?php echo $theme; ?> ml-4" href="#title-name"><?php echo $arraylang[$lang]['name']; ?></a>
                                    <a class="nav-link text-<?php echo $theme; ?> ml-4" href="#title-info"><?php echo $arraylang[$lang]['info']; ?></a>
                                    <a class="nav-link text-<?php echo $theme; ?> ml-4" href="#title-taxes"><?php echo $arraylang[$lang]['taxes']; ?></a>
                                </nav>
                                <a class="nav-link font-weight-bold text-<?php echo $theme; ?>" href="#advanced"><?php echo $arraylang[$lang]['advanced']; ?>&nbsp;&nbsp;<i class="fas fa-toolbox"></i></a>
                                <nav class="nav nav-pills flex-column">
                                    <a class="nav-link text-<?php echo $theme; ?> ml-4" href="#title-site"><?php echo $arraylang[$lang]['site']; ?></a>
                                    <a class="nav-link text-<?php echo $theme; ?> ml-4" href="#title-dbcfg"><?php echo $arraylang[$lang]['dbcfg']; ?></a>
                                </nav>
                            </nav>
                        </nav>
                    </div>
                    <div class="col-sm-8" style="overflow-y: auto; padding-left: 7.5px; padding-right: 22.5px;">
                        <a id="top"></a>
                        <div data-spy="scroll" data-target="#navbar-left" data-offset="0">
                                <br>
                                <!-- section 1: appearance -->
                                <h4 id="appearance"><?php echo ($arraylang[$lang]['appearance']); ?></h4>
                                <!-- language -->
                                <h5 id="title-lang"><?php echo ($arraylang[$lang]['lang']); ?></h5>
                                <p for="title-lang"><?php echo ($arraylang[$lang]['textlang']); ?></p>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="lang" id="english" value="EN" <?php if ($lang=="EN") echo "checked"; ?>>
                                        <label class="custom-control-label" for="english"><span class="flag-icon flag-icon-gb"></span>&nbsp;English (en-gb)</label>
                                    </input>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" name="lang" id="italian" value="IT" <?php if ($lang=="IT") echo "checked"; ?>>
                                        <label class="custom-control-label" for="italian"><span class="flag-icon flag-icon-it"></span>&nbsp;Italian (it-it)</label>
                                    </input>
                                </div>
                                <br>

                                <!-- theme -->
                                <h5 id="title-theme"><?php echo ($arraylang[$lang]['theme']); ?></h5>
                                <p for="title-theme"><?php echo ($arraylang[$lang]['texttheme']); ?></p>
                                <?php $theme = $array['LOOKNFEEL']['theme']; ?>
                                <div class="row">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%; margin-top: 0.25rem;">
                                        <div class="col-md-3">
                                            <!-- buttons should be label maybe -->
                                            <button type="button" class="btn btn-outline-success <?php if ($theme=="default") echo "active"; ?>" style="width: 100%">
                                                <div class="default-grad rounded-circle mx-auto d-block"></div>
                                                Default
                                                <input type="radio" name="style" id="default" value="default" autocomplete="off"
                                                <?php if ($theme=="default") echo "checked"; ?> hidden>
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-outline-primary <?php if ($theme=="blue") echo "active"; ?>" style="width: 100%">
                                                <div class="blue-grad rounded-circle mx-auto d-block"></div>
                                                Blue
                                                <input type="radio" name="style" id="blue" value="blue" autocomplete="off"
                                                <?php if ($theme=="blue") echo "checked"; ?> hidden>
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-outline-warning <?php if ($theme=="yellow") echo "active"; ?>" style="width: 100%">
                                                <div class="yellow-grad rounded-circle mx-auto d-block"></div>
                                                Yellow
                                                <input type="radio" name="style" id="yellow" value="yellow" autocomplete="off"
                                                <?php if ($theme=="yellow") echo "checked"; ?> hidden>
                                            </button>
                                        </div>
                                        <!--
                                        <div class="col-md-3">
                                            <button class="btn btn-outline-dark <?php if ($theme=="dark") echo "active"; else echo "disabled"; ?>" style="width: 100%">
                                                <div class="dark-grad  rounded-circle mx-auto d-block disabled"></div>
                                                Dark
                                                <input type="radio" name="style" id="dark" value="dark" autocomplete="off"
                                                <php if ($theme=="dark") echo "checked"; else echo "disabled"; ?> hidden>
                                            </button>
                                        </div>
                                        -->
                                    </div>
                                </div>
                                <hr>

                                <!-- section 2: configurations -->
                                <h4 id="config"><?php echo $arraylang[$lang]['config']; ?></h4>
                                <h5 id="title-name"><?php echo $arraylang[$lang]['name']; ?></h5>
                                <p id="text-name"><?php echo $arraylang[$lang]['textname']; ?></p>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $array['INFO']['name']; ?>">
                                    </div>
                                </div>
                                <br>

                                <h5 id="title-info"><?php echo $arraylang[$lang]['info']; ?></h5>
                                <p id="text-info"><?php echo $arraylang[$lang]['textinfo']; ?></p>
                                <div class="row">
                                    <div class="col">
                                        <label for="#ntables"><?php echo $arraylang[$lang]['ntables']; ?></label>
                                        <input type="number" class="form-control" name="ntables" id="ntables" min="1" max="50" value="<?php echo $array['INFO']['ntables']; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="#cover"><?php echo $arraylang[$lang]['cover']; ?></label>
                                        <input type="number" class="form-control" name="cover" id="cover" value="<?php echo $array['INFO']['cover']; ?>" min="0" max="999">
                                    </div>
                                </div>
                                <br>

                                <h5 id="title-taxes"><?php echo $arraylang[$lang]['taxes']; ?></h5>
                                <p id="text-taxes"><?php echo $arraylang[$lang]['texttaxes']; ?></p>
                                <input type="number" class="form-control" name="taxes" id="taxes" value="<?php echo $array['INFO']['tax']; ?>" min="0" max="999">
                                <hr>

                                <!-- section 3: advanced -->
                                <h4 id="advanced"><?php echo $arraylang[$lang]['advanced']; ?></h4>
                                <h5 id="title-site"><?php echo $arraylang[$lang]['site']; ?></h5>
                                <p id="text-site"><?php echo $arraylang[$lang]['textsite']; ?></p>
                                <input type="text" class="form-control" placeholder="<?php echo $arraylang[$lang]['site']; ?>" name="site" id="site" value="<?php echo $array['CONFIG']['site']; ?>">
                                <br>

                                <h5 id="title-dbcfg"><?php echo $arraylang[$lang]['dbcfg']; ?></h5>
                                <p id="text-dbcfg"><?php echo $arraylang[$lang]['textdbcfg']; ?></p>
                                <h6><?php echo $arraylang[$lang]['hostdbname']; ?></h6>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="hostname" id="hostname" placeholder="Hostname" value="<?php echo $array['CONFIG']['hostname']; ?>">
                                    <input type="text" class="form-control" name="dbname" id="dbname" placeholder="Database name" value="<?php echo $array['CONFIG']['dbname']; ?>">
                                </div>
                                <br>
                                <h6><?php echo $arraylang[$lang]['userpwname']; ?></h6>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="user" id="user" placeholder="Username" value="<?php echo $array['CONFIG']['user']; ?>">
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $array['CONFIG']['password']; ?>">
                                </div>
                                <div class="offset-md-1" style="margin-top: 0.5rem;margin-bottom: 0.5rem;">
                                    <span class="text-muted"><?php echo $arraylang[$lang]['porttext']; ?></span>
                                </div>

                                <br>
                                <a class="text-<?php echo $theme; ?> text-decoration-none d-flex justify-content-center" href="#top"><?php echo $arraylang[$lang]['goup']; ?></a>
                                <br>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo $arraylang[$lang]['cancel']; ?></button>
                        <button type="submit" class="btn btn-success <?php if($level != 0){echo 'disabled';} ?>" style="text-decoration: none;"><?php echo $arraylang[$lang]['save']; ?></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="justify-content-between align-self-center background-container" style="display: flex; width: auto;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Attiva navigazione" style="margin: 0.2rem; margin-right: 0.3rem;">
                <span class="navbar-toggler-icon" style="height: 1em; width: 1em;"></span>
            </button>
            <?php
                if(isset($_COOKIE['logged-id'])) {
                    echo '<a class="btn btn-link text-danger text-decoration-none" href="../php/logout.inc.php" style="padding-left: 12; padding-right: 12;"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Logout</a>';
                }
            ?>
        </div>
    </nav>


