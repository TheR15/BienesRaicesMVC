<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value=<?php echo s($vendedor->nombre); ?>>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor(a)" value=<?php echo s($vendedor->apellido); ?>>
        </fieldset>

        <fieldset>
            <legend>Informacion Extra</legend>


            <label for="telefono">Telefono:</label>
            <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor(a)" value=<?php echo s($vendedor->telefono); ?>>
        </fieldset>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
    </form>
</main>