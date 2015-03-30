<?php

@session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once 'banco.php';
require_once 'bean/post.php';

class PostDao extends Banco {

    public function listaPost() {
        $conexao = $this->abreConexao();

        $dataAtual = date('Y-m-d');

        $domingo = strtotime("last Sunday");
        $sabado = strtotime("first Saturday");

        $domingo = date("Y-m-d", $domingo);
        $sabado = date("Y-m-d", $sabado);


        $sql = "SELECT p.*, DATE_FORMAT(p.aprovacao_data, '%d/%m/%Y às %H:%i') AS aprovacao,
                u.nome AS usuario
                FROM " . TBL_POST . " p
                    LEFT JOIN ".TBL_USUARIO." u ON u.idUsuario = p.aprovacao_usuario
                WHERE p.data > '$domingo'
                ORDER BY p.data
                ";


        $banco = $conexao->query($sql);

        $linhas = array();
        while ($linha = $banco->fetch_assoc()) {
            $linhas[] = $linha;
        }

        return $linhas;

        $this->fechaConexao();
    }
    
    public function listaPost1($objPost){
        $conexao = $this->abreConexao();
        
        $sql = "
                SELECT * FROM ".TBL_POST." WHERE idPost = ".$objPost->getIdPost()."
               ";
        
        $banco = $conexao->query($sql);
        
        $linha = $banco->fetch_assoc();
        return $linha;
        
        $this->fechaConexao();
    }

    public function cadPost($objPost){
        $conexao = $this->abreConexao();
        
        echo $sql = "INSERT INTO ".TBL_POST." SET
                data='".$objPost->getData()."',
                texto='".$objPost->getTexto()."',
                datahora='".$objPost->getDataCadastro()."',
                flag = '".$objPost->getFlag()."',
                idUsuario = ".$objPost->getIdUsuario().",
                imagem = '".$objPost->getImagem()."'
                ";
        
        $conexao->query($sql) or die($conexao->error);
        
        $this->fechaConexao();
    }
    
    public function altPost($objPost){
        $conexao = $this->abreConexao();
        $sql = "UPDATE ".TBL_POST."
                SET
                data='".$objPost->getData()."',
                texto='".$objPost->getTexto()."'
                    WHERE idPost=".$objPost->getIdPost()."
                ";
        
        $conexao->query($sql);
        
        $this->fechaConexao();
    }
    
    public function delPost(Post $objPost){
        $conexao = $this->abreConexao();
        
        $sql = "DELETE FROM ".TBL_POST." WHERE idPost = ".$objPost->getIdPost();
        
        $conexao->query($sql);
        
        $this->fechaConexao();
    }
    
    
    public function altImagem(Post $objPost){
        $conexao = $this->abreConexao();
        
        $sql = "UPDATE ".TBL_POST." SET
                imagem = '".$objPost->getImagem()."'
                    WHERE idPost = ".$objPost->getIdPost()."
               ";
        
        $conexao->query($sql);
        
        $this->fechaConexao();
    }
    
    public function aprovaPost(Post $objPost){
        $conexao = $this->abreConexao();
      echo  $sql = "
                UPDATE ".TBL_POST." SET
                aprovacao_usuario = ".$objPost->getIdUsuario().",
                aprovacao_data = '".$objPost->getData()."'
                    WHERE idPost = ".$objPost->getIdPost()."
               ";
        
        $conexao->query($sql);
        $this->fechaConexao();
    }

}

$objPostDao = new PostDao();
