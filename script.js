
const lastSec = document.querySelector(".last-sec");
const waitBtn = document.querySelector("#wait-btn");
const close = document.querySelector("#closed");


const burgerMenu = () => {
   waitBtn.addEventListener('click', () => {
       if(lastSec.style.display = "none") {
           lastSec.style.display = "block";
           let tl = gsap.timeline({defaults:{duration: 1.5}});
           tl.from('.wait-form', { y:100, opacity: 0, ease: 'bounce',})
       } else {
            lastSec.style.display = "none"
       }
   });

   close.addEventListener("click", ()=> {
       if(lastSec.style.display = "block"){
            lastSec.style.display = "none";
            tl.to('.wait-form', { x:100, opacity: 0, ease: 'bounce',})
       }else {
            lastSec.style.display = "block";
       }
   })
}

burgerMenu();


