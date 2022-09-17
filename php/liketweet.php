<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];
    $tweet_id=$_POST['tweet_id'];
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");

    // Prepare SQL in order to be executed later on
    $query=$mysqli->prepare("INSERT INTO `tweets_likes`(created_at,tweet_id,user_id) values(?,?,?)");
    $query->bind_param("sss",$current_time,$tweet_id,$id,);
    // Here we have two cases of the query has been excuted:
        // 1-First case is that this user hasn't liked this tweet before. Hence, we must return with liked
        // 2-Second case is that this user has liked this tweet before, and since user_id and tweet_id are primary keys
        // So,we must retun status as already like through JSON response
    $response=[];
    if($query->execute()){
        $response['status']="liked";
    }else{
        $response['status']="already liked";
    }
    echo json_encode($response);
}
?>