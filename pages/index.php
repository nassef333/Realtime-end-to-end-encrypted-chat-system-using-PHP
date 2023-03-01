

<?php
session_start();
if(empty($_SESSION['login'])){
    header('Location:login.php');
}

include"../users/messages.php";
include"../users/users.php";

// echo"<pre>";
// var_dump($_SESSION['login']);die;

// var_dump(getLastMessage(5, 16));



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="../assets/css/nucleo-icons.css">
    <link rel="stylesheet" href="../assets/css/nucleo-svg.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/users.css">
    <title>Main Page</title>
</head>
<body>
    <div class="wrapper">
        <section class="users">
        <header>
            <div class="content">
                <img src="../assets/img/<?=$_SESSION['login']['img'];?>" alt="">
                <div class="details">
                    <span><b><?=$_SESSION['login']['username'];?></b></span>
                    <p style="color: green;">Active Now</p>
                </div>
            </div>
            <a class="logout btn btn-danger" href="logout.php">LOG OUT</a>
        </header>
        <div class="search">
            <span class="text form-search">Select an user to start chat</span>
            <input class="form-control mr-sm-2" type="search" placeholder="Enter name to search...">
            <button class="btn btn-success my-2 p-2" type="submit">Search</button>
        </div>
        <?php 
        $users = getallUsers();
            // echo"<pre>";
            // var_dump($users);die;
            ?>
        <div class="users-list">

        

            <?php foreach($users as $user): ?>
                <?php if ($user[0] != $_SESSION['login']['id']): ?>
                <a href="chat.php?id=<?=$user[0]?>" >
                    <div class="content">
                        <img src="../assets/img/<?=$user[4]?>" alt="">
                        <div class="status-dot" style="background:<?php if($user[5] == 1)echo('greed'); else echo('red');?>;position:relative; right: 12px;"></div>

                        <div class="details">
                            <span><b><?=$user[1]?></b></span>
                            <p><?php 
                            if(empty(getLastMessage($user[0], $_SESSION['login']['id'])[0])){
                                echo"NO MESSAGES YET";
                            } 
                            if(!empty(getLastMessage($user[0], $_SESSION['login']['id'])[0])){
                                echo(getLastMessage($user[0], $_SESSION['login']['id'])[0]); 
                            }
                            ?></p>
                        </div>
                        
                    </div>
                </a>
                <?php endif; ?>
            <?php endforeach; ?>
            

        </div>


        </section>
    </div>
</body>
</html>



