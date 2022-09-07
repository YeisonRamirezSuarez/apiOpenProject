<?php
/**
 * Ejemplo de cómo usar PHP, JSON y cURL para enviar
 * datos codificados a otro servidor
 * 
 * @author parzibyte
 */

# Definimos los datos que vamos a enviar, estos pueden venir de cualquier lugar
# Los hacemos complejos y largos para demostrar cómo se pueden anidar

$nombre = $_REQUEST['name'];
$apellido = $_REQUEST['apellido'];
$contrasena = $_REQUEST['contraseña'];
$correo = $_REQUEST['correo'];
$usuario = $_REQUEST['usuario'];

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
        "email"=> $correo,
        "firstName"=> $nombre,
        "language"=> "es",
        "lastName"=> $apellido,
        "login"=> $usuario,
        "password"=> $contrasena,
        "status"=> "active"
      

];


// Los codificamos
// recomendado: https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/
$datosCodificados = json_encode($persona);

// Comenzar a crear el objeto de curl
# A dónde se hace la petición...
$url = "https://kadm.openproject.com/api/v3/users";
$ch = curl_init($url);

# Ahora le ponemos todas las opciones
# Nota: podríamos usar la versión corta de arreglos: https://parzibyte.me/blog/2018/10/11/sintaxis-corta-array-php/
curl_setopt_array($ch, array(
    // Indicar que vamos a hacer una petición POST
    CURLOPT_CUSTOMREQUEST => "POST",
    // Justo aquí ponemos los datos dentro del cuerpo
    CURLOPT_POSTFIELDS => $datosCodificados,

    CURLOPT_USERPWD => "apikey:f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7",
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

?>

<script>

   <?php
       echo "var jsvar ='$datosCodificados';";
   ?>
   console.log(jsvar); 
</script>