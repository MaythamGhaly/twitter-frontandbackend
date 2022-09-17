<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
include("connection.php");

if(isset($_GET['id'])){
    // Get all parameters using GET method
    $id=$_GET['id'];
    $other_id=$_GET['other_id'];

    // We don't need all data, we only need data that everyone can see. hence, we shouldn't return sensitive data like passowrd,email ...
    $query=$mysqli->prepare("SELECT `users`.first_name,`users`.last_name,`users`.username,`users`.profile_picture_url,`users`.cover_picture_url,`users`.created_at, 
    COUNT( CASE WHEN `followers`.user_id = ? THEN 1 END ) AS following,
    COUNT( CASE WHEN `followers`.user_following = ? THEN 1 END ) AS followers 
    FROM users,followers
    WHERE `users`.`id`=? LIMIT 1");
    $query->bind_param("sss",$id,$id,$other_id);
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
    // Now, we are getting data of the each tweet's data
    $query=$mysqli->prepare("SELECT tweets.id,tweets.text,tweets.created_at
    FROM tweets
    WHERE tweets.user_id=? ORDER BY created_at DESC");
    $query->bind_param("s",$other_id);
    $query->execute();
    $array_tweets=$query->get_result();

    while($a = $array_tweets->fetch_assoc()){
        $response_tweets_data['id']=$a['id'];
        $response_tweets_data['text']=$a['text'];
        $response_tweets_data['created_at']=$a['created_at'];

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
        $response_tweets[]=$response_tweets_data;
    }
    // Put the prepared data into the JSON response (same as first name, last name...)
    $response['tweets']=$response_tweets;
    // After the above operations, we need to get the relation between id and other id.
    // Hence, if user is visiting his profile, so, the relation will be nothing.
    // Another case, if user is visiting another profile, here we have to show 4 cases:
        // 1-if first user is following the other user, so, the response must be 'following'.
        // 2-if first user is followed by the other user, so, the response must be 'follows you'.
        // 3-if both first user and other user follow each other, so, the response must be 'friends'.
        // 4-if neither first user is following the other user nor vice versa, so, the response must be 'not friends'.
    $query = $mysqli->prepare('SELECT * from followers WHERE (followers.user_id=? or followers.user_id=?) and(followers.user_following=? or followers.user_following=?) LIMIT 2');    
    $query->bind_param("ssss",$id,$other_id,$id,$other_id);
    $query->execute();
    $return=$query->get_result();
    $row= mysqli_num_rows($return);

    // If first id is equal to other id that means the user is visiting his profile
    if($id==$other_id){
        $response['relation']='same profile';
    // if the return number is 0 that means they don't follow each other
    }else if($row==0){
        $response['relation']='not firends';
    // if the return number is 1 that means the first id user following the second user or vice versa
    }else if($row==1){
        $return=$return->fetch_assoc();
        // Here, the first user is following second user
        if($return['user_id']==$id){
            $response['relation']='following';
        // Here, the first user is following second user
        }else{
            $response['relation']='follows you';
        }
    // if the return number is 2 that means they are following each other
    }else{
        $response['relation']='friends';
    }
    echo json_encode($response);
}