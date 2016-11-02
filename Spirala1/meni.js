function myFunction() {
    var x = document.getElementByID("mojanav");
    if (x.className === "navigacija") {
        x.className += ".responsive";
    } else {
        x.className = "navigacija";
    }
}
