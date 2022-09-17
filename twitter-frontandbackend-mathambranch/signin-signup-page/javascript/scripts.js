// Since we are working with local storage, we need to check if the user has checked remember me before, either in sign in
// or in signup with new account

if(!localStorage.getItem("remember_me")==null || localStorage.getItem("remember_me")=='true'){
    // Here the user is clicked on remember me. Hence, we have to redirect him/her to the feeds page.
    
    // TODO:redirect user to feeds page
}else{
    // We have to clear local storage if user didn't check remember me checkbox.
    localStorage.clear();
    // Popup of register
    // Defining all elemnts
    // Contents of register pop up
    const first_name=document.getElementById('first_name');
    const last_name=document.getElementById('last_name');
    const username=document.getElementById('username');
    const email=document.getElementById('email');
    const password=document.getElementById('password');
    const re_password=document.getElementById('re_password');
    const remember_me=document.getElementById('remember_me');
    const register=document.getElementById('register');
    const pick_up_files=document.getElementById("pick_up_files");
    const btn_profile_picture = document.getElementById("btn_profile_picture");
    const btn_cover_picture = document.getElementById("btn_cover_picture");
    let cover_base64 = "";
    let profile_base64 = "";

    // Add color red for some exceptions
    const addColorRed=(input,placeholder)=>{
        input.classList.add('red-color-text');
        input.placeholder=placeholder;
    };
    // Remove color red when exception is gone
    const removeColorRed=(input,placeholder)=>{
        input.classList.remove('red-color-text');
        input.placeholder=placeholder;
    };
    // Put some coditions at each enrty
    const checkEntries = ()=>{
        // First name must be not empty and more than 2 characters
        if(first_name.value==''){
            addColorRed(first_name,"Required *");
        }else if(first_name.value.length<=2){
            first_name.value="";
            addColorRed(first_name,"Invalid Name");
            // Last name must be not empty and more than 2 characters
        }else if(last_name.value==''){
            addColorRed(last_name,"Required *");
        }else if(last_name.value.length<=2){
            last_name.value="";
            addColorRed(last_name,"Invalid Family");
            // username must be not empty and more than 2 characters
        }else if(username.value==''){
            addColorRed(username,"Required *");
        }else if(username.value.length<=2 ||username.value.includes('@')){
            username.value="";
            addColorRed(username,"Invalid Username");
            // Email must be not empty and more than 5 characters and valid
        }else if(email.value==''){
            addColorRed(email,"Required *");
        }else if(email.value.length<=6 || !email.value.includes('@')){
            email.value="";
            addColorRed(email,"Invalid Email");
            // Password and re-enter password section must be not empty and more than 4 characters
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
            // Password and re-enter password must be equal
        } else if(re_password.value!=password.value){
            re_password.value="";
            password.value="";
            addColorRed(password,"Must be equal");
            addColorRed(re_password,"Must be equal");
            // Add user after picking up cover and profile
        }else {
            try{
                pick_up_files.innerText=""
                pick_up_files.style.fontSize="0vw";
                addUser(cover_base64,profile_base64);
            }catch(err){
                console.log(err.message);
                pick_up_files.style.color="red";
                pick_up_files.innerText="Cover and profile are required."
                pick_up_files.style.fontSize="2vw";
            }
        }
    }
    
    //The below function will let the profile image to convert to Base64 
    let pickUpProfile =()=>{
        let file = btn_profile_picture['files'][0];
        let reader = new FileReader();
        reader.onload = function () {
            profile_base64 = reader.result.replace("data:", "")
                .replace(/^.+,/, "");
            
        }
        reader.readAsDataURL(file);
        return profile_base64;
    }
    //The below function will let the cover image to convert to Base64 
    let pickUpCover =()=>{
        let file = btn_cover_picture['files'][0];
        let reader = new FileReader();
        reader.onload = function () {
            cover_base64 = reader.result.replace("data:", "")
                .replace(/^.+,/, "");
        }
        reader.readAsDataURL(file);
        return cover_base64;
    }

    btn_profile_picture.addEventListener("change",pickUpProfile);
    btn_cover_picture.addEventListener('change',pickUpCover);
    // In the following functions, in case an exception is required, it will be gone by clicking on each.
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

    
    //send     
    const addUser=(cover_base64,profile_base64)=>{
        let url = "http://localhost/twitter-frontandbackend/php/adduser.php";
        let parameters = {
            method:'POST',
            body: new URLSearchParams({
                first_name:first_name.value,
                last_name:last_name.value,
                username:username.value,
                email:email.value,
                password:password.value,
                profile_picture:profile_base64,
                cover_picture:cover_base64
                
            })
        };
        fetch(url,parameters)
        .then(respone=>respone.json())
        .then(data=>{
            if(Object.values(data)[0]=="done"){
                // In case the firt response is done, we need to check if user has checked remember me checkbox.
                // Hence, next time we will direct him to the feeds page
                if(remember_me.checked){
                    localStorage.setItem("remember_me","true");
                    
                }else{
                    localStorage.setItem("remember_me","false");
                }
                localStorage.setItem("id",Object.values(data)[1]);
                // TODO:redirect user to feeds page
            }else{
                // In case the first response is not done, so it will be is_registered, which means that this email is
                // existed before.
                email.value="";
                email.classList.add('red-color-text');
                email.placeholder="Registered before";
            }
        });}

        // Pop up of sign in
        // Contents of sign in pop up
        const email_sign_in=document.getElementById('email_sign_in');
        const password_sign_in=document.getElementById('password_sign_in');
        const remember_me_sign_in=document.getElementById('remember_me_sign_in');
        const login=document.getElementById('login');
        let checkEmailPassword = ()=>{
            console.log('hy');
            if(email_sign_in.value==''){
                addColorRed(email_sign_in,"Required *");
            }else if(password_sign_in.value==''){
                addColorRed(password_sign_in,"Required *");
            }else{
                let url = "http://localhost/twitter-frontandbackend/php/login.php";
                let parameters = {
                    method:'POST',
                    body: new URLSearchParams({
                        email:email_sign_in.value,
                        password:password_sign_in.value
                    })
                };
                fetch(url,parameters)
                .then(respone=>respone.json())
                .then(data=>{
                    if(Object.values(data)[0]=="registered"){
                        // In case the firt response is registered, we need to check if user has checked remember me checkbox.
                        // Hence, next time we will direct him to the feeds page
                        if(remember_me_sign_in.checked){
                            localStorage.setItem("remember_me","true");
                        }else{
                            localStorage.setItem("remember_me","false");
                        }
                        localStorage.setItem("id",Object.values(data)[1]);
                        // TODO:redirect user to feeds page
                    }else{
                        // In case the first response is not registered so, that means either email or password is wrong
                        email_sign_in.value="";
                        password_sign_in.value="";
                        email_sign_in.classList.add('red-color-text');
                        email_sign_in.placeholder="Wrong email or password";
                        password_sign_in.classList.add('red-color-text');
                        password_sign_in.placeholder="Wrong email or password";
                    }
                    console.log(data);
                });
            }
        }
        email_sign_in.addEventListener('click',function(){
            removeColorRed(email_sign_in,"Enter your email");
        });
        password_sign_in.addEventListener('click',function(){
            removeColorRed(password_sign_in,"Enter your Password");
        })
        login.addEventListener('click',checkEmailPassword);
    }