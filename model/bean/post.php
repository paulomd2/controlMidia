<?php

@include_once '../../include/funcoes.php';
@include_once '../include/funcoes.php';
@include_once 'include/funcoes.php';
class Post {

    private $idPost;
    private $texto;
    private $imagem;
    private $data;
    private $dataCadastro;
    private $idUsuario;
    private $flag;
    
    function getIdPost() {
        return $this->idPost;
    }
    function setIdPost($idPost) {
        $this->idPost = seg($idPost);
    }

    
    function getTexto() {
        return $this->texto;
    }
    function setTexto($texto) {
        $this->texto = seg($texto);
    }

    
    function getImagem() {
        return $this->imagem;
    }
    function setImagem($imagem) {
        $this->imagem = seg($imagem);
    }

    
    function getData() {
        return $this->data;
    }
    function setData($data) {
        $this->data = seg($data);
    }
    
    public function getDataCadastro(){
        return $this->dataCadastro;
    }
    public function setDataCadastro($data){
        $this->dataCadastro = seg($data);
    }
    
    
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = seg($idUsuario);
    }
    
    
    public function getFlag(){
        return $this->flag;
    }
    public function setFlag($flag){
        $this->flag = $flag;
    }
}

$objPost = new Post();
