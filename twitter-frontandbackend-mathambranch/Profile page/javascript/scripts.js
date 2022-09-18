const name1=document.getElementById("name");
const tweets_number=document.getElementById("tweets_number");;
const cover_photo=document.getElementById("cover_photo");
const Profil_picture=document.getElementById("Profil_picture");
const full_name=document.getElementById("full_name");
const username=document.getElementById("username");
const join_date=document.getElementById("join_date");
const following_number=document.getElementById("following_number");
const follwer_number=document.getElementById("follwer_number");

let url = `http://localhost/twitter-frontandbackend/php/visitprofile.php?id=${localStorage.getItem("id")}&other_id=${localStorage.getItem("id")}`;
    fetch(url)
    .then(respone=>respone.json())
    .then(data=>{console.log(data)
        name1.innerText=Object.values(data)[0];
        if((Object.values(data)[2])!="NA"){
        cover_photo.src="http://localhost/twitter-frontandbackend/php/".concat(Object.values(data)[2]);
        }
        if((Object.values(data)[3])!="NA"){
        Profil_picture.src="http://localhost/twitter-frontandbackend/php/".concat(Object.values(data)[3]);
        }
        full_name.innerText=`${Object.values(data)[0]} ${Object.values(data)[1]}`;
        username.innerText=`@${Object.values(data)[4]}`;
        let toMonthName=(monthNumber)=> {
            const date = new Date(Object.values(data)[5]);
            date.setMonth(monthNumber - 1);
          
            return date.toLocaleString('en-US', {
              month: 'long',
            });
          }
        const date= Object.values(data)[5];
        const array=date.split("-");
        join_date.innerText=`Joined ${array[2]},${toMonthName(array[1])} ${array[0]}`;
        following_number.innerText=`${Object.values(data)[6]} Following`
        follwer_number.innerText=`${Object.values(data)[7]} Followers`
        console.log(Object.values(data)[8].length);
        if(Object.values(data)[8].length<=1){
            tweets_number.innerText=`${Object.values(data)[8].length} Tweet`
        }else{
            tweets_number.innerText=`${Object.values(data)[8].length} Tweets`
        }
        let array_tweets=Object.values(data)[8];
        // console.log(array_tweets);
        let likeTweet=(tweet_id,)=>{

        }
        for(let i=0;i<array_tweets.length;i++){
            console.log("saddsa");
            console.log(array_tweets[i]);
        }
    });