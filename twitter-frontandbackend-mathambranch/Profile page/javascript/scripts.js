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
// The below url will be used for the pcitures of every tweet on top left
let profile_url;
// Fetch all data of the user in one single JSON response
let url = `http://localhost/twitter-frontandbackend/php/visitprofile.php?id=${localStorage.getItem("id")}&other_id=${localStorage.getItem("id")}`;
    fetch(url)
    .then(respone=>respone.json())
    .then(data=>{
        name1.innerText=Object.values(data)[0];
        if((Object.values(data)[2])!="NA"){
            // Get cover photo
            cover_photo.src="http://localhost/twitter-frontandbackend/php/".concat(Object.values(data)[2]);
        }
        if((Object.values(data)[3])!="NA"){
            // Get profile photo   
            Profil_picture.src="http://localhost/twitter-frontandbackend/php/".concat(Object.values(data)[3]);
            profile_url=Profil_picture.src; 
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
        
        // Like tweet, so when the response is liked, the color will be red.
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
        // Like tweet, so when the response is unliked, the color will be gray.
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
                tweet_img.src="http://localhost/twitter-frontandbackend/php/".concat(array_tweet_pictures[j]);
                images.appendChild(tweet_img);
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