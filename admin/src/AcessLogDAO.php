<?php
require_once "ConexaoBD.php";

class AccessLogDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function registrarLog($admin_id, $action) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO accesslogs (admin_id, action, ip_address) VALUES (:admin_id, :action, :ip_address)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([
            ':admin_id' => $admin_id,
            ':action' => $action,
            ':ip_address' => $ip_address
        ]);
    }
}
