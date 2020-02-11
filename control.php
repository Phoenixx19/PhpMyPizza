<?php
if(!isset($_COOKIE['logged-id']))
header('Location: ../login/');
require('./links.php');
$theme=  theme($array['LOOKNFEEL']['theme']);
$tables = ($array['INFO']['ntables']);
?>

<html>
    <head>
        <meta http-equiv="refresh" content="10" id="reload">
        <!--refresh ogni 10 secondi-->
    </head>
    <body>
        <div class="container-fluid background-container">
            <?php
                //query 1
                $sql = "SELECT `table_number`, `timestamp`, COUNT(*) AS `orders` FROM `orders` GROUP BY `table_number` ORDER BY `timestamp`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '<div class="card-columns" style="margin: 1rem;">';
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='card shadow p-3 mb-5 animated fadeInUp faster' style='margin-top: 1rem; border: none;'>
                        <div class='card-body row'>
                            <div class='col-sm-6'>
                                <h5 class='card-title text-left' style='margin-bottom: 0;'>".($arraylang[$lang]['table'])." ".$row["table_number"]."&nbsp;
                                <span style='margin-top: -0.3em;' class='badge badge-pill align-middle badge-"; echo $theme; echo "'>";
                                if ($row["orders"]==1) {
                                    echo $row["orders"]." ".($arraylang[$lang]['order']);
                                } else {
                                    echo $row["orders"]." ".($arraylang[$lang]['orders']);
                                }
                                echo "</span>
                            </h5>
                            </div>
                            <div class='col-sm-6'>
                                <p class='text-muted text-right' style='margin-bottom: 0;'><i class='far fa-clock'></i>&nbsp;&nbsp;".time_elapsed_string($row["timestamp"])."</p>
                            </div>
                        </div>";

                        $sqlord = "SELECT quantity,menu.name,edits,orders.id FROM `orders` JOIN menu ON orders.refid_menu=menu.id WHERE table_number=".$row["table_number"]." ORDER BY orders.timestamp";
                        $resultord = $conn->query($sqlord);
                        if ($resultord->num_rows > 0) {
                            while ($roword = $resultord->fetch_assoc()) {
                                echo "<div class='card-footer text-center'><form method='post' action='../php/topay.inc.php' style='margin-bottom: 0;'>
                                <div class='row align-items-center'>
                                    <div class='col-sm-2 text-left'>
                                        <span class='text-muted'>".$roword["quantity"]."</span>
                                    </div>
                                    <div class='col-md-auto text-left'>
                                        <p style='margin-bottom: 0;'>".$roword["name"]."</p>
                                    </div>";
                                    if ($roword["edits"] != NULL) {
                                        echo "<div class='col-md-auto text-left'>
                                        <span class='text-muted'>".$roword["edits"]."</span>
                                        </div>";
                                    }
                                    echo "<div class='col text-right'>
                                        <input type='number' name='id' value=".$roword['id']." hidden>
                                        <div class='custom-control custom-checkbox'>
                                            <input type='checkbox' class='custom-control-input' id='".$roword['id']."' onclick='this.form.submit()'>
                                            <label class='custom-control-label' for='".$roword['id']."'>".($arraylang[$lang]['ready'])."</label>
                                        </div>
                                        <!-- <button class='btn btn-link text-"; echo $theme; echo "' name='orderdel'
                                            type='submit' style='margin-bottom: 0; padding: 0;'>
                                            <i class='fas fa-utensils'></i>
                                        </button> -->
                                    </div>
                                </div>
                            </form></div>";
                            }
                        }
                        echo "</div>";
                    }
                    echo '</div>';
                } else {
                    echo '<div class="jumbotron jumbotron-fluid" style="margin-top: 2rem; max-width: 50%; background-color: transparent !important;">
                    <div class="container">
                        <div class="animated fadeInUp">
                            <h1 class="display-2">:(</h1><br>
                        </div>
                        <div class="animated fadeInUp delay-1s">
                            <h2 class="lead" style="font-size: 2rem;">'.$arraylang[$lang]['dbempty'].'</h2>
                            <h5 class="text-muted">'.$arraylang[$lang]['dbemptytext'].'&nbsp;<a class="text-'.$theme.'" href="../serve/">'.$arraylang[$lang]['dbemptylink'].'</a></h5>
                        </div>
                    </div>
                  </div>';
                }
            ?>
        </div>
        <script type="text/javascript">
            $('#settings').on('shown.bs.modal', function(e) {
                $('#reload').parentNode.removeChild($('#reload'));
            });
            $('#settings').on('hidden.bs.modal', function (e) {
                $('head').append('<meta http-equiv="refresh" content="60" id="reload">');
            });
        </script>
    </body>
</html>