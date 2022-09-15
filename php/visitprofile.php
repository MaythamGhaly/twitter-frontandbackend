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
    $array=$query->get_result()->fetch_assoc();
    // Create JSON response and return profile data of this user
    $response=[];
    $response["first_name"]= $array['first_name'];
    $response["last_name"]= $array['last_name'];
    $response["profile_picture_url"]= $array['profile_picture_url'];
    $response["cover_picture_url"]= $array['cover_picture_url'];
    $response["created_at"]= $array['created_at'];

    // Now, we have to add to JSON response his tweets, their numbers and their pictures.
    $response_tweets1=[];
    $response_tweets=[];
    $query=$mysqli->prepare("SELECT tweets.id,tweets.text,tweets.created_at,COUNT(tweets.id) as likes FROM tweets,tweets_likes WHERE tweets.user_id=? AND tweets.id=tweets_likes.tweets_id GROUP BY tweets.id");
    $query->bind_param("s",$id);
    $query->execute();
    $array=$query->get_result();
    while($a = $array->fetch_assoc()){
        // $response_tweets['id'][]= $a['id'];
        // $response_tweets['text'][]= $a['text'];
        // $response_tweets['created_at'][]= $a['created_at'];
        // // $response_tweets[]=$response_tweets;
        $response_tweets1['id']=$a['id'];
        $response_tweets1['text']=$a['text'];
        $response_tweets1['created_at']=$a['created_at'];
        $response_tweets1['likes']=$a['likes'];
        $response_tweets[]=$response_tweets1;
    }
    // echo json_encode($response_tweets);
    // echo '<br>';
    $response['tweets']=$response_tweets;
    echo json_encode($response);
}