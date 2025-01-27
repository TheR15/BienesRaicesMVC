<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php 
        foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
    <?php endforeach;?>

    <form action="/login" method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">E-Mail</label>
            <input name="email" id="email" type="email" placeholder="Ingrese tu correo electronico">

            <label for="password">Password</label>
            <input name="password" id="password" type="password" placeholder="Tu password">
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
</main>