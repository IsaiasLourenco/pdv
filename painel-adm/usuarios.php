<?php
$pag = 'usuarios';
@session_start();
require_once('../conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/fontesEtitulos.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
</head>

<body>

    <h6><i class="bi bi-person-fill-add"></i> USUÁRIOS</h6>
    <a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-primary   mt-2">Novo Usuário</a>

    <div class="mt-4" style="margin-right:25px">
        <?php
        $query = $pdo->query("SELECT * from funcionarios order by id desc");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);

        if ($total_reg > 0) {


        ?>
            <small>
                <table id="usuarios" class="table table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th style="text-align:center">Senha</th>
                            <th>Cargo</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        for ($i = 0; $i < $total_reg; $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }

                            @$id_car = $res[$i]['cargo'];

                            $query1 = $pdo->query("SELECT * FROM cargos WHERE id = '$id_car'");
                            $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                            @$nome_car = $res1[0]['nome'];


                        ?>

                            <tr>
                                <td><?php echo $res[$i]['nome'] ?></td>
                                <td><?php echo $res[$i]['cpf'] ?></td>
                                <td><?php echo $res[$i]['email'] ?></td>
                                <td style="text-align:center"><?php echo $res[$i]['senha'] ?></td>
                                <td><?php echo $nome_car ?></td>
                                <td style="text-align: center;">
                                    <a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar Registro">
                                        <i class="bi bi-pencil-square text-success"></i>
                                    </a>

                                    <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir Registro">
                                        <i class="bi bi-trash3 text-danger mx-1"></i>
                                        
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>
            </small>
        <?php } else {
            echo '<p>Não existem dados para serem exibidos!!';
        } ?>
    </div>
</body>

<?php
if (@$_GET['funcao'] == "editar") {
    $titulo_modal = 'Editar Registro';
    $query = $pdo->query("SELECT * from funcionarios where id = '$_GET[id]'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        $nome = $res[0]['nome'];
        $email = $res[0]['email'];
        $cpf = $res[0]['cpf'];
        $senha = $res[0]['senha'];
        $telefone = $res[0]['telefone'];
        $cep = $res[0]['cep'];
        $rua = $res[0]['rua'];
        $numero = $res[0]['numero'];
        $bairro = $res[0]['bairro'];
        $cidade = $res[0]['cidade'];
        $estado = $res[0]['estado'];
        $nivel = $res[0]['cargo'];
        $datanasc = $res[0]['datanasc'];
        $imagem = $res[0]['imagem'];
        $id = $res[0]['id'];
    }
} else {
    $titulo_modal = 'Inserir Registro';
}
?>

<!-- MODAL INSERÇÃO EDIÇÃO -->
<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="frmCad" name="frmCad">
                <div class="modal-body">


                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome </label>
                                <input type="text" class="form-control" id="nome" value="<?php echo @$nome ?>" name="nome" placeholder="Nome" autofocus required tabindex="1">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF </label>
                                <input type="text" class="form-control" id="cpf" value="<?php echo @$cpf ?>" name="cpf" placeholder="CPF" required tabindex="2">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" autocomplete="off" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?php echo @$email ?>" required tabindex="3">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone </label>
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(xx)xxxx-xxxx" value="<?php echo @$telefone ?>" required tabindex="4">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP </label>
                                <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?php echo @$cep ?>" tabindex="5">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua </label>
                                <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?php echo @$rua ?>" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-2">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número </label>
                                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo @$numero ?>" placeholder="Número" tabindex="6">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro </label>
                                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo @$bairro ?>" readonly>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade </label>
                                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo @$cidade ?>" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-2">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado </label>
                                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo @$estado ?>" placeholder="UF" readonly>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha </label>
                                <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo @$senha ?>" required tabindex="7">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="datanasc" class="form-label">Data Nascimento </label>
                                <input type="date" class="form-control" id="datanasc" name="datanasc" placeholder="Nascimento" value="<?php echo @$datanasc ?>" required tabindex="8">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo </label>
                                <select class="form-select" aria-label="Default select example" id="cargo" name="cargo" tabindex="9">
                                    <?php
                                    $query = $pdo->query("SELECT * FROM cargos ORDER BY nome ASC");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < @count($res); $i++) {
                                        foreach ($res[$i] as $key => $value) {
                                        }
                                        $id_cargo = $res[$i]['id'];
                                        $nome_cargo = $res[$i]['nome'];
                                    ?>
                                        <option <?php if (@$id_cargo == @$nivel) { ?> selected <?php } ?> value="<?php echo $id_cargo ?>"><?php echo $nome_cargo ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" value="<?php echo @$imagem ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                    </div>

                    <div id="divImgConta" class="mt-4">
                        <?php if (@$imagem != "") { ?>
                            <img src="../assets/imagens/fucionarios/<?php echo @$resEd[0]['imagem'] ?>" width="170px" id="target">
                        <?php  } else { ?>
                            <img src="../assets/imagens/funcionarios/sem-foto.jpg" width="170px" id="target" alt="Foto Funcionario">

                        <?php } ?>
                    </div>

                    <div style="text-align: center;" id="mensagem">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar mudanças</button>

                    <input name="id" type="hidden" value="<?php echo @$id ?>">
                    

                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM MODAL INSERÇÃO EDIÇÃO -->

<!-- MODAL EXCLUSÃO -->
<div class="modal fade" tabindex="-1" id="modalDeletar">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php 
            $query = $pdo->query("SELECT * from funcionarios where id = '$_GET[id]'");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            $nome_usu = $res[0]['nome'];
            ?>
        
            <div class="modal-header">
                <h5 class="modal-title">Excluir Registro - <?php echo $nome_usu ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-excluir">
                <div class="modal-body">

                    <p>Deseja Realmente Excluir <?php echo $nome_usu ?>?</p>

                    <div style="text-align: center;" id="mensagem-excluir"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>

                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM MODAL EXCLUSÃO -->


<?php
if (@$_GET['funcao'] == "novo") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
            backdrop: 'static'
        })

        myModal.show();
    </script>
<?php } ?>



<?php
if (@$_GET['funcao'] == "editar") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalCadastrar'), {
            backdrop: 'static'
        })

        myModal.show();
    </script>
<?php } ?>



<?php
if (@$_GET['funcao'] == "deletar") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalDeletar'), {

        })

        myModal.show();
    </script>
<?php } ?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#frmCad").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    $('#nome').focus();
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=" + pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function() { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function() {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>
<!-- FIM AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->

<!--AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
    $("#form-excluir").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/excluir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Excluído com Sucesso!") {

                    $('#mensagem-excluir').addClass('text-success')

                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=" + pag;

                } else {

                    $('#mensagem-excluir').addClass('text-danger')
                }

                $('#mensagem-excluir').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,

        });
    });
</script>
<!--FIM AJAX PARA EXCLUIR DADOS -->

<!-- SCRIPT PARA DATABLES USUARIOS -->
<script>
    $(document).ready(function() {
        var table = $('#usuarios').DataTable({
            ordering: false
        });


    });
</script>
<!-- FIM DO SCRIPT PARA DATABLES USUARIOS -->