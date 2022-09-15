<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
$first_name='Mahdi';
$last_name='Doe';
$username='@Mahdi';
$email="mahdi@gmail.com";
$password='test';

$query=$mysqli->prepare("SELECT COUNT(*) as num FROM `users` WHERE email=? LIMIT 1");
$query->bind_param("s",$email);
$query->execute();
$return = $query->get_result()->fetch_assoc();
// echo $return['num'];
if($return['num']==1){
    $response=[];
    $response["status"]='is_registered';
    echo json_encode($response);
}else{
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");
    $query=$mysqli->prepare("INSERT INTO `users`(email,first_name,last_name,username,password,created_at) values(?,?,?,?,?,?)");
    $query->bind_param("ssssss",$email,$first_name,$last_name,$username,$password,$current_time);
    $query->execute();
    $id= mysqli_insert_id($mysqli);
    echo $id;
}
// $array=$query1->get_result();
// // Create Json response
// $response=[];
// while($a = $array->fetch_assoc()){
//     $response[]= $a;
//     echo $a['num'];
// }
// // Print json response
// echo json_encode($response);
?>