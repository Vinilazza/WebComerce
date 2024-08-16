<?php

class ConexaoBD{


    public  static function getConexao():PDO{
        $conexao = new PDO("mysql:host=localhost;dbname=banco_ma","root","vinicris");
        return $conexao;
    }
}