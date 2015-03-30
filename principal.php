<?php
@session_start();

if ($_SESSION["codigoAR"] == '') {
    header("Location: index.php?Erro=2");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>        
        <title>Baby Beauty</title>
        <?php include_once 'include/head.php'; ?>
        <script src="js/posts.js"></script>
    </head>
    <body>
        <?php
        include_once 'include/header.php';
        require_once "model/postDAO.php";
        ?>
        <div class="main">
            <div class="post-all" id="posts">
                <?php
                    require_once 'posts.php';
                ?>
            </div>
        </div>
        <div id="backtop">
            <span onclick="rolar_para('body')"></span>
        </div>
    </body>
</html>