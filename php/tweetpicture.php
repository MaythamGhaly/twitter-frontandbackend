<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];
    $tweet_id=$_POST['tweet_id'];
    $picture=$_POST['picture'];
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d H:m:s");

    // decode image
    $picture=base64_decode($picture);
    // Here, we are creating the path of the picture
    $path="users/".$id."/tweets/".$tweet_id;
    // In case the path not exist, so, this is the first picture of the tweet.
    // Otherwise, it will never enter the below block.
    if(!file_exists($path)){
        mkdir($path, 755);
    }
    // Final path of image
    $path=$path."/".strtotime($current_time).".png";
    // Put image into the folder
    file_put_contents($path, $picture);

    // Insert the path into tweets_pictures into Database
    $query=$mysqli->prepare("INSERT INTO tweets_pictures(picture_url,tweets_id) VALUES(?,?)");
    $query->bind_param("ss",$path,$tweet_id);
    $response=[];
    // In case the below query executed, so, we have to retun status as done. Otherwise, we have to return fail sith JSON response.
    if($query->execute()){
        $response['status']="done";
    }else{
        $response['status']="fail";
    }
    echo json_encode($response);
}
?>