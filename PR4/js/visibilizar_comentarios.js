import { BTN_COMENTARIOS } from "./constantes.js"

BTN_COMENTARIOS.addEventListener('click', () => {

    let content = document.querySelector('.contenido-comentarios');

    if (content.classList.contains('hidden')) {
        //añadir clase visible
        content.classList.add('visible');
        //quitar clase oculto
        content.classList.remove('hidden');
    }else{
        content.classList.add('hidden');
        content.classList.remove('visible');
    }

});