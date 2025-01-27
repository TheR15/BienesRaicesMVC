<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="LogoTipo de Bienes Raices">
                </a>


                <div class="mobile-menu">
                    <img src="/src/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <img src="/build/img/dark-mode.svg" class="dark-mode-boton" alt="">
                        <?php if ($auth):?>
                            <a href="/cerrar-sesion.php">Cerrar Sesion</a>
                        <?php endif;?>
                    </nav>
                </div>

            </div><!--Este es el cierre de la barra-->
            <?php
            ?>
        </div>
    </header>