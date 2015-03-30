<?php
@session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once 'constantesBanco.php';

//Constantes de Tabela
//Tabelas ADMIN
define("TBL_USUARIO",DB_ADMIN.TBL_ADMIN."usuarios ");
define("TBL_POST",DB_ADMIN.TBL_ADMIN."posts ");
define("TBL_COMENTARIO",DB_ADMIN.TBL_ADMIN."comentarios ");