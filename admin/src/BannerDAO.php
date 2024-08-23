<?php

require_once 'ConexaoBD.php';

class BannerDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function adicionarBanner($imagem, $titulo, $link, $ordem) {
        $sql = "INSERT INTO banners (imagem, titulo, link, ordem) VALUES (:imagem, :titulo, :link, :ordem)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':ordem', $ordem);
        return $stmt->execute();
    }

    public function listarBanners() {
        $sql = "SELECT * FROM banners WHERE ativo = 1 ORDER BY ordem ASC";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarBanner($id, $titulo, $link, $ordem, $ativo) {
        $sql = "UPDATE banners SET titulo = :titulo, link = :link, ordem = :ordem, ativo = :ativo WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':ordem', $ordem);
        $stmt->bindParam(':ativo', $ativo);
        return $stmt->execute();
    }

    public function excluirBanner($id) {
        $sql = "DELETE FROM banners WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>
