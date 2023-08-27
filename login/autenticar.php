<?php
require_once("../conexao.php");
@session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email AND senha = :senha");
$query->bindValue(":email", "$email");
$query->bindValue(":senha", "$senha");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_func = @count($res);

if ($total_func > 0) {

    $_SESSION['nome_usuario'] = $res[0]['nome'];
    $_SESSION['id_cargo_usuario'] = $res[0]['cargo'];
    $id_cargo = $res[0]['cargo'];

    $query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $nome_cargo = $res[0]['nome'];

    if ($nome_cargo == 'Administrador') {
        echo "<script language='javascript'>window.location='painel-adm'</script>";
    } else if ($nome_cargo == 'Caixa') {
        echo "<script language='javascript'>window.location='painel-caixa'</script>";
    } else {
        echo "<script language='javascript'> window.alert ('Você não tem autorização  de acesso ao sistema, fale com o Administrador!')</script>";
        echo "<script language='javascript'> window.location='index.php' </script>";
    }
} else {
    echo "<script language='javascript'> window.alert ('Dados incorretos!')</script>";
    echo "<script language='javascript'> window.location='index.php' </script>";
}
