<?php

session_start();
require_once '../include/funcoes.php';
require_once '../model/usuarioDAO.php';

$opcao = $_POST['opcao'];
switch ($opcao) {
    case 'verificaLogin':
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $objUsuario->setLogin($login);
        $objUsuario->setSenha($senha);

        $resposta = $objUsuarioDao->verificaLogin($objUsuario);

        $retorno = 0;
        if ($resposta != 0) {
            $_SESSION["codigoAR"] = $resposta['idUsuario'];
            $_SESSION['nivel'] = $resposta['nivel'];
            $retorno = 1;
        }

        print_r($retorno);
        break;
}
?>