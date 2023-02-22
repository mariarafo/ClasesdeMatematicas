<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Recuperar
{
    public $email;
    public $nombre;
    public $apellido;
    public $token;

    public function __construct($nombre, $apellido, $email, $token)
    {
        
        $this->nombre = $nombre;
        $this->apellido=$apellido;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarRecuperar()
    {
        //Crear una instancia de PHPMAILER
        $mail = new PHPMailer();

        //Vamos a confirgurar SMTP (es el protocolo que se utiliza para el envio de email)
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'f3e3ac6a245058';
        $mail->Password = '2fb248d8219618';
        $mail->SMTPSecure = 'tls'; // es la forma segura para que no te roben datos
        $mail->Port = 2525;

        //Vamos a configurar el contenido del email
        $mail->setFrom('cuentas@clasesdematematicas.com'); //quien envia el email
        $mail->addAddress('cuentas@clasesdematematicas.com', 'ClasesdeMatematicas.com'); // direccion donde se va a recibir
        $mail->Subject = 'Reestablece tu Password'; //el mensaje que el usuario va a leer

        //Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; // acepta letras especificas del lenguaje español ejemplo acento

        //Definir Contenido
        $contenido = '<html>';
        $contenido .= "<p>Hola <strong> " . $this->nombre. " ". $this->apellido .  " </strong> has solicitado reestablecer tu Password en Clases de Matemáticas, solo debes  presionar el siguiente enlace para hacerlo:</p>";
        $contenido .= "<p><a href='http://localhost:3000/recuperar?token=". $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si no solicitaste este cambio puedes ignorar el mensaje</p>";
        $contenido .= '</html>';


        $mail->Body = $contenido;
        $mail->AltBody = 'Esto es texto alternativo sin HTML';

        //Enviar el email
        $mail->send(); //send() devuelve true o false donde true es lo envio y false no lo envio



    }
}
