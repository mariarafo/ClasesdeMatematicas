<?php

namespace Controllers;

use Classes\Email;
use Classes\Recuperar;
use MVC\Router;
use Model\Usuario;
use Model\ActiveRecord;
use PHPMailer\PHPMailer\PHPMailer;
use Intervention\Image\ImageManagerStatic as Image;


class LoginControllers
{
    public static function login(Router $router)
    {  //iniciar sesion
        $alertas = [];
        $auth = new Usuario; //para que quede guardado en la pagina principal si se puso mal el password 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            // debuguear($auth);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                //comprobar si existe el usuario 
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario) {
                    //verficar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        //autenticar el usuario
                        // session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionando
                        if ($usuario->admin === "1"){
                            $_SESSION['admin']=$usuario->admin??null;
                            header('Location:/admin');
                        } else {
                            header('Location:/cita');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no Encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }


    public static function logout()
    { //cerrar sesion
        // echo "Desde Logout"; //para verificar que se conecta
       session_start();
       $_SESSION=[];
       header('Location:/');
    }


    public static function olvide(Router $router)
    {   //olvide password
        // echo "Desde Olvide"; //para verificar que se conecta
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth=new Usuario($_POST);
            $alertas=$auth->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                if($usuario && $usuario->confirmado==='1'){
                    //Generar un token
                    $usuario->crearToken();
                    $usuario->guardar();
                    //Enviar el email con el token
                    
                    $email = new Recuperar($usuario->nombre, $usuario->apellido, $usuario->email, $usuario->token);
                    $email->enviarRecuperar();              
                  
                    

                    //Enviar un email con las inscrtrucciones

                    //muestra en la pantalle el mensaje de exito
                    Usuario::setAlerta('exito', 'Revisa tu email ahi se te mando las instrucciones');
                   

                }else{
                    Usuario::setAlerta('error', 'El Usuario no Existe o no esta Confirmado');
                    
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
          'alertas'=>$alertas,
          
          
        ]);
    }


    public static function recuperar(Router $router)
    {   //recuperar password
        //echo "Desde Recuperar"; //para verificar que se conecta
        $alertas = [];
        $error=false;
        $token=s($_GET['token']);

        //buscar usuario por su token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token NO Válido'); 
            $error=true; 
           
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Leer el nuevo password y guardarlo
            $password=new Usuario($_POST);
            $alertas=$password->validarPassword();
            if(empty($alertas)){
                $usuario->password=null;

                $usuario->password=$password->password;
                $usuario->hashPassword();
                $usuario->token=null;

               $resultado=$usuario->guardar();
               if($resultado){
                header('Location:/');
               }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
         'alertas'=>$alertas,
         'error'=>$error
         
        ]);
    }

    public static function crear(Router $router)
    {   //crear cuenta de usuario
        // echo "Desde Crear Cuenta";//para verificar que se conecta
        $usuario = new Usuario; // para tener el objeto vacio y cuando lo recarguemos aparezca el formulario vacio

        //Arreglo que nos devuelve mensajes de error si el usuario manda el formulario vacio o les falta campos llenados
        $alertas = [];

        // debuguear($errores);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST); // -> es para acceder a ese  atributo

            //Validar que no hayas campos vacios antes le llamabamos errores
            $alertas = $usuario->validarNuevaCuenta(); //devuelve un arreglo

            //Revisar que alerta este vacio
            if (empty($alertas)) {
                //verifica que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    //esta registrado
                    $alertas = Usuario::getAlertas();
                } else {
                    //hashear el password
                    $usuario->hashPassword();

                    //generar un token unico
                    $usuario->crearToken();

                    //Enviar el email con el token
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();

                    //Enviar el usuario a la base de datos
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location:/mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }


    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
        ]);
    }

    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']); //sanitizamos con s y commo queremos leer la url usamos $get
        $usuario = Usuario::where('token', $token); // donde de la columna de la base de datos buscamos el sigueinte valor $token

        if (empty($usuario) || $usuario->token === '') {
            //mostrar mensaje de error

            Usuario::setAlerta('error', 'Token no válido');
        } else {
            //modificar usuario a confirmado
            $usuario->confirmado = "1";
            $usuario->token = '';
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }

        $alertas = Usuario::getAlertas(); //para que pueda las alertas
        $router->render('auth/confirmar-cuenta', [  //para mostrar en la vista de la pagina que es lo q esta en la carpeta views
            'alertas' => $alertas
        ]);
    }

   


}
