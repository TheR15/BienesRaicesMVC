<?php
//Este archivo se encarga de importar todos los archivos necesarios para que la aplicacion funcione sin necesidad de importar uno por uno
require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectamos a la base de datos

$db = conectarDB();

use Model\ActiveRecord;

//Seteamos la conexion a la base de datos
ActiveRecord::setDB($db);