<?php

namespace Model;

class Servicio extends ActiveRecord
{

    //vamos a escribir teniendo en cuenta la base de datos
    protected static $tabla = 'servicios';

    //las columnas que va a tener la base de datos
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    //atributos
    public $id;
    public $nombre;
    public $precio;


    //metodo
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    
    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][]='El Nombre de la Clase es obligatorio';
        }
        
        if(!$this->precio){
            self::$alertas['error'][]='El Precio de la Clase es obligatorio';
        }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][]='El Precio no es válido';
        }
        return self::$alertas;
    }


}
