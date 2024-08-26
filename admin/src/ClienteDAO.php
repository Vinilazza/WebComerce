<?php
require_once "ConexaoBD.php";

class ClienteDAO{

    public function consultarcliente($email){
        $conexao = ConexaoBD::getConexao();

        $sql = "select idcliente,nome,email,endereco from clientes where email='$email'";

        $resultado = $conexao->query($sql);
        return $resultado->fetch(PDO::FETCH_ASSOC);

    }

    public function consultarClientes() {
        $conexao = ConexaoBD::getConexao();

        $sql = "select idcliente,nome,email,endereco from clientes";

        $resultado = $conexao->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);  
    }

    function consultarPorChave($chave){
        $conexao = ConexaoBD::getConexao();

        $sql = "SELECT * FROM clientes where nome like'%$chave%'";

        $resultado = $conexao->query($sql);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }

    function registrarVisita(){
        $conexao = ConexaoBD::getConexao();

     $ip = $_SERVER['REMOTE_ADDR']; 
     $query = "INSERT INTO visitas (ip) VALUES (:ip)";
     $stmt = $conexao->prepare($query);
     $stmt->bindParam(':ip', $ip);
     $stmt->execute();
    }

    function contarVisitas() {
        $conexao = ConexaoBD::getConexao();

        $query = "SELECT COUNT(*) AS total FROM visitas";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }


    function verificarUsuario($google_id) {
        $conexao = ConexaoBD::getConexao();
    
        $query = "SELECT * FROM clientes WHERE google_id = :google_id";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':google_id', $google_id, PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    function cadastrarUsuario($id, $nome, $email, $foto) {
        $conexao = ConexaoBD::getConexao();
    
        $query = 'INSERT INTO clientes (nome, email, google_id, foto) VALUES (:nome, :email, :google_id, :foto)';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':google_id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_STR); 
    
        $stmt->execute();
    }

    public function cadastrarUsuarioInterno($nome, $email, $senha) {
        $conexao = ConexaoBD::getConexao();
    
        // Gerar o hash da senha
        $hashSenha = password_hash($senha, PASSWORD_BCRYPT);
    
        // Gerar imagem com iniciais
        $imagemBinaria = $this->gerarImagemIniciais($nome);
    
        // Inserir dados no banco de dados
        $query = 'INSERT INTO clientes (nome, email, senha, foto_blob) VALUES (:nome, :email, :senha, :foto_blob)';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $hashSenha, PDO::PARAM_STR);
        $stmt->bindParam(':foto_blob', $imagemBinaria, PDO::PARAM_LOB);
    
        $stmt->execute();
    }
    
    public function verificarLoginInterno($email, $senha) {
        $conexao = ConexaoBD::getConexao();
    
        // Busca o usuário pelo e-mail
        $query = 'SELECT * FROM clientes WHERE email = :email';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verifica se o usuário existe
        if ($usuario) {
            // Verifica se a senha fornecida corresponde ao hash armazenado
            if (password_verify($senha, $usuario['senha'])) {
                // Login bem-sucedido
                return $usuario;
            } else {
                // Senha incorreta
                return null;
            }
        } else {
            // Usuário não encontrado
            return null;
        }
    }
    

    private function gerarImagemIniciais($nome) {
        // Extrai as iniciais
        $nomeArray = explode(' ', $nome);
        $iniciais = '';
        foreach ($nomeArray as $parte) {
            $iniciais .= strtoupper($parte[0]);
        }
    
        // Configurações da imagem
        $largura = 100;
        $altura = 100;
        $fundo = [255, 255, 255];  // Cor branca
        $corTexto = [0, 0, 0];     // Cor preta
        $fonte = __DIR__ . '../public/Montserrat-Medium.ttf';  // Atualize para o caminho da sua fonte TTF
        $tamanhoFonte = 40;
    
        // Cria uma imagem
        $imagem = imagecreate($largura, $altura);
        $corFundo = imagecolorallocate($imagem, $fundo[0], $fundo[1], $fundo[2]);
        $corTextoImagem = imagecolorallocate($imagem, $corTexto[0], $corTexto[1], $corTexto[2]);
    
        // Calcula a posição do texto
        $caixaTexto = imagettfbbox($tamanhoFonte, 0, $fonte, $iniciais);
        $x = ($largura - ($caixaTexto[2] - $caixaTexto[0])) / 2;
        $y = ($altura - ($caixaTexto[7] - $caixaTexto[1])) / 2;
        $y -= $caixaTexto[7];
    
        // Adiciona o texto na imagem
        imagettftext($imagem, $tamanhoFonte, 0, $x, $y, $corTextoImagem, $fonte, $iniciais);
    
        // Captura a imagem como string binária
        ob_start();
        imagepng($imagem);
        $imagemBinaria = ob_get_clean();
        imagedestroy($imagem);
    
        return $imagemBinaria;  // Retorna a imagem binária
    }

    


}

?>