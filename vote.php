<?php ob_start(); ?>
<?php session_start(); ?>
<?php include("db.php"); ?>

<?php
    if(!isset($_SESSION['username']) && !isset($_SESSION['user_responcem']) && !isset($_SESSION['user_responcef'])){
        header("Location: index.php");
    }else{
        if($_SESSION['user_responcem'] == "no response" and $_SESSION['user_responcef'] == "no repsonce"){
            $user_responcem = $_SESSION['user_responcem'];
            $user_responcef = $_SESSION['user_responcef'];
        }else{
            header("Location: thanks.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .label1{
            color: aliceblue;
            font-size: 20px;
        }
        * {
        box-sizing: border-box;
        }
        .column {
            float: left;
            width: 100%;
            padding: 10px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        select, .label1 {
            width: 100%;
            font-size: 17px;
        }
    </style>
</head>
<body>
        <div class="box">
            <?php 
                if (isset($_GET['votemsg'])) {
                    $votemsg = $_GET['votemsg'];
                    switch ($votemsg) {
                        case 'warn':
                        echo "<h4 style='color:#8a6d3b'>";
                        echo 	"Warning! Voting Failed!.";
                        echo "</h4>";
                        break;
                    
                        default:
                        echo "<h4 style='color:red'>";
                        echo 	"Danger! Voting Failed!.";
                        echo "</h4>";
                        break;
                    }
                }
            ?>
            <h2>Voting</h2>
            <p style="color: rgb(255, 255, 255); text-align: center;">Vote for your colleague</p>
            <form action="" method="post">
                <div class="row">
                    <div class="column">
                        <label class="label1">Male Representative</label>
                    </div>
                    <div class="column">
                        <select name="user_responcem">
                            <option value="no response">Select Male Rep</option>
                            <option value="JINASENA I.U.">JINASENA I.U.</option>
                            <option value="SENARATH R.A.H.R.">SENARATH R.A.H.R.</option>
                            <option value="GUNAWARDHANA G.I.T.">GUNAWARDHANA G.I.T.</option>
                            <option value="JAYALATH J.R.M.H.">JAYALATH J.R.M.H.</option>
                            <option value="HATHNAPITIYA H.G.O.J.">HATHNAPITIYA H.G.O.J.</option>
                            <option value="DILSHAN N.R.">DILSHAN N.R.</option>
                            <option value="SAMARAKOON S.M.N.S.">SAMARAKOON S.M.N.S.</option>
                            <option value="VITHANAGE T.V.T.I.">VITHANAGE T.V.T.I.</option>
                            <option value="YASODHANA G.A.D.">YASODHANA G.A.D.</option>
                            <option value="SAMARASINGHE M.T.S.">SAMARASINGHE M.T.S.</option>
                            <option value="KULATHUNGA L.M.">KULATHUNGA L.M.</option>
                            <option value="RODRIGO A.S.M.">RODRIGO A.S.M.</option>
                            <option value="DASSANAYAKE B.D.M.S.P.">DASSANAYAKE B.D.M.S.P.</option>
                            <option value="HERATH H.R.C.D.">HERATH H.R.C.D.</option>
                            <option value="PERERA K.J.M.">PERERA K.J.M.</option>
                            <option value="BANDARA A.M.G.S.">BANDARA A.M.G.S.</option>
                            <option value="AKALANKA J.K.S.">AKALANKA J.K.S.</option>
                            <option value="HASANKA U.K.D.S.">HASANKA U.K.D.S.</option>
                            <option value="GUNARATHNA D.M.C.D.">GUNARATHNA D.M.C.D.</option>
                            <option value="GODAKUMBURA T.M.">GODAKUMBURA T.M.</option>
                            <option value="DISSANAYAKA M.D.S.">DISSANAYAKA M.D.S.</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label class="label1">Female Representative</label>
                    </div>
                    <div class="column">
                        <select name="user_responcef">
                            <option value="no repsonce">Select Female Rep</option>
                            <option value="PEIRIS W.M.D.M.">PEIRIS W.M.D.M.</option>
                            <option value="RATHNAYAKE R.M.S.A.">RATHNAYAKE R.M.S.A.</option>
                            <option value="DE SILVA D.S.S.">DE SILVA D.S.S.</option>
                            <option value="WEERAKKODY Y.N.">WEERAKKODY Y.N.</option>
                            <option value="RANATHUNGA G.G.U.V.">RANATHUNGA G.G.U.V.</option>
                            <option value="MADHUWANTHI K.W.H.M.I.">MADHUWANTHI K.W.H.M.I.</option>
                            <option value="DISSANAYAKE D.M.T.N.">DISSANAYAKE D.M.T.N.</option>
                            <option value="ANGULGAMUWA A.S.D.">ANGULGAMUWA A.S.D.</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <center><input type="submit" name="submit" value="Vote" style="width: 100%;"></center>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        $user_email = $_SESSION['username'];
        $user_responcem = $_POST['user_responcem'];
        $user_responcef = $_POST['user_responcef'];

        $user_email = mysqli_real_escape_string($connection, $user_email);
        $user_responcem = mysqli_real_escape_string($connection, $user_responcem);
        $user_responcef = mysqli_real_escape_string($connection, $user_responcef);

        $query = "UPDATE users SET user_responcem = '{$user_responcem}', user_responcef = '{$user_responcef}' WHERE user_email='{$user_email}'";
        $result = mysqli_query($connection, $query);

        if(!$result){
            header("Location: vote.php?votemsg=warn");
        }else{
            header("Location: thanks.php");
        }
    }
?>