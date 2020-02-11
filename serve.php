<?php
    if(!isset($_COOKIE['logged-id']))
    header('Location: ../login/');
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
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/d2ea588ed1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">


<html>
    <body>
        <div class="container text-center">
            <br>
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="../php/insert_order.inc.php" method="POST" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="name"><b><?php echo ($arraylang[$lang]['food']); ?>:</b><br>
                                        <div class="input-group" style="flex-wrap: nowrap;">
                                            <select class="form-control form-control-lg" style="width: 15rem;" id="name" name="name" required>
                                                <?php
                                                    $sql = 'SELECT id,name,tipo FROM menu order by id';
                                                    $result = $conn->query($sql);
                                                    $currentCategory = null;
                                                    while($row = $result->fetch_assoc()){
                                                        if ($row['tipo'] != $currentCategory) {
                                                            echo "<option disabled>".$row['tipo']."</option>";
                                                            $currentCategory = $row['tipo'];
                                                        }
                                                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                            <div class="input-group-append align-self-center">
                                                <a class="btn btn-outline-<?php echo $theme ?>" href="/menu" role="button" style="padding: 15;"><i class="fas fa-book-open"></i></a>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="quantityin"><b><?php echo ($arraylang[$lang]['quantity']); ?>:</b><br>
                                        <input class="form-control form-control-lg" type="number" name="quantity" max="30" min="1" id="quantityin" placeholder="1" style="width: 15rem;" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="table_numberin"><b><?php echo ($arraylang[$lang]['table']); ?>:</b><br>
                                        <input class="form-control form-control-lg" type="number" name="table_number" max="40" min="1" id="table_numberin" placeholder="1" style="width: 15rem;" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="editsin"><b><?php echo ($arraylang[$lang]['edits']); ?>:</b><br>
                                        <textarea class="form-control" aria-label="With textarea" name="edits" id="editsin" style="width: 15rem;" placeholder="Senza olio di palma..."></textarea>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-<?php echo $theme ?>" style="width: 15rem;"><i class="fas fa-plus"></i>&nbsp;<b><?php echo ($arraylang[$lang]['add']); ?></b></button>
                            </form>
                            <script>
                                // Form validation
                                (function() {
                                  'use strict';
                                  window.addEventListener('load', function() {
                                    var forms = document.getElementsByClassName('needs-validation');
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                      form.addEventListener('submit', function(event) {
                                        if (form.checkValidity() === false) {
                                          event.preventDefault();
                                          event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                      }, false);
                                    });
                                  }, false);
                                })();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row-sm">
            <div class="col-sm-5 mx-auto">
                <div class="table-responsive-sm">
                    <table class="table table-striped table-sm border-left border-right border-bottom shadow-sm">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo ($arraylang[$lang]['food']); ?></th>
                                <th scope="col"><?php echo ($arraylang[$lang]['quantity']); ?></th>
                                <th scope="col"><?php echo ($arraylang[$lang]['table']); ?></th>
                                <th scope="col"><?php echo ($arraylang[$lang]['edits']); ?></th>
                                <th scope="col"><?php echo ($arraylang[$lang]['timestamp']); ?></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user_id = $_COOKIE['logged-id'];
                            $sql = 'SELECT menu.name,quantity,orders.id,table_number,edits,timestamp FROM orders JOIN menu ON orders.refid_menu=menu.id ORDER BY timestamp DESC';
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()) {
                                echo '
                                <tr>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['quantity'].'</td>
                                    <form action="../php/delete.inc.php" method="post">
                                        <input type="number" name="id" value="'.$row['id'].'" id="" hidden>
                                        <td>'.$row['table_number'].'</td>
                                        <td>'.$row['edits'].'</td>
                                        <td>'.time_elapsed_string($row['timestamp']).'</td>
                                        <td><button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button></td>
                                    </form>
                                </tr>';
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
