<?php
    header('Content-type: text/html; charset=utf-8');
    require('./links.php');
    $id = substr($_SERVER['REQUEST_URI'],7);
    $sqlcat = "SELECT tipo FROM menu WHERE id=".$id.";";
    $rescat = $conn->query($sqlcat);
    if ($rescat->num_rows > 0) {
        while ($rowcat = $rescat->fetch_assoc()) {
            $category = $rowcat['tipo'];
        }
    }
    $sqlmax = "SELECT MAX(`id`) AS id FROM `menu`";
    $resmax = $conn->query($sqlmax);
    if ($resmax->num_rows > 0) {
        while ($rowmax = $resmax->fetch_assoc()) {
            $maxid = $rowmax['id'];
        }
    }
?>
<head>
    <?php
        if($_SERVER['REQUEST_URI'] == '/food/') {
            echo '<meta http-equiv="refresh" content="0;?1">';
        }
    ?>
<style>
    .list-group-item.active {
        <?php if ($theme == "default") {
            echo "background-color: #28a745;
                    border-color: #28a745;";
            } else
            if ($theme == "yellow") {
            echo "color: #000;
                    background-color: #ffc107;
                    border-color: #ffc107;"; }
        ?>
    }
</style>
</head>
<body>
    <div class="container background-container">
        <p class="margin-top: 1rem;"></p>
        <br>
        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    <h5 class="list-group-item d-flex justify-content-center"><?php echo $category; ?></h5>
                    <?php
                        $sql = 'SELECT id,name FROM menu WHERE tipo="'.$category.'" order by id';
                        $result = $conn->query($sql);
                        if ($result->num_rows > 1) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<a class="list-group-item list-group-item-action ';
                                if ($id==$row['id']) {
                                  echo 'active';
                                }
                                echo '" href="?'.$row['id'].'">'.$row['name'].'</a>';
                            }
                        } else if ($_SERVER['REQUEST_URI'] == '/food/?54550') {
                            // Nothing
                        } else {
                            echo '<head><meta http-equiv="refresh" content="0;?1"></head>';
                        }
                    ?>
                </div>
                <br>
                <nav aria-label="...">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if($id == 1) {echo 'disabled';} ?>">
                            <a class="page-link text-<?php if($id != 1) echo theme($theme); ?>" href="?1" aria-label="Start">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only"><?php echo $arraylang[$lang]['start']; ?></span>
                            </a>
                        </li>
                        <li class="page-item <?php if($id == 1) {echo 'disabled';} ?>">
                            <a class="page-link text-<?php if($id != 1) echo theme($theme); ?>" href="?<?php echo $id-1 ?>"><?php echo $arraylang[$lang]['previous']; ?></a>
                        </li>
                        <li class="page-item <?php if($id == $maxid) {echo 'disabled';} ?>">
                            <a class="page-link text-<?php if($id != $maxid) echo theme($theme); ?>" href="?<?php echo $id+1 ?>"><?php echo $arraylang[$lang]['next']; ?></a>
                        </li>
                        <li class="page-item <?php if($id == $maxid) {echo 'disabled';} ?>">
                            <a class="page-link text-<?php if($id != $maxid) echo theme($theme); ?>" href="?<?php echo $maxid; ?>" aria-label="End">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only"><?php echo $arraylang[$lang]['end']; ?></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php
            $sql2 = 'SELECT * FROM menu WHERE id='.$id;
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 1)
                header('Location: errors/db.html');
            elseif ($result2->num_rows < 1)
                header('Location: errors/404.html');
            else{

                while($row2 = $result2->fetch_assoc()){
                    echo '<div class="col">
                            <h1 class="d-flex justify-content-center">'.$row2['name'].' (€'.$row2['price'].')</h1>
                            <h5 class="d-flex justify-content-center">'.$row2['descrizione'].'</h5>
                            <br>
                            <img src="'.$row2['photo_url'].'" alt="" class="rounded img-fluid mx-auto d-block shadow" style="max-width:80%;border-style: solid;border-width: 2px;">
                        </div>';
                    }
                }
        ?>
        </div>
    </div>
</body>
