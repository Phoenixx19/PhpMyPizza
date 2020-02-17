<!-- font awesome -->
<?php $_SERVER['version'] = "1.0.2alpha"; ?>
<script src="https://kit.fontawesome.com/d2ea588ed1.js" crossorigin="anonymous"></script>

<!-- bootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
    button, [type="button"], [type="reset"], [type="submit"] {
        -webkit-appearance: none;
    }

    label {
        margin-bottom: 0;
    }

    .default-grad {
        width: 75%;
        height: 0;
        padding:37.5% 0;
        margin: 0.5rem;
        background: linear-gradient(to top right, #f8f9fa 20%, #28a745 80%);
    }

    .blue-grad {
        width: 75%;
        height: 0;
        padding:37.5% 0;
        margin: 0.5rem;
        background: linear-gradient(to top right, #f8f9fa 20%, #007bff 80%);
    }

    .yellow-grad {
        width: 75%;
        height: 0;
        padding:37.5% 0;
        margin: 0.5rem;
        background: linear-gradient(to top right, #f8f9fa 20%, #ffc107 80%);
    }
</style>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- flags-icons-css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css">
<!-- animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

<?php
    //!-- file check --!//

    $file = "./config.ini";
    if (!file_exists($file)) {
        echo '
            <body class="h-100 bg-light text-center">
                <div class="container h-100 animated fadeIn fast">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="col-10 col-md-8 col-lg-6">
                            <img class="mb-4 animated fadeIn delay-1s" src="http://gf0.altervista.org/resources/phpmypizza.ico" alt="" width="72" height="72">
                                <h1>Welcome to PhpMyPizza</h1>
                                <!-- Form -->
                                <form class="form-example" action="./php/first_access.inc.php" method="post">
                                    <input type="text" name="site" value="http://'.$_SERVER['HTTP_HOST'].'" hidden>
                                    <div class="tab-content"></div>
                                        <div class="tab-pane fade active show" id="get-started" role="tabpanel" aria-labelledby="get-started-tab">
                                            <p class="description lead"><b>Introduction</b></p>
                                            <div class="row justify-content-center">
                                                <p class="text-justify" style="border-bottom: 1.75rem!important;">Hello, you are launching PhpMyPizza for the first time!
                                                    <br><br>In order to complete the installation, you need to set a database and fill the following forms in order to make PhpMyPizza to work.
                                                    <br><br>Thank you for using our software, feel free to provide feedbacks and report bugs on our <a href="https://www.github.com">Github</a>, if you feel like it! :)
                                                </p>
                                            </div>
                                            <br>
                                            <button type="button" class="btn btn-outline-primary font-weight-bold" onclick="$(\'#myTab a[href=\u0022#database\u0022]\').tab(\'show\')">Get Started</button>
                                        </div>
                                        <div class="tab-pane fade" id="database" role="tabpanel" aria-labelledby="database-tab">
                                            <p class="description lead"><b>Step 1:</b> Set up your MySQL database.</p>
                                            <div class="row justify-content-center">
                                                <div class="col-sm-9" style="padding: 1rem;"><!-- Input fields -->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="hostname" placeholder="IP / Hostname" name="hostname">
                                                    </div>
                                                    <div class="form-row align-items-center" style="margin-bottom: 1rem;">
                                                        <div class="col-sm">
                                                            <input type="text" placeholder="MySQL Username" name="user" class="form-control">
                                                        </div>
                                                        <div class="col-sm">
                                                            <input type="password" placeholder="MySQL Password" name="password" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="dbname" placeholder="Database Name" name="dbname" onclick="$(this).popover(\'show\')" data-toggle="popover" data-trigger="focus" data-html="true" data-title="<b class=\'text-primary\'><i class=\'fas fa-exclamation-circle\'></i>&nbsp;&nbsp;Alert</b>" data-content="If the database name isn\'t found, it will create a new one with the name inserted.">
                                                    </div>
                                                    <div class="custom-control custom-checkbox text-justify" style="margin-bottom: 1rem;">
                                                        <input type="checkbox" class="custom-control-input" id="querycheck" name="querycheck" checked>
                                                        <label class="custom-control-label" for="querycheck">Delete incomplete orders after a hour and half?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <nav aria-label="...">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item">
                                                        <a class="page-link text-primary font-weight-bold" onclick="$(\'#myTab a[href=\u0022#profile\u0022]\').tab(\'show\')" style="cursor: pointer;">Next&nbsp;&nbsp;<i class="fas fa-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <p class="description lead"><b>Step 2:</b> Create your account.</p>
                                            <div class="row justify-content-center">
                                                <div class="col-sm-9" style="padding: 1rem;">
                                                    <!-- Input fields -->
                                                    <div class="form-row align-items-center" style="margin-bottom: 1rem;">
                                                        <div class="col-sm">
                                                            <input type="text" placeholder="Name" name="usrname" class="form-control">
                                                        </div>
                                                        <div class="col-sm">
                                                            <input type="text" placeholder="Surname" name="usrsurname" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">@</span>
                                                        </div>
                                                        <input type="text" class="form-control username" id="usrusername" placeholder="Username" name="usrusername">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control password" id="usrpassword" placeholder="Password" name="usrpassword">
                                                    </div>
                                                </div>
                                            </div>
                                            <nav aria-label="...">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item">
                                                        <a class="page-link text-primary font-weight-bold" onclick="$(\'#myTab a[href=\u0022#database\u0022]\').tab(\'show\')" style="cursor: pointer;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a class="page-link text-primary font-weight-bold" onclick="$(\'#myTab a[href=\u0022#preferences\u0022]\').tab(\'show\')" style="cursor: pointer;">Next&nbsp;&nbsp;<i class="fas fa-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
                                        <p class="description lead"><b>Step 3:</b> Finalize your expirience.</p>
                                        <div class="row justify-content-center">
                                            <div class="col-sm-9" style="padding: 1rem;">
                                                <!-- Input fields -->
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name" placeholder="Restaurant\'s name" value="PhpMyPizza\'s Restaurant" name="name">
                                                </div>
                                                <div style="padding: 0.5rem;">
                                                    <h6>Select the color scheme:</h6>
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%; margin-top: 0.25rem; margin-bottom: 1rem;">
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn btn-outline-success active" style="width: 100%">
                                                                <div class="default-grad rounded-circle mx-auto d-block"></div>
                                                                Default
                                                                <input type="radio" name="style" id="default" value="default" autocomplete="off" checked hidden>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn btn-outline-primary" style="width: 100%">
                                                                <div class="blue-grad rounded-circle mx-auto d-block"></div>
                                                                Blue
                                                                <input type="radio" name="style" id="blue" value="blue" autocomplete="off" hidden>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn btn-outline-warning" style="width: 100%">
                                                                <div class="yellow-grad rounded-circle mx-auto d-block"></div>
                                                                Yellow
                                                                <input type="radio" name="style" id="yellow" value="yellow" autocomplete="off" hidden>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6>Select your language:</h6>
                                                <div class="row" style="margin-bottom: 1rem;">
                                                    <div class="col-sm-6 custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" name="lang" id="english" value="EN" checked>
                                                            <label class="custom-control-label" for="english"><span class="flag-icon flag-icon-gb"></span>&nbsp;English (en-gb)</label>
                                                        </input>
                                                    </div>
                                                    <div class="col-sm-6 custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" name="lang" id="italian" value="IT">
                                                            <label class="custom-control-label" for="italian"><span class="flag-icon flag-icon-it"></span>&nbsp;Italian (it-it)</label>
                                                        </input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link text-primary font-weight-bold" onclick="$(\'#myTab a[href=\u0022#profile\u0022]\').tab(\'show\')" style="cursor: pointer;"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back</a>
                                                </li>
                                                <li class="page-item">
                                                    <button class="page-link text-success font-weight-bold" type="submit" style="cursor: pointer;">Done&nbsp;&nbsp;<i class="fas fa-pizza-slice"></i></button>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist" hidden>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="get-started-tab" data-toggle="tab" href="#get-started" role="tab" aria-controls="get-started" aria-selected="true">Get Started</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="database-tab" data-toggle="tab" href="#database" role="tab" aria-controls="database" aria-selected="true">Database</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="preferences-tab" data-toggle="tab" href="#preferences" role="tab" aria-controls="preferences" aria-selected="false">Preferences</a>
                                        </li>
                                    </ul>
                                </form>
                            <!-- Form end -->
                            <p class="mt-5 ml-3 text-muted" style="margin-bottom: 0.5rem;">Apache Version: '.$_SERVER['SERVER_SOFTWARE'].'&nbsp;
                                <i class="text-success far fa-check-circle" data-toggle="tooltip" data-placement="right" title="It just works."></i>
                            </p>
                            <p class="ml-3 text-muted" style="margin-bottom: 0.5rem;">PHP Version: '.phpversion().'&nbsp;&nbsp;';
                            if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
                                echo '<i class="text-success far fa-check-circle" data-toggle="tooltip" data-placement="right" title="This version is supported."></i></p>';
                            } else {
                                echo '<i class="text-warning far fa-question-circle" data-toggle="tooltip" data-placement="right" title="This version could not work well. Update your PHP."></i></p>';
                            }
                            echo '<p class="text-muted">&copy; 2019-2020&nbsp;&minus;&nbsp;PhpMyPizza '.$_SERVER['version'].'</p>
                            <!-- End input fields -->
                        </div>
                    </div>
                </div>
            </body>
        ';
} else {
    include 'resources/Mobile_Detect.php';
    $detect = new Mobile_Detect();

    if(!isset($_COOKIE['logged-id']))
        header('Location: ./login/');
    else {
        if ($detect->isMobile())
            header('Location: ../serve/');
        else
            header('Location: ../control/');
    }
}
