<?php
@session_start();

if ($_SESSION["codigoAR"] == '') {
    header("Location: login.php?Erro=2");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>        
        <title>Baby Beauty</title>
        <?php include_once 'include/head.php'; ?>
        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
        <script>
            webshims.setOptions('waitReady', false);
            webshims.setOptions('forms-ext', {types: 'date'});
            webshims.polyfill('forms forms-ext');
        </script>
        <script src="js/posts.js"></script>
    </head>
    <body>
        <?php include_once 'include/header.php' ?>
        <div class="main">
            <form method="post" id="frmCadPost" action="control/postControle.php?opcao=cadPost" class="cad-post" enctype="multipart/form-data" >
                <input type="hidden" value="cadPost" name="opcao" />
                <fieldset>
                    <h2>DATA</h2>
                    <input type="date" name="data" id="data" /><br />
                    <span id="spanData" class="erro"></span>
                </fieldset>
                <fieldset>
                    <h2>CONTEÚDO DO POST</h2>
                    <textarea name="texto" id="texto"></textarea>
                </fieldset>
                <fieldset>
                    <h2>IMAGEM DO POST</h2>
                    <input type="file" name="foto" id="foto" /><br />
                    <span id="spanImagem" class="erro"></span>
                </fieldset>
                <input type="button" id="btnCadPost" value="Cadastrar post"/> <input type="button" onclick="history.back(-1);" class="btn" value="VOLTAR">
            </form>
        </div>
    </body>
</html>