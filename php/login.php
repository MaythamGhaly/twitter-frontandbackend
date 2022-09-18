<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['email'])){
    // Get all parameters using POST method
    $email = $_POST['email'];
    // Hash passowrd before checking it to other passwords, since we've hashed all passwords once the user has registered.
    $password = hash("sha256", $_POST["password"]);
    // Check if this user is registered before
    $query=$mysqli->prepare("SELECT id FROM `users` WHERE email=? AND password=? LIMIT 1");
    $query->bind_param("ss",$email,$password);
    $query->execute();
    $return = $query->get_result();
    $row= mysqli_num_rows($return);
    // Here we have to check whether if the number of rows returned from DataBase is 0 or 1 and create JSON response.
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
}
?>