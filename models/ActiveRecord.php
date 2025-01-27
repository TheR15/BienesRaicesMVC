<?php

namespace Model;

class ActiveRecord
{
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores
    protected static $errores = [];

    //Definimos la conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    // Creamos el metodo guardar
    public function crear()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la base de datos 
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /admin?resultado=1');
        }
    }
    //Actualizar un registro
    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();
        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /admin?resultado=2');
        }
    }

    //Eliminar un registro
    public function eliminar()
    {
        //Eliminar un registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //Identificar y unir los atributos de la base de datos
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            //Si la columna es igual a id, no la agregamos
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    //Sanitizar los atributos
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    //Validar los datos
    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    //Subida de archivos 
    public function setImagen($imagen)
    {
        //Eliminar la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        //Asignar la imagen a la propiedad
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar imagen
    public function borrarImagen()
    {
        //Comprobar si la imagen existe
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        //Si la imagen existe, eliminarla
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Listar todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Listar un numero determinado de registros
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        //Retornar la primera posicion del arreglo
        return array_shift($resultado);
    }


    public static function consultarSQL($query)
    {
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        //Liberar la memoria
        $resultado->free();
        //Retornar los resultados
        return $array;
    }

    //Crear un objeto en base a una consulta
    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sinconizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
