<?php
require "vendor/autoload.php";
$url="http://localhost/webservice/ws.php?wsdl";
$cliente = new nusoap_client($url,'wsdl');
$error=$cliente->getError();
if ($error){
    echo "Error en coneccion : $error";
}

$parametro = array("username"=>$_POST["username"], "password"=>$_POST["password"]);
$resultado=$cliente->call('login',$parametro);
$cliente->getError();
//print_r($resultado);
if ($resultado["level"]!=0){
    echo"
    <h1>ID:{$resultado["id_user"]}</h1>
    <h1>Nombre:{$resultado["fullname"]}</h1>
    <h1>Email:{$resultado["email"]}</h1>
    <h1>Nivel:{$resultado["level"]}</h1>
    ";
}else{
    echo "<h1>{$resultado["msg"]}</h1>";
}

$resultado=$cliente->call('login',$parametro);