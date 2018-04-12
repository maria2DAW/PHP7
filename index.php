<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Envío de correo con la función mail de PHP</title>
        <link rel="stylesheet" href="css/estilo.css" />
    </head>
    <body>
        <?php        
            // Import PHPMailer classes into the global namespace
            // These must be at the top of your script, not inside a function
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            //Load Composer's autoloader
            require 'vendor/autoload.php';

            $mail = new PHPMailer(true); 
        ?>
        
        
        <h1>Envío de correo con la función mail de PHP</h1>
        
        <form name="mail_frm" action="enviar-phpmailer.php" method="post" enctype="multipart/form-data">
            DE:
            <input type="text" name="de_txt" />
            <br /><br />
            PARA:
            <input type="text" name="para_txt" />
            <br /><br />
            Asunto: 
            <input type="text" name="asunto_txt" />
            <br /><br />
            Adjuntar archivo: <input type="file" name="archivo_fls" />
            <br /><br />
            Mensaje:<br />
            <textarea name="mensaje_txa"></textarea>
            <br /><br />
            <input type="button" name="enviar_btn" value="enviar" /><br />
            
            <?php
                error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
                
                if(isset($_GET["respuesta"]))
                {
                    echo "<span>".$_GET["respuesta"]."</span>";
                }
            ?>
        </form>
        
        <script src="js/validaciones.js"></script>    
    </body>
</html>
