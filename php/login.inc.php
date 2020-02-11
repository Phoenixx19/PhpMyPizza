
<?php
    require('connect.inc.php');
    if(!isset($_POST['submit-login']))
        header('Location: ../errors/404.php');
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];


    if(empty($username) || empty($password))
        header("location: ../login.php?empty");

    $password_hashed = md5($password);
    $sql = "SELECT * FROM users WHERE username='".$username."' AND psw='".$password_hashed."'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //output data of each row
        while($row = $result->fetch_assoc()) {
            //echo $row['id'].'      '.$row['username'].'      '.$row['psw'].'<br>';
            setcookie('logged-id',$row['id'],time()+(86400 * 30), "/");
            //echo $_COOKIE['logged-id'];
            //header("location: ../login.php?".$row['id']);
            header('Location: ../');
        }
    } 
    else {
        header("location: ../login.php?error");
    }
    $conn->close();
?>