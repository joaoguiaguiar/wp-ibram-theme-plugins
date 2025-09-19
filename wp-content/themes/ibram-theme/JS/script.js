const menuButton = document.querySelector('#menu-toggle'); 

function toggleMenu() {
    const lista = document.querySelector('.container__lista');
    lista.classList.toggle('active');
}


menuButton.addEventListener('click', toggleMenu);
