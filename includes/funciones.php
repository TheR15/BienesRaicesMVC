<?php
//Funciones, en este archivo se encuentran las funciones que se utilizan en el proyecto

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{
   include TEMPLATES_URL . "/${nombre}.php";
}

//Verifica si el usuario esta autenticado
function estaAutenticado()
{
   session_start();
   if (!$_SESSION['login']) {
      header('Location: /');
   }
}

// Debuguea una variable
function debuguear($variable)
{
   echo "<pre>";
   var_dump($variable);
   echo "</pre>";
   exit;
}

//Escapa / Sanitiza el HTML
function s($html): string
{
   $s = htmlspecialchars($html);
   return $s;
}

//Valida el tipo de contenido

function validarTipoContenido($tipo)
{
   $tipos = ['vendedor', 'propiedad'];
   //in_array busca un valor en un array
   return in_array($tipo, $tipos);
}

//Muestra los mensajes

function mostrarNotificacion($codigo)
{
   $mensaje = '';
   switch ($codigo) {
      case 1:
         $mensaje = 'Creado correctamente';
         break;
      case 2:
         $mensaje = 'Actualizado correctamente';
         break;
      case 3:
         $mensaje = 'Eliminado correctamente';
         break;
      default:
         $mensaje = false;
         break;
   }
   return $mensaje;
}

function validarORedireccionar(string $url)
{
   //Validar que sea un idvalido
   $id = $_GET['id'];
   $id = filter_var($id, FILTER_VALIDATE_INT);

   if (!$id) {
      header("Location: ${url}");
   }

   return $id;
}
