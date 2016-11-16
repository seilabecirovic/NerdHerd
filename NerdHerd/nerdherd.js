function funkcijaUcitanja(sadrzaj) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200){
            document.getElementById("polje").innerHTML = ajax.responseText;
            history.pushState(sadrzaj, "", window.location.href);
          }
        if (ajax.readyState == 4 && ajax.status == 404)
            document.getElementById("polje").innerHTML = "Error: unknown URL";
    }
    ajax.open("GET", sadrzaj, true);
    ajax.send();

}
function funkcijaUcitanjaPast(sadrzaj2){
  var ajax = new XMLHttpRequest();
ajax.onreadystatechange = function() {
if (ajax.readyState == 4 && ajax.status == 200){
  document.getElementById("polje").innerHTML = ajax.responseText;
}
if (ajax.readyState == 4 && ajax.status == 404)
  document.getElementById("polje").innerHTML = "Greska: nepoznat URL";
}
ajax.open("GET", sadrzaj2, true);
ajax.send();    }

window.onload = function() {
    history.replaceState("latestreview.html","", window.location.href);
    funkcijaUcitanjaPast("latestreview.html");
}
window.onpopstate = function(event) {
funkcijaUcitanjaPast(event.state);
}

function DDFunkcija() {
    var x = document.getElementById("mojanav");
    if (x.className === "navigacija") {
        x.className += " responsive";
    } else {
        x.className = "navigacija";
    }
}

function enlargeImage(element) {
var modal = document.getElementById('myModal');
var modalImg = document.getElementById("modalImage");
modal.style.display = "block";
modalImg.src = element.src;
}

 function closeButton() {
   var mod= document.getElementById('myModal');
    mod.style.display = "none";
}

window.addEventListener("keydown", function(e){
   var key = e.keyCode ? e.keyCode : e.which;
   if (key == 27) {
     var mod= document.getElementById('myModal');
      mod.style.display = "none";
}
});

var slideIndex = 1;

function CarouselFun(n) {
  prikazCarousel(slideIndex += n);
}
function trenutniCarousel(n) {
  prikazCarousel(slideIndex = n);
}
function prikazCarousel(n) {
  var i;
  var x = document.getElementsByClassName("carousel");
  var dots = document.getElementsByClassName("dot");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";

}
