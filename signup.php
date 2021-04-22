<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("db.php"); ?>

<?php
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }else{
        $user_emailsession = $_SESSION['username'];
        $user_emailsession = mysqli_real_escape_string($connection, $user_emailsession);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
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
                  case 'signupmsg':
                    echo "<h4 style='color:green'>";
                    echo 	  "Reset Your Password Here with your own password and log again!";
                    echo "</h4>";
                    break;

                  case 'pass_warning':
                    echo "<h4 style='color:#8a6d3b'>";
                    echo 	"Warning! Password are not matched!.";
                    echo "</h4>";
                    break;
                
                  case 'empty_warning':
                    echo "<h4 style='color:#8a6d3b'>";
                    echo 	"Warning! Fill all fields!.";
                    echo "</h4>";
                    break;

                  default:
                    echo "<h4 style='color:red'>";
                    echo 	"Danger! Adding User Failed!.";
                    echo "</h4>";
                    break;
              }
          }
        ?>
        <h2>Login</h2>
        <p style="color: rgb(255, 255, 255);">Enter Your Username and Password</p>
        <form action="" method="post">
          <div class="inputBox">
            <input type="email" name="user_email" required autocomplete="off" disabled onkeyup="this.setAttribute('value', this.value);"  value="<?php echo $user_emailsession?>">
            <label class="labels">Username</label>
          </div>
          <div class="inputBox">
            <input type="password" name="user_password" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);" value="">
            <label class="labels">Passward</label>
          </div>
          <div class="inputBox">
            <input type="password" name="user_cpassword" required autocomplete="off" onkeyup="this.setAttribute('value', this.value);" value="">
            <label class="labels">Confirm Passward</label>
          </div>
          <input type="submit" name="submit" value="Signup">
        </form>
      </div>
</body>
</html>

<?php
  if(isset($_POST['submit'])){
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_cpassword = $_POST['user_cpassword'];

    if (!empty($user_password) && !empty($user_cpassword)) {
        if($user_password === $user_cpassword){
            $user_email = mysqli_real_escape_string($connection, $user_email);
            $user_password = mysqli_real_escape_string($connection, $user_password);
            
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            $insert_user = "UPDATE users SET user_password = '{$user_password}', user_status = 1 WHERE user_email = '{$user_emailsession}'";
            $insert_user_query = mysqli_query($connection, $insert_user);
            if ($insert_user_query) {
                header("Location: index.php");
            }else {
                header("Location: signup.php?msg");
            }
        }else{
            header("Location: signup.php?msg=pass_warning");
        }
    }else{
        header("Location: signup.php?msg=empty_warning");
    }
  }
?>