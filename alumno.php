<?php
require "vendor/autoload.php";
$url="http://localhost/webservice/ws.php?wsdl";
$cliente = new nusoap_client($url,'wsdl');
$error=$cliente->getError();
if ($error){
    echo "Error en coneccion : $error";
}

$valor = array("idalu"=>$_POST["idalu"],
 "nombre"=>$_POST["nombre"],
"laboratorio1"=>$_POST["laboratorio1"],
"laboratorio2"=>$_POST["laboratorio2"],
"parcial" => $_POST["parcial"]);
$resultado=$cliente->call('promedio',$_POST["laboratorio1"],$_POST["laboratorio2"],$_POST["laborator2"],$_POST["parcial"],$_POST["parcial"]);
$cliente->getError();
print_r($resultado);

print_r($resultado);

    echo"
    <h1>ID:{$valor["idalu"]}</h1>
    <h1>Nombre:{$valor["nombre"]}</h1>
    <h1>laboratorio1:{$valor["laboratorio1"]}</h1>
    <h1>laboratorio2:{$valor["laboratorio2"]}</h1>
    <h1>parcial:{$valor["parcial"]}</h1>
    <h1>promedio:{$resultado["valor"]}</h1>
    ";


    $resultado=$cliente->call('promedio',$valor);


