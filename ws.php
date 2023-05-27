<?php
require "vendor/autoload.php";
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargetNamespace="urn:server";
$server->register('hola',
array('usuario'=>'xsd:string'),
array('return'=>'xsd:string'),
'urn:server',
'urn:server#holaServer',
'rpc',
'encoded',
'Function hola mundo es un webservice'
);

$server->wsdl->addComplexType(
    'Persona',
    'complexType',
    'struct',
    'all',
    '',
    
    array(
        'idalu'=>array('name'=>'idalu', 'type'=>'xsd:string'),
        'nombre'=>array('name'=>'nombre', 'type'=>'xsd:string'),
        'laboratorio1'=>array('name'=>'laboratorio1', 'type'=>'xsd:float'),
        'laboratorio2'=>array('name'=>'laboratorio2', 'type'=>'xsd:float'),
        'parcial'=>array('name'=>'parcial', 'type'=>'xsd:float')
    )
    );

$server->register('sumatoria',
array('v1'=>'xsd:int','v2'=>'xsd:int'),
array('resultado'=>'xsd:int'),
'urn:server',
'urn:server#sumatoria',
'rpc',
'encoded',
'Function sumatoria mundo SUMA DEL NUMERO V1 AL V2');

function hola($usuario){
    return "bienvenido $usuario";
}


/** se espera dos parametros para si  */


function sumatoria($v1, $v2){
    $total=0;
    for($i=$v1;$i<=$v2;$i++){
        $total+= $i;
    }
    return $total;
}
$server->register(
    'login',
    array('username' => 'xsd:string', 'password' => 'xsd:string'),
        array('return' => 'tns:Persona'),
        'urn:server',
        'urn:server#loginServer',
        'rpc',
        'encoded',
        'Function para validar login'
);

$server->register('promedio',
array('laboratorio1'=>'xsd:float','laboratorio2'=>'xsd:float','parcial'=>'xsd:float'),
array('resultado'=>'xsd:int'),
'urn:server',
'urn:server#promedio',
'rpc',
'encoded',
'Function de promedio de notas');

function promedio($laboratorio1, $laboratorio2, $paracial){
    
    $total = 0;
    $total = ($laboratorio1*0.25)+($laboratorio2*0.25)+($parcial*0.50);
    
    return $total;
}

function login($username,$password){
    if($username=="admin" && $password=="catolica"){
        $valor=array(
            'id_user'=>1,
            'fullname'=>"juana de lopes",
            'email'=>"admin@example.com",
           'msg'=>"usuario correcto",
           'level'=>1);
}else{
    $valor=array(
        'id_user'=>0,
        'fullname'=>'',
        'email'=>'',
       'msg'=>'usuario incorrecto',
        'level'=>0);
}
return $valor;
}
$server->service(file_get_contents("php://input"));