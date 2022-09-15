<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_GET['id'])){
    // Get id using GET method
    $id=$_GET['id'];

    // We don't need all data, we only need data that everyone can see. hence, we shouldn't return sensitive data like passowrd,email ...
    $query=$mysqli->prepare("SELECT first_name,last_name,username,profile_picture_url,cover_picture_url,created_at FROM users WHERE id=? LIMIT 1");
    $query->bind_param("s",$id);
    $query->execute();
    $array_data=$query->get_result()->fetch_assoc();
    // Create JSON response and return profile data of this user
    $response=[];
    $response["first_name"]= $array_profile_data['first_name'];
    $response["last_name"]= $array_profile_data['last_name'];
    $response["profile_picture_url"]= $array_profile_data['profile_picture_url'];
    $response["cover_picture_url"]= $array_profile_data['cover_picture_url'];
    $response["created_at"]= $array_profile_data['created_at'];

    // Now, we have to add to JSON response his tweets, their numbers and their pictures.
    // $response_tweets=[];
    echo json_encode($response);
}