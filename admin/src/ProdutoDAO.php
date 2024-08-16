<?php
require_once "ConexaoBD.php";

class ProdutoDAO{

    public function consultarProdutos(){
        $conexao = ConexaoBD::getConexao();
        $sql = 'SELECT * FROM produto';
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarColecao($colecao){
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT * FROM produto where colecao='$colecao' limit 1,4";
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }


    function consultarPorChave($chave){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM produto where nome like'%$chave%'";

        $resultado = $conexao->query($sql);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }

    public function consultarProdutoPorID($id){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM produto WHERE idproduto = $id";
        
        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }


    public function cadastrar($dados){
        $conexao = ConexaoBD::getConexao();

        $nome = $dados['nome'];
        $preco = $dados['preco'];
        $parcelas = $dados['parcelas'];
        $categoria = $dados['tipo'];
        $joia = $dados['joia_produto'];
        $descricao = $dados['descricao'];
        $edicao = $dados['edicao'];
        $colecao = $dados['colecao'];

        $imagem = pegarImagem($_FILES);

        $sql = "INSERT INTO produto (nome, parcelas, idcategoria, descricao, preco, idjoia, edicao, colecao, imagem)
        VALUES ('$nome', $parcelas, $categoria, '$descricao', $preco, $joia, '$edicao', '$colecao', '$imagem')";

        $conexao->exec($sql);
    }

    public function editar($dados, $id){
        $conexao = ConexaoBD::getConexao();

        $nome = $dados['nome'];
        $preco = $dados['preco'];
        $parcelas = $dados['parcelas'];
        $categoria = $dados['tipo'];
        $joia = $dados['joia_produto'];
        $descricao = $dados['descricao'];
        $edicao = $dados['edicao'];
        $colecao = $dados['colecao'];

        $imagem = pegarImagem($_FILES);

        $sql = "UPDATE produto SET 
        nome='$nome', 
        preco='$preco', 
        parcelas=$parcelas,
        descricao='$descricao', 
        idcategoria=$categoria,
        idjoia=$joia,
        edicao='$edicao',
        colecao='$colecao',
        imagem='$imagem'
        WHERE idproduto=$id";


        $conexao->exec($sql);
    }


    public function deletar($id){
        $conexao = ConexaoBD::getConexao();
        $sql = "DELETE FROM produto WHERE idproduto=$id";
        
        $conexao->exec($sql);
    }
}