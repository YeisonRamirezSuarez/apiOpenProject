<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="es-cr" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Test</title>
</head>
<style>
        .button {
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
        }
        
        .button1 {background-color: #4CAF50;} /* Green */
        .button2 {background-color: #008CBA;} /* Blue */
        </style>
<body>
   

<?php
function escribir($x){
	echo $x;
}

function msg($x){
	echo '<script> alert("' . $x . '"); </script>';
}

function peticion(){
   $esquema =[

      '_links' =>[
  
          'members' => [
  
                 'href' => 'api/v3/users/1'
          ],
  
      ],
  
      'name' => 'DMA'
  
  ];
  
  $persona = [
  
      
          "admin" => false,
          "email"=> "h.wurject.com",
          "firstName"=> "ANDRES",
          "language"=> "de",
          "lastName"=> "CANBAS",
          "login"=> "h.ESDADt",
          "password"=> "huntSSAer565465465465",
          "status"=> "active"
        
  
  ];
  
  
  // Los codificamos
  // recomendado: https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/
  $datosCodificados = json_encode($persona);
  
  // Comenzar a crear el objeto de curl
  # A dónde se hace la petición...
  $url = "https://dma.openproject.com/api/v3/users/1";
  $ch = curl_init($url);
  
  # Ahora le ponemos todas las opciones
  # Nota: podríamos usar la versión corta de arreglos: https://parzibyte.me/blog/2018/10/11/sintaxis-corta-array-php/
  curl_setopt_array($ch, array(
      // Indicar que vamos a hacer una petición POST
      CURLOPT_CUSTOMREQUEST => "GET",
      // Justo aquí ponemos los datos dentro del cuerpo
      CURLOPT_POSTFIELDS => $datosCodificados,
  
      CURLOPT_USERPWD => "apikey:6a727de0a523bf2cd1b200558df6c9dc51b04b32755460d69f27575d88308f3e",
      // Encabezados
      //CURLOPT_HEADER => true,
      CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Content-Length: ' . strlen($datosCodificados), // Abajo podríamos agregar más encabezados
          'Personalizado: ¡Hola mundo!', # Un encabezado personalizado
      ),
      # indicar que regrese los datos, no que los imprima directamente
      //CURLOPT_RETURNTRANSFER => true,
  ));
  # Hora de hacer la petición
  $resultado = curl_exec($ch);
  # Vemos si el código es 200, es decir, HTTP_OK
  $codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if($codigoRespuesta === 200){
      # Decodificar JSON porque esa es la respuesta
      $respuestaDecodificada = json_decode($resultado);
      # Simplemente los imprimimos
      echo "Se ejecuto consulta. Código de respuesta: $codigoRespuesta";
      //echo "<strong>El servidor dice que la hora de petición fue: </strong>" . $respuestaDecodificada->id;
      //echo "<strong>El servidor dice que la hora de petición fue: </strong>" . $respuestaDecodificada->name;
      //echo "<br><strong>El servidor dice que el primer lenguaje es: </strong>" . $respuestaDecodificada->primerLenguaje;
      // echo "<br><strong>Los encabezados que el servidor recibió fueron: </strong><pre>" . var_export($respuestaDecodificada->encabezados, true) . "</pre>";
      // echo "<br><strong>Los gustos musicales que el servidor recibió fueron: </strong><pre>" . var_export($respuestaDecodificada->gustosMusicales, true) . "</pre>";
      // echo "<br><strong>Los libros que el servidor recibió fueron: </strong><pre>" . var_export($respuestaDecodificada->libros, true) . "</pre>";
      // echo "<br><strong>Mensaje del servidor: </strong>" . $respuestaDecodificada->mensaje;
  }else if($codigoRespuesta === 303){
      echo "No se permite crear usuarios. Código de respuesta: $codigoRespuesta";
  } else{
  
      # Error
      echo "Error consultando. Código de respuesta: $codigoRespuesta";
  }
  curl_close($ch);
}

?>



<form method="post">
	<input name="Text1" style="width: 350px " type="text" /><br />
	<input  class="button button1" name="Button1" type="submit" value="Escribir"  />
	&nbsp;
	<input  class="button button2" name="Button2" type="submit" value="Mensaje" /> 
</form>

<?php

	$texto;

	if(isset($_POST['Text1']))
		$texto=$_POST['Text1'];

	if(isset($_POST["Button1"])){
	     escribir($texto);
	}

	if(isset($_GET["Button2"])){
	     peticion();
	}

?>

</body>

</html>