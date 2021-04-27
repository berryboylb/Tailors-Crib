
const menu = document.querySelector(".menu");
const nav = document.querySelector(".navlist");
const line0 = document.querySelector(".line0");
const line1 = document.querySelector(".line1");
const line2 = document.querySelector(".line2");


const burgerMenu = ()=> {
    menu.addEventListener("click", ()=>{
        nav.classList.toggle('nav-active');
        menu.classList.toggle('toggle');
    });
}

burgerMenu();
