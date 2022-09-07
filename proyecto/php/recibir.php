<?php
$array = $_POST['array'];
$nombre = $_POST['name'];

$id = preg_split(",/,", $array);

$esquemapeticion= array();
    

    for($i = 0; $i <= count($id) -1; $i++)
    {
        $peticion = array (
          
            'href' => '/api/v3/users/'.$id[$i]
            );
        array_push($esquemapeticion, $peticion);
    }

$grupoUser = array (
    '_links' => 
    array (
      'members' =>
        $esquemapeticion,
    ),
    'name' => $nombre,
);

$datosCodificados = json_encode($grupoUser);
$KEY = "f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7";
$url = "https://kadm.openproject.com/api/v3/groups";
$ch = curl_init($url);
curl_setopt_array($ch, array(
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $datosCodificados,
  CURLOPT_USERPWD => "apikey:$KEY",
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($datosCodificados),
    'Personalizado: ¡Hola mundo!', 
  ),
  CURLOPT_RETURNTRANSFER => true,
));

$resultado = curl_exec($ch);
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($codigoRespuesta === 201) {
    echo "Se ejecuto consulta. Código de respuesta: $codigoRespuesta";
} else if ($codigoRespuesta === 303) {
  echo "No se permite crear usuarios. Código de respuesta: $codigoRespuesta";
} else {
  echo "Error consultando. Código de respuesta: $codigoRespuesta";
}
curl_close($ch);





?>

