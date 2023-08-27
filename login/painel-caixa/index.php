<?php 
require_once("../../conexao.php");
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAIXA - <?php echo $nome_sistema ?></title>
    <link rel="shortcut icon" href="../../assets/imagens/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/fontesEtitulos.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.css">
</head>
<body>
    <h5>SÃO PAULO FUTEBOL CLUBE</h5>
    <p>Nome do usuário: <?php echo $_SESSION['nome_usuario'] ?></p>
    <img src="https://3.bp.blogspot.com/-SARnVPwOuyQ/U2BoNS67PcI/AAAAAAAADHs/POCEq6X77rU/s1600/s1.gif" alt="">
</body>
</html>