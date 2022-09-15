<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_GET['id'])){
    // Get id using GET method
    $id=$_GET['id'];

    // We don't need all data, we only need data that everyone can see.
    $query=$mysqli->prepare("SELECT first_name,last_name,username,profile_picture_url,cover_picture_url,created_at FROM users WHERE id=? LIMIT 1");
    $query->bind_param("s",$id);
    $query->execute();
    $array=$query->get_result()->fetch_assoc();
    // Create Json response and return it
    $response=[];
    $response[]= $array;
    echo json_encode($response);
}