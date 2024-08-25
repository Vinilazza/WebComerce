<?php
require_once "ConexaoBD.php";

class ClienteLogDAO
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function registrarLog($clienteid, $action)
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO clientelogs (cliente_id, action, ip_address) VALUES (:clienteid, :action, :ip_address)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([
            ':clienteid' => $clienteid,
            ':action' => $action,
            ':ip_address' => $ip_address
        ]);
    }


    public function visitasProdutos()
    {
        $sql = "SELECT 
            clientes.idcliente,
            clientes.nome AS nome_cliente,
            clientes.email,
            produto.idproduto,
            produto.nome,
            produto.visitas
        FROM clientelogs
        INNER JOIN clientes ON clientelogs.cliente_id = clientes.idcliente
        INNER JOIN produto ON clientelogs.action = produto.idproduto
        WHERE clientelogs.cliente_id AND action REGEXP '^[0-9]+$'";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countProdutos()
    {
        $sql = "
SELECT p.idproduto, p.nome as nomeproduto, SUM(p.visitas) as visitas
            FROM produto p
            JOIN clientelogs cl ON cl.action = p.idproduto WHERE cl.cliente_id AND action REGEXP '^[0-9]+$'
            GROUP BY p.idproduto, p.nome
        ";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function incrementarVisitasProduto($idproduto)
    {
        $conexao = ConexaoBD::getConexao();

        $query = "UPDATE produto SET visitas = visitas + 1 WHERE idproduto = :idproduto";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        $stmt->execute();
    }
}
