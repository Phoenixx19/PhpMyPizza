<?php
    if(!isset($_COOKIE['logged-id']))
    header('Location: ../login/');
    require('./links.php');
    $sqllvl = "SELECT level FROM users WHERE id=".$_COOKIE['logged-id'];
    $resllvl = $conn->query($sqllvl);
    if ($resllvl->num_rows > 0) {
        while ($rowllvl = $resllvl->fetch_assoc()) {
            if ($rowllvl['level']!=0) {
                echo '<head><meta http-equiv="refresh" content="0;url=../"></head>';
                die();
            }
        }
    }
    $id = substr($_SERVER['REQUEST_URI'],8);

    function level($level, $array, $lang) {
        if ($level==0) {
            echo '<span class="badge badge-pill badge-danger">'.$array[$lang]['user0'].'</span>';
        } else if ($level==1) {
            echo '<span class="badge badge-pill badge-warning">'.$array[$lang]['user1'].'</span>';
        } else if ($level==2) {
            echo '<span class="badge badge-pill badge-success">'.$array[$lang]['user2'].'</span>';
        }
    }
?>

<html>
<script>
$(document).ready(function(){
    $('input[type="checkbox"]').click(function(){
        $('div[id="image-form"]').toggle();
        $('input[name="usrphoto"]').val(null);
    });
});
</script>
    <!-- modal insert -->
    <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="../php/add_user.inc.php" method="post">
                    <input type="text" name="r_url" value="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" style="display: none;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $arraylang[$lang]['adduser']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: calc(100vh - 300px); overflow-y: auto;">
                            <div class="form-group row">
                                <label class="col-sm-3 align-self-center col-form-label"><?php echo $arraylang[$lang]['namesurname']; ?></label>
                                <div class="col-sm-9 align-self-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="<?php echo $arraylang[$lang]['firstname']; ?>" name="usrname">
                                        <input type="text" class="form-control" placeholder="<?php echo $arraylang[$lang]['lastname']; ?>" name="usrsurname">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label align-self-center"><?php echo $arraylang[$lang]['username']; ?></label>
                                <div class="col-sm-9 align-self-center input-group">
                                <div class="input-group-prepend">
                                    <small class="input-group-text">@</small>
                                </div>
                                <input type="text" class="form-control" name="usrusername">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label align-self-center"><?php echo $arraylang[$lang]['password']; ?></label>
                                <div class="col-sm-9 align-self-center">
                                    <input type="password" class="form-control" name="usrpassword">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 align-self-center"><?php echo $arraylang[$lang]['imgchoose']; ?></div>
                                <div class="col-sm-9 align-self-center">
                                    <div class="custom-control custom-checkbox" style="margin-bottom: 0.5rem;">
                                        <input type="checkbox" class="custom-control-input" id="check" name="usrcheck">
                                        <label class="custom-control-label" for="check"><?php echo $arraylang[$lang]['imgchoosetext']; ?></label>
                                    </div>
                                    <div id="image-form">
                                        <input type="text" class="form-control" placeholder="<?php echo $arraylang[$lang]['imgurl']; ?>" name="usrphoto">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 align-self-center"><?php echo $arraylang[$lang]['role']; ?></div>
                                <div class="col-sm-9 align-self-center">
                                    <select class="form-control" id="usrlvl" name="usrlvl" required>
                                        <?php
                                            $sqlvl = "SELECT level FROM `users` GROUP BY level";
                                            $reslvl = $conn->query($sqlvl);
                                            if ($reslvl->num_rows > 0) {
                                                while ($rowlvl = $reslvl->fetch_assoc()) {
                                                    echo '<option value="'.$rowlvl['level'].'">'.$arraylang[$lang]['user'.$rowlvl['level']].' ('.$rowlvl['level'].')</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-link text-info text-decoration-none"><?php echo $arraylang[$lang]['restart']; ?></button>
                        <button type="submit" class="btn btn-<?php echo theme($theme); ?>"><?php echo $arraylang[$lang]['add']; ?></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal options - next release hopefully 
            <div class="modal fade" id="modalAdvUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        -->
    <style>
        .nav-pills .nav-link {
            <?php
                if ($theme == "default") {
                    echo 'color: #28a745!important;';
                } else if ($theme == "yellow") {
                    echo 'color: #ffc107!important;';
                }
            ?>
        }

        .nav-link.active {
            <?php
                if ($theme == "default") {
                    echo 'color: #fff!important;
                        background-color: #28a745!important;';
                } else if ($theme == "yellow") {
                    echo 'color: #000!important; background-color: #ffc107!important;';
                }
            ?>
        }

        .bg-gradient {
            <?php if ($theme == "default") {
                echo 'background: linear-gradient(to top, #ffffff 0%, #28a745 75%);';
            } else if ($theme == "blue") {
                echo 'background: linear-gradient(to top, #ffffff 0%, #007bff 75%);';
            } else if ($theme == "yellow") {
                echo 'background: linear-gradient(to top, #ffffff 0%, #ffc107 75%);';
            }
            ?>
        }

        #side-nav {
            position: fixed;
            height:93.6vh;
            overflow-y: scroll;
        }

        #content-wrapper {
            overflow-y: scroll;
            position: relative;
            height:93.6vh;
        }

        #content-wrapper::-webkit-scrollbar {
          width: 0.8rem;
        }

        #content-wrapper::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #content-wrapper::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 15px;
        }

        #content-wrapper::-webkit-scrollbar-thumb:hover {
            background: #888;
            border-radius: 15px;
        }

        #content-wrapper::-webkit-scrollbar-thumb:active {
            background: #555;
            border-radius: 15px;
        }
    </style>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <body>
        <div class="container-fluid background-container">
            <div class="row" style="height: 80%;">
                <div class="col-sm-3" style="padding-left: 0; padding-right: 0;">
                    <div class="list-group-flush" id="content-wrapper">
                        <?php
                            $sql = "SELECT id,photo_url,surname,name,username,level FROM users ORDER BY level, registered";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<a href="?'.$row['id'].'" class="list-group-item list-group-item-action border-right" style="padding: 0.5rem;">
                                        <div class="d-flex">
                                            <div class="p-2 align-self-center"><img class="rounded-circle" src="'.$row['photo_url'].'" width="75" height="75"></div>
                                            <div class="p-2 align-self-center">';
                                                if ($row['surname']==NULL && $row['name']==NULL) {
                                                    echo '<h5 class="mb-1">@'.$row['username'].'</h5>';
                                                    echo level($row['level'], $arraylang, $lang);
                                                    echo '<br>';
                                                } else {
                                                    echo '<h5 class="mb-1">'.$row['surname'].', '.$row['name'].'</h5>';
                                                    echo level($row['level'], $arraylang, $lang);
                                                    echo '<br>
                                                    <small>@'.$row['username'].'</small>';
                                                }
                                                echo '
                                            </div>
                                        </div>
                                    </a>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="text-center col bg-gradient ?>" style="flex: 0 0 2.75%; max-width: 2.75%; padding: 0;">
                    <div style="padding-top: 33.3%;">
                        <span data-toggle="tooltip" data-placement="right" title="<?php echo $arraylang[$lang]['adduser']; ?>">
                            <a href="#modalInsert" class="btn btn-link text-white text-decoration-none" style="font-size: 100%; padding: 0.5rem;" type="button" data-toggle="modal"><i class="text-white fas fa-plus"></i></a>
                        </span>
                        <br>
                        <br>
                        <span data-toggle="tooltip" data-placement="right" title="<?php echo $arraylang[$lang]['advuser']; ?> (In future updates)">
                            <a href="#modalAdvUsers" class="btn btn-link text-secondary text-decoration-none disabled" style="font-size: 100%; padding: 0.5rem;" type="button" data-toggle="modal"><i class="fas fa-users-cog"></i></a>
                        </span>
                    </div>
                </div>
                <div class="col" style="overflow-y: auto; padding: 2rem;">
                    <div class="container h-100">
                        <div class="row h-100 justify-content-center align-items-center">
                        <?php
                        $sqldetails="SELECT * FROM users WHERE id=".$id;
                        $resdet = $conn->query($sqldetails);
                            if ($resdet = $conn->query($sqldetails)) {
                                while ($rowdet = $resdet->fetch_object()) {
                                    echo '
                                    <div class="card shadow p-3 mb-5 animated fadeIn fast" id="card">
                                        <div class="card-body">
                                            <form action="../php/update_user.inc.php" method="post" id="updateuserform">
                                                <input type="text" name="r_url" value="';
                                                    echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                                    echo '" style="display: none;">
                                                <input type="text" name="id" value="'.$rowdet->id.'" hidden>
                                                <h3>'.$arraylang[$lang]['infoacc'].'</h3>
                                                <div class="d-flex p-4" style="padding-bottom: 0!important;">
                                                    <div class="p-4 align-self-center">
                                                        <img class="rounded-circle" src="'.$rowdet->photo_url.'" width="175" height="175">
                                                    </div>
                                                    <div class="p-4 align-self-center" style="width: 40%; padding-bottom: 0!important; padding-top: 0!important;">
                                                        <small class="text-muted">'.$arraylang[$lang]['lastname'].'</small>
                                                        <h4 class="mb-2">'.$rowdet->surname.'</h5>
                                                        <small class="text-muted">'.$arraylang[$lang]['firstname'].'</small>
                                                        <h4 class="mb-3">'.$rowdet->name.'</h4>
                                                        <small class="text-muted">'.$arraylang[$lang]['username'].'</small>
                                                        <h4 class="mb-2">@'.$rowdet->username.'</h4>
                                                    </div>
                                                    <div class="p-4 align-self-center" style="width: 43%; padding-bottom: 0!important; padding-top: 0!important;">
                                                        <small>'.$arraylang[$lang]['crole'].'</small>
                                                        <h4 class="mb-3"><span class="badge badge-pill badge-'.theme($theme).'">'.$arraylang[$lang]['user'.$rowdet->level].'</span></h4>
                                                        <small>'.$arraylang[$lang]['registered'].'</small>
                                                        <h4 class="mb-3">'.$rowdet->registered.'</h4>
                                                    </div>
                                                </div>
                                                <hr>
                                                <ul class="nav nav-pills pt-3 mb-3 justify-content-center" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="pills-level-tab" data-toggle="pill" href="#pills-level" role="tab" aria-controls="pills-level" aria-selected="true">'.$arraylang[$lang]['role'].'</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="false">'.$arraylang[$lang]['username'].'</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-pw-tab" data-toggle="pill" href="#pills-pw" role="tab" aria-controls="pills-pw" aria-selected="false">'.$arraylang[$lang]['password'].'</a>
                                                    </li>
                                                </ul>
                                                <br>
                                                <div class="tab-content" id="pills-tabContent" style="padding-left: 0.01rem;">
                                                    <div class="tab-pane fade show active" id="pills-level" role="tabpanel" aria-labelledby="pills-level-tab">
                                                        <h3>'.$arraylang[$lang]['changerole'].'</h3>
                                                        <p>'.$arraylang[$lang]['changeroletext'].'</p>
                                                        <div class="ml-4 p-2">
                                                            <div class="input-group" style="width: 40%;">
                                                                <select class="form-control" style="width: 15rem;" id="level" name="level" required>';
                                                                    $sqlvl = "SELECT level FROM `users` GROUP BY level";
                                                                    $reslvl = $conn->query($sqlvl);
                                                                    if ($reslvl->num_rows > 0) {
                                                                        while ($rowlvl = $reslvl->fetch_assoc()) {
                                                                            if ($rowdet->level == $rowlvl['level']) {
                                                                                echo '<option value="'.$rowlvl['level'].'" selected>'.$arraylang[$lang]['user'.$rowlvl['level']].' ('.$rowlvl['level'].')</option>';
                                                                            } else {
                                                                                echo '<option value="'.$rowlvl['level'].'">'.$arraylang[$lang]['user'.$rowlvl['level']].' ('.$rowlvl['level'].')</option>';
                                                                            }
                                                                        }
                                                                    }
                                                        echo '</select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                                                        <h3>'.$arraylang[$lang]['changeinfo'].'</h3>
                                                        <p>'.$arraylang[$lang]['changeinfotext'].'</p>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="#usrname">'.$arraylang[$lang]['firstname'].'</label>
                                                                <input type="text" class="form-control" id="usrname" name="usrname" value="'.$rowdet->name.'">
                                                            </div>
                                                            <div class="col">
                                                                <label for="#usrsurname">'.$arraylang[$lang]['lastname'].'</label>
                                                                <input type="text" class="form-control" id="usrsurname" name="usrsurname" value="'.$rowdet->surname.'">
                                                            </div>
                                                            <div class="col">
                                                                <label for="#usrusername">'.$arraylang[$lang]['username'].'</label>
                                                                <input type="text" class="form-control" id="usrusername" name="usrusername" value="'.$rowdet->username.'">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-pw" role="tabpanel" aria-labelledby="pills-pw-tab">
                                                        <h3>'.$arraylang[$lang]['changepw'].'</h3>
                                                        <p>'.$arraylang[$lang]['changepwtext'].'</p>
                                                        <div class="input-group" style="width: 60%;">
                                                            <input type="password" class="form-control" name="usrpassword" placeholder="Password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="post" action="../php/delete_user.inc.php" class="mr-auto">
                                                <input type="number" name="user" value="'.$rowdet->id.'" hidden>
                                                <a type="submit" class="btn btn-link text-danger"><i class="fas fa-trash"></i>&nbsp;&nbsp;'.$arraylang[$lang]['delete'].'</a>
                                            </form>
											<a class="btn btn-link text-success" style="cursor: pointer;" onclick="$(\'#updateuserform\').submit();">'.$arraylang[$lang]['update'].'&nbsp;&nbsp;<i class="fas fa-redo-alt"></i></a>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo '<div class="jumbotron jumbotron-fluid" style="margin-top: 2rem; max-width: 100%; background-color: transparent !important;">
                                    <div class="container">
                                        <div class="animated fadeInUp">
                                            <h1 class="display-2">:(</h1><br>
                                        </div>
                                        <div class="animated fadeInUp delay-1s">
                                            <h2 class="lead" style="font-size: 2rem;">'.$arraylang[$lang]['noaccsel'].'</h2>
                                            <h5 class="text-muted">'.$arraylang[$lang]['noacctext'].'</h5>
                                        </div>
                                    </div>
                                </div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>