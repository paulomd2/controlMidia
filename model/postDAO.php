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


        $sql = "SELECT *
                    FROM " . TBL_POST . "
                        WHERE data > '$domingo'
                        ORDER BY data";


        $banco = $conexao->query($sql);

        $linhas = array();
        while ($linha = $banco->fetch_assoc()) {
            $linhas[] = $linha;
        }

        return $linhas;

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

}

$objPostDao = new PostDao();
