var btnAbrir = document.getElementById('menu'),
lista = document.getElementById('lista'),
titulo = document.getElementById('titulo');

btnAbrir.addEventListener('click', function(){
    if(lista.className === 'active'){
        lista.classList.remove('active');
        titulo.classList.remove('oculto');
        
    }else{
        lista.classList.add('active');
        titulo.classList.add('oculto');
    }
});