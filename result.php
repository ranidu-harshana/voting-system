<?php include("db.php"); ?>
<?php
    $query = "SELECT * FROM nominees";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("QUERY FAILED " . mysqli_error($connection));
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $nominees_name = $row['nominees_name'];
            $count_query = "SELECT COUNT(*) FROM users WHERE user_responcef = '{$nominees_name}' or user_responcem = '{$nominees_name}'";
            $count_query_result = mysqli_query($connection, $count_query);
            if($count_query_result){
                $count_row = mysqli_fetch_assoc($count_query_result);
                $count = $count_row['COUNT(*)'];

                $r=mysqli_query($connection, "UPDATE nominees SET vote_count = '{$count}' WHERE nominees_name = '{$nominees_name}'");
                if(!$r){
                    die("F" . mysqli_error($connection));
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <table border='1' style="color:white;">
            <tr>
                <th>Male Representative</th>
                <th>Vote Count</th>
            </tr>
            <?php
                $selet_nominee_male = "SELECT * FROM nominees WHERE nominee_gender = 'male' ORDER BY vote_count DESC LIMIT 5";
                $selet_nominee_fmale = "SELECT * FROM nominees WHERE nominee_gender = 'female' ORDER BY vote_count DESC LIMIT 5";
                $res_male = mysqli_query($connection, $selet_nominee_male);
                $res_fmale = mysqli_query($connection, $selet_nominee_fmale);

                if($res_male && $res_fmale){
                    while($selet_nominee_rowm = mysqli_fetch_assoc($res_male)){
                        $nominees_namem = $selet_nominee_rowm['nominees_name'];
                        $vote_countm = $selet_nominee_rowm['vote_count'];
                        echo "<tr>";
                        echo    "<td>$nominees_namem</td>";
                        echo    "<td>$vote_countm</td>";
                        echo "</tr>";
                    }
                    ?>
                         <tr>
                            <th>Female Representative</th>
                            <th>Vote Count</th>
                        </tr>
                    <?php
                    if(mysqli_num_rows($res_fmale)){
                        while($selet_nominee_rowf = mysqli_fetch_assoc($res_fmale)){
                            $nominees_namef = $selet_nominee_rowf['nominees_name'];
                            $vote_countf = $selet_nominee_rowf['vote_count'];
                            echo "<tr>";
                            echo    "<td>$nominees_namef</td>";
                            echo    "<td>$vote_countf</td>";
                            echo "</tr>";
                        }
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>