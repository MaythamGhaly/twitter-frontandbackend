// Define all variables
const name1=document.getElementById("name");
const tweets_number=document.getElementById("tweets_number");;
const cover_photo=document.getElementById("cover_photo");
const Profil_picture=document.getElementById("Profil_picture");
const full_name=document.getElementById("full_name");
const username=document.getElementById("username");
const join_date=document.getElementById("join_date");
const following_number=document.getElementById("following_number");
const follwer_number=document.getElementById("follwer_number");
const follow_button= document.getElementById("follow_button");
const block_button=document.getElementById("block_button");
const back=document.getElementById("arrow")


back.addEventListener("click",() => {
    location.replace("file:///C:/Users/Qitabi/Desktop/twitter-frontandbackend-housseinbranch/twitter-frontandbackend-housseinbranch/twitter-frontandbackend-mathambranch/Feed%20page/index.html");
})

let relation="";
// The below url will be used for the pcitures of every tweet on top left
let profile_url="../Profile page/images/PP.png";
// Fetch all data of the user in one single JSON response
let url = `http://localhost/twitter-frontandbackend/php/visitprofile.php?id=${localStorage.getItem("id")}&other_id=${localStorage.getItem("other_id")}`;
     
    fetch(url)
    .then(respone=>respone.json())
    .then(data=>{
        // relation variable is the relation between first user and other one. Hence we've 4 cases:
        // 1-If thery aren't friends the button's innerText must be follow
        // 2-If 1st user follows 2nd user, the button's innerText must be following
        // 3-If 1st user is followed by 2nd user, the button's innerText must be follow back
        // 4-If thery are following each other, the button's innerText must be friends
        relation=Object.values(data)[9];
            if(relation=="not firends"){
                follow_button.innerText="Follow";
            }else if(relation=="following"){
                follow_button.innerText="Following";
            }else if(relation=="follows you"){
                follow_button.innerText="follow back";
            }else if(relation=="friends"){
                follow_button.innerText="Friends";
            }
               
    name1.innerText=Object.values(data)[0];
    if((Object.values(data)[3])!="NA"){
    // Get cover photo
    // Put try catch exception to avoid them
    try{cover_photo.src="http://localhost/twitter-frontandbackend/php/".concat(Object.values(data)[3]);}
    catch(err){}
}
if((Object.values(data)[2])!="NA"){
    // Get profile photo   
    try{
    Profil_picture.src="http://localhost/twitter-frontandbackend/php/".concat(Object.values(data)[2]);
    profile_url=Profil_picture.src; }
    catch(err){}
}
// Put each data on its place
full_name.innerText=`${Object.values(data)[0]} ${Object.values(data)[1]}`;
username.innerText=`@${Object.values(data)[4]}`;
// Get month name
let toMonthName=(monthNumber)=> {
    const date = new Date(Object.values(data)[5]);
    date.setMonth(monthNumber - 1);
    return date.toLocaleString('en-LB', {
        month: 'long',
    });
    }
// The result of the day will be like : Joined 3, September 2022
const date= Object.values(data)[5];
const array=date.split("-");
join_date.innerText=`Joined ${array[2]},${toMonthName(array[1])} ${array[0]}`;
following_number.innerText=`${Object.values(data)[6]} Following`
follwer_number.innerText=`${Object.values(data)[7]} Followers`

if(Object.values(data)[8].length<=1){
    tweets_number.innerText=`${Object.values(data)[8].length} Tweet`
}else{
    tweets_number.innerText=`${Object.values(data)[8].length} Tweets`
}
let array_tweets=Object.values(data)[8];
    
// Like tweet, so when the response is as 'liked', the color will be red.
let likeTweet=(id,tweet_id,heart)=>{
        let url = "http://localhost/twitter-frontandbackend/php/liketweet.php";
        let parameters = {
            method:'POST',
            body: new URLSearchParams({
                id:id,
                tweet_id:tweet_id
            })
        };
        fetch(url,parameters)
        .then(respone=>respone.json())
        .then(data=>{
            if(Object.values(data)[0]=="liked"){
            heart.innerHTML=Array('\&#10084;&#65039;');
            heart.style.backgroundColor='white';
;                   }
        });}
// Like tweet, so when the response is as unliked, the color will be gray.
let unLikeTweet=(id,tweet_id,heart)=>{
        let url = "http://localhost/twitter-frontandbackend/php/unliketweet.php";
        let parameters = {
            method:'POST',
            body: new URLSearchParams({
                id:id,
                tweet_id:tweet_id
            })
        };
        fetch(url,parameters)
        .then(respone=>respone.json())
        .then(data=>{
            if(Object.values(data)[0]=="unliked"){
            heart.innerHTML=Array('&#128420;');
            heart.style.backgroundColor='wheat';
            }
        });
}
    
// Get the data of each data and start the with appendChild by imagining the block how it could be if it's 
// made through html and start improve it here.
const all_tweets=document.getElementById('all_tweets');
for(let i=0;i<array_tweets.length;i++){
    const id= Object.values(array_tweets[i])[0];
    const text= Object.values(array_tweets[i])[1];
    const date= Object.values(array_tweets[i])[2];
    let num_likes= Object.values(array_tweets[i])[3];
    const isLiked= Object.values(array_tweets[i])[4];
    const array_tweet_pictures= Object.values(array_tweets[i])[5];

    const div_tweet=document.createElement('div');
    div_tweet.classList.add('Tweet');
    const tweet_header=document.createElement('div');
    tweet_header.classList.add('tweet-header');
    const tweet_profile=document.createElement('img');
    tweet_profile.classList.add("tweet-profile");
    const name_date = document.createElement('div');
    name_date.classList.add('name-date');
    const p=document.createElement('p');
    const h6=document.createElement('h6');
    name_date.appendChild(p);
    name_date.appendChild(h6);
    tweet_header.appendChild(tweet_profile);
    tweet_header.appendChild(name_date);
    div_tweet.appendChild(tweet_header);
    const tweet_text=document.createElement('div');
    tweet_text.classList.add('tweet-text');
    const p1=document.createElement('p');
    const images =document.createElement('div');
    images.classList.add('images');

    // The below loop is to fetch all the pictures in al tweets
for(let j=0;j<array_tweet_pictures.length;j++){
    const tweet_img=document.createElement('img');
    tweet_img.classList.add('tweet-img');
    if(array_tweet_pictures[j]!="NA"){
    tweet_img.src="http://localhost/twitter-frontandbackend/php/".concat(array_tweet_pictures[j]);
    images.appendChild(tweet_img);}
}
    tweet_text.appendChild(p1);
    tweet_text.appendChild(images);
    div_tweet.appendChild(tweet_text);
    const likes=document.createElement('div');
    likes.classList.add('likes');
    const heart=document.createElement('span');
    heart.classList.add('heart');
    const p2=document.createElement('p');
    likes.appendChild(heart);
    likes.appendChild(p2);
    div_tweet.appendChild(likes);
    p.innerText=full_name.innerText;
    // Split the date by date, month then year
    h6.innerText=`${date.split("-")[2]}, ${toMonthName(date.split("-")[1])} ${date.split("-")[0]}`;
    if(profile_url!="NA"){
        tweet_profile.src=profile_url;}
    p1.innerText=text;    
        
    if(num_likes<1){
        p2.innerText=`${num_likes} like`;
    }else{
        p2.innerText=`${num_likes} likes`;
    }
    // If the user has liked his tweet so the heart's color wil be red. Otherwise, it will be gray
    if(isLiked=='isliked'){
        heart.innerHTML=Array('\&#10084;&#65039;');
        // we have differentiate the two cases through the background color wich are white and wheat who 
        // are too close to each other. Beacuse, we couldn't differe between them beause of inflexibility
        // of emojis
        heart.style.backgroundColor='white';
    }else{
        heart.innerHTML=Array('&#128420;');
        heart.style.backgroundColor='wheat';
    }
    heart.addEventListener('click',function(){
        if( heart.style.backgroundColor=='wheat'){
            likeTweet(localStorage.getItem("id"),id,heart,p2,num_likes);
            num_likes++;
        }else{
            unLikeTweet(localStorage.getItem("id"),id,heart,p2,num_likes);
            num_likes--;
        }
        p2.innerText=`${num_likes} likes`;
    });
    all_tweets.appendChild(div_tweet) ;
}
});

// Send block request to the server in case 1st user clicked on block button
let blockUser = ()=>{
        let url = "http://localhost/twitter-frontandbackend/php/blockuser.php";
        let parameters = {
            method:'POST',
            body: new URLSearchParams({
                id:localStorage.getItem("id"),
                other_id:localStorage.getItem("other_id")
            })
        };
        fetch(url,parameters)
        .then(respone=>respone.json())
        .then(data=>{
            console.log(data);
            if(Object.values(data)[0]=="blocked"){
                location.replace("file:///C:/Users/Qitabi/Desktop/twitter-frontandbackend-housseinbranch/twitter-frontandbackend-housseinbranch/twitter-frontandbackend-mathambranch/Feed%20page/index.html");
                console.log("done");
            }
        });
}
// In order to avoid orginizing many buttons, and to make the follow idea easier, here we've 4 cases:
// 1- If the innerText of follow button was follow or follow back which mean that 1st user didn't follow 2nd user yet.Hence:
    // a)if 1st user is followed by 2nd user, the follow button's innerText will be follow back and after follow request, the result will be friends
    // b)if 1st and 2nd user aren't friends, the folllow button's innerText will be follow and after follow request, the result will be following sice 2nd user didn't follow 1st user yet.
// 2)If the innerText of follow button was following, when 1st user re-clink on it, a 'unfollow' request will be sent to the server and the result will be follow, since they aren't firends anymore unless someone follow the other one.

let followUser = ()=>{
    if(follow_button.innerText=="Follow" || follow_button.innerText=="follow back"){
        let url = "http://localhost/twitter-frontandbackend/php/followuser.php";
        let parameters = {
            method:'POST',
            body: new URLSearchParams({
                id:localStorage.getItem("id"),
                other_id:localStorage.getItem("other_id")
            })
        };
        fetch(url,parameters)
        .then(respone=>respone.json())
        .then(data=>{
            console.log(data);
            if(Object.values(data)[0]=="done"){
                if(follow_button.innerText=="Follow"){
                    follow_button.innerText="Following";}
                else{
                    follow_button.innerText="Friends";
                }
            }
        });
    }else if(follow_button.innerText=="Following"){
        let url = "http://localhost/twitter-frontandbackend/php/unfollowuser.php";
        let parameters = {
            method:'POST',
            body: new URLSearchParams({
                id:localStorage.getItem("id"),
                other_id:localStorage.getItem("other_id")
            })
        };
        fetch(url,parameters)
        .then(respone=>respone.json())
        .then(data=>{
            console.log(data);
            if(Object.values(data)[0]=="done"){
                follow_button.innerText="Follow";
            }
        });
    }

}
block_button.addEventListener('click',blockUser);
follow_button.addEventListener('click',followUser);