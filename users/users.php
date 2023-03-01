<?php

function createuser($username, $email, $password, $img){
    $connection = mysqli_connect("localhost","root","","nigochat");
    mysqli_query($connection, "Insert into users (`username`, `email`, `password`, `img`) Values ('$username', '$email', '$password', '$img')");
    return mysqli_affected_rows($connection);
}

function online($id){
    $connection = mysqli_connect("localhost","root","","nigochat");
    mysqli_query($connection, "UPDATE `users` SET `status` = '1' where `id` = $id");
}

function offline($id){
    $connection = mysqli_connect("localhost","root","","nigochat");
    mysqli_query($connection, "UPDATE `users` SET `status` = '0' where `id` = $id");
}

function searchUser($reciever_id){
    $connection = mysqli_connect("localhost","root","","nigochat");
    $result = mysqli_query($connection, "select * from `users` where `email` = '$reciever_id'");
    return mysqli_fetch_assoc($result);
}

function searchUserID($reciever_id){
    $connection = mysqli_connect("localhost","root","","nigochat");
    $result = mysqli_query($connection, "select * from `users` where `id` = '$reciever_id'");
    return mysqli_fetch_assoc($result);
}

function getallUsers(){
    $connection = mysqli_connect("localhost","root","","nigochat");
    $result = mysqli_query($connection, "select * from `users` ");
    return mysqli_fetch_all($result);
}
