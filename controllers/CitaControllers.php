<?php

namespace Controllers;

use Classes\Email;
use Classes\Recuperar;
use MVC\Router;
use Model\Usuario;
use Model\ActiveRecord;
use PHPMailer\PHPMailer\PHPMailer;
use Intervention\Image\ImageManagerStatic as Image;


class CitaControllers
{ 
    public static function index(Router $router){
        //echo 'desde cita';
        if (!$_SESSION['nombre']) {
            session_start();
         
        }
        
        isAuth();//para revisar que el usuario este autenticado

        $router->render('cita/index', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
           'nombre'=>$_SESSION['nombre'],
           'id'=>$_SESSION['id']
        ]);
    }


  




}