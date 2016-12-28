function searchkey(){
  var searchTxt=$("input[name='search']").val();
  $.post("pretraga.php",{searchVal: searchTxt},function(output){
    $("#output").html(output);
  });
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
    var mod = document.getElementById('myModal');
    mod.style.display = "none";
}


window.onclick = function(event) {

      var modal1 = document.getElementById('id01');
    if (event.target == modal1) {
        modal1.style.display = "none";

    }
}

window.addEventListener("keydown", function(e) {
    var key = e.keyCode ? e.keyCode : e.which;
    if (key == 27) {
        var mod = document.getElementById('myModal');
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
    if (n > x.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = x.length
    }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    x[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";

}

function unosRev() {
    var tacnost = false;
    var greska = document.getElementsByClassName('greska')[0];
    var ime = document.getElementsByName('name')[0];
    var title = document.getElementsByName('title')[0];
    var tekst = document.getElementsByName('Tekst')[0];
    var email = document.getElementsByName('email')[0];
    greska.innerHTML = "";
    var imeRegEx = /^[a-zA-Z ]{2,30}$/;
    var emailRegEx = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (ime.value.length < 1 || !imeRegEx.test(ime.value)) {
        ime.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Name is not valid</li>";
        tacnost = false;
    } else {
        ime.style.borderColor = "#b793b7";
        tacnost = true;
    }

    if (email.value.length < 0 || !emailRegEx.test(email.value)) {
        email.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Email is not valid</li>";
        tacnost = false;
    } else {
        email.style.borderColor = "#b793b7";
        tacnost = true;
    }
    if (title.value.length < 1 || !imeRegEx.test(title.value)) {
        title.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Title is not valid</li>";
        tacnost = false;
    } else {
        title.style.borderColor = "#b793b7";
        tacnost = true;
    }
    if (tekst.value.length < 500) {
        tekst.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Review is not valid</li>";
        tacnost = false;
    } else {
        tekst.style.borderColor = "#b793b7";
        tacnost = true;
    }
    if (!tacnost) greska.style.display = "inline-block";
    return tacnost;
}

function unosKom() {
    var tacnost = false;
    var greska = document.getElementsByClassName('greska')[0];
    var ime = document.getElementsByName('name')[0];
    greska.innerHTML = "";
    var imeRegEx = /^[a-zA-Z ]{2,30}$/;

    if (ime.value.length < 1 || !imeRegEx.test(ime.value)) {
        ime.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Name is not valid</li>";
        tacnost = false;
    } else {
        ime.style.borderColor = "#b793b7";
        tacnost = true;
    }

    if (!tacnost) greska.style.display = "inline-block";
    return tacnost;
}

function unosKont() {
    var tacnost = false;
    var greska = document.getElementsByClassName('greska')[0];
    var ime = document.getElementsByName('name')[0];
    var tekst = document.getElementsByName('Tekst')[0];
    var email = document.getElementsByName('email')[0];
    greska.innerHTML = "";
    var imeRegEx = /^[a-zA-Z ]{2,30}$/;
    var emailRegEx = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (ime.value.length < 1 || !imeRegEx.test(ime.value)) {
        ime.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Name is not valid</li>";
        tacnost = false;
    } else {
        ime.style.borderColor = "#b793b7";
        tacnost = true;
    }

    if (email.value.length < 0 || !emailRegEx.test(email.value)) {
        email.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Email is not valid</li>";
        tacnost = false;
    } else {
        email.style.borderColor = "#b793b7";
        tacnost = true;
    }

    if (tekst.value.length < 50) {
        tekst.style.borderColor = "#421C5";
        greska.innerHTML += "<li>Contact message is not valid</li>";
        tacnost = false;
    } else {
        tekst.style.borderColor = "#b793b7";
        tacnost = true;
    }
    if (!tacnost) greska.style.display = "inline-block";
    return tacnost;
}
