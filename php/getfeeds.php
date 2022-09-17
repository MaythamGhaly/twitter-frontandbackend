<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query=$mysqli->prepare("SELECT DISTINCT tweets.id,tweets.text,tweets.created_at,tweets.user_id
     FROM tweets,followers
     WHERE tweets.user_id IN 
     (SELECT followers.user_id from followers WHERE followers.user_id=?)
     OR tweets.user_id IN
     (SELECT followers.user_id from followers WHERE followers.user_following=?)");

    $query->bind_param("ss",$id,$id);
    $query->execute();
    $array=$query->get_result();
     $resonse_tweets=[];
     $response=[];
     while($a=$array->fetch_assoc()){
        $resonse_tweets['tweets.id']=$a['tweets.id'];
        $resonse_tweets['tweets.text']=$a['tweets.text'];
        $resonse_tweets['tweets.created_at']=$a['tweets.created_at'];
        $resonse_tweets['tweets.user_id']=$a['tweets.user_id'];
     }
     $response['tweets']=$resonse_tweets;
     echo json_encode($response);
// }
// SELECT DISTINCT tweets.id,tweets.text,tweets.created_at,tweets.user_id
// FROM tweets,followers
// WHERE tweets.user_id IN 
// (SELECT followers.user_id from followers WHERE followers.user_id=1)
// OR tweets.user_id IN
// (SELECT followers.user_id from followers WHERE followers.user_following=1)
?>
