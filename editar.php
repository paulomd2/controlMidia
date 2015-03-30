<?php
@session_start();
if ($_SESSION["codigoAR"] == '') {
    header("Location: login.php?Erro=2");
}
require_once 'model/postDAO.php';

$idPost = ($_GET['idPost']);

$objPost->setIdPost($idPost);

$post = $objPostDao->listaPost1($objPost);
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>        
        <title>Baby Beauty</title>
        <?php include_once 'include/head.php'; ?>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
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
            <form id="frmAltPost" method="post" action="control/postControle.php?opcao=altPost" class="edi-post" enctype="multipart/form-data"  style="overflow: hidden;">
	        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" />
                <input type="hidden" value="<?php echo $post['imagem'] ?>" name="imagemAntiga" />
                <input type="hidden" value="altPost" name="opcao" />
                <fieldset class="fl"> 
                    <h2>IMAGEM DO POST</h2>
                    <figure>
                        <img src="upload/<?php echo $post['imagem']; ?>" alt=""/>
                    </figure>
                    <input type="file" name="foto" id="foto" />
                    
                </fieldset>
                <fieldset class="fr">
                    <fieldset>
                        <h2>DATA</h2>
                        <input type="date" name="data" id="data" value="<?php echo $post['data']; ?>" /><br />
                        <span class="erro" id="spanData" />
                    </fieldset>
                    <fieldset>
                        <h2>CONTEÚDO DO POST</h2>
                        <textarea name="texto" id="texto"><?php echo $post['texto']; ?></textarea>
                    </fieldset>
                    <input type="button" value="Editar post" id="btnAltPost" />
                    <input type="button" onclick="history.back(-1);" class="btn" value="VOLTAR"><br />
                    <span id="spanImagem" class="erro"></span>
                </fieldset>

            </form>

        </div>

    </body>
</html>