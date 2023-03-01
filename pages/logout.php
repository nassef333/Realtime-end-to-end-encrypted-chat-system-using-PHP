<?php

session_start();

include"../users/messages.php";
include"../users/users.php";

offline($_SESSION['login']['id']);

session_destroy();
header("location:login.php");