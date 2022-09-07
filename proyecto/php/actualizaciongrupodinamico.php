<?php
//Pedir usuarios
$KEY = "f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7";
$url = "https://kadm.openproject.com/api/v3/users";
$ch = curl_init($url);
curl_setopt_array($ch, array(
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_USERPWD => "apikey:$KEY",
    CURLOPT_RETURNTRANSFER => true,
));

$respuesta = curl_exec($ch);

curl_close($ch);


$valores=json_decode($respuesta, TRUE);

$crear = [];

for($i = 0; $i <= count($valores['_embedded']['elements']) - 1; $i++){
    array_push($crear, $valores['_embedded']['elements'][$i]['id']);
}

$esquemapeticion= array();

    for($i = 0; $i <= count($crear) -1; $i++)
    {
        $peticion = array (
                'href' => '/api/v3/users/'.$crear[$i]
            );
        array_push($esquemapeticion, $peticion);
    }

$id = $_REQUEST['id'];


$grupoUser = array (
    '_links' => 
    array (
      'members' =>
        $esquemapeticion,
    ),
    
);
$datosCodificados = json_encode($grupoUser);
$url = "https://kadm.openproject.com/api/v3/groups/{$id}";
$ch = curl_init($url);
curl_setopt_array($ch, array(
    CURLOPT_CUSTOMREQUEST => "PATCH",
    CURLOPT_POSTFIELDS => $datosCodificados,
    CURLOPT_USERPWD => "apikey:f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7",
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($datosCodificados), 
        'Personalizado: ¡Hola mundo!', 
    ),
    CURLOPT_RETURNTRANSFER => true,
));
$resultado = curl_exec($ch);
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($codigoRespuesta === 200){
    echo "Se ejecuto consulta. Código de respuesta: $codigoRespuesta";
}else if($codigoRespuesta === 303){
    echo "No se permite crear usuarios. Código de respuesta: $codigoRespuesta";
} else{
    echo "Error consultando. Código de respuesta: $codigoRespuesta";
}
curl_close($ch);

?>
