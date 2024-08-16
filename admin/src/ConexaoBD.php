<?php

class ConexaoBD{


    public  static function getConexao():PDO{
        $conexao = new PDO("mysql:host=localhost;dbname=web","root","vinicris");
        return $conexao;
    }
}