<?php

namespace Controllers;

use Classes\Email;
use Classes\Recuperar;
use MVC\Router;
use Model\Usuario;
use Model\ActiveRecord;
use Model\AdminCita;
use PHPMailer\PHPMailer\PHPMailer;
use Intervention\Image\ImageManagerStatic as Image;


class AdminControllers
{
    public static function index(Router $router)
    {
        //echo 'desde Admin';
        if (!$_SESSION['nombre']) {
            session_start();
        }
        
        isAdmin();
        
        //
        $fecha=$_GET['fecha'] ?? date('Y-m-d');// nos trae el valor de la feha
        $fechas=explode('-',$fecha);// separamos la fecha con el separador - y tendremos un arreglo con 3 elemtnos array=[y,m,d] = fecha[0],fecha[1], fecha[2]
        //
        //para validar la fecha usamos checkdate
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){// aqui checks es primero el mes, dia y año por eso son esos valores
          header('Location:/404');
        }

      
       

        //consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '$fecha' ";

        $citas= AdminCita::SQL($consulta); //para hacer la consulta plana a SQL
       

        $router->render('admin/index', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha'=>$fecha
        ]);
    }
}
