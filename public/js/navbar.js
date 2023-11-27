var navbar_tog = document.getElementById("navbar")
if(navbar_tog){
    navbar_tog.addEventListener("click", (e) => {
        if (e.target.classList.contains("active")) {
            document.querySelector("#toggle-icon").click()
        }
    });
}
var toggle_icon = document.getElementById("toggle-icon")
if(toggle_icon){
    toggle_icon.addEventListener('click', function() {
        document.getElementById("navbar").classList.toggle("active");
        var para = document.getElementById("toggle-icon");
        para.classList.toggle("rotate-icon");
    })
}

function changeLanguage(lang){
    location.href = '/'+lang+'/home';
}
