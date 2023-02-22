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


class ServicioControllers
{

    public static function index (Router $router){

        if (!$_SESSION['nombre']) {
            session_start();
         
        }
        isAdmin(); //para proteger las rutas de crear, actualizar servicios

        $servicios=Servicio::all();

        $router->render('/servicios/index', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
            'nombre'=>$_SESSION['nombre'],
            'servicios'=>$servicios
        ]);
    }


    public static function crear(Router $router){

        if (!$_SESSION['nombre']) {
            session_start();         
        }

        isAdmin();

        $servicio=new Servicio;
        $alertas=[];

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $servicio->sincronizar($_POST);
            $alertas=$servicio->validar();
            if(empty($alertas)){
                $servicio->guardar();
                header('Location:/servicios');
            }

        }

        $router->render('/servicios/crear', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
            'nombre'=>$_SESSION['nombre'],
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
       
    }

    public static function actualizar (Router $router){

        if (!$_SESSION['nombre']) {
            session_start();         
        }

        isAdmin();
        
        if(!is_numeric($_GET['id'])) return;
        $servicio=Servicio::find($_GET['id']);
        $alertas=[];

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            
            $servicio->sincronizar($_POST);
            $alertas=$servicio->validar();
            if(empty($alertas)){
                $servicio->guardar();
                header('Location:/servicios');            }
        }

        $router->render('/servicios/actualizar', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
            'nombre'=>$_SESSION['nombre'],
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }

    public static function eliminar(){  
        
        if (!$_SESSION['nombre']) {
            session_start();         
        }
        
        isAdmin();
        
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $id=$_POST['id'];
            $servicio=Servicio::find($id); //para encontrarlo en la base de datos
            $servicio->eliminar(); //para eliminarlo
            header('Location:/servicios');
            
        }
       
       
    }

   
}