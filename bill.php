<?php
    if(!isset($_COOKIE['logged-id']))
    header('Location: ../login/');
    require('./links.php');
    $theme =  theme($array['LOOKNFEEL']['theme']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sqldel = "DELETE FROM c_orders WHERE table_number=".$_POST['tn'];
    $resultdel = $conn->query($sqldel);
};
    $amount = 0;
?>

<body>
    <style>
        .blank-row {
            height: 1rem !important;
            background-color: #ffffff;
        }
    </style>

    <?php
        $sql = "SELECT `table_number`, `timestamp`, COUNT(table_number) AS orders FROM `c_orders` GROUP BY `table_number` ORDER BY `timestamp`";
        $result = $conn->query($sql);
        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="modal fade" id="order'.$row['table_number'].'" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header align-items-center">
                                <h5 class="modal-title">'.$arraylang[$lang]['table'].' '.$row['table_number'].'</h5>
                                <span>'.time_elapsed_string($row["timestamp"]).'</span>
                            </div>
                            <div class="modal-body" style="padding: 0;">
                                <table class="table table-sm">
                                <thead>
                                    <tr>
                                    <th class="text-center" scope="col">'.$arraylang[$lang]['quantity'].'</th>
                                    <th scope="col">'.$arraylang[$lang]['food'].'</th>
                                    <th scope="col">'.$arraylang[$lang]['edits'].'</th>
                                    <th class="text-center" scope="col">'.$arraylang[$lang]['amount'].'</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $sql2 = "SELECT quantity, menu.name, menu.price, edits FROM c_orders JOIN menu ON c_orders.refid_menu=menu.id WHERE table_number=".$row['table_number'];
                                $res2 = $conn->query($sql2);
                                if ($res2->num_rows > 0) {
                                    while ($row2 = $res2->fetch_assoc()) {
                                        echo '<tr>
                                        <th scope="row" class="text-center text-muted">'.$row2['quantity'].'</th>
                                        <td>'.$row2['name'].'</td>
                                        <td class="text-muted font-weight-bolder">'.$row2['edits'].'</td>
                                        <td class="text-center">';
                                        $amount = $amount + ($row2['quantity'] * $row2['price']);
                                        echo useCurrency($array['LANG']['language'], ($row2['quantity'] * $row2['price'])).'</td>
                                      </tr>';
                                    }
                                    echo '<tr class="font-weight-bold">
                                        <th colspan="3">&nbsp;&nbsp;'.$arraylang[$lang]['subtotal'].':</th>
                                        <td class="text-center">'.useCurrency($array['LANG']['language'], $amount).'</td>
                                    </tr>
                                    <tr class="blank-row">
                                        <td colspan="4"></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td colspan="2">&nbsp;'.$arraylang[$lang]['cover'].'</td>';
                                        echo '<td class="text-center"><b>+</b> '.useCurrency($array['LANG']['language'], $array['INFO']['cover']).'</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td colspan="2">&nbsp;IVA</td>';
                                        $tax = ($amount * $array['INFO']['tax']) / 100;
                                        echo '<td class="text-center"><b>+</b> '.useCurrency($array['LANG']['language'], $tax).'</td>
                                    </tr>
                                    <tr class="table-secondary font-weight-bold">
                                        <th colspan="3">&nbsp;&nbsp;'.$arraylang[$lang]['total'].':</th>';
                                        $amount = $amount + $tax + $array['INFO']['cover'];
                                        echo '<td class="text-center">'.useCurrency($array['LANG']['language'], $amount).'</td>
                                    </tr>';
                                }
                                $amount = 0;
                                echo '</tbody>
                                </table>
                                </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-link text-secondary mr-auto" data-dismiss="modal">'.$arraylang[$lang]['close'].'</a>
                                <form method="post" action="/bill.php" id="delete_'.$row['table_number'].'">
                                    <input type="text" name="tn" value="'.$row['table_number'].'" hidden>
                                    <a type="button" class="btn btn-link text-danger" name="" onclick="document.getElementById(&quot;delete_'.$row['table_number'].'&quot;).submit();"><i class="fas fa-trash"></i></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    ?>
    <div class="container-fluid background-container" style="margin-top: 1.5rem;">
    <div class="jumbotron" style="background: linear-gradient(to right, #e9ecef 12.5%, #ffffff 87.5%);">
        <h3 class="display-4"><?php echo $arraylang[$lang]['topaybill'] ?></h3>
        <p class="lead"><?php echo $arraylang[$lang]['desc1bill'] ?></p>
        <span><?php echo $arraylang[$lang]['desc2bill'] ?></span>
    </div>
        <?php
        //query 1
            $sql = "SELECT `table_number`, `timestamp`, COUNT(table_number) AS orders FROM `c_orders` GROUP BY `table_number` ORDER BY `timestamp`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo '<div class="card-columns" style="margin-left: 1rem;margin-right: 1rem;margin-bottom: 1rem; column-count: 4;">';
                while ($row = $result->fetch_assoc()) {
                    $tablenumber = $row['table_number'];
                    $totamount = 0;
                    echo '<div class="card shadow p-3 mb-5" style="margin-top: 1rem;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="d-flex col align-items-center justify-content-start font-weight-bold">
                                        '.$arraylang[$lang]['table'].' '.$tablenumber.'
                                    </div>
                                    <div class="d-flex col align-items-center justify-content-end" style="padding: 0;">
                                        <a class="btn btn-link text-'.$theme.'" href="#order'.$row['table_number'].'" type="button"
                                            data-toggle="modal" data-target="#order'.$row['table_number'].'" title="'.$arraylang[$lang]['openbill'].'"><i class="fas fa-share-square"></i></a>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">';

                    //query 2
                    $sqlnum = "SELECT quantity, menu.price FROM c_orders JOIN menu ON c_orders.refid_menu=menu.id WHERE table_number=".$tablenumber;
                    $resnum = $conn->query($sqlnum);
                    if ($resnum->num_rows > 0) {
                        while ($rownum = $resnum->fetch_assoc()) {
                                    $totamount = $totamount + ($rownum['quantity'] * $rownum['price']);
                        }

                        echo '<li class="list-group-item justify-content-between">
                                <div class="row">
                                    <div class="d-flex col align-items-center justify-content-start">';
                                        if ($row["orders"]==1) {
                                            echo $row["orders"]." ".($arraylang[$lang]['order']);
                                        } else {
                                            echo $row["orders"]." ".($arraylang[$lang]['orders']);
                                        }
                                    echo '</div>
                                    <div class="d-flex col align-items-center justify-content-end">
                                        <b>'.useCurrency($array['LANG']['language'], $totamount).'</b>
                                    </div>
                                </div>
                            </li>';
                    }
                    echo "</ul>
                    </div>";
                }
            } else {
                echo '<div class="jumbotron jumbotron-fluid" style="margin-top: 2rem; max-width: 50%; background-color: transparent !important;">
                    <div class="container">
                        <div class="animated fadeInUp">
                            <h1 class="display-2">:(</h1><br>
                        </div>
                        <div class="animated fadeInUp delay-1s">
                            <h2 class="lead" style="font-size: 2rem;">'.$arraylang[$lang]['nobills'].'</h2>
                            <h5 class="text-muted">'.$arraylang[$lang]['nobillstext'].'&nbsp;<a class="text-'.$theme.'" href="../control/">'.$arraylang[$lang]['nobillslink'].'</a></h5>
                        </div>
                    </div>
                  </div>';
            }
        ?>
        
        </div>
    </div>
</body>
