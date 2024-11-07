<?php

$usuario = 'estufa';
$senha = 'Hunter231020@#';
$database = 'estufa';
$host = 'estufa.mysql.dbaas.com.br';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

