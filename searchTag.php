<html>
<head>
    <link rel="stylesheet" href=".\css\home.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<body>

    <?php
    session_start();
    require_once("dbconnect.php");
    //$tag=$_POST['tag'];
    $tag = "%{$_POST['tag']}%";
    $username=$_GET['username'];
    $mysqli =dbconnect();
    $query = $mysqli->prepare("SELECT DISTINCT pin.pin_id,pin.pin_name,image FROM pin,tag WHERE pin.pin_id = tag.pin_id AND tag.tag LIKE ?");
    $query->bind_param('s', $tag);
    $query->execute();
    /*$query->bind_result($image);
            while($query->fetch()) {
                echo '<img  width ="300" height="300" src="data:image/jpeg;base64,'.base64_encode( $image ).'" />';
            }
    */
    $pins = $query->get_result();
    foreach($pins as $row){
        //echo $row['pin_name'];
        echo '
                    <div class = "friendBox">
                        <a target="_top" href="javascript:void(0)" onclick="window.open(\'pin.php?username='.$username.'&pin_id='.$row['pin_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=700, width=800\')">
                        <div class="top">'.$row['pin_name'].'</div>
                        <div class="middle">
                            <img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="250" width="250" />
                        </div>
                        </a>
                        <div class="bottom">
                            <a target="_top" href="javascript:void(0)" onclick="window.open(\'pinIt.php?username='.$username.'&pin_id='.$row['pin_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=380, width=380\')">Pin It!</a>
                        </div>
                    </div>';
    }

    //for pinboards

    $boardQuery = $mysqli->prepare("SELECT DISTINCT username as boardOwner,pinboard_name,pinboard_id FROM pinboard WHERE pinboard_name LIKE ?");
    $boardQuery->bind_param('s', $tag);
    $boardQuery->execute();
    $board = $boardQuery->get_result();
    foreach($board as $row){
        //echo $row['pin_name'];
        echo '
                    <div class = "friendBox">
                        <a target="_top" href="javascript:void(0)" onclick="window.open(\'pins.php?username='.$username.'&pinboard_id='.$row['pinboard_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=700, width=800\')">
                        <div class="top">Pinboard :  '.$row['pinboard_name'].'</div>
                        <div class="middle">
                            <img src="./images/train.jpg" height="250" width="250" />
                        </div>
                        </a>

                    </div>';
    }


 ?>

</div>
</body>
</html>