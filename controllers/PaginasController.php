<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {

        $id = validarORedireccionar('/');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {

        $router->render('paginas/blog', []);
    }
    public static function entrada(Router $router)
    {

        $router->render('paginas/entrada', []);
    }
    public static function contacto(Router $router)
    {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuesta = $_POST['contacto'];
            //Crar una instacia de PHPMailer

            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'e6eb37ef07b7f9';
            $mail->Password = '89f93abd950acf';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contendio del email;
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuesta['nombre'] . '</p>';

            //Enviar de forma condicional 

            if ($respuesta['contacto'] === 'telefono') {
                $contenido .= '<p>Eligio ser contactado por telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuesta['telefono'] . '</p>';
                $contenido .= '<p>Fecha de contacto: ' . $respuesta['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuesta['hora'] . '</p>';
            } else {
                //Es email
                $contenido .= '<p>Eligio ser contactado por email</p>';
                $contenido .= '<p>Email: ' . $respuesta['email'] . '</p>';
            }
            $contenido .= '<p>Mensaje: ' . $respuesta['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra: ' . $respuesta['tipo'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: ' . $respuesta['mensaje'] . '</p>';
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            if ($mail->send()) {
                $mensaje = 'Mensaje enviado correctamente';
            } else {
                $mensaje = 'El mensaje no se pudo enviar';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
