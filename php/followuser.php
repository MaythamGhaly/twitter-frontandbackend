<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];
    $other_id=$_POST['other_id'];
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");

    // Prepare SQL in order to be executed later on
    $query=$mysqli->prepare("INSERT INTO followers(user_id,user_following,created_at) values(?,?,?)");
    $query->bind_param("sss",$id,$other_id,$current_time);
    // Here we have two cases: if the above query has been executed, so, we have to return done with JSON response.
    // Otherwise, the query will never be executed since user_id and user_following are primary key, so, first user is already following second user.
    
    $response=[];
    if($query->execute()){
        $response['status']="done";
    }else{
        $response['status']="already following";
    }
    echo json_encode($response);
}