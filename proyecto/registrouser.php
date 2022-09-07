<?php

include_once("registrouser.html");

$nombre = $_REQUEST['name'];
$apellido = $_REQUEST['apellido'];
$contrasena = $_REQUEST['contraseña'];
$correo = $_REQUEST['correo'];
$usuario = $_REQUEST['usuario'];

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
$datosCodificados = json_encode($persona);

$KEY = "f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7";
$url = "https://kadm.openproject.com/api/v3/users";
$ch = curl_init($url);
curl_setopt_array($ch, array(
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $datosCodificados,
  CURLOPT_USERPWD => "apikey:$KEY",
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($datosCodificados),
    'Personalizado: ¡Hola mundo!', # Un encabezado personalizado
  ),
  CURLOPT_RETURNTRANSFER => true,
));
$resultado = curl_exec($ch);
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($codigoRespuesta === 200) {
} else if ($codigoRespuesta === 303) {
  echo "No se permite crear usuarios. Código de respuesta: $codigoRespuesta";
} else {
  echo "Error consultando. Código de respuesta: $codigoRespuesta";
}
curl_close($ch);
?>

<script>
  const tabla = document.querySelector('#cuerpo');
  var var1 = <?php echo $resultado ?>;
  console.log(var1);

  for (let i = 0; i < var1.total; i++) {
    tabla.innerHTML += `
      <tr>
        <th scope="row">${var1['_embedded']['elements'][i]['id']}</th>
        <td>${var1['_embedded']['elements'][i]['name']}</td>
        <td>${var1['_embedded']['elements'][i]['email']}</td>
        <td>${var1['_embedded']['elements'][i]['status']}</td>
        <td><input id='fncbox' onclick='validar()' name='checkboxvar[]'  type='checkbox'  value='${var1['_embedded']['elements'][i]['id']}'></td>
        </tr>
        `
  }

  function validar() {
    if (document.getElementById('fncbox').checked) {
      var id = document.getElementById('fncbox').value;
      console.log(id);
      id = "";
    }
  }
</script>