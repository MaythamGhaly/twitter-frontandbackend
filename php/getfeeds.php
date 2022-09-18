<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");
if(isset($_GET['id'])){
    // Get id using GET method
    $id=$_GET['id'];

    // The below query will get all the tweets for the users who follow each other
    $query=$mysqli->prepare("SELECT DISTINCT tweets.id,tweets.text,tweets.created_at,tweets.user_id
    FROM tweets,followers
    WHERE tweets.user_id IN 
    (SELECT followers.user_id from followers WHERE followers.user_following=?)
    OR tweets.user_id IN
    (SELECT followers.user_following from followers WHERE followers.user_following=?)
    OR tweets.user_id IN
    (SELECT followers.user_id from followers WHERE followers.user_id=?)
    OR tweets.user_id IN
    (SELECT followers.user_following from followers WHERE followers.user_id=?)
    OR tweets.user_id=?
    ORDER BY tweets.created_at DESC
     ");

    $query->bind_param("sssss",$id,$id,$id,$id,$id);
    $query->execute();
    $array=$query->get_result();
    $response=[];
     $response_tweets_data=[];
     $response_tweets=[];
     while($a=$array->fetch_assoc()){
        $response_tweets_data['id']=$a['id'];
        $response_tweets_data['text']=$a['text'];
        $response_tweets_data['created_at']=$a['created_at'];
        $response_tweets_data['user_id']=$a['user_id'];
        
         // Getting the number of likes of each tweet
         $query=$mysqli->prepare("SELECT COUNT(*) as numlikes FROM tweets_likes WHERE tweets_likes.tweet_id=?");
         $query->bind_param("s",$a['id']);
         $query->execute();
         $return=$query->get_result()->fetch_assoc();
         $response_tweets_data['numlikes']=$return['numlikes'];
 
         // Getting if the user that he's visiting the profile has putted a like for a tweet
         $query=$mysqli->prepare("SELECT COUNT(*) as isliked FROM tweets_likes WHERE tweets_likes.tweet_id=? and tweets_likes.user_id=?");
         $query->bind_param("ss",$a['id'],$id);
         $query->execute();
         $return=$query->get_result()->fetch_assoc();
 
         if($return['isliked']==0){
             $response_tweets_data['isliked']='notliked';
         }else{
             $response_tweets_data['isliked']='isliked';
         }

         // Now, we want to get the pictures' urls of every tweet and put them inside response_tweets_data
        $query=$mysqli->prepare("SELECT picture_url FROM tweets_pictures WHERE tweets_id=?");
        $query->bind_param("s",$a['id']);
        $query->execute();
        $array_pictures=$query->get_result();
        // picture_url is the array that will contains all pictures' urls of the tweet
        $picture_url=[];
        while($b=$array_pictures->fetch_assoc()){
               $picture_url[]=$b['picture_url'];
        }
        // Put the pictures array insede response_tweets_data (same as id,text,likes...)
        $response_tweets_data['picture_urls']=$picture_url;
        // Prepare the whole data of this tweet.
        
        // Getting the first name, last name and profile picture of every user match first query
         $query=$mysqli->prepare("SELECT first_name,last_name,profile_picture_url FROM users WHERE users.id=?");
         $query->bind_param("s",$a['user_id']);
         $query->execute();
         $return=$query->get_result()->fetch_assoc();
         $response_tweets_data['first_name']=$return['first_name'];
         $response_tweets_data['last_name']=$return['last_name'];
         $response_tweets_data['profile_picture_url']=$return['profile_picture_url'];
         $response_tweets[]=$response_tweets_data;
     }
     // These data will also be shown in feeds page
     $query=$mysqli->prepare("SELECT first_name,last_name,profile_picture_url FROM users WHERE users.id =?");
     $query->bind_param("s",$id);
     $query->execute();
     $array=$query->get_result()->fetch_assoc();
     $response['first_name']=$array['first_name'];
     $response['last_name']=$array['last_name'];
     $response['profile_picture_url']=$array['profile_picture_url'];
     $response['tweets']=$response_tweets;
     echo json_encode($response);
}
?>