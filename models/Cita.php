<?php

namespace Model;

class Cita extends ActiveRecord
{
    
    //vamos a escribir teniendo en cuenta la base de datos
    protected static $tabla = 'citas';

    //las columnas que va a tener la base de datos
    protected static $columnasDB = ['id', 'fecha', 'hora','usuarioId'];

    //atributos
    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;


    //metodo
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
    }

    
}