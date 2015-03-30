<?php

@session_start();
require_once '../model/comentarioDAO.php';
require_once '../model/postDAO.php';
@include_once '../include/funcoes.php';
/*
  $acao = $_GET['acao'];

  $idPost = $_REQUEST['idPost'];
  $idUsuario = $_POST['idUsuario'];

  $data = $_POST['data'];
  $texto = $_POST['texto'];
 */
$opcao = $_POST['opcao'];
switch ($opcao) {
    case 'cadComentario':
        $comentario = $_POST['comentario'];
        $idPost = $_POST['idPost'];
        $idUsuario = $_SESSION['codigoAR'];
        $data = date('Y-m-d H:i:s');

        $objComentario->setComentario($comentario);
        $objComentario->setIdPost($idPost);
        $objComentario->setIdUsuario($idUsuario);
        $objComentario->setData($data);

        $objComentarioDao->cadComentario($objComentario);
        break;

    case 'cadPost':
        $data = $_POST['data'];
        $texto = $_POST['texto'];
        $flag = 'aprovacao';
        $idUsuario = $_SESSION['codigoAR'];
        $dataCadastro = date("Y-m-d H:i:s");

        if ($_FILES['foto']['name'] != '') {
            $foto = uploadImagem();
            if ($foto == false) {
                $foto = '';
            }
        } else {
            $foto = '';
        }

        $objPost->setData($data);
        $objPost->setTexto($texto);
        $objPost->setFlag($flag);
        $objPost->setIdUsuario($idUsuario);
        $objPost->setDataCadastro($dataCadastro);
        $objPost->setImagem($foto);

        $objPostDao->cadPost($objPost);

        header("Location: ../principal.php");
        break;

    case 'altPost':
        $data = $_POST['data'];
        $texto = $_POST['texto'];
        $idPost = $_POST['idPost'];


        //var_dump($_FILES);
        if ($_FILES['foto']['name'] != '') {
            $foto = uploadImagem();
            if ($foto == false) {
                $foto = '';
            }
        } else {
            $foto = $_POST['imagemAntiga'];
        }

        $objPost->setData($data);
        $objPost->setTexto($texto);
        $objPost->setImagem($foto);
        $objPost->setIdPost($idPost);

        $objPostDao->altPost($objPost);

        header("Location: ../principal.php");
        break;

    case 'excluirPost':
        $idPost = $_POST['idPost'];

        $objPost->setIdPost($idPost);
        $objComentario->setIdPost($idPost);

        $post = $objPostDao->listaPost1($objPost);
        $objComentarioDao->delComentario($objComentario);

        unlink('../upload/' . $post['imagem']);
        $objPostDao->delPost($objPost);

        break;

    case 'alteraImagem':
        $idPost = $_POST['idPost'];
        $foto = uploadImagem();

        if ($foto === false) {
            $foto = '';
        }
        
        $objPost->setImagem($foto);
        $objPost->setIdPost($idPost);
        
        $post = $objPostDao->listaPost1($objPost);
        unlink('../upload/' . $post['imagem']);
        
        $objPostDao->altImagem($objPost);
        
        header("Location: ../principal.php");
        break;
        
        case 'aprovaPost':
            $idPost = $_POST['idPost'];
            $data = date('Y-m-d H:i:s');
            
            $objPost->setIdPost($idPost);
            $objPost->setIdUsuario($_SESSION['codigoAR']);
            $objPost->setData($data);
            
            $objPostDao->aprovaPost($objPost);
            break;
}

?>