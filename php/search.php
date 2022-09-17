<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if($_GET['id']){
    $id=$_GET['id'];
    $keyword=$_GET['keyword'];
    $keyword="%".$keyword."%";
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
    $array_pictures=$query->get_result();
    $response=[];
    while($a = $array_pictures->fetch_assoc())
    {
        $response[]=$a;
    }
    echo json_encode($response);

    // SELECT DISTINCT users.id,users.first_name,users.last_name,users.username,users.profile_picture_url
    // FROM users,blockers
    // WHERE (users.first_name LIKE '%e%' OR users.last_name LIKE '%e%' OR users.username LIKE '%e%') AND
    // (users.id NOT IN 
    //     (SELECT blockers.user_id FROM blockers WHERE blockers.user_id =users.id AND blockers.user_blocking=1)
    // )
// TODO:
// SELECT DISTINCT users.id,users.first_name,users.last_name,users.username,users.profile_picture_url
// FROM users,blockers
// WHERE (users.first_name LIKE '%e%' OR users.last_name LIKE '%e%' OR users.username LIKE '%e%') AND
// (users.id NOT IN 
//     (SELECT blockers.user_id FROM blockers WHERE blockers.user_id =users.id AND blockers.user_blocking=1)) AND
//     (users.id NOT IN
//     (SELECT blockers.user_blocking FROM blockers WHERE blockers.user_id=1 AND blockers.user_blocking=users.id)
//     )
}
?>