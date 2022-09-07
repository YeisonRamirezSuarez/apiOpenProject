
<?php

include_once("listaproyecto.html");

$KEY = "f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7";
$url = "https://kadm.openproject.com/api/v3/projects";
$ch = curl_init($url);
curl_setopt_array($ch, array(
  CURLOPT_CUSTOMREQUEST => "GET",
  //23dfe6c0cb2e7f44a10dd2bde9fed116147e7b834bda749644025c04c2c93a0e
  // mio f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7
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
  console.log(var1);
  


  var momento = [];
  for (let j = 0; j < var1.total; j++) {
      momento.push(var1['_embedded']['elements'][j]['_links']['members']);
  }

  for (let i = 0; i < var1.total; i++) {
    tabla.innerHTML += `
      <tr>
        <th scope="row">${var1['_embedded']['elements'][i]['id']}</th>
        <td>${var1['_embedded']['elements'][i]['name']}</td>
        <td>${var1['_embedded']['elements'][i]['updatedAt']}</td>
        <td>${var1['_embedded']['elements'][i]['_links']['status']['title']}</td>
        </tr>
        `
        
  }
  // <td>${momento[i].length}</td>
 
            
 
</script>

