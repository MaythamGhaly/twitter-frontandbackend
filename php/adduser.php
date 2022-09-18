<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_POST['first_name'])){
    // Get all parameters using POST method
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    // Hash passowrd before insert it into users table
    $password = hash("sha256", $_POST["password"]);
    $profile_picture=$_POST['profile_picture'];
    $cover_picture=$_POST['cover_picture'];

    //Here we have to know if this email is existed before,so, in case it's existed we'll insert it in order to avoid duplicates 
    $query=$mysqli->prepare("SELECT COUNT(*) as num FROM `users` WHERE email=? LIMIT 1");
    $query->bind_param("s",$email);
    $query->execute();
    $return = $query->get_result()->fetch_assoc();

    // If the result is 1, so, this email is exsited before. Hence, we have to return is_registered with JSON, otherwise, we have to start filling data.
    if($return['num']==1){
        $response=[];
        $response["status"]='is_registered';
        echo json_encode($response);
    }else{
        // Get the current date and add to attribute created at to be used later on in profile .
        date_default_timezone_set('Asia/Beirut');
        $current_time = date ("Y-m-d");
        // Here we didn't fill profile_picture_url and cover_picture_url since we need to fill them into users folder.
        $query=$mysqli->prepare("INSERT INTO `users`(email,first_name,last_name,username,password,created_at) values(?,?,?,?,?,?)");
        $query->bind_param("ssssss",$email,$first_name,$last_name,$username,$password,$current_time);
        $query->execute();
        // Here we want to get the last id inserted into users table
        $id= mysqli_insert_id($mysqli);
        //Decode pictures  
        $profile_picture=base64_decode($profile_picture);
        $cover_picture=base64_decode($cover_picture);
        // Since users folder is created by default, so, we need to create folder called same as id
        $initial_path="users/".$id;
        mkdir($initial_path, 755);
        // Start creating profile folder,cover folder and tweets that will contain the tweets of this user
        $profile_picture_path=$initial_path."/profile";
        $cover_picture_path=$initial_path."/cover";
        $tweets_path=$initial_path."/tweets";
        mkdir($profile_picture_path, 755);
        mkdir($cover_picture_path, 755);
        mkdir($tweets_path, 755);
        // Rename both profile and cover picture and fill them into their folders respectively
        $profile_picture_path=$profile_picture_path."/".strtotime($current_time).".png";
        $cover_picture_path=$cover_picture_path."/".strtotime($current_time).".png";
        file_put_contents($profile_picture_path, $profile_picture);
        file_put_contents($cover_picture_path, $cover_picture);
        //Now, we have the path. Hence, we have to update profile_picture_url and  cover_picture_url into users table
        $query=$mysqli->prepare("UPDATE `users` SET profile_picture_url=?,cover_picture_url=? WHERE id = ?");
        $query->bind_param("sss",$profile_picture_path,$cover_picture_path,$id);
        $query->execute();
        // Once these steps done, we have to return a JSON response containing status and id
        $response=[];
        $response["status"]='done';
        $response["id"]=$id;
        echo json_encode($response);
    }//End of else
}//End of isset method
    ?>