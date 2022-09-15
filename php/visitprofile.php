<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_GET['id'])){
    // Get id using GET method
    $id=$_GET['id'];

    // We don't need all data, we only need data that everyone can see. hence, we shouldn't return sensitive data like passowrd,email ...
    $query=$mysqli->prepare("SELECT `users`.first_name,`users`.last_name,`users`.username,`users`.profile_picture_url,`users`.cover_picture_url,`users`.created_at, 
    COUNT( CASE WHEN `followers`.users_id = ? THEN 1 END ) AS following,
    COUNT( CASE WHEN `followers`.user_following = ? THEN 1 END ) AS followers 
    FROM users,followers
    WHERE `users`.`id`=? LIMIT 1");
    $query->bind_param("sss",$id,$id,$id);
    $query->execute();
    $array_profile=$query->get_result()->fetch_assoc();

    // When we want to create JSON response through this page, it will be divided into 2 main info: 
    // 1-General data like first name, last name...
    // 2-All the tweets of this user which is divided into many info:
        // 2-1) General info like text, date of this tweet...
        // 2-2)Every single picture for this tweet wich contains only the url of the picture
    // Create JSON response which will be returned later on
    $response=[];
    $response["first_name"]= $array_profile['first_name'];
    $response["last_name"]= $array_profile['last_name'];
    $response["profile_picture_url"]= $array_profile['profile_picture_url'];
    $response["cover_picture_url"]= $array_profile['cover_picture_url'];
    $response["created_at"]= $array_profile['created_at'];
    $response["following"]= $array_profile['following'];
    $response["followers"]= $array_profile['followers'];
    // Now, we have to add to JSON response user's tweets, their numbers and their pictures.
    // response_tweets_data is the array containing all the data about each tweet
    $response_tweets_data=[];
    // response_tweets is the array containing all the data about all tweets
    $response_tweets=[];
    // Now, we are getting data of the tweets in addition to the number of likes of each form another table which is tweets_likes.
    $query=$mysqli->prepare("SELECT tweets.id,tweets.text,tweets.created_at,COUNT(tweets.id) as likes ,COUNT( CASE WHEN tweets_likes.users_id = ? THEN 1 END ) AS liked FROM tweets,tweets_likes WHERE tweets.user_id=? AND tweets.id=tweets_likes.tweets_id GROUP BY tweets.id ORDER BY tweets.created_at DESC");
    $query->bind_param("ss",$id,$id);
    $query->execute();
    $array_tweets=$query->get_result();
    while($a = $array_tweets->fetch_assoc()){
        $response_tweets_data['id']=$a['id'];
        $response_tweets_data['text']=$a['text'];
        $response_tweets_data['created_at']=$a['created_at'];
        $response_tweets_data['likes']=$a['likes'];
        $response_tweets_data['liked']=$a['liked'];
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
        $response_tweets[]=$response_tweets_data;
    }
    // Put the prepared data into the JSON response (same as first name, last name...)
    $response['tweets']=$response_tweets;
    echo json_encode($response);
}