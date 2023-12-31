<?php
require_once("conexao.php");

$queryAdm = $pdo->query("SELECT * FROM cargos WHERE nome = 'Administrador' ");
$resAdm = $queryAdm->fetchAll(PDO::FETCH_ASSOC);
$id_cargoAdm = @$resAdm[0]['id'];

$queryFuncAdm = $pdo->query("SELECT * FROM funcionarios WHERE cargo = '$id_cargoAdm' ");
$resAdm = $queryFuncAdm->fetchAll(PDO::FETCH_ASSOC);
$total_reg_adm = @count($resAdm);

if ($total_reg_adm == 0) {
    //INSERIR OS CARGOS NECESSÁRIOS PARA A VALIDAÇÃO NA TABELA CARGOS
    $pdo->query("INSERT INTO cargos SET nome = 'Administrador'");
    $id_cargoNovoAdm = $pdo->lastInsertId();

    //INSERIR UM USUARIO/FUNCIONARIO NA TABELA CASO NÃO EXISTA NENHUM
    $pdo->query("INSERT INTO funcionarios SET nome = 'Isaias', cpf = '24707435831', email = 'isaias.lourenco2020@outlook.com', telefone = '19996745466', cep = '13843184', rua = 'Mococa', numero = '880', bairro = 'Lot Parque Itacolomy', cidade = 'Mogi Guaçu', estado = 'SP', senha = '0808', cargo = '$id_cargoNovoAdm', datacad = curDate(), datanasc = '1977-08-08', imagem = 'sem-foto.jpg'");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="shortcut icon" href="assets/imagens/logo.ico" type="image/x-icon">


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>


    <div id="login">
        <a href="index.php" title="Voltar para Login..">
            <h3 class="text-center text-white pt-5"><img class="logoIndex" src="assets/imagens/logo.png" alt="Logo"></h3>
        </a>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="form-login" action="autenticar.php" method="post">
                            <h3 class="text-center text-dark">Login</h3>
                            <div class="form-group">
                                <label for="usuario" class="text-dark">Usuário:</label>
                                <input autofocus type="text" name="usuario" id="usuario" class="form-control" placeholder="Insira seu Email" required>
                            </div>
                            <div class="form-group">
                                <label for="senha" class="text-dark">Senha:</label><br>
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="Insira sua Senha" required>
                            </div>
                            <div class="form-group">

                                <input type="submit" name="submit" class="btn btn-secondary btn-md" value="Logar">
                            </div>
                            <div id="register-link" class="text-right mt-1">
                                <a href="" data-toggle="modal" data-target="#modal-cadastrar" class="text-dark">Cadastre-se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- Modal Cadastro Cliente -->
<div class="modal fade" id="modal-cadastrar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastre-se</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input autofocus type="text" class="form-control" id="nome" name="nomeCad" aria-describedby="emailHelp" required>

                    </div>

                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" autocomplete="off" class="form-control" id="email" name="emailCad" aria-describedby="email" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="text" class="form-control" name="senhaCad" id="senha" required="">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary" name="btn-cadastrar">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim Modal Cadastro Cliente -->

<!-- Ajax Cadastro Cliente -->
<?php

if (isset($_POST['btn-cadastrar'])) {
    $hoje = date('Y-m-d');
    $email_novo = $_POST['emailCad'];

    //BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
    $query = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email_novo'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo "<script language='javascript'>window.alert('E-mail já cadastrado!')</script>";
        echo "<script language='javascript'>window.location='index.php'</script>";
        exit();
    }

    $queryCargo = $pdo->query("SELECT * FROM cargos WHERE nome = 'Cliente' ");
    $resCargo = $queryCargo->fetchAll(PDO::FETCH_ASSOC);
    $total_reg_cli = @count($resCargo);
    if ($total_reg_cli == 0) {

        //INSERIR OS CARGOS NECESSÁRIOS PARA A VALIDAÇÃO NA TABELA CARGOS
        $pdo->query("INSERT INTO cargos SET nome = 'Cliente'");
        $id_cargoNovoCli = $pdo->lastInsertId();

        $query = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo, datacad) VALUES (:nome, :email, :senha, :cargo, :datacad)");
        $query->bindValue(":nome", $_POST['nomeCad']);
        $query->bindValue(":email", $_POST['emailCad']);
        $query->bindValue(":senha", $_POST['senhaCad']);
        $query->bindValue(":cargo", $id_cargoNovoCli);
        $query->bindValue(":datacad", $hoje);
        $query->execute();
        $id_NovoFunc = $pdo->lastInsertId();
        $comentario = 'Alguma coisa a ser editada depois!!';

        $queryCli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:funcionario, :comentario)");
        $queryCli->bindValue(":funcionario", $id_NovoFunc);
        $queryCli->bindValue(":comentario", $comentario);
        $queryCli->execute();

        echo "<script language='javascript'>window.alert('Cadastrado com Sucess!!')</script>";
        echo "<script language='javascript'>window.location='index.php'</script>";
        exit();
    }
    $id_cargo = $resCargo[0]['id'];
    $query = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo, datacad) VALUES (:nome, :email, :senha, :cargo, :datacad)");
    $query->bindValue(":nome", $_POST['nomeCad']);
    $query->bindValue(":email", $_POST['emailCad']);
    $query->bindValue(":senha", $_POST['senhaCad']);
    $query->bindValue(":datacad", $hoje);
    $query->bindValue(":cargo", $id_cargo);
    $query->execute();
    $id_NovoFunc = $pdo->lastInsertId();
    $comentario = 'Alguma coisa a ser editada depois!!';
    $queryCli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:funcionario, :comentario)");
    $queryCli->bindValue(":funcionario", $id_NovoFunc);
    $queryCli->bindValue(":comentario", $comentario);
    $queryCli->execute();

    echo "<script language='javascript'>window.alert('Cadastrado com Sucesso!!')</script>";
    exit();
}
?>
<!-- Fim Ajax Cadastro Cliente -->

<!-- FOCO NO NOME ABRINDO A MODAL CADASTRO -->
<script>
    $('#modal-cadastrar').on('shown.bs.modal', function(event) {
        $("#nomeCad").focus();
    })
</script>
<!-- FIM FOCO NO NOME ABRINDO A MODAL CADASTRO -->