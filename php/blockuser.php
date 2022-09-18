<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id=$_POST['id'];
    $other_id=$_POST['other_id'];
    // The below query will delete the relation between first and seconnd user
    $query= $mysqli->prepare("DELETE FROM `followers` WHERE
    (followers.user_id=? AND followers.user_following=?) OR (followers.user_id=? AND followers.user_following=?)");
    $query->bind_param("ssss",$id,$other_id,$other_id,$id);
    // When above query is executed, these 2 users will added to blockers table into DataBase.
    if($query->execute()){
        $query=$mysqli->prepare("INSERT INTO blockers(user_id,user_blocking) values(?,?)");
        $query->bind_param("ss",$id,$other_id);
        // When both queries are executed, a JSON response with status 'blocked' will be returned back
        $response=[];
        if($query->execute()){
            $response['status']="bocked";
        }else{
            $response['status']="already bocked";
        }
        echo json_encode($response);
    }
}
?>