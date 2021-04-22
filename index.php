<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>

</style>
</head>
<body>
        <div class="box">
          <?php 
            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                switch ($msg) {
                    case 'login_failed':
                      echo "<h4 style='color:#8a6d3b'>";
                      echo 	"Warning! Username or Password Invalid!.";
                      echo "</h4>";
                      break;
                  
                    default:
                      echo "<h4 style='color:red'>";
                      echo 	"Danger! Login Failed!.";
                      echo "</h4>";
                      break;
                }
            }
          ?>
          <h2>Login</h2>
          <p style="color: rgb(255, 255, 255);">Enter Your Username and Password</p>
          <form action="" method="post">
            <div class="inputBox">
              <input type="email" name="user_email" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);"  value="">
              <label class="labels">Username</label>
            </div>
            <div class="inputBox">
              <input type="password" name="user_password" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);" value="">
              <label class="labels">Passward</label>
            </div>
            <input type="submit" name="submit" value="Login">
          </form>
        </div>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $user_email = mysqli_real_escape_string($connection, $user_email);
        
        $query = "SELECT * FROM users WHERE user_email = '{$user_email}'";
        $result = mysqli_query($connection, $query);

        if(!$result){
          header("Location: index.php?msg");
        }else{
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $db_user_email = $row['user_email'];
                    $db_user_password = $row['user_password'];
                    $db_user_status = $row['user_status'];
                    $db_user_responcem = $row['user_responcem'];
                    $db_user_responcef = $row['user_responcef'];
                }
                if($db_user_status == 0){
                    if($user_email === $db_user_email && $user_password === $db_user_password){
                        $_SESSION['username'] = $db_user_email;
                        $_SESSION['user_responcem'] = $db_user_responcem;
                        $_SESSION['user_responcef'] = $db_user_responcef;
                        header("Location: signup.php?msg=signupmsg");
                    }else{
                      header("Location: index.php?msg=login_failed");
                    }
                }elseif($db_user_status == 1){
                    if($user_email === $db_user_email && password_verify($user_password, $db_user_password)){
                        $_SESSION['username'] = $db_user_email;
                        $_SESSION['user_responcem'] = $db_user_responcem;
                        $_SESSION['user_responcef'] = $db_user_responcef;
                        header("Location: vote.php");
                    }else{
                      header("Location: index.php?msg=login_failed");
                    }
                }
            }else{
                header("Location: index.php?msg=login_failed");
            }
        }
    }
?>