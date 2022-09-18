<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];
    $other_id=$_POST['other_id'];

    // Prepare SQL in order to be executed later on
    $query=$mysqli->prepare("DELETE FROM followers WHERE followers.user_id=? and followers.user_following=? LIMIT 1");
    $query->bind_param("ss",$id,$other_id);
    //If the above query is executed, a JSON response will be returned back with status done. 
    if($query->execute()){
        $response=[];
        $response['status']="done";
        echo json_encode($response);
    }
}