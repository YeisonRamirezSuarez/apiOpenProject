<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>Informacion grupos</h1>
    <?php
    /**
     * Ejemplo de cómo usar PHP, JSON y cURL para enviar
     * datos codificados a otro servidor
     * 
     * @author parzibyte
     */

    # Definimos los datos que vamos a enviar, estos pueden venir de cualquier lugar
    # Los hacemos complejos y largos para demostrar cómo se pueden anidar
    $esquema = [

        '_links' => [

            'members' => [

                'href' => 'api/v3/users/1'
            ],

        ],

        'name' => 'DMA'

    ];

    $persona = [


        "admin" => false,
        "email" => "h.wurject.com",
        "firstName" => "ANDRES",
        "language" => "de",
        "lastName" => "CANBAS",
        "login" => "h.ESDADt",
        "password" => "huntSSAer565465465465",
        "status" => "active"


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
        CURLOPT_CUSTOMREQUEST => "GET",
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
        CURLOPT_RETURNTRANSFER => true,
    ));
    # Hora de hacer la petición
    $resultado = curl_exec($ch);
    # Vemos si el código es 200, es decir, HTTP_OK
    $codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($codigoRespuesta === 200) {
        # Decodificar JSON porque esa es la respuesta
        $respuestaDecodificada = json_decode($resultado);

        echo json_encode($resultado);
        # Simplemente los imprimimos
        // echo "Se ejecuto consulta. Código de respuesta: $codigoRespuesta";

        // echo "<strong>El servidor dice que la hora de petición fue: </strong>" . $respuestaDecodificada->total;
        // echo "<br>";
        // echo "<strong>El servidor dice que la hora de petición fue: </strong>" . $respuestaDecodificada->name;
        $valores = json_decode($resultado, TRUE);



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

        //echo "<br><strong>El servidor dice que el primer lenguaje es: </strong>" . $respuestaDecodificada->primerLenguaje;
        // echo "<br><strong>Los encabezados que el servidor recibió fueron: </strong><pre>" . var_export($respuestaDecodificada->encabezados, true) . "</pre>";
        // echo "<br><strong>Los gustos musicales que el servidor recibió fueron: </strong><pre>" . var_export($respuestaDecodificada->gustosMusicales, true) . "</pre>";
        // echo "<br><strong>Los libros que el servidor recibió fueron: </strong><pre>" . var_export($respuestaDecodificada->libros, true) . "</pre>";
        // echo "<br><strong>Mensaje del servidor: </strong>" . $respuestaDecodificada->mensaje;
    } else if ($codigoRespuesta === 303) {
        echo "No se permite crear usuarios. Código de respuesta: $codigoRespuesta";
    } else {

        # Error
        echo "Error consultando. Código de respuesta: $codigoRespuesta";
    }
    curl_close($ch);

    ?>
    <style>
        * {

            margin: 0;
            padding: 0;


        }


        h1 {

            text-align: center;
            margin-bottom: 2rem;
        }

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

        .button1 {
            background-color: #4CAF50;
        }

        /* Green */
        .button2 {
            background-color: #008CBA;
        }


        .cuerpo {

            width: 100%;
            height: 100%;
            background: #4CAF50;
            display: inline-block;

        }


        .simple {

            background: #008CBA;
            width: 80%;
        }

        .table {

            background: red;
            text-align: center;
        }

        .table td {

            text-align: center;
            background: green;
            width: 40%;
        }

        .table #cbox {

            background: purple;
            width: 10%;
        }


        .f {

            background: yellow;
        }

        /* Blue */
    </style>
    </head>

    <body>

        <div class="contenedor">

            <div class="simple"> <?php


                                    // echo "__________________________________________";
                                    // echo "<br>";
                                    // echo "<br>";
                                    // print_r("Nombre usuario");
                                    // echo "---------------------\t";
                                    // print_r("Id usuario");
                                    // echo "<br>";
                                    // echo "<br>";

                                    for ($i = 0; $i <= count($valores['_embedded']['elements']) - 1; $i++) {
                                        // $h = print_r($valores['_embedded']['elements'][$i]['name']);
                                        // echo "---------------------\t";
                                        // print_r($valores['_embedded']['elements'][$i]['id']);
                                        // echo "<br>";
                                        echo "
                            <form action='registrogrupomiembro.php' method='POST'>
                            <table class='table'>
            <tbody>
             
              <tr>
                <th scope='row'>"  . $valores['_embedded']['elements'][$i]['id'] . "</th>
                <td colspan='2' class='table-active'>" . $valores['_embedded']['elements'][$i]['name'] . "</td>
                <td>" . $valores['_embedded']['elements'][$i]['email'] . "</td>
                <td id='cbox'> <input id='fncbox" . $i . "' name='checkboxvar[$i]'.$i. onclick = 'validar()' type='checkbox'  value='"  . $valores['_embedded']['elements'][$i]['id'] . "'><br></td>
                <td id='cbox'>  <button class='button button2' type='submit' '>Enviar informacion</button><br></td>
                <td id='cbox'>   <input type='text' name='name' id='name'><br></td>
              </tr>
            </tbody>
          </table>
          </form> 
          ";
                                    }
                                    ?>

            </div>




        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                    </tr>
                </thead>
                <tbody id='cuerpo'>

                </tbody>
            </table>
        </div>

        <h1>Registro grupo miembro</h1>
        <!-- <form action="registrogrupomiembro.php" method="POST">
        <h2> <label for="name">Ingrese nombre del grupo</label></h2>
        <input type="text" name="name" id="name">
        <br>
        <!-- <h2><label for="id">Ingrese id del usuario a ingresar</label></h2>
        <input type="text" name="id" id="id"> -->
        <!-- <input type="checkbox" value="1" name="checkboxvar[]" id="checkboxvar" >
        <input type="checkbox" value="" name="checkboxvar[]" id="checkboxvar" >

        <br>
        <br>
        <br>
        <button class="button button2" type="submit" ">Enviar informacion</button>
   
</form>  -->






        <script>
            chebx = [];



            function validar() {}
            label:
                for (let index = 0; index < 10; index++) {




                    if (document.getElementById(`fncbox${index}`).checked) {


                        var id = document.getElementById(`fncbox${index}`).value;


                        //array_push(chebx, id);

                        // for (let index = 0; index < chebx.length; index++) {
                        //    console.log(chebx[index])

                        // }

                        console.log(id);

                        id = "";


                    }
                    console.log("-----------------------");
                    console.log("id");





                }



            const tabla = document.querySelector('#cuerpo');


            console.log("Estoy aqui");


            var var1 = <?php echo $resultado ?>;

            console.log(`Variable 2 ${var1.total}`);

            for (let i = 0; i < var1.total; i++) {

                tabla.innerHTML += `
                            <tr>
                              <th scope="row">${var1.total}</th>
                              <td>${var1._type}</td>
                              <td>${var1.pageSize}</td>
                              <td>${var1.count}</td>
                            </tr>
                  `

            }

            /* .forEach(elemento => {
                   
                   tabla.innerHTML +=  `
                             <tr>
                               <th scope="row">${elemento.email}</th>
                               <td>${elemento.name}</td>
                               <td>${elemento.login}</td>
                               <td>${elemento.status}</td>
                             </tr>
                   `
                 });*/
        </script>

    </body>

</html>