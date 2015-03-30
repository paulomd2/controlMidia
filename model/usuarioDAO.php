<?php
require_once 'banco.php';
require_once 'bean/usuario.php';

class UsuarioDAO extends Banco{
    public function verificaLogin($objUsuario){
        $conexao = $this->abreConexao();
        
        $sql = "select * from ".TBL_USUARIO." where login='".$objUsuario->getLogin()."' and senha='".$objUsuario->getSenha()."'";
        
        $banco = $conexao->query($sql);
        
        $num_linhas = $banco->num_rows;
        
        if($num_linhas == 0){
            $resposta = 0;
        }else{
            $resposta = $banco->fetch_assoc();
        }
        
        return $resposta;
        
        $this->fechaConexao();
    }
    
    
    public function listaUsuario($idUsuario){
        $conexao = $this->abreConexao();
        
        $sql = "SELECT * FROM ".TBL_USUARIO." WHERE idUsuario = ".$idUsuario;
        
        $banco = $conexao->query($sql);
        
        $linha = $banco->fetch_assoc();
        
        return $linha;
    }
}
$objUsuarioDao = new UsuarioDAO();