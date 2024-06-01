var mostrandoRegistro = false;

document.getElementById('btn-cambio').addEventListener('click', (e) => {

    e.preventDefault();

    var registro = document.querySelector('.registro');
    var login = document.querySelector('.login');
    var mensaje = document.getElementById('mensaje');
    var btnCambio = document.querySelector('#btn-cambio');
    var error = document.querySelector('#error');

    if (!mostrandoRegistro) {
        registro.style.display = 'flex';
        login.style.display = 'none';
        mensaje.textContent = '¿Ya tienes cuenta? ';
        btnCambio.textContent = 'Iniciar sesión';
        mostrandoRegistro = true;
        error.style.display = 'none';
    } else {
        registro.style.display = 'none';
        login.style.display = 'flex';
        mensaje.textContent = '¿No tienes cuenta? ';
        btnCambio.textContent = 'Registrarse';
        mostrandoRegistro = false;
        error.style.display = 'none';
    }
});