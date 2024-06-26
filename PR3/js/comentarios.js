import { FORM } from './constantes.js';
import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/+esm'

function validarEmail() {
  var email = document.getElementById('email').value;
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

/*
function dibujarComentario (name, email, comment, fecha){ // Antes se usaba

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
  var avatar = 'icon/avatar' + numero + '.jpg';
  divImgAvatar.innerHTML = '<img src="' + avatar + '" alt="avatar">';

  //generar color aleatorio
  var color = Math.floor(Math.random() * 16777215).toString(16);
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

  divComentario.appendChild(fecha);

  Swal.fire({
    title: '<h3 style="color:black;">Su comentario será público para el resto de usuarios</h3>',
    icon: 'success',
    confirmButtonColor: "#879435",
    confirmButtonText: "De acuerdo, lo entiendo.",
    imageUrl: avatar,
    imageWidth: 200,
    imageHeight: 200,
    imageAlt: "Custom image"
  })

  //Añadimos el comentario al contenedor de comentarios

  COMENTARIOS.appendChild(divComentario);
}*/

FORM.addEventListener('submit', function (event) {

  event.preventDefault();

  if (!validarEmail()) {
    Swal.fire({
      title: '<h3 style="color:black">Ingrese un email con formato xxx@xxx.xxx</h3>',
      icon: 'error',
      confirmButtonColor: "#879435",
      confirmButtonText: "Volver a intentar",
      imageUrl: "../icon/email.jpg",
      imageWidth: 200,
      imageHeight: 200,
      imageAlt: "Custom image"
    })
    return;
  }

});