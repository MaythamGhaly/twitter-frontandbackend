window.onload = () => {
    const edit=document.getElementById("edit")
    const profile=document.getElementById("container")
    const popup=document.getElementById("edit-popup")
    const x = window.matchMedia("(max-width: 786px)")
    const close=document.getElementById("close")

    edit.addEventListener("click", () => {
                btnstatus=true
                popup.style.display = "block"
                profile.style.display = "none"
            })
            close.addEventListener("click", () => {
                btnstatus=false
                popup.style.display = "none"
                profile.style.display = "block"
            })

}