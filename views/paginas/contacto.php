<main class="contacto-header">
    <h1>Contacto</h1>

    <?php if ($mensaje) { ?>
        <p class='alerta exito'><?php echo $mensaje; ?></p>";
    <?php } ?>


    <div class="header-contacto">
        <img src="build/img/destacada3.jpg" alt="Imagen contacto">
    </div>

    <h2>Llena el Formulario de Contacto</h2>

    <form method="POST" class="formulario contenedor seccion">
        <fieldset>
            <legend>Informacion Personal</legend>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" placeholder="Ingrese tu nombre" name="contacto[nombre]">

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]"></textarea>

        </fieldset>

        <fieldset>
            <legend>Informacion Sobre Propiedad</legend>
            <label for="opcion-compra">VENDE O COMPRA</label>
            <select name="contacto[tipo]" id="opcion-compra">
                <option value="" disabled selected>--Seleccione una opcion--</option>
                <option value="Vende">Vende</option>
                <option value="Compra">Compra</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input id="presupuesto" type="number" placeholder="Tu precio o presupuesto" name="contacto[precio]">
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <label for="telefono">Como desea ser Contactado</label>

            <div class="forma-contacto">
                <label for="">TELEFONO</label>
                <input type="radio" value="telefono" name="contacto[contacto]">

                <label for="">E-MAIL</label>
                <input type="radio" value="correo" name="contacto[contacto]">
            </div>

            <div id="contacto"></div>



        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>