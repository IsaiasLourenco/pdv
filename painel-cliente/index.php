<?php 
require_once("../conexao.php");
require_once("verificar.php");
@session_start();
// VERIFICAR USUÁRIO LOGADO
$id_cargo = $_SESSION['id_cargo_usuario'];
$query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo = $res[0]['nome'];

if ($nome_cargo != 'Cliente') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAINEL CLIENTE - <?php echo $nome_sistema ?></title>
    <link rel="shortcut icon" href="../../assets/imagens/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/fontesEtitulos.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
</head>
<body>
    <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio obcaecati ratione repudiandae, perspiciatis, soluta, magni numquam animi atque incidunt asperiores excepturi eaque hic praesentium laudantium in nemo cum perferendis distinctio!</h5>
    <p>Nome do usuário: <?php echo $_SESSION['nome_usuario'] ?></p>
    <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExcXg4ZjJ5dXA5eDM0MGZrcmppZWNoOW05bzZmMzR2YzRrbTR4Z29rZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/C5BaEcgI6LYq3l3xTN/giphy.gif" alt="">

    <a href="../logout.php">Sair</a>
</body>
</html>