<?php 

$ch1=curl_init();

$esquema = array(

    '_links' => array(

        'members' => array(

               'href' => 'api/v3/users/1'
        ),

    ),

    'name' => 'DMA'

);

// $esquema = array(
    
//         '_links' => array(
//           'members'=> array(
            
//               'href'=> "/api/v3/users/363"
//             ,
            
//               'href'=> "/api/v3/users/60"
            
//           )
//         ),
//         'name'=> "The group"
      

//);

// $esquema = array(

//     '_links' => array(

//         'properties' => array(

//             'members' => array(

//                 'type' => "array",
//                 'items' => array(
//                     'type' => "object",
//                 ),
//                 'properties' => array(
//                     'href' => array(
//                         'type' => "string"
//                     )
//                 )

//             ),
//             'type' => "object"
//         ),
//         'name' => array(
//             'type' => "string"
//         )

//     ),

// );

$data = json_encode($esquema);

echo is_array($data) ? 'Array' : 'No es un array';

echo "<br>";


curl_setopt($ch1, CURLOPT_URL, "https://kadm.openproject.com/api/v3/groups");
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_USERPWD, "apikey:f2ac148dfb1a6806297528171af4bc90598734fda5a429c2346a65ded2e62ef7");
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-type: application/hal+json', 'Content-length: 100'));

$resultado = curl_exec($ch1);
curl_close($ch1);


echo $resultado;


?>


<script>

   <?php
       echo "var jsvar ='$data';";
   ?>
   console.log(jsvar); 
</script>