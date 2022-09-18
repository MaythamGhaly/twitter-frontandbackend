<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_POST['id'])){
    //Get all parameters using POST method 
    $id=$_POST['id'];
    $text=$_POST['text'];
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");
    // The below query will add the text to tweets table into DataBase
    $query=$mysqli->prepare("INSERT INTO tweets(text,created_at,user_id) VALUES(?,?,?)");
    $query->bind_param("sss",$text,$current_time,$id);
    
    $response=[];
    // In case the above query has been executed, the JSON response must contain the id of last tweet uploaded.
    // Otherwise, an error will be returned with JSON response also
    if($query->execute()){
        $tweet_id= mysqli_insert_id($mysqli);
        $response['status']="done";
        $response['tweet_id']=$tweet_id;
    }else{
        $response['status']="fail";
    }
    echo json_encode($response);

}
?>