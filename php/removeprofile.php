<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id = $_POST['id'];

    // Now we have to get what inside profile_picture_url, so, in case the return is NA that means the picture is already removed.
    // Otherwise, it will be a link of the image and we have to delete it
    $query=$mysqli->prepare("SELECT profile_picture_url FROM `users` WHERE id=? LIMIT 1");
    $query->bind_param("s",$id);
    $query->execute();
    $return = $query->get_result()->fetch_assoc();

    // Return already removed if the response is NA
    if($return ['profile_picture_url']=="NA"){
        $response=[];
        $response["status"]='already removed';
        echo json_encode($response);
    // Update field and put NA, then delete the picture from its path
    }else{
        $na="NA";
        $query=$mysqli->prepare("UPDATE `users` SET profile_picture_url =? WHERE id=? LIMIT 1");
        $query->bind_param("ss",$na,$id);
        if($query->execute() && unlink($return['profile_picture_url'])){
            // Return picture profile in case both cases above are done
            $response=[];
            $response["status"]='profile removed';
            echo json_encode($response);
        }
    }
}