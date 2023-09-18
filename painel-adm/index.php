<?php
require_once("../conexao.php");
@session_start();
$id_user = $_SESSION['id_usuario'];
$id_cargo_user = $_SESSION['id_cargo_usuario'];  

//VERIFICAR PERMISSÃO DO USUÁRIO
$query = $pdo->query("SELECT * FROM cargos WHERE id = '$id_cargo_user'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cargo_user = $res[0]['nome'];

if($nome_cargo_user != 'Administrador'){
    // echo "<script language='javascript'> window.alert ('Você não tem autorização  de acesso ao sistema, fale com o Administrador!')</script>";
    echo "<script language='javascript'> window.location='../index.php' </script>";
}

//VARIÁVEEIS DO MENU ADM
$menu1 = 'home';
$menu2 = 'usuarios';
$menu3 = 'fornecedores';
$menu4 = 'cargos';
$menu5 = 'categorias';
$menu6 = 'pprodutos';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/fontesEtitulos.css">
    <link rel="shortcut icon" href="../assets/imagens/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img class="img-index" src="../assets/imagens/logo.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?pagina=<?php echo $menu1 ?>"><i class="bi bi-house-door-fill"></i> Home <span class="sr-only">(Página atual)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-people-fill"></i>
                        Pessoas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="index.php?pagina=<?php echo $menu2 ?>"><i class="bi bi-person-badge-fill"></i> Usuários</a>
                        <a class="dropdown-item" href="index.php?pagina=<?php echo $menu3 ?>"><i class="bi bi-person-fill-add"></i> Fornecedores</a>
                        <a class="dropdown-item" href="index.php?pagina=<?php echo $menu4 ?>"><i class="bi bi-list-task"></i> Cargos</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i><i class="bi bi-plus-circle-fill"></i>
                        Cadastros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="index.php?pagina=<?php echo $menu5 ?>"><i class="bi bi-table"></i> Categorias</a>
                        <a class="dropdown-item" href="index.php?pagina=<?php echo $menu3 ?>"><i class="fa-solid fa-cart-shopping"></i> Produtos</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Destaques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Preços</a>
                </li>

            </ul>

        </div>
        <?php
        $query = $pdo->query("SELECT * from funcionarios WHERE id = '$id_user'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $nome_usuario = $res[0]['nome'];
        ?>
        <img src="../assets/imagens/icone-user.png" width="40px" height="40px" alt="Foto">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $nome_usuario ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-truck-ramp-box"></i> Editar Perfil</a>
                    <a class="dropdown-item" href="../logout.php">Sair</a>

                </div>
            </li>
        </ul>
    </nav>

    <div class="container-fluid mt-2">
        <?php
        if (@$_GET['pagina'] == $menu1) {
            require_once($menu1 . '.php');
        } elseif (@$_GET['pagina'] == $menu2) {
            require_once($menu2 . '.php');
        } elseif (@$_GET['pagina'] == $menu3) {
            require_once($menu3 . '.php');
        } elseif (@$_GET['pagina'] == $menu4) {
            require_once($menu4 . '.php');
        } elseif (@$_GET['pagina'] == $menu5) {
            require_once($menu5 . '.php');
        } else {
            require_once($menu1 . '.php');
        }
        ?>
    </div>

    <!-- Ajax para funcionar Mascaras JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    
    <!-- Mascaras JS -->
    <script src="../assets/js/mascaras.js"></script>

    <!-- BUSCA CEP -->
    <script src="../assets/js/buscaCep.js"></script>

    <link rel="stylesheet" href="../assets/DataTabels/datatables.min.css">

    <script src="../assets/DataTabels/datatables.min.js"></script>

</body>

</html>