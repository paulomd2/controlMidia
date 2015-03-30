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
                <form action="control/postControle.php" id="frmAltImagem" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idPost" value="<?php echo $post['idPost']; ?>" />
                    <input type="hidden" name="opcao" value="alteraImagem" />

                    <input type="file" name="foto" id="imagem<?php echo $post['idPost']; ?>" style="border: 0;">
                    <input type="button" onclick="alteraImagem(<?php echo $post['idPost']; ?>)" value="ALTERAR IMAGEM" class="btn" style="border: 0;"><br />
                    <span id="spanImagem<?php echo $post['idPost']; ?>" class="erro"></span>
                </form>
            <?php endif; ?>
        </div>
        <div class="cont-post">
            <h2>DATA / CONTEÚDO DO POST</h2>
            <p class="data">
                <?php echo utf8_encode(strftime('%A, %d de %B de %Y', strtotime($post['data']))); ?>
            </p>
            <p>
                <?php echo nl2br($post['texto']); ?>
            </p>
            <p>
                <?php
                if ($_SESSION['nivel'] == 1) {
                    echo "<a href='editar.php?idPost=" . $post['idPost'] . "' class='btn'>Editar</a>";
                    echo "<a href='javascript:delPost(" . $post['idPost'] . ")' class='btn'>Excluir</a>";
                    if ($post['aprovacao_data'] == '' || $post['aprovacao_data'] == '0000-00-00 00:00:00') {
                        echo "<a href='javascript:aprovaPost(" . $post['idPost'] . ")' class='btn aprovar'>APROVAR POST</a>";
                    } else {
                        echo "<span class='btn aprovado'>POST APROVADO <i class='icon icon-checkmark'></i></span>";
                    }
                }
                ?>
            </p>
            <div class="comentarios">

                <h2>COMENTÁRIOS / OBSERVAÇÕES</h2>

                <?php
                if ($post['aprovacao_data'] == '' || $post['aprovacao_data'] == '0000-00-00 00:00:00') {
                    ?>
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
                    <form method="post" name="form" id="form<?php echo $post['idPost']; ?>" class="add-coment">
                        <textarea placeholder="Escreva aqui seu comentário" name="texto" id="texto<?php echo $post['idPost']; ?>"></textarea>
                        <input type="button" value="ADICIONAR COMENTÁRIO" onclick="cadComentario(<?php echo $post['idPost']; ?>)" class="btn"/><br />
                        <span class="erro" id="spanComentario"></span>
                    </form>
                    <?php
                }else {
                    echo 'Post aprovado por <strong>' . $post['usuario'] . '</strong> em <strong>' . $post['aprovacao'] . '</strong>.';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
endforeach;
?>