<?php session_start(); 

if(isset($_SESSION['username'])){
    $_SESSION['username'] = null;
    $_SESSION['user_responcem'] = null;
    $_SESSION['user_responcef'] = null;
    
    header("Location: index.php");
}
?>