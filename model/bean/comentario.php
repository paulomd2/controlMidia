<?php

@include_once '../../include/funcoes.php';
@include_once '../include/funcoes.php';
@include_once 'include/funcoes.php';

class Comentario {

    private $idCOmentario;
    private $idUsuario;
    private $idPost;
    private $comentario;
    private $data;

    function getIdCOmentario() {
        return $this->idCOmentario;
    }
    function setIdCOmentario($idCOmentario) {
        $this->idCOmentario = seg($idCOmentario);
    }

    
    function getIdUsuario() {
        return $this->idUsuario;
    }
    function setIdUsuario($idUsuario) {
        $this->idUsuario = seg($idUsuario);
    }

    
    function getIdPost() {
        return $this->idPost;
    }
    function setIdPost($idPost) {
        $this->idPost = seg($idPost);
    }

    
    function getComentario() {
        return $this->comentario;
    }
    function setComentario($comentario) {
        $this->comentario = seg($comentario);
    }

    
    function getData() {
        return $this->data;
    }
    function setData($data) {
        $this->data = seg($data);
    }

}

$objComentario = new Comentario();