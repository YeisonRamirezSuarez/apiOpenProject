
<?php



$id= 7;


$ch=curl_init();
//2dc1b25a3f78f6f9e40b97d815b3d265b67b7eefd22cce7d606b334e24b558d3

//6c9421836f0b2973068db6fa8c047cec7d37d74101e94e9e2feaa476d477e5a8 empresa
curl_setopt($ch, CURLOPT_URL, "https://pruebasat.openproject.com/api/v3/users");
curl_setopt($ch, CURLOPT_USERPWD, "apikey:2dc1b25a3f78f6f9e40b97d815b3d265b67b7eefd22cce7d606b334e24b558d3"); //Your credentials goes here

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$respuesta = curl_exec($ch);

curl_close($ch);


$valores=json_decode($respuesta, TRUE);

$crear = [];

//Muestra toda la respuestaaaaaaaaaa
// echo count($valores['_embedded']['elements']);
// echo "<br>";
// echo "<br>";
// print_r($valores['_embedded']['elements']);
// $arreglo = array($valores);
//echo is_array($valores) ? 'Array' : 'No es un array';

//echo count($valores);
//print_r ($arreglo);

//
// Todo esto es para mostrar roles
echo "<br>";
echo "<br>";
echo "_______________________";
echo "<br>";
for($i = 0; $i <= count($valores['_embedded']['elements']) - 1; $i++){
    print_r($valores['_embedded']['elements'][$i]['name']);
    echo "<br>";
    array_push($crear, $valores['_embedded']['elements'][$i]['id']);
}

//print_r($crear);

echo "<br>";

for($i = 0; $i <= count($crear) -1; $i++)
{
    echo $crear[$i]."<br>";
   
}

/*{
    "_links": {
      "members": [
        {
          "href": "/api/v3/users/$crear[i]"
        },
      
      ]
    },
    "name": "DMA-Interno WPOSS"
  }*/

//Solitud de envio crear

//   $ch1=curl_init();

// $esquema = array(

//     '_links' => array(

//         'members' => array(

//                'href' => 'api/v3/users/1'
//         ),

//     ),

//     'name' => 'DMA'

// );

// $data = json_encode($esquema);

// echo is_array($data) ? 'Array' : 'No es un array';

// echo "<br>";


// $http_Key = ['apikey : 2dc1b25a3f78f6f9e40b97d815b3d265b67b7eefd22cce7d606b334e24b558d3'];
// $URL_CREAR_GRUPO = "https://pruebasat.openproject.com/api/v3/groups";
// curl_setopt($ch1, CURLOPT_URL, $URL_CREAR_GRUPO);
// curl_setopt($ch1, CURLOPT_POST, 1);
// curl_setopt($ch1, CURLOPT_USERPWD, "apikey:2dc1b25a3f78f6f9e40b97d815b3d265b67b7eefd22cce7d606b334e24b558d3");
// curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($esquema));
// curl_setopt($ch, CURLOPT_HTTPHEADER, $http_Key);
// $resultado = curl_exec($ch1);
// curl_close($ch1);


// echo $resultado;


// termina


//Crear
// $postdata = http_build_query(

//     array(

//     '_links' => array(

//         'members' => array(

//                'href' => 'api/v3/users/1'
//         ),

//     ),

//     'name' => 'DMA'
//     )
// );

// $data = json_encode($postdata);

// echo is_array($data) ? 'Array' : 'No es un array';

// echo "<br>";

// $opts = array('http' =>
//     array(
//         'method' => 'GET',
//         'header' => 'https://pruebasat.openproject.com/api/v3/groups',
//         'content' => $data
//     )
// );






//$context = stream_context_create($opts);
//$result = file_get_contents('http://localhost/prueba.php', false, $context);
//echo $result;

//print_r($opts);








//Todo estos es para mostrar gurpos




//print_r("_embedded===", $valores->id);
//echo "El nombre del Pokemon es: ".$valores['email'];

// foreach($valores as $value){

  
// }



?>


<script>

   <?php
       echo "var jsvar ='$postdata';";
   ?>
   console.log(jsvar); 
</script>


    





