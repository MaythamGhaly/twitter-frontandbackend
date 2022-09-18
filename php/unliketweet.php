<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];
    $tweet_id=$_POST['tweet_id'];

    // Prepare SQL in order to be executed later on
    $query=$mysqli->prepare("DELETE FROM `tweets_likes` WHERE tweet_id=? AND user_id=? LIMIT 1");
    $query->bind_param("ss",$tweet_id,$id);
    $response=[];
    // In case this query has been executed, we have to return status as unliked with JSON response
    if($query->execute()){
        $response['status']="unliked";
    }
    echo json_encode($response);
}
?>