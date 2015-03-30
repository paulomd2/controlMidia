<?php
require_once 'model/comentarioDAO.php';
$comentarios = $objComentarioDao->listaComentarios($_GET['idPost']);

foreach ($comentarios as $comentario):
    $nomeComentario = $comentario['nome'];
    $textoComentarios = $comentario['comentario'];
    $dataComentario = $comentario['dataComentario'];
    ?>
    <p>
        <span class="dt-user"><strong><?php echo $nomeComentario; ?></strong> - <em><?php echo $dataComentario; ?></em></span>
        <?php echo $textoComentarios; ?>
    </p>
    <?php
endforeach;
?>