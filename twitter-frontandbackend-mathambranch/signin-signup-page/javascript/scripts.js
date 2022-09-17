// Since we are working with local storage, we need to check if the user has checked remember me before, either in sign in
// or in signup with new account
if(!localStorage.getItem("remember_me")==null){
    // Here the user is clicked on remember me. Hence, we have to redirect him/her to the feed page.

}else{
    // Popup of register
    const input_first_name_sign_up=document.getElementById('input_first_name_sign_up');
    const input_last_name_sign_up=document.getElementById('input_last_name_sign_up');
    const input_username_sign_up=document.getElementById('input_username_sign_up');
    const input_email_sign_up=document.getElementById('input_email_sign_up');
    const input_password_sign_up=document.getElementById('input_password_sign_up');
    const input_re_password_sign_up=document.getElementById('input_re_password_sign_up');
    const btn_profile_picture_sign_up=document.getElementById('btn_profile_picture_sign_up');
    const btn_cover_picture_sign_up=document.getElementById('btn_cover_picture_sign_up');
    const cb_remember_me_sign_up=document.getElementById('cb_remember_me_sign_up');
    const btn_register_sign_up=document.getElementById('btn_register_sign_up');
    let has_uploaded_profile=true;
    let has_uploaded_cover=false;




    const addColorRed=(input,placeholder)=>{
        input.classList.add('red-color-text');
        input.placeholder=placeholder;
    }
    const addColorRedButton=(input,text)=>{
        input.classList.add('red-color-text');
        input.innerText=text;
    }

    const removeColorRed=(input,placeholder)=>{
        input.classList.remove('red-color-text');
        input.placeholder=placeholder;
    }
    const removeColorRedButton=(input,text)=>{
        input.classList.remove('red-color-text');
        input.innerText=text;
    }
    input_first_name_sign_up.addEventListener('click',function(){
        removeColorRed(input_first_name_sign_up,"First Name");
    });
    input_last_name_sign_up.addEventListener('click',function(){
        removeColorRed(input_last_name_sign_up,"Last Name");
    });
    input_username_sign_up.addEventListener('click',function(){
        removeColorRed(input_username_sign_up,"Username");
    });
    input_email_sign_up.addEventListener('click',function(){
        removeColorRed(input_email_sign_up,"Email");
    });
    input_password_sign_up.addEventListener('click',function(){
        removeColorRed(input_password_sign_up,"Password");
    });
    input_re_password_sign_up.addEventListener('click',function(){
        removeColorRed(input_re_password_sign_up,"Re-enter your password");
    });
    btn_profile_picture_sign_up.addEventListener('click',function(){
        removeColorRedButton(btn_profile_picture_sign_up,"Profile picture");
    });
    btn_cover_picture_sign_up.addEventListener('click',function(){
        removeColorRedButton(btn_cover_picture_sign_up,"Cover picture");
    });
    const checkEntries=()=>{
        if(input_first_name_sign_up.value==''){
            addColorRed(input_first_name_sign_up,"Required *");
        }else if(input_last_name_sign_up.value==''){
            addColorRed(input_last_name_sign_up,"Required *");
        }else if(input_username_sign_up.value==''){
            addColorRed(input_username_sign_up,"Required *");
        }
        else if(input_email_sign_up.value==''){
            addColorRed(input_email_sign_up,"Required *");
        }
        else if(input_password_sign_up.value==''){
            addColorRed(input_password_sign_up,"Required *");
        }else if(input_re_password_sign_up.value==''){
            addColorRed(input_re_password_sign_up,"Required *");
        }else if(!has_uploaded_profile){
            addColorRedButton(btn_profile_picture_sign_up,"Profile Required");
        }else if(!has_uploaded_cover){
            addColorRedButton(btn_cover_picture_sign_up,"Cover Required");
        }
    }
    btn_register_sign_up.addEventListener('click',checkEntries);

}
