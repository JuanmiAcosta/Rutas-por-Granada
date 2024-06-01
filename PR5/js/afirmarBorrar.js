import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/+esm'

function borrarActividad() {
    console.log('Borrando actividad...');
    var id = document.getElementById('id_act').innerText;

    // Redirige a la URL de eliminación
    window.location.href = '/eliminarActividad/' + id;
}

document.getElementById('borrar-act').addEventListener('click', function() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar esta actividad!",
        icon: 'warning',
        imageUrl: "../icon/tnt.png",
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: "Custom image",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',   
        confirmButtonText: '¡Sí, bórrala!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llamar a la función de borrar actividad ( php )
            console.log('Swal aceptando ...');
            borrarActividad();
        }
    })
});