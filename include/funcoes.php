<?php
function seg($var) {
    $procura = array("insert into", "update", "delete from", "select % from");
    $retorno = str_ireplace($procura, '', $var);
    
    return $retorno;
}