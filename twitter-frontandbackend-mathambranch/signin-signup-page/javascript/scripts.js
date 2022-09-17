// Since we are working with local storage, we need to check if the user has checked remember me before, either in sign in
// or in signup with new account
if(!localStorage.getItem("remember_me")==null){
    // Here the user is clicked on remember me. Hence, we have to redirect him/her to the feed page.

}else{
    // Popup of register
    const first_name=document.getElementById('first_name');
    const last_name=document.getElementById('last_name');
    const username=document.getElementById('username');
    const email=document.getElementById('email');
    const password=document.getElementById('password');
    const re_password=document.getElementById('re_password');
    const btn_profile_picture=document.getElementById('btn_profile_picture');
    const btn_cover_picture=document.getElementById('btn_cover_picture');
    const remember_me=document.getElementById('remember_me');
    const register=document.getElementById('register');
    const label_profile_picture=document.getElementById('label_profile_picture');
    const label_cover_picture=document.getElementById('label_cover_picture');
    const pick_up_files=document.getElementById("pick_up_files");
    let profile_base64= "";
    let cover_base64= "";
   

    const addColorRed=(input,placeholder)=>{
        input.classList.add('red-color-text');
        input.placeholder=placeholder;
    };
    const removeColorRed=(input,placeholder)=>{
        input.classList.remove('red-color-text');
        input.placeholder=placeholder;
    };
    const checkEntries = ()=>{

        if(first_name.value==''){
            addColorRed(first_name,"Required *");
        }else if(first_name.value.length<=2){
            first_name.value="";
            addColorRed(first_name,"Invalid Name");
        }else if(last_name.value==''){
            addColorRed(last_name,"Required *");
        }else if(last_name.value.length<=2){
            last_name.value="";
            addColorRed(last_name,"Invalid Family");
        }else if(username.value==''){
            addColorRed(username,"Required *");
        }else if(username.value.length<=2){
            username.value="";
            addColorRed(username,"Invalid Username");
        }else if(email.value==''){
            addColorRed(email,"Required *");
        }else if(email.value.length<=6 || !email.value.includes('@')){
            email.value="";
            addColorRed(email,"Invalid Username");
        } else if(password.value==''){
            addColorRed(password,"Required *");
        }else if(password.value.length<5){
            password.value="";
            addColorRed(password,"Invalid Password");
        }else if(re_password.value==''){
            addColorRed(re_password,"Required *");
        }else if(re_password.value.length<5){
            re_password.value="";
            addColorRed(password,"Invalid Password");
        } else if(re_password.value!=password.value){
            re_password.value="";
            password.value="";
            addColorRed(password,"Must be equal");
            addColorRed(re_password,"Must be equal");
        }else {
            try{
                pick_up_files.innerText=""
                pick_up_files.style.fontSize="0vw";
                pickCover();
                pickProfile();
                console.log("done");
            }catch(err){
                console.log("error");
                pick_up_files.style.color="red";
                pick_up_files.innerText="Cover and profile are required."
                pick_up_files.style.fontSize="2vw";
            }
        }
    }
    first_name.addEventListener('click',function(){
        removeColorRed(first_name,"First name");
    });
    last_name.addEventListener('click',function(){
        removeColorRed(last_name,"Last name");
    });
    username.addEventListener('click',function(){
        removeColorRed(username,"Username");
    });
    email.addEventListener('click',function(){
        removeColorRed(email,"Email");
    });
    password.addEventListener('click',function(){
        removeColorRed(password,"Password");
    });
    re_password.addEventListener('click',function(){
        removeColorRed(re_password,"Re-enter your password");
    });
    register.addEventListener('click',checkEntries);

    }


    // const addUser = ()=>{
    
    //     let url = "";
    //     let parameters = {
    //         method:'POST',
    //         body: new URLSearchParams({
    //             //your parameters must be here
    //         })
    //     }
    //     fetch(url,parameters)
    //     .then(respone=>respone.json())
    //     .then(data=>console.log(data));
    // }


    const pickProfile = ()=>{
        let file = btn_profile_picture['files'][0];
      
        let reader = new FileReader();
          
        reader.onload = function () {
            profile_base64 = reader.result.replace("data:", "")
                .replace(/^.+,/, "");
      
            console.log(profile_base64);
        }
        reader.readAsDataURL(file);
    }
    const pickCover = ()=>{
        let file = btn_cover_picture['files'][0];
      
        let reader = new FileReader();
          
        reader.onload = function () {
            cover_base64 = reader.result.replace("data:", "")
                .replace(/^.+,/, "");
      
            console.log(cover_base64);
        }
        reader.readAsDataURL(file);
    }