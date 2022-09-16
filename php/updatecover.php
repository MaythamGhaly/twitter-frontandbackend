<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $cover = $_POST['id'];
    $query=$mysqli->prepare("SELECT cover_picture_url FROM `users` WHERE id=? LIMIT 1");
    $query->bind_param("s",$id);
    $query->execute();
    $return = $query->get_result()->fetch_assoc();
    echo $return['cover_picture_url'];
    if($return['cover_picture_url']!='NA'){
        unlink($return['cover_picture_url']);
    }
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");
    $cover_picture_path="users/".$id."/cover/".strtotime($current_time).".png";
    $cover_picture=base64_decode($cover_picture);
    
    $query=$mysqli->prepare("UPDATE `users` SET cover_picture_url=? WHERE id =?");
    $query->bind_param("ss",$cover_picture_path,$id);
    if($query->execute() && file_put_contents($cover_picture_path, $cover_picture)){
        $response=[];
        $response["status"]='cover changed';
        echo json_encode($response);
    }
}
?>