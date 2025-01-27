<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido',
        'telefono'
    ];

    
    // Creamos los atributos de la clase
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    // Creamos el constructor de la clase
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    
    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$errores[] = 'El apellido es obligatorio';
        }
        if (!$this->telefono) {
            self::$errores[] = 'El numero de telefono es obligatorio';
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = 'Formato no valido';
        }
        return self::$errores;
    }
}