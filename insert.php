<?php ob_start(); ?>

<?php include("db.php"); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="number">
        <input type="submit" name="submit">
    </form>
    <?php
        if(isset($_SESSION['username'])){
            echo $_SESSION['user_responcef'];
        }
    ?>
</body>
</html>


<?php
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    if(isset($_POST['submit'])){
        $number = $_POST['number'];
        $password = generateRandomString();
        $concat = "cst19" . $number . "@std.uwu.ac.lk";
        $query = "INSERT INTO users(user_email, user_password) VALUES('{$concat}', '{$password}')";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("FAILED " . mysqli_error($connection));
        }
    }
?>