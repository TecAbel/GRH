var btnAbrir = document.getElementById('menu'),
lista = document.getElementById('lista');

btnAbrir.addEventListener('click', function(){
    if(lista.className === 'active'){
        lista.classList.remove('active');
        
    }else{
        lista.classList.add('active');
    }
});