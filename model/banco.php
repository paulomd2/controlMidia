<?php
require_once "constantes.php";

class Banco {

    private $host = CON_ADMIN_HOST;
    private $user = CON_ADMIN_USER;
    private $pass = CON_ADMIN_PASS;
    private $base = CON_ADMIN_BASE;
    private $Conn;

    public function abreConexao() {
        $this->Conn = new mysqli($this->host, $this->user, $this->pass, $this->base);
        
        return $this->Conn;
    }

    public function fechaConexao() {
        mysqli_close ($this->Conn);
    }

}