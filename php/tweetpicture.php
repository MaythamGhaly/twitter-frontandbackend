<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $tweet_id=$_POST['tweet_id'];
    $picture=$_POST['picture'];
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d H:m:s");
    $picture=base64_decode($picture);
    $path="users/".$id."/tweets/".$tweet_id;
    if(!file_exists($path)){
        mkdir($path, 755);
    }

    $path=$path."/".strtotime($current_time).".png";
    file_put_contents($path, $picture);

    $query=$mysqli->prepare("INSERT INTO tweets_pictures(picture_url,tweets_id) VALUES(?,?)");
    $query->bind_param("ss",$path,$tweet_id);
    $response=[];
    if($query->execute()){
        $response['status']="done";
    }else{
        $response['status']="fail";
    }
    echo json_encode($response);

}
?>