var modal = document.getElementById("myModal");
var modalImg = document.getElementById("modal-img");
var captionText = document.getElementById("caption");


// document.addEventListener("click", (e) => {
//   const elem = e.target;
//   if (elem.id === "myImg") {
//     modal.style.display = "block";
//     modalImg.src = elem.dataset.biggerSrc || elem.src;
//     captionText.innerHTML = elem.alt;
//   }
// })
var span = document.getElementsByClassName("close")[0];
if(span){
    span.onclick = function() {
      modal.style.display = "none";
    }
}
