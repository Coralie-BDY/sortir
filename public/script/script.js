"use strict";

console.log("hello");
let checkbox = document.getElementById("search_sortie_sortiePassee");
let champ = document.getElementById("past");

function check() {

    if (checkbox.checked === true) {
        alert('coché');
        champ.style.display = "block";
    } else {
        alert('non');
        champ.style.display = "none";
    }
}
console.log(checkbox);
console.log(champ);


