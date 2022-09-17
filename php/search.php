<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if($_GET['id']){
    // Get all parameters using GET method
    $id=$_GET['id'];
    $keyword=$_GET['keyword'];
    // Add % before and after keyword since we want the aproximately matches from table users.
    $keyword="%".$keyword."%";
    // The query below will get some data about users but without existing a user with searching user in blockers table.
    $query=$mysqli->prepare("SELECT DISTINCT users.id,users.first_name,users.last_name,users.username,users.profile_picture_url
    FROM users,blockers
    WHERE (users.first_name LIKE ? OR users.last_name LIKE ? OR users.username LIKE ?) AND
    (users.id NOT IN 
        (SELECT blockers.user_id FROM blockers WHERE blockers.user_id =users.id AND blockers.user_blocking=?)) AND
        (users.id NOT IN
        (SELECT blockers.user_blocking FROM blockers WHERE blockers.user_id=? AND blockers.user_blocking=users.id)
        )");
    $query->bind_param("sssss",$keyword,$keyword,$keyword,$id,$id);
    $query->execute();
    $array=$query->get_result();
    // After getting some data from table users, we need to get also number of tweets, following and followers of each user.
    $response_data=[];
    $response=[];
    while($a = $array->fetch_assoc())
    {
        $response_data['id']=$a['id'];
        $response_data['first_name']=$a['first_name'];
        $response_data['last_name']=$a['last_name'];
        $response_data['username']=$a['username'];
        $response_data['profile_picture_url']=$a['profile_picture_url'];


        $query = $mysqli->prepare("SELECT COUNT(id) as tweet FROM tweets WHERE tweets.user_id=?");
        $query->bind_param("s",$a['id']);
        $query->execute();
        $return=$query->get_result()->fetch_assoc();
        $response_data['tweet']=$return['tweet'];
        
        
        $query = $mysqli->prepare(" SELECT COUNT( CASE WHEN `followers`.user_id = ? THEN 1 END ) AS following,
        COUNT( CASE WHEN `followers`.user_following = ? THEN 1 END ) AS followers 
        FROM users,followers
        WHERE `users`.`id`=? LIMIT 1");
        $query->bind_param("sss",$a['id'],$a['id'],$a['id']);
        $query->execute();
        $return=$query->get_result()->fetch_assoc();
        $response_data['following']=$return['following'];
        $response_data['followers']=$return['followers'];
        $response[]=$response_data;
    }
    echo json_encode($response);
}
?>