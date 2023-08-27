<?php 
require_once("config.php");
date_default_timezone_set('America/Sao_Paulo');

try {
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$usuario", "$senha"); 
} catch (\Throwable $th) {
    echo "Erro de conexão!! <br>" . $th;
}
