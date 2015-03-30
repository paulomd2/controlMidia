<?php
require_once 'bean/comentario.php';
require_once 'banco.php';

class ComentarioDAO extends Banco{
    public function listaComentarios($idPost){
        $conexao = $this->abreConexao();
        
        $sql = "SELECT *,date_format(datahora,'%d/%m/%Y - %H:%i') as dataComentario
                FROM ".TBL_COMENTARIO." c
                JOIN usuarios u ON c.idUsuario=u.idUsuario
                WHERE idPost=".$idPost."
                ORDER by datahora desc";
        
        $banco = $conexao->query($sql);
        
        $linhas = array();
        while($linha = $banco->fetch_assoc()){
            $linhas[] = $linha;
        }
        
        return $linhas;
        $this->fechaConexao();
    }
    
    public function cadComentario(Comentario $objComentario){
        $conexao = $this->abreConexao();
        
        echo $sql = "INSERT INTO ".TBL_COMENTARIO." SET
                idPost=".$objComentario->getIdPost().",
                idUsuario=".$objComentario->getIdUsuario().",
                comentario='".$objComentario->getComentario()."',
                datahora='".$objComentario->getData()."'";
        
        $conexao->query($sql);
        
    }
    
    
    public function delComentario(Comentario $objComentario){
        $conexao = $this->abreConexao();
        
        $sql = "DELETE FROM ".TBL_COMENTARIO."
                    WHERE idPost = ".$objComentario->getIdCOmentario()." ";
        
        $conexao->query($sql);
        
    }
}

$objComentarioDao = new ComentarioDAO();