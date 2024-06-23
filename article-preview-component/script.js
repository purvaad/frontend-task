const component = document.getElementById("social")
const btn = document.getElementsByTagName("button")
const img = document.getElementsByTagName("img")

clicked();

function clicked(){
    if(component.style.display =="none"){
    component.style.display = "flex";
    btn[0].style.backgroundColor = "hsl(212, 23%, 69%)";
    img[2].style.webkitFilter = "brightness(100)";
    img[2].style.filter = "brightness(100)";
    }else {
    component.style.display = "none";
    btn[0].style.backgroundColor= "hsl(210, 46%, 95%)"
    img[2].style.webkitFilter = "unset";
    img[2].style.filter = "unset";
    }
}