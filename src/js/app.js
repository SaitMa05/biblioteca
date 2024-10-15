const btnMenu = document.querySelector("#toggleChecker")
const nav = document.querySelector('.nav')

const btnCategoria = document.querySelector(".btnCategoria")
const categoria = document.querySelector('#ocultar')

const btnCursos = document.querySelector(".ocultarCursos")
const cursos = document.querySelector(".cursosC");


// Formulario Registro


// alert("Hola")

document.addEventListener("DOMContentLoaded", () => {
    iniciarApp();
})

function iniciarApp(){
    menuResponsive()
}

function menuResponsive(){
    btnMenu.addEventListener("click", () => {
        nav.classList.toggle('d-n')
    })
    btnCategoria.addEventListener("click", () => {
        categoria.classList.toggle('d-n')
        btnCategoria.classList.toggle('rotate')
    })
    btnCursos.addEventListener("click", ()=>{
        cursos.classList.toggle('d-none')
        if(!cursos.classList.contains('d-none')){
            btnCursos.textContent= "Ocultar Cursos"
        }else{
            btnCursos.textContent= "Mostrar Cursos"
        }
    })
}

const yearFooter = document.querySelector('.yearFooter');
let yearActual = new Date().getFullYear();
yearFooter.textContent = yearActual;