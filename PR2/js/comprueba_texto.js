import { TEXTO } from './constantes.js';

const palabrasFeillas = ['puta', 'mierda', 'coño', 'polla', 'gilipollas', 'cabrón', 'cabron', 'idiota', 'imbecil', 'imbécil'];


TEXTO.addEventListener('input', function() {

    //console.log(TEXTO.tagName.toLowerCase());
    //console.log(TEXTO.value);

    var palabras = TEXTO.value.split(' ');

    for (var i = 0; i < palabras.length; i++) {
        // If the word is prohibited, alert the user
        if (palabrasFeillas.includes(palabras[i].toLowerCase())) {
            alert('Se ha detectado una palabra no permitida en el comentario. Será censurada inmediatamante.');

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