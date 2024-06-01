var texto = document.getElementById('search').value;

async function getListaActividades(text) {
    let response = await fetch('/getActividadesPorTitulo.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'texto=' + text
    });

    let data = await response.json();
    return data;
}

async function actualizarListaActividades() {
    var texto = document.getElementById('search').value;
    let actividades = await getListaActividades(texto);

    let listaActs = document.querySelector('.listaActs');
    listaActs.innerHTML = '';

    actividades.forEach(actividad => {
        let act = document.createElement('div');
        act.classList.add('act');
        act.innerHTML = `
            <a class="logo" href="/actividad/${actividad.id}" ><img src="${actividad.foto}" alt="Actividad"><a>
            <h2>${actividad.titulo}</h2>
            <p>Localización: ${actividad.ubicacion}</p>
            <a href="/modificarCrearActividad/${actividad.id}" class="editarbtn"><img src="/icon/pico.png" alt="editar"></a>
        `;

        listaActs.appendChild(act);
    });
}

var texto2 = document.getElementById('searchComents').value;

async function getListaComentarios(text) {
    let response = await fetch('/getComentariosPorTexto.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'texto=' + text
    });

    let data = await response.json();
    return data;
}

/*$comentarios[] = array('nombre' => $comentario['nick'],'id_comentario' => $comentario['id_comentario'], 'email' => $comentario['email'], 
                'comentario' => $comentario['comentario'], 'fecha' => $comentario['fecha'], 'avatar' => $comentario['avatar']
                , 'red' => $red, 'green' => $green, 'blue' => $blue, 'id' => $comentario['id']);*/

async function actualizarListaComentarios() {
    var texto = document.getElementById('searchComents').value;
    let comentarios = await getListaComentarios(texto);

    let listaComents = document.querySelector('.listaComents');
    listaComents.innerHTML = '';

    comentarios.forEach(comentario => {
        let coment = document.createElement('div');
        coment.classList.add('comentario');
        coment.innerHTML = `
            <div class="autor">
                <div class="img-avatar" style="background-color: rgb(${comentario.red}, ${comentario.green}, ${comentario.blue});"> <img src="${comentario.avatar}" alt="avatar"> </div>
                <p>${comentario.nombre} ( ${comentario.email} )</p>
            </div>
            <p>${comentario.comentario}</p>
            <p class="fechaYhora">${comentario.fecha}</p>
            <a href="/actividad/${comentario.id}" class="irActividad">Ir a la actividad : ${comentario.titulo}</a>
        `;

        listaComents.appendChild(coment);
    });

}



