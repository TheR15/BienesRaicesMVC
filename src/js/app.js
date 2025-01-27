document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkmode();
})

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => {
        input.addEventListener('click', mostrarMetodosContacto);
    });

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');//Si la tiene la quita, si no la tiene la pone
}
function darkmode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    //console.log (prefiereDarkMode.matches);

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })
    const botonDarkMode = document.querySelector('.dark-mode-boton')
    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    })
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero telefono</label>
            <input type="tel" placeholder="Tu telefono" id="telefono" name="contacto[telefono]">

            <p>Eliga la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input id="fecha" type="date" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input id="hora" type="time" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
             <label for="email">E-Mail</label>
            <input id="email" type="email" placeholder="Ingrese tu correo electronico" name="contacto[email]">
        `;
    }
}