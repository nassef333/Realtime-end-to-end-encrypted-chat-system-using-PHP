<?php
session_start();
if(empty($_SESSION['login'])){
    header('Location:login.php');
}
include"../users/messages.php";
include"../users/users.php";

// $idOfFriend = $_GET['id'];

// echo "<pre>";
// var_dump($idOfFriend);



    $reciever_id = $_GET['id'];
    $sender_id = $_SESSION['login']['id'];
    
    $messages = fitchById($sender_id, $reciever_id);



    // echo "<pre>";
    // var_dump($messages);die;
    // var_dump($messages);die;

    // if(isset($_POST['img'])){
    //     $fileTemp = $_FILES['img']['tmp_name']; 
    //     $img = $_FILES['img']['name'];
    //     move_uploaded_file($fileTemp, "../assets/img/".$img);
    // }
    
    if(isset($_POST['message'])) {
        if($_POST['message'] != "") {
        $description = $_POST['message'];
        $img ="NULL";
        sendMessage($sender_id, $reciever_id, $description, $img);
        }
    }


    $useridd = searchUserID($_GET['id']);

    // echo "<pre>";
    // var_dump($useridd);die;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <script type="text/JavaScript">
        function timedRefresh(timeoutPeriod) {
        setTimeout("location.reload(true);",timeoutPeriod);
        }
    </script>
      <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/nucleo-icons.css">
    <link rel="stylesheet" href="../assets/css/nucleo-svg.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/chat.css">
    <title>Main Page</title>
</head>
<body onload="JavaScript:timedRefresh(300000);">
<div class="wrapper">
        <section class="users chat-area">
        <header>
            <div class="content">
                <a href="index.php"  style="padding: 15px 5px 5px 5px;"><i style="font-size: 20px" class="fa fa-arrow-left"></i></a>
                <img width="50px" height="50px" src="../assets/img/<?=$useridd['img']?>" alt="">
                <div class="details">
                    <span><b><?=$useridd['username']?></b></span>
                    <p style="color: green;"><?php if($useridd['status'] == 1)echo('Active Now'); else echo('Offline');?></p>
                </div>
            </div>
            <div class="call">
                <a href="#"><i class="fa-solid fa-phone"></i></a>
                <a href="#"><i class="fa-solid fa-video"></i></a>
            </div>
        </header>
        <div class="chat-box">





        <?php foreach($messages as $message): ?>
            <?php 
                            $msgDate = $message[5];
                            $msgTimeArr = explode(" ", $msgDate);
                            $msgTimeAtSeconds = array_pop($msgTimeArr);
                            $explodeSec = explode(":", $msgTimeAtSeconds);
                            $msgTime = $explodeSec[0].":". $explodeSec[1];
            ?>
            <?php if($message[1] == $sender_id): ?>

            <div class="chat outgoing">
                <div class="details">
                    <?php if($message[4] != "NULL"):?> 
                         <img src="../assets/img/<?=$message[4]?>"  width="100%" height="auto" style="border-radius: 10px" >
                    <?php endif;?>
                <p> <?=$message[3]?> <br><span class="text-left"><?=$msgTime?></span><br></p>

                </div>
            </div>
            <?php else:?>
            <div class="chat incoming">
                <img width="40px"height="40px"  src="../assets/img/<?=$useridd['img']?>" alt="">
                <div class="details">
                <?php if($message[4] != "NULL"):?> 
                         <img src="../assets/img/<?=$message[4]?>"  width="100%" height="auto" style="border-radius: 10px" >
                    <?php endif;?>
                    <p> <?=$message[3]?><br><span class="text-left"><?=$msgTime?></span><br></p>
                </div>
            </div>       
            <?php endif;?>     
        <?php endforeach; ?>    
        </div>
        <div class="text-box">
            <hr>
            <form action="" method="POST" enctype="multipart/form-data" >
                <div class="form-group mx-sm-3 mb-2" height="1rem">
                    <input name="message" type="text" class="form-control" id="" placeholder="Enter a Message..." required>

                    <input name="img" VALUE="NULL" type="file" id="upload" hidden/>
                    <label name="img" value="NULL" for="upload" style="font-size: 20px;"><i style="background: inherit; color: white; font-size: 25px" class="fa fa-paperclip" aria-hidden="true"></i></label>


                    <button type="submit" value="" class="btn btn-primary m-0"><i style="font-size: 30px; background: inherit; color:white" class='fa fa-arrow-right'></i></button>
                </div> 

            </form>
        </div>
        </section>
</div>

</body>
</html>

<?php

