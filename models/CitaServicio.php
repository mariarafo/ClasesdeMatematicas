<?php

namespace Model;

class CitaServicio extends ActiveRecord
{

    //vamos a escribir teniendo en cuenta la base de datos
    protected static $tabla = 'citasservicios';

    //las columnas que va a tener la base de datos
    protected static $columnasDB = ['id', 'citaId', 'servicioId'];

    //atributos
    public $id;
    public $citaId;
    public $servicioId;


    //metodo
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citaId = $args['citaId'] ?? '';
        $this->servicioId = $args['servicioId'] ?? '';
    }

    



}
