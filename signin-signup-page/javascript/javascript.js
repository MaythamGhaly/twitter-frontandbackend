window.onload = () => {
    const btn_signin = document.getElementById("log-in-btn")
    const btn_signup = document.getElementById("signup-btn")
    const signin = document.getElementById("login-page")
    const pop_signin = document.getElementById("pop-signin")
    const pop_signup=document.getElementById("pop-signup")
    const x = window.matchMedia("(max-width: 786px)")
    const close = document.getElementById("close")
    const close_signup = document.getElementById("close-signup")
    let btnstatus=false

    // Fignin popup responsivity
    if (x.matches ) {
        btn_signin.addEventListener("click", () => {
            btnstatus=true
            pop_signin.style.display = "block"
            signin.style.display = "none"
        })
        close.addEventListener("click", () => {
            btnstatus=false
            pop_signin.style.display = "none"
            signin.style.display = "block"
        })
    }
    else {
        btn_signin.addEventListener("click", () => {
            btnstatus=true
            pop_signin.style.display = "block"
        })
        close.addEventListener("click", () => {
            btnstatus=false
            signin.style.display = "block"
            pop_signin.style.display = "none"
        })
    }
    // Function to make the page responsive when the window resizing
    window.addEventListener('resize', () => {
        if (btnstatus && x.matches) {
            signin.style.display = "none"
            close.addEventListener("click", () => {
                pop_signin.style.display = "none"
                signin.style.display = "block"
            })}
        else if (btnstatus){
            signin.style.display = "block"
        }
        else if (!btnstatus){
            signin.style.display = "block"
            close.addEventListener("click", () => {
                btnstatus=false
                pop_signin.style.display = "none"
            })
        }
    });
    // Signup popup responsivity
    if (x.matches ) {
        btn_signup.addEventListener("click", () => {
            btnstatus=true
            pop_signup.style.display = "block"
            signin.style.display = "none"
        })
        close_signup.addEventListener("click", () => {
            btnstatus=false
            pop_signup.style.display = "none"
            signin.style.display = "block"
        })
    }
    else {
        btn_signup.addEventListener("click", () => {
            btnstatus=true
            pop_signup.style.display = "block"
        })
        close_signup.addEventListener("click", () => {
            btnstatus=false
            signin.style.display = "block"
            pop_signup.style.display = "none"
        })
    }
    // function to make the page responsive when the window resizing
    window.addEventListener('resize', () => {
        if (btnstatus && x.matches) {
            signin.style.display = "none"
            close.addEventListener("click", () => {
                pop_signup.style.display = "none"
                signin.style.display = "block"
            })}
        else if (btnstatus){
            signin.style.display = "block"
        }
        else if (!btnstatus){
            signin.style.display = "block"
            close.addEventListener("click", () => {
                btnstatus=false
                pop_signup.style.display = "none"
            })
        }
    });
}
    

    




