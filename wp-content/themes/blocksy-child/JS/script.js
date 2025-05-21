function toggleMenu() {
    const lista = document.querySelector('.container__lista');
    lista.classList.toggle('active');
}

const menuButton = document.querySelector('#menu-toggle'); 

menuButton.addEventListener('click', toggleMenu);
