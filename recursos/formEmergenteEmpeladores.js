var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
    overlay = document.getElementById('overlay'),
    popup = document.getElementById('popup'),
    btnCerrarPopup = document.getElementById('btn-cerrar-popup'),
    titulo = document.getElementById('titulo');

btnAbrirPopup.addEventListener('click',function(){
    overlay.classList.add('active');
    popup.classList.add('active');
    titulo.classList.add('oculto');
});

btnCerrarPopup.addEventListener('click',function(){
    overlay.classList.remove('active');
    popup.classList.remove('active');
    titulo.classList.remove('oculto');
});