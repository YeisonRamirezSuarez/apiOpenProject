<?php
$fields = [
    
        "admin" => false,
        "email"=> "h.wurst@openproject.com",
        "firstName"=> "Hans",
        "language"=> "de",
        "lastName"=> "Wurst",
        "login"=> "h.wurst",
        "password"=> "hunter5",
        "status"=> "active"
      
   
];


$postdata = http_build_query($fields);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://pruebasat.openproject.com/api/v3/users");
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_USERPWD, "apikey:2dc1b25a3f78f6f9e40b97d815b3d265b67b7eefd22cce7d606b334e24b558d3");
curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/hal+json', 'Content-length: 100'));
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
echo $result;
?>