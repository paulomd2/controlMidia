<?php
@session_start();
require_once 'model/postDAO.php';
require_once 'model/comentarioDAO.php';
//Data em português
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
$posts = $objPostDao->listaPost();

foreach ($posts as $post):
    ?>
    <div class="ipost">
        <div class="imagem">
            <figure><img src="upload/<?php echo $post['imagem']; ?>" alt=""/></figure>
            <!--<a href="#" class="btn">Alterar Imagem</a>-->
            <?php if ($_SESSION['nivel'] == 1): ?>
                <form action="cadPost.php?acao=2" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idPost" value="<?php echo $post['idPost']; ?>" />
                    <input type="file" name="foto" style="border: 0;">
                    <input type="submit" value="ALTERAR IMAGEM" class="btn" style="border: 0;">
                </form>
            <?php endif; ?>
        </div>
        <div class="cont-post">
            <h2>DATA / CONTEÚDO DO POST</h2>
            <p class="data">
                <?php echo utf8_encode(strftime('%A, %d de %B de %Y', strtotime($post['data']))); ?>
            </p>
            <p>
                <?php echo $post['texto']; ?>
            </p>
            <p>
                <?php
                if ($_SESSION['nivel'] == 1) {
                    echo "<a href='editar.php?idPost=" . $post['idPost'] . "' class='btn'>Editar</a>";
                    echo "<a href='cadPost.php?idPost=" . $post['idPost'] . "&acao=4' class='btn'>Excluir</a>";
                }
                ?>
            </p>
            <div class="comentarios">
                <h2>COMENTÁRIOS / OBSERVAÇÕES</h2>

                <?php
                $comentarios = $objComentarioDao->listaComentarios($post['idPost']);

                foreach ($comentarios as $comentario):
                    $nomeComentario = $comentario['nome'];
                    $textoComentarios = $comentario['comentario'];
                    $dataComentario = $comentario['dataComentario'];
                    ?>
                    <div id="comentariosAjax<?php echo $post['idPost']; ?>">
                        <p>
                            <span class="dt-user"><strong><?php echo $nomeComentario; ?></strong> - <em><?php echo $dataComentario; ?></em></span>
                            <?php echo $textoComentarios; ?>
                        </p>
                    </div>
                    <?php
                endforeach;
                ?>

                <!--<a href="#" class="btn">Adicionar comentário</a>-->
                <form action="cadPost.php?acao=3" method="post" name="form" id="form<?php echo $post['idPost']; ?>" class="add-coment">
                    <textarea placeholder="Escreva aqui seu comentário" name="texto" id="texto<?php echo $post['idPost']; ?>"></textarea>
                    <input type="button" value="ADICIONAR COMENTÁRIO" onclick="cadComentario(<?php echo $post['idPost']; ?>)" class="btn"/><br />
                    <span class="erro" id="spanComentario"></span>
                </form>
            </div>
        </div>
    </div>
    <?php
endforeach;
?>