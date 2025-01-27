<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {

        session_start();

        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas solo puede acceder el admin
        $rutas_protegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar'
        ];

        //Se obtiene la url actual de la página
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        //Se guarda el tipo de petición ya sea GET o POST
        $metodo = $_SERVER['REQUEST_METHOD'];
        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }
        if ($fn) {
            //La página fue encontrada
            call_user_func($fn, $this);
        } else {
            //Página no encontrada
            echo 'Página no encontrada';
        }
    }

    //Muestra una vista
    public function render($view, $datos = [])
    {
        //Se inicia el almacenamiento en memoria
        //Se extraen los datos
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";
        //Se guarda el contenido en la variable
        $contenido = ob_get_clean(); //Limpiar el buffer
        include __DIR__ . "/views/layout.php";
    }
}
