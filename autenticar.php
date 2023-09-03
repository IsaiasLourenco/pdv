<?php
require_once("conexao.php");
@session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$query_con = $pdo->prepare("SELECT * FROM funcionarios WHERE (email = :usuario OR cpf = :usuario) AND senha = :senha");
$query_con->bindValue(":usuario", "$usuario");
$query_con->bindValue(":senha", "$senha");
$query_con->execute();
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_func = @count($res_con);
if ($total_func > 0) {
    $id_cargo = $res_con[0]['cargo'];
    $_SESSION['nome_usuario'] = $res_con[0]['nome'];
    $_SESSION['id_cargo_usuario'] = $res_con[0]['cargo'];
    $_SESSION['cpf_usuario'] = $res_con[0]['cpf'];
    $_SESSION['id_usuario'] = $res_con[0]['id'];
    
    $query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $nome_cargo = $res[0]['nome'];

    if ($nome_cargo == 'Administrador') {
        echo "<script language='javascript'>window.location='painel-adm'</script>";
    } else if ($nome_cargo == 'Caixa') {
        echo "<script language='javascript'>window.location='painel-caixa'</script>";
    } else if ($nome_cargo == 'Cliente') {
        echo "<script language='javascript'>window.location='painel-cliente'</script>";
    }  else {
        echo "<script language='javascript'> window.alert ('Você não tem autorização  de acesso ao sistema, fale com o Administrador!')</script>";
        echo "<script language='javascript'> window.location='index.php' </script>";
    }
} else {
    echo "<script language='javascript'> window.alert ('Dados incorretos!')</script>";
    echo "<script language='javascript'> window.location='index.php' </script>";
}
	