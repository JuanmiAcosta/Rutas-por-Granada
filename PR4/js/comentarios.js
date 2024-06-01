import { FORM } from './constantes.js';
import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/+esm'

function validarEmail() {
  var email = document.getElementById('email').value;
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

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