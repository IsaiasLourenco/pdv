<?php
require_once("../../conexao.php");

$id = $_POST['id'];

$pdo->query("DELETE from funcionarios WHERE id = '$id'");
$pdo->query("DELETE from clientes WHERE funcionario = '$id'");

echo 'Excluído com Sucesso!';
?>