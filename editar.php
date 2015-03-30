<?php
@session_start();
	$codigo=$_SESSION["codigoAR"];
    if(isset($codigo))
    {

		include("include/conexao.php");
		
		$idPost=$_GET['idPost'];
		
		$sql=mysql_query("select * from posts where idPost=$idPost");
		$reg=mysql_fetch_array($sql);
		$data=$reg['data'];
		$imagem=$reg['imagem'];
		$texto=$reg['texto'];

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
    </head>
    <body>
        <?php include_once 'include/header.php' ?>
        <div class="main">
            <form method="post" action="cadPost.php?acao=5&idPost=<?php echo $idPost; ?>" class="edi-post" enctype="multipart/form-data"  style="overflow: hidden;">
	        <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" />
                <fieldset class="fl"> 
                    <h2>IMAGEM DO POST</h2>
                    <figure>
                        <img src="<?php echo $imagem; ?>" alt=""/>
                    </figure>
                    <input type="file" name="foto" />
                </fieldset>
                <fieldset class="fr">
                    <fieldset>
                        <h2>DATA</h2>
                        <input type="date" name="data" value="<?php echo $data; ?>" />
                    </fieldset>
                    <fieldset>
                        <h2>CONTEÚDO DO POST</h2>
                        <textarea name="texto"><?php echo $texto; ?></textarea>
                    </fieldset>
                    <input type="submit" value="Editar post"/> <input type="button" onclick="history.back(-1);" class="btn" value="VOLTAR">
                </fieldset>

            </form>

        </div>

    </body>
</html>
<?php
	}
	else
	{
		header("Location: login.php?Erro=2");
	}
?>