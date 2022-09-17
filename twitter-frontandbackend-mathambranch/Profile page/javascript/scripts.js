const name1=document.getElementById("name");
const tweets_number=document.getElementById("tweets_number");;
const cover_photo=document.getElementById("cover_photo");
const Profil_picture=document.getElementById("Profil_picture");
const full_name=document.getElementById("full_name");
const username=document.getElementById("username");
const join_date=document.getElementById("join_date");
const following_numer=document.getElementById("following_numer");
const join_date=document.getElementById("join_date");

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
        console.log(Object.values(data)[6]);
    });