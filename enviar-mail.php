<?php

$de = $_POST['de_txt'];
$para = $_POST['para_txt'];
$asunto = $_POST['asunto_txt'];
$mensaje = $_POST['mensaje_txa'];

//Para que no aparezcan símbolos extraños a la hora de recibir el correo
$cabeceras = "MIME-Version 1.0\r\n";
//Tipo de texto en formato HTML. Formato Europeo/Occidental, para que no aparezcan símbolos raros (charset).
$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
$cabeceras .= "From: $de \r\n";

//El cuarto parámetro es opcional
if(mail($para, $asunto, $mensaje, $cabeceras))
{
    $respuesta = "El mensaje ha sido enviado.";
}

else
{
    $respuesta = "Ocurrió un error. No se enviaron los datos.";
}

header("Location: index.php?respuesta=$respuesta");

