<?php

namespace Controllers;

use Classes\Email;
use Classes\Recuperar;
use MVC\Router;
use Model\Usuario;
use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;
use Model\ActiveRecord;
use PHPMailer\PHPMailer\PHPMailer;
use Intervention\Image\ImageManagerStatic as Image;


class APIControllers
{

    public static function index()
    {

        $servicios = Servicio::all();
        echo json_encode($servicios); //me permite ver todos los datos de la base de datos con json


    }

    public static function guardar()
    { // recordar que un arreglo asociativo es un equivalente a un objeto en javascript

        //Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar(); //lo inserta en la base de datos   

        $id = $resultado['id'];

        //almacena la cita y el servicio
        //almacena los servicios con el ID de la cita
        $idServicios = explode(",", $_POST['servicios']); //separador y el string que quiero separar = me da un arreglo 
        
        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);           
            $citaServicio->guardar();
        }

        //retonramos una respuesta
        echo json_encode(['resultado'=>$resultado]);
    }


    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id= $_POST['id'];
            $cita= Cita::find($id);
            $cita->eliminar();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
