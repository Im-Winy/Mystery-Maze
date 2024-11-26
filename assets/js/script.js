/* toggle switch */
let navbar = document.querySelector(".navbar");
console.log(navbar);

let connexion = document.querySelector(".connexion");
console.log(connexion);

let interrupteur = document.querySelector(".turn-on");
console.log(interrupteur);

let background = document.querySelector("body");
console.log(background);

let footer = document.querySelector("footer");
console.log(footer);

/* fonction dark-mode */
function darkMode() {
    /* navbar */
    navbar.classList.toggle("dark-mode");
    /* connexion */
    connexion.classList.toggle("connected");
    /* bouton */
    interrupteur.classList.toggle("turn-off");
    /* background */
    background.classList.toggle("dark-mode");
    /* footer */
    footer.classList.toggle("dark-mode");
}
/* Écouteur d'évènement */
interrupteur.addEventListener("click", darkMode);

/* masque - mot de passe */
function myFunction() {
    let x = document.getElementById("mdp");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}