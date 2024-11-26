/* toggle switch */
let navbar = document.querySelector(".navbar");
console.log(navbar);

let connexion = document.querySelector(".connexion");
console.log(connexion);

let interrupteur = document.querySelector(".turn-on");
console.log(interrupteur);

let background = document.querySelector("main");
console.log(background);

let footer = document.querySelector("footer");
console.log(footer);

/* font */
let h2 = document.querySelector("h2");
console.log(h2);

let paragrapheBasDePage = document.querySelector("p.social-media");
console.log(paragrapheBasDePage);

/*  */
function toggleSwitch() {
    /* navbar */
    navbar.classList.toggle("black-background");
    /* connexion */
    connexion.classList.toggle("connected");
    /* bouton */
    interrupteur.classList.toggle("turn-off");
    /* background */
    background.classList.toggle("black-background");
    /* h2 */
    h2.classList.toggle("white");
    /* paragraphe */
    paragrapheBasDePage.classList.toggle("white");
    /* footer */
    footer.classList.toggle("black-background");
}

interrupteur.addEventListener("click", toggleSwitch);

/* masque - mot de passe */
function myFunction() {
    let x = document.getElementById("mdp");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}