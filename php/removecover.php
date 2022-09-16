<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// if(isset($_POST['id'])){
    // $id = $_POST['id'];
    $id=18;
    $query=$mysqli->prepare("SELECT cover_picture_url FROM `users` WHERE id=? LIMIT 1");
    $query->bind_param("s",$id);
    $query->execute();
    $return = $query->get_result()->fetch_assoc();
    echo $return ['cover_picture_url'];
    if($return ['cover_picture_url']=="NA"){
        $response=[];
        $response["status"]='already removed';
        echo json_encode($response);
    }else{
        $na="NA";
        $query=$mysqli->prepare("UPDATE `users` SET cover_picture_url =? WHERE id=? LIMIT 1");
        $query->bind_param("ss",$na,$id);
        // if($query->execute() && rmdir($return['cover_picture_url'])){
        if($query->execute() &&  unlink($return['cover_picture_url'])){
           
            $response=[];
            $response["status"]='cover removed';
            echo json_encode($response);
        }

    }
// }