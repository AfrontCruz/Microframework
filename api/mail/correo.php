<?php
require("includes/class.phpmailer.php");
require_once("../utils/response.php");

class correo
{
    // Atributos de usuario
    private $mail;
    
    public function __construct($titulo, $message, $correo)
    {
        // $message  = file_get_contents('../mail/template/example.html');
        // $message = str_replace( "@name", "Oscar Daniel", $message ); 
        // print_r( $message );

        $mail = new PHPMailer();

        $mail->From     = ("notificaciones@rheach.pro"); //Dirección desde la que se enviarán los mensajes. Debe ser la misma de los datos de el servidor SMTP.
        $mail->FromName = "Notificaciones RHEA";
        $mail->AddAddress( $correo ); // Dirección a la que llegaran los mensajes.

        // Aquí van los datos que apareceran en el correo que reciba

        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject  =  $titulo;
        $mail->Body     =  $message;

        // Datos del servidor SMTP

        $mail->IsSMTP(); 
        $mail->Host = "smtp.office365.com:587";  // Servidor de Salida.
        // $mail->SMTPDebug = 2;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = "notificaciones@rheach.pro";  // Correo Electrónico
        $mail->Password = "Redsnow0518"; // Contraseña
        if( $mail->Send() ){
            $response = new response(null, true, null);
            print_r( json_encode( $response ) );
        }
        else{
            $response = new response(null, false, null);
            print_r( json_encode( $response ) );
        }
    }

    
}
?>
