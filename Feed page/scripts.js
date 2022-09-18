const full_name = document.getElementById('full_name');
const profile_picture=document.getElementById('profile_picture');
const to_profile=document.getElementById("to-profile")
localStorage.setItem("id",2);
// Get all the feed by sending a request to the server
    let url = `http://localhost/twitter-frontandbackend/php/getfeeds.php?id=${localStorage.getItem("id")}`;

    to_profile.addEventListener("click",() => {
        location.replace("file:///C:/Users/Qitabi/Desktop/twitter%20site/twitter-frontend/Profile%20page/index.html");
    })
    fetch(url)
    .then(respone=>respone.json())
    .then(data=>{
        full_name.innerText=`${Object.values(data)[0]} ${Object.values(data)[1]}`;
        
        try{
            profile_picture.src=Object.values(data)[2];
            profile_picture.src=`http://localhost/twitter-frontandbackend/php/${Object.values(data)[2]}`;
        }
        catch(err){
            profile_picture.src="../Profile page/images/PP.png";
        }
          
        let toMonthName=(monthNumber)=> {
            if(monthNumber=="1" || monthNumber=="01"){
                return "January";
            }else if(monthNumber=="2" || monthNumber=="02"){
                return "February";
            }else if(monthNumber=="3" || monthNumber=="03"){
                return "March";
            }else if(monthNumber=="4" || monthNumber=="04"){
                return "April";
            }else if(monthNumber=="5" || monthNumber=="05"){
                return "May"
            }else if(monthNumber=="6" || monthNumber=="06"){
                return "June";
            }else if(monthNumber=="7" || monthNumber=="07"){
                return "July";
            }else if(monthNumber=="8" || monthNumber=="08"){
                return "August";
            }else if(monthNumber=="9" || monthNumber=="09"){
                return "September";
            }else if(monthNumber=="10" ){
                return "October";
            }else if(monthNumber=="11"){
                return "November";
            }else if(monthNumber=="12" ){
                return "December";
            }

            }



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
                  }
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
    const tweets=Object.values(data)[3];
        const all_tweets=document.getElementById('all_tweets');
        for(let i =0 ;i<tweets.length;i++){
            let id= Object.values(tweets[i])[0];
            let  date=Object.values(tweets[i])[2];
            const array_tweet_pictures= Object.values(tweets[i])[6];
            let isLiked=Object.values(tweets[i])[5];
            num_likes=Object.values(tweets[i])[4]

            const Tweet_feed=document.createElement('div');
            Tweet_feed.classList.add("Tweet-feed");
            const tweet_header=document.createElement('div');
            tweet_header.classList.add('tweet-header')
            const tweet_profile=document.createElement('img');
            tweet_profile.classList.add('tweet-profile');
            const name_date=document.createElement('div');
            name_date.classList.add('name-date');
            const p=document.createElement('p');
            const h6=document.createElement('h6');
            name_date.appendChild(p);
            name_date.appendChild(h6);
            tweet_header.appendChild(tweet_profile);
            tweet_header.appendChild(name_date);
            // 2nd one
            const phone_text=document.createElement('div');
            phone_text.classList.add('phone-text');
            const p1=document.createElement('p');
            const images=document.createElement('div');
            images.classList.add('images');
            for(let j=0;j<array_tweet_pictures.length;j++){
                const tweet_img=document.createElement('img');
                tweet_img.classList.add('tweet-img');
                if(array_tweet_pictures[j]!="NA"){
                tweet_img.src="http://localhost/twitter-frontandbackend/php/".concat(array_tweet_pictures[j]);
                images.appendChild(tweet_img);}
            }
            phone_text.appendChild(p1);
            phone_text.appendChild(images);
            
            // 3rd one
            const likes=document.createElement('div');
            likes.classList.add('likes');

            const heart =document.createElement('span');
            heart.classList.add('heart');

            const p2=document.createElement('p');
            likes.appendChild(heart);
            likes.appendChild(p2);

            Tweet_feed.appendChild(tweet_header);
            Tweet_feed.appendChild(phone_text);
            Tweet_feed.appendChild(likes);
            
            p.innerText=`${Object.values(tweets[i])[7]} ${Object.values(tweets[i])[8]}`;
            p1.innerText=Object.values(tweets[i])[1];

            tweet_profile.src="http://localhost/twitter-frontandbackend/php/".concat(Object.values(tweets[i])[9]);
            
            h6.innerText=`${date.split("-")[2]}, ${toMonthName(date.split("-")[1])} ${date.split("-")[0]}`;

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

            all_tweets.appendChild(Tweet_feed);
        }
    });

    // Upload tweets
    const btn_tweet=document.getElementById('btn_tweet');
    const tweet_text=document.getElementById('tweet_text');
    const btn_upload_tweet=document.getElementById('btn_upload_tweet');
    let image_base64 = "";

    let addTweet = ()=>{
        if(tweet_text.value.length==0 || tweet_text.value.length>280){
            tweet_text.value='';
            tweet_text.classList.add('red-color-text');
            tweet_text.placeholder="Text length must be between 0 and 280";
        }else{
                let url = "http://localhost/twitter-frontandbackend/php/tweet.php";
                let parameters = {
                    method:'POST',
                    body: new URLSearchParams({
                        id:localStorage.getItem('id'),
                        text:tweet_text.value
                    })
                };
                fetch(url,parameters)
                .then(respone=>respone.json())
                .then(data=>{
                    tweet_text.value='';
                    tweet_text.placeholder="Done";
                    if(image_base64!=""){
                        let url1 = "http://localhost/twitter-frontandbackend/php/tweetpicture.php";
                        let parameters1 = {
                            method:'POST',
                            body: new URLSearchParams({
                                id:localStorage.getItem('id'),
                                tweet_id:Object.values(data)[1],
                                picture:image_base64
                            })
                        };
                        fetch(url1,parameters1)
                        .then(respone=>respone.json())
                        .then(data1=>{
                            location.reload();
                        });
                    }
                });

        }
    }

    let removeColorRed=()=>{
        tweet_text.classList.remove('red-color-text');
        tweet_text.placeholder="What's happening? ...";
    }
    
     let pickUpImage =()=>{
        let file = btn_upload_tweet['files'][0];
        let reader = new FileReader();
        reader.onload = function () {
            image_base64 = reader.result.replace("data:", "")
                .replace(/^.+,/, "");
            
        }
        reader.readAsDataURL(file);
        return image_base64;
    }
    btn_upload_tweet.addEventListener('change',pickUpImage);
    tweet_text.addEventListener('click',removeColorRed);
    btn_tweet.addEventListener('click',addTweet);

    // Search friends
    