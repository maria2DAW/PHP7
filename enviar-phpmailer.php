<?php   
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$de = $_POST['de_txt'];
$para = $_POST['para_txt'];
$asunto = $_POST['asunto_txt'];
$mensaje = $_POST['mensaje_txa'];

//Para que no aparezcan símbolos extraños a la hora de recibir el correo
$cabeceras = "MIME-Version 1.0\r\n";
//Tipo de texto en formato HTML. Formato Europeo/Occidental, para que no aparezcan símbolos raros (charset).
$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
$cabeceras .= "From: $de \r\n";

$archivo = $_FILES["archivo_fls"]["tmp_name"];
$destino = $_FILES["archivo_fls"]["name"];

//El cuarto parámetro es opcional
if(move_uploaded_file($archivo, $destino))
{
    try 
    {  
        $mail->SMTPDebug = 2;        
        
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));        
              
        //Protocolo SMTP
        $mail->isSMTP();
        
        //Autenticación en el SMTP
        $mail->SMTPAuth = true;
        //SSL security socket layer
        $mail->SMTPSecure = 'ssl';
        //Servidor de SMTP de gmail
        $mail->Host = 'smtp.gmail.com';
        //Puerto seguro del servidor SMTP de gmail
        $mail->Port = 465;
        //Codificación del correo
        $mail->CharSet = "UTF-8";
        //Remitente del correo
        $mail->From = $de;
        //Destinatario o destinatarios
        $mail->AddAddress($para);
        //Tu correo de gmail
        $mail->Username = "maria.rengelcasimiro@gmail.com";
        //Contraseña de gmail
        $mail->Password = "118320851214";
        //Asunto del correo
        $mail->Subject = $asunto;
        //Contenido del correo
        $mail->Body = $mensaje;
        //Número de colunmas que tendrá el correo electrónico
        $mail->WordWrap = 50;
        //Se indica que el cuerpo del correo tendrá formato HTML
        $mail->isHTML(true);
        //Accedemos al archivo que se subió al servidor y lo adjuntamos
        $mail->AddAttachment($destino);

        //Enviamos el correo por PHPMailer
        $mail->send();
        $respuesta = "El mensaje ha sido enviado con la clase PHPMailer y tu cuenta de gmail.";
    
    }
    
    catch (Exception $e) 
    {
        $respuesta = "El mensaje no se pudo enviar con la clase PHPMailer y tu cuenta de gmail.";
        $respuesta .= " Error: ".$mail->ErrorInfo;
    }
}

else
{
    $respuesta = "Ocurrió un error al subir el archivo adjunto.";
}

//Nos sirve para borrar un archivo en el servidor. 
//Con esto nuestra carpeta no se llenara de archivos que no necesitaremos.
unlink($destino);

header("Location: index.php?respuesta=$respuesta");

