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

        //var_dump($_FILES);
        if ($_FILES['foto']['name'] != '') {
            $foto = uploadImagem();
            if ($foto == false) {
                $foto = '';
            }
        } else {
            $foto = '';
        }
        
        //echo $foto;

        $objPost->setData($data);
        $objPost->setTexto($texto);
        $objPost->setFlag($flag);
        $objPost->setIdUsuario($idUsuario);
        $objPost->setDataCadastro($dataCadastro);
        $objPost->setImagem($foto);

        $objPostDao->cadPost($objPost);

        header("Location: ../principal.php");
        break;
}

if ($acao == 1) {

    $sqlInsert = mysql_query("insert into posts set data='$data',texto='$texto',datahora=current_timestamp");

    $sql2 = mysql_query("select max(idPost) as idPost from posts");
    $reg = mysql_fetch_array($sql2);
    $idPost = $reg['idPost'];

    $uploaddir2 = 'upload/';
    //$uploadfile2 = $uploaddir2 . $_FILES['foto']['name'];
    $uploadfile2 = $uploaddir2 . "post" . $idPost . ".png";

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile2)) {

        $foto = $uploadfile2;

        $sqlInsertarquivo = mysql_query("update posts set imagem='$foto' where idPost=$idPost");
    }

    header("Location: principal.php");
}

//Troca imagem
if ($acao == 2) {
    $uploaddir2 = 'upload/';

    //$uploadfile2 = $uploaddir2 . $_FILES['foto']['name'];
    $uploadfile2 = $uploaddir2 . "post" . $idPost . ".png";

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile2)) {

        $foto = $uploadfile2;

        $sqlInsertarquivo = mysql_query("update posts set imagem='$foto' where idPost=$idPost");
    }

    header("Location: principal.php");
}
/*
  //Adiciona Comentário
 * 
  //Pronto
  if ($acao == 3) {
  $sql = mysql_query("insert into comentarios set idPost='$idPost',idUsuario='$idUsuario',comentario='$texto',datahora=current_timestamp");
  header("Location: principal.php");
  }
 */

//Ecluir Post
if ($acao == 4) {
    $idPost = $_GET['idPost'];
    $sqlImagem = mysql_query("select imagem from posts where idPost=$idPost");
    $regImagem = mysql_fetch_array($sqlImagem);
    $imagem = $regImagem['imagem'];
    @unlink($imagem);

    $sql = mysql_query("delete from posts where idPost=$idPost");
    $sqlComentario = mysql_query("delete from comentarios where idPost=$idPost");

    header("Location: principal.php");
}

//Editar Post
if ($acao == 5) {
    $sql = mysql_query("update posts set data='$data',texto='$texto' where idPost=$idPost");

    $uploaddir2 = 'upload/';

    //$uploadfile2 = $uploaddir2 . $_FILES['foto']['name'];
    $uploadfile2 = $uploaddir2 . "post" . $idPost . ".png";

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile2)) {

        $foto = $uploadfile2;

        $sqlInsertarquivo = mysql_query("update posts set imagem='$foto' where idPost=$idPost");
    }

    header("Location: principal.php");
}

function uploadImagem() {

    $valido = true;
    $tipoArquivo = pathinfo($_FILES['foto']['name']);
    $tipoArquivo = '.' . $tipoArquivo['extension'];

    $new_file_name = strtolower(md5(date('d/m/Y/H:i:s'))) . $tipoArquivo;
    if ($_FILES['foto']['size'] > (1048576)) { //não pode ser maior que 1Mb
        $valido = false;
    } else {
        @$imagemAntiga = '../upload/' . $_POST["imagemAntiga"];

        if (!file_exists('../upload/')) {
            mkdir('../upload/');
        } elseif (file_exists($imagemAntiga)) {
            @unlink($imagemAntiga);
        }
        move_uploaded_file($_FILES['foto']['tmp_name'], '../upload/' . $new_file_name);

        $valido = $new_file_name;
    }

    return $valido;
}

?>