window.onload = () => {
    const btn=document.getElementById("log-in-btn")
    const signin=document.getElementById("login-page")
    const popup=document.getElementById("pop-up")
    const x = window.matchMedia("(max-width: 786px)")
    console.log("no")
    // if (x.matches){
    //     signin.style.display="none"
    // }
    btn.addEventListener("click",()=>{
        console.log("yes")
        popup.style.display="block"
        
        
    })

    




}