<?php
require_once 'model/usuarioDAO.php';
$retorno = $objUsuarioDao->listaUsuario($_SESSION['codigoAR']);
?>

<div class="bgheader">
    <header>
        <div class="logo">
            <a href="principal.php"><img src="img/logo.png" alt=""/></a>
        </div>
        <div class="barra-topo">
            <?php if ($retorno['nivel'] == 1) {
                ?>
                <div class="add-post">
                    <a href="adicionar.php" class="cor-apoio"><i class="icon icon-plus"></i> <span>Adicionar Post</span></a>
                </div>
            <?php } ?>
            <div class="hi-user">
                <span>Bem vindo (a) <strong><?php echo $retorno['nome'] ?></strong></span>
            </div>
            <div class="sair">
                <a href="sair.php" class="cor-principal"><i class="icon icon-exit"></i> <span>Sair</span></a>
            </div>
        </div>
    </header>
</div>