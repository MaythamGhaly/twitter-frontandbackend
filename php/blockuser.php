<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $other_id=$_POST['other_id'];
    $query= $mysqli->prepare("DELETE FROM `followers` WHERE
    (followers.user_id=? AND followers.user_following=?) OR (followers.user_id=? AND followers.user_following=?)");
    $query->bind_param("ssss",$id,$other_id,$other_id,$id);
    if($query->execute()){
        $query=$mysqli->prepare("INSERT INTO blockers(user_id,user_blocking) values(?,?)");
        $query->bind_param("ss",$id,$other_id);
        if($query->execute()){
            $response=[];
            $response['status']="done";
            echo json_encode($response);
        }
    }
}
?>