<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
// Get all parameters using POST method
    $password = hash("sha256", $_POST["password"]);
    $id=$_POST['id'];
    
    $query=$mysqli->prepare("UPDATE `users` SET `users`.password=? WHERE id=?");
    $query->bind_param("ss",$password,$id);
    $response=[];
    // In case the query is executed, we have to return done, otherwise, we have to return error
    if($query->execute()){
        $response["status"]='done';
    }else{
        $response["status"]='error';
    }
    echo json_encode($response);
}