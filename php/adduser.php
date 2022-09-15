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
$profile_picture='';
$cover_picture='';
      $image = "/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAFA3PEY8MlBGQUZaVVBfeMiCeG5uePWvuZHI////////
////////////////////////////////////////////2wBDAVVaWnhpeOuCguv/////////////
////////////////////////////////////////////////////////////wAARCAEsASwDASIA
AhEBAxEB/8QAGQABAQADAQAAAAAAAAAAAAAAAAECAwQF/8QAKhABAQACAQMEAQQBBQAAAAAAAAEC
EQMhMUEEElFhMhMjM5FxFCJCUoH/xAAXAQEBAQEAAAAAAAAAAAAAAAAAAQID/8QAGhEBAQEBAQEB
AAAAAAAAAAAAAAERMQISIf/aAAwDAQACEQMRAD8A4gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAWS26gIN2PD/2v/jZMZj2jN9Rcc8wyvaVlOLL6bxPpcaf0cvmJ+jl9N4n1THP
ePKeGNmu7qLJe82v0Y5Buy4Z/wAf6arLLqtS6ziAKAAAAAAAAAAAAAAAAAAAAAAALJu6gLjjcrqO
jHCYzp/aYY+2a8+WTna1IAIoLraAAAAAJljMp1UBzZY3G6rF054+6a8+HPZqukus2IAqAAAAAAAA
AAAAAAAAAAAADbw49fd8NTpwmsJE9X8WMgJ1c2hsw4t9cujPj49db3ZmBJJNSNPJh7budm4s3NVR
yjPPD236YIAAAADTzY6vunluTOe7GxZcpXKA6MAAAAAAAAAAAAAAAAAAAALjN5SOpz8f5xvY9NRW
7iw1N3uw4sfdlvxG9FAAFRQTLGZTVac+K49usb1XEcY6ssMcu8YXgnipi60K2/ofbZjhMeyYOUbe
bHV3GoHNlNZWMWfL/JWDrGAAAAAAAAAAAAAAAAAAAAGfF+cb2jj/ADjpwm8pGPXWo38ePtxjIEUA
BQAFBUAVRAAY5z3Y2OZ1Ofkx1kzVcvL/ACVrZ8l3nWDpOMUAAAAAAAAAAAAAAAAAAABZdXbt9P1u
44XZ6L8anpY6qi1GGgAFABQFRQFQRUFHP6nL247dDj9bfxiDlQG2QAAAAAAAAAAAAAAAAAAAB2+j
/jridvo/wqXix01FRloAQUAFAVFAVBAFHF638o7XD6y/uQnSuYBpkAAAAAAAAAAAAAAAAAAAAdfo
r0scjp9Hf99iXix2gMqgCKoigKiqgqCgACOD1d/dd7z/AFN3y0nStIDTIAAAAAAAAAAAAAAAAAAA
A3emuuWfbSz47rPG/ZR6cKmN3IrDaAICooCoKigAAgF7PN5rvlyejndY15mV3lb9rErEBpAAAAAA
AAAAAAAAAAAAAAAAHpcOXuwlbHm8fLlx3p1nw7eLmxzndizGtbUURUABQAAFQBr5eWceOwTnzmPH
erzmfJyZcl3f6YNSJQBUAAAAAAAAAAAAAAAAAAAAAAFlsu5eqNnDj7uST46g7sdzFnLKSahZK5tg
m7O/WLLKAqAKb0xuXx1Nb60Ddy+o0erx/b/x1dDXzz3cdn0qPOAbZAAAAAAAAAAAAAAAAAAAAAAB
Zjb2lZTjyv0DB2ek49T3Xy0Ti+a7eKy46iVYzAYaEuMqgJ7b8nt+btQCTQugETL8VTLtQeZlNZWf
FRuz4/dnbL3rC8eX1XRhgMrjZ3lYgAAAAAAAAAAAAAALJb2Z44ecv6bAaZhlfDKcV81sAYzjx/yy
mMnaQAUQBWWGftrAB2Y5TKbiuTDO410YcuOTFmNazARRYigtrES5Sd6CtXLyeIx5ObfTFp3tqRLV
EGmVSyXvABLhjfDG8U8VmA1Xjv0lxynhuAc425Yb6zu1AAAAAAAM8MfNYybum0FEAUQBRAFEAUQB
TaANmPLlj5bJ6j5jnEyLrp/1E+EvqPiOcMhrblz5Vhcre9Yi4iiAKIAogCiAKIArDPHzGQDSLZq6
QAAAAGeHyyYzsoKIAogCiAKIAogCiAKIAogCiAKIAogCiAKIAogCiAJnPLBsvWNYAACzuiwGQgCi
AKIAogCiAKIAogCiAKIAogCiAKIAogCiAKIAogCscu6l7AxAAWIAogCiAKIAogCiAKIAogCiAKIA
ogCiAKIAogCiAKIAogCiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP/Z
";
$profile_picture=$image;
$cover_picture=$image;

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
    $profile_picture=base64_decode($profile_picture);
    $cover_picture=base64_decode($cover_picture);
    $initial_path="users/".$id;

    mkdir($initial_path, 755);
    $profile_picture_path=$initial_path."/profile";
    $cover_picture_path=$initial_path."/cover";
    $tweets_path=$initial_path."/tweets";

    mkdir($profile_picture_path, 755);
    mkdir($cover_picture_path, 755);
    mkdir($tweets_path, 755);
    
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