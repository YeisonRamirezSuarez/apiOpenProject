
<?php

include_once("listauser.html");

$KEY = "f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7";
$url = "https://kadm.openproject.com/api/v3/users";
$ch = curl_init($url);
curl_setopt_array($ch, array(
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_USERPWD => "apikey:$KEY",
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Personalizado: ¡Hola mundo!', 
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
  

  for (let i = 0; i < var1.total; i++) {
    tabla.innerHTML += `
      <tr>
        <th scope="row"><input type="checkbox" name="checkboxvar" value="${var1['_embedded']['elements'][i]['id']}" class="valores"></input></th>
        <td>${var1['_embedded']['elements'][i]['name']}</td>
        <td>${var1['_embedded']['elements'][i]['email']}</td>
        <td>${var1['_embedded']['elements'][i]['status']}</td>
        </tr>
        `
  }

 
</script>

