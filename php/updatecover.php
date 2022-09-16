<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_POST['id'])){
    // Get all parameters using POST method
    $id = $_POST['id'];
    $cover_picture = $_POST['cover_picture'];

    // Here, we need to get the url of cover image. Hence, we have two case:
        // 1-In case it's a valid path that means we must remove the cover
        // and put the new image with new path according to current time.
        // 2-Another case if it's NA, so we start inserting the new image and update cover url filed in users table.
    $query=$mysqli->prepare("SELECT cover_picture_url FROM `users` WHERE id=? LIMIT 1");
    $query->bind_param("s",$id);
    $query->execute();
    $return = $query->get_result()->fetch_assoc();
    // Here, if image is exist we just need to remove it.
    if($return['cover_picture_url']!='NA'){
        unlink($return['cover_picture_url']);
    }
    // Define new path according to current time
    date_default_timezone_set('Asia/Beirut');
    $current_time = date ("Y-m-d");
    $cover_picture_path="users/".$id."/cover/".strtotime($current_time).".png";
    $cover_picture=base64_decode($cover_picture);
    // Update the cover_picture_url in users table
    $query=$mysqli->prepare("UPDATE `users` SET cover_picture_url=? WHERE id =?");
    $query->bind_param("ss",$cover_picture_path,$id);
    // If both cases, excuting the above query and upload the new image will return cover changed as JSON response
    if($query->execute() && file_put_contents($cover_picture_path, $cover_picture)){
        $response=[];
        $response["status"]='cover changed';
        echo json_encode($response);
    }
}
?>