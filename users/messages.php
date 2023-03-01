<?php

function sendMessage($sender_id, $reciever_id, $description, $img) {
    $connection = mysqli_connect("localhost","root","","nigochat");
    mysqli_query($connection, "INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `description`, `img`, `time`) VALUES (NULL, '$sender_id', '$reciever_id', '$description', '$img', current_timestamp())");
    return mysqli_affected_rows($connection);
}

function fitchById($sender_id, $reciever_id){
    $connection = mysqli_connect("localhost","root","","nigochat");
    $res = mysqli_query($connection, "SELECT * FROM `messages` WHERE `sender_id` = '$sender_id' AND `reciever_id` = '$reciever_id' OR `sender_id` = '$reciever_id' AND `reciever_id` = '$sender_id'");
    return mysqli_fetch_all($res);
}

function getLastMessage($sender_id, $reciever_id){
    $connection = mysqli_connect("localhost","root","","nigochat");
    $res = mysqli_query($connection, "SELECT `description` FROM `messages` WHERE (`sender_id` = '$sender_id' && `reciever_id` = '$reciever_id')  OR (`sender_id` = '$reciever_id' && `reciever_id` = '$sender_id')");
    $result = mysqli_fetch_all($res);
    return array_pop($result);
}

function updating(){
    $connection = mysqli_connect("localhost","root","","nigochat");
    mysqli_query($connection, "UPDATE messages SET lastname='Doe' WHERE id=2");
}








