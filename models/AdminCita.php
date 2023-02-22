<?php

namespace Model;

class AdminCita extends ActiveRecord
{
    
    //vamos a escribir teniendo en cuenta la base de datos
    protected static $tabla = 'citasservicios';

    //las columnas que va a tener la base de datos
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email','telefono', 'servicio','precio'];

    //atributos
    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    //metodo
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email= $args['email'] ?? '';
        $this->telefono= $args['telefono'] ?? '';
        $this->servicio= $args['servicio'] ?? '';
        $this->precio= $args['precio'] ?? '';
    }

    
}