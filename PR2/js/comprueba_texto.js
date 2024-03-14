import { TEXTO } from './constantes.js';
import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/+esm'

const palabrasFeillas = ['puta', 'mierda', 'coño', 'polla', 'gilipollas', 'cabrón', 'cabron', 'idiota', 'imbecil', 'imbécil'];


TEXTO.addEventListener('input', function() {

    //console.log(TEXTO.tagName.toLowerCase());
    //console.log(TEXTO.value);

    var palabras = TEXTO.value.split(' ');

    for (var i = 0; i < palabras.length; i++) {
        // If the word is prohibited, alert the user
        if (palabrasFeillas.includes(palabras[i].toLowerCase())) {
            Swal.fire({
                title: '<h3 style="color:black">Se ha detectado una palabra no permitida en el comentario. Será censurada inmediatamante.</h3>',
                icon: 'error',
                confirmButtonColor: "#879435",
                confirmButtonText: "De acuerdo, lo entiendo.",
                imageUrl: "icon/censurar.jpg",
                imageWidth: 200,
                imageHeight: 200,
                imageAlt: "Custom image"
              })

            var long = palabras[i].length;

            palabras[i] = '';

            for (var j = 0; j < long; j++) {
                palabras[i] += '*';
            }

            TEXTO.value = palabras.join(' ');

            break;
        }
    }
});