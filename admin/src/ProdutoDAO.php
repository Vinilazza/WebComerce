<?php
require_once "ConexaoBD.php";
require_once "funcao.php";

class ProdutoDAO
{

    public function consultarProdutos()
    {
        $conexao = ConexaoBD::getConexao();
        $sql = 'SELECT * FROM produto';
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPrimeiraImagem($idproduto)
    {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT imagem FROM produto_imagens WHERE idproduto = :idproduto ORDER BY id ASC LIMIT 1";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        $stmt->execute();
        $imagem = $stmt->fetch(PDO::FETCH_ASSOC);
        return $imagem ? $imagem['imagem'] : null;
    }


    public function marcarImagemPrincipal($idproduto, $idimagem)
    {
        $conexao = ConexaoBD::getConexao();

        // Desmarca qualquer outra imagem que possa estar marcada como principal
        $sqlDesmarcar = "UPDATE produto_imagens SET principal = FALSE WHERE idproduto = :idproduto";
        $stmtDesmarcar = $conexao->prepare($sqlDesmarcar);
        $stmtDesmarcar->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        $stmtDesmarcar->execute();

        // Marca a nova imagem como principal
        $sqlMarcar = "UPDATE produto_imagens SET principal = TRUE WHERE id = :idimagem";
        $stmtMarcar = $conexao->prepare($sqlMarcar);
        $stmtMarcar->bindParam(':idimagem', $idimagem, PDO::PARAM_INT);
        $stmtMarcar->execute();
    }

    public function consultarImagemPrincipal($idproduto)
    {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT imagem FROM produto_imagens WHERE idproduto = :idproduto AND principal = TRUE LIMIT 1";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        $stmt->execute();
        $imagem = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se não houver imagem principal, retorna a primeira imagem
        if (!$imagem) {
            $imagem = $this->consultarPrimeiraImagem($idproduto);
        }

        return $imagem ? $imagem['imagem'] : null;
    }


    public function consultarCategorias($categoria)
    {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT * FROM categorias where categoria='$categoria' limit 1,4";
        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarImagem($idproduto, $imagem, $indiceAtual, $indicePrincipal) {
        try {
            $conexao = ConexaoBD::getConexao();
            
            // Define se a imagem atual é a principal ou não
            $principal = ($indiceAtual == $indicePrincipal) ? 1 : 0;
            
            $sql = "INSERT INTO produto_imagens (idproduto, imagem, principal) VALUES (:idproduto, :imagem, :principal)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
            $stmt->bindParam(':imagem', $imagem, PDO::PARAM_LOB);
            $stmt->bindParam(':principal', $principal, PDO::PARAM_INT);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao adicionar imagem: " . $e->getMessage();
            return false;
        }
    }
    


    public function consultarImagensPorProduto($idproduto) {
        $conexao = ConexaoBD::getConexao();
    
        $sql = "SELECT id, imagem, principal FROM produto_imagens WHERE idproduto = :idproduto";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    function consultarPorChave($chave)
    {
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM produto where nome like'%$chave%'";

        $resultado = $conexao->query($sql);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarProdutoPorID($id)
    {
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM produto WHERE idproduto = $id";

        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }


    public function cadastrar($dados)
    {
        $conexao = ConexaoBD::getConexao();

        // Extrair dados do formulário
        $nome = $dados['nome'];
        $preco = $dados['preco'];
        $parcelas = $dados['parcelas'];
        $categoria = $dados['tipo'];
        $descricaotecnica = $dados['descricao_tecnica'];
        $descricaoproduto = $dados['descricao_produto'];
        $condicao = $dados['condicao'];
        $quantidade = $dados['quantidade'];
        $imagemPrincipal = $dados['imagem_principal'];
        $emoferta = isset($dados['em_oferta']) ? 1 : 0;
        $valoroferta = $dados['valor_oferta'];


        // Inserir o produto na tabela 'produto'
        $sql = "INSERT INTO produto (nome, parcelas, idcategoria, descricao_tecnica, descricao_produto, preco, em_oferta,valor_oferta, quantidade, condicao)
                VALUES ('$nome', $parcelas, $categoria, '$descricaotecnica','$descricaoproduto',  $preco, '$emoferta','$valoroferta', '$quantidade', '$condicao')";
        $conexao->exec($sql);

        // Recuperar o ID do produto recém-cadastrado
        $idproduto = $conexao->lastInsertId();

        // Verificar se há imagens enviadas
        if (!empty($_FILES['imagens']['tmp_name'][0])) {
            foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
                $imagem = file_get_contents($tmp_name);  // Obtém o conteúdo binário da imagem
                $this->adicionarImagem($idproduto, $imagem, $key, $imagemPrincipal);  // Chama o método adicionarImagem
            }
        }
    }


    public function editar($dados, $id)
    {
        $conexao = ConexaoBD::getConexao();

        $nome = $dados['nome'];
        $preco = $dados['preco'];
        $parcelas = $dados['parcelas'];
        $categoria = $dados['tipo'];
        $joia = $dados['joia_produto'];
        $descricao = $dados['descricao'];
        $condicao = $dados['condicao'];
        $desccurta = $dados['desccurta'];

        $imagem = pegarImagem($_FILES);

        $sql = "UPDATE produto SET 
        nome='$nome', 
        preco='$preco', 
        parcelas=$parcelas,
        descricao='$descricao', 
        idcategoria=$categoria,
        idjoia=$joia,
        condicao='$condicao',
        desccurta='$desccurta',
        imagem='$imagem'
        WHERE idproduto=$id";


        $conexao->exec($sql);
    }


    public function deletar($id)
    {
        $conexao = ConexaoBD::getConexao();
        
        try {
            // Começa uma transação
            $conexao->beginTransaction();
            
            // Exclui todas as imagens associadas ao produto
            $sqlExcluirImagens = "DELETE FROM produto_imagens WHERE idproduto = :idproduto";
            $stmtExcluirImagens = $conexao->prepare($sqlExcluirImagens);
            $stmtExcluirImagens->bindParam(':idproduto', $id, PDO::PARAM_INT);
            $stmtExcluirImagens->execute();
            
            // Exclui o produto
            $sqlExcluirProduto = "DELETE FROM produto WHERE idproduto = :idproduto";
            $stmtExcluirProduto = $conexao->prepare($sqlExcluirProduto);
            $stmtExcluirProduto->bindParam(':idproduto', $id, PDO::PARAM_INT);
            $stmtExcluirProduto->execute();
            
            // Commit da transação
            $conexao->commit();
        } catch (PDOException $e) {
            // Rollback em caso de erro
            $conexao->rollBack();
            echo "Erro ao deletar produto: " . $e->getMessage();
        }
    }
    
    public function consultarProdutosPorCategoria($idCategoria, $limit, $offset) {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT * FROM produto WHERE idcategoria = :idcategoria LIMIT :limit OFFSET :offset";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idcategoria', $idCategoria, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function contarProdutosPorCategoria($idCategoria) {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT COUNT(*) as total FROM produto WHERE idcategoria = :idcategoria";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idcategoria', $idCategoria, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    


    public function contarProdutos()
    {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT COUNT(*) AS total FROM produto";
        $stmt = $conexao->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function contarClientes()
    {
        $conexao = ConexaoBD::getConexao();
        $sql = "SELECT COUNT(*) AS total FROM clientes";
        $stmt = $conexao->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
