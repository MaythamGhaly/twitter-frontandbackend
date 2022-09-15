<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// if(isset($_POST['id'])){

    // $username=$_POST['username'];
    // $id=$_POST['id'];
    $username = "@houssein1231";
    $id="1";
    $query=$mysqli->prepare("UPDATE `users` SET`users`.username=? WHERE id=?");
    $query->bind_param("ss",$username,$id);
    if($query->execute()){
        echo "done";
    }else{
        echo "fail";
    }
// }