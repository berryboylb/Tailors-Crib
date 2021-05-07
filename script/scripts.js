
const btn = document.querySelector("#btn");
const form = document.querySelector(".out-form");
const pointer = document.querySelector(".pointer");
const close = document.querySelector("#close");

const burgerMenu = ()=> {
    btn.addEventListener('click', ()=> {
        if(form.style.display = "none") {
            pointer.style.display = "none";
            form.style.display = "flex";
            // form.style.animation = "mymove 2s 1";
            let tl = gsap.timeline({defaults:{duration: 1.5}});

        tl.from('.out-form', { x:100, opacity: 0, ease: 'bounce',})
        }else {
            pointer.style.display = "flex";
            form.style.display = "none";
        }
    });

    close.addEventListener('click', ()=> {
        if(form.style.display = "flex"){
            form.style.display = "none";
            pointer.style.display = "flex";
        }else {
            form.style.display = "flex";
            pointer.style.display = "none";
        }
    })
}

burgerMenu();
