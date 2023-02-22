<?php 

require __DIR__ . '/../vendor/autoload.php'; 
$dotenv= Dotenv\Dotenv::createImmutable(__DIR__); //manda a llamar al archivo .env que tiene las variables de entorno
$dotenv->safeLoad(); //si el archivo .env no existe no nos va a dar un error

require 'funciones.php';
require 'database.php';


// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);