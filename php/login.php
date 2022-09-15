<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
// if(isset($_POST['email'])){
    $email = 'mahdi@gmail.com';
    $passwrod='test';
    $query=$mysqli->prepare("SELECT id FROM `users` WHERE email=? AND password=? LIMIT 1");
    $query->bind_param("ss",$email,$passwrod);
    $query->execute();
    $return = $query->get_result();
    $row= mysqli_num_rows($return);
    if($row==0){
        $response=[];
        $response["status"]='not registered';
        echo json_encode($response);
    }else{
        $return=$return->fetch_assoc();
        $response=[];
        $response["status"]='registered';
        $response["id"]=$return['id'];
        echo json_encode($response);
    }




    // }

?>