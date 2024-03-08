import { FORM, COMENTARIOS } from './constantes.js';

function validarEmail() {
    var email = document.getElementById('email').value;
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}


FORM.addEventListener('submit', function(event) {

    event.preventDefault();

    if (!validarEmail()) {
        alert('Por favor, introduce un email válido. Formato (<loquesea>@<loquesea>.<loquesea>)');
        return;
    }

    // Recogemos los valores
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var comment = document.getElementById('comments').value;

    // Creamos el div y su clase
    var divComentario = document.createElement('div');
    divComentario.classList.add('comentario');

    //DIV AUTOR
    var divAutor = document.createElement('div');
    divAutor.classList.add('autor');

    var divImgAvatar = document.createElement('div');
    divImgAvatar.classList.add('img-avatar');

    //generar un numero aleatorio entre 1 y 5
    var numero = Math.floor(Math.random() * 5) + 1;
    divImgAvatar.innerHTML = '<img src="icon/avatar'+numero+'.jpg" alt="avatar">';

    //generar color aleatorio
    var color = Math.floor(Math.random()*16777215).toString(16);
    divImgAvatar.style.backgroundColor = "#" + color;

    divAutor.appendChild(divImgAvatar);

    var nombreAutor = document.createElement('p');
    nombreAutor.textContent = name + ' ( ' + email + ' )';

    divAutor.appendChild(nombreAutor);

    divComentario.appendChild(divAutor);

    //COMENTARIO

    var comentarioTexto = document.createElement('p');
    comentarioTexto.textContent = comment;

    divComentario.appendChild(comentarioTexto);

    //FECHA Y HORA  

    var fecha = new Date();
    var fechaTexto = document.createElement('p');
    fechaTexto.textContent = fecha.toLocaleString();

    divComentario.appendChild(fechaTexto);

    //Añadimos el comentario al contenedor de comentarios

    COMENTARIOS.appendChild(divComentario);

});