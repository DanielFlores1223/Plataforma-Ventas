const btnToggle = document.querySelector('.toggle-btn');

btnToggle.addEventListener('click', function name(params) {
    document.getElementById('slidebar').classList.toggle('active');

})

function cambiarColor(comp, colorX){
    comp.style.background = colorX;
}