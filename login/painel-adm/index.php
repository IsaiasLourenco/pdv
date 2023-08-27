<?php
require_once("../../conexao.php");
require_once("verificar.php");
@session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAINEL ADMINISTRATIVO - <?php echo $nome_sistema ?></title>
    <link rel="shortcut icon" href="../../assets/imagens/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/fontesEtitulos.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
</head>

<body>
    <h5>HOME</h5>
    <p>Nome do usuário: <?php echo $_SESSION['nome_usuario'] ?></p>
</body>

</html>