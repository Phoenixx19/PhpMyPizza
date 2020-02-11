<?php
    if(isset($_COOKIE['logged-id'])){
        header('Location: ../');
    }
    require('./links.php');
?>

<html>
<link rel="stylesheet">
<style>
body {
    width: 100%;
}

#main-div {
    max-width: 600px;
    width: 90%;
    margin: auto;
}
</style>


<body>
    <div class="container animated fadeIn fast" style="height: 85%; text-align: center;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <div id="main-div">
                    <form action="/php/login.inc.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="login-username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="login-password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group form-check" hidden>
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit-login"><?php echo $arraylang[$lang]['login']; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>