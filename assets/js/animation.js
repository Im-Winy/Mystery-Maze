let perso1 = document.querySelector(".perso1");
console.log(perso1);

let perso2 = document.querySelector(".perso2");
console.log(perso1);

let perso3 = document.querySelector(".perso3");
console.log(perso1);

let perso4 = document.querySelector(".perso4");
console.log(perso1);

/* 1er masque */
perso1.addEventListener("mouseover", () => {
    perso1.style.opacity = "100";
    perso1.style.transition = "3s";
});

perso1.addEventListener("mouseleave", () => {
    perso1.style.opacity = "0";
    perso1.style.transition = "5s";
});

/* 2ème masque */
perso2.addEventListener("mouseover", () => {
    perso2.style.opacity = "100";
    perso2.style.transition = "3s";
});

perso2.addEventListener("mouseleave", () => {
    perso2.style.opacity = "0";
    perso2.style.transition = "5s";
});

/* 3ème masque */
perso3.addEventListener("mouseover", () => {
    perso3.style.opacity = "100";
    perso3.style.transition = "3s";
});

perso3.addEventListener("mouseleave", () => {
    perso3.style.opacity = "0";
    perso3.style.transition = "5s";
});

/* 4ème masque */
perso4.addEventListener("mouseover", () => {
    perso4.style.opacity = "100";
    perso4.style.transition = "3s";
});

perso4.addEventListener("mouseleave", () => {
    perso4.style.opacity = "0";
    perso4.style.transition = "5s";
});