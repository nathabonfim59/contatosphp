<?php

// Configuração do banco de dados
$dbHost = '127.0.0.1';
$dbUsername = 'sistemacontatosa';
$dbPassword = 'sistema123contatos';
$dbName = 'contatos';

$conexao = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conexao) {
    exibe_erro("Erro ao conectar-se ao banco de dados!");
}

/**
 * Recupera uma lista de contatos do banco de dados
 *
 * @param mysqli $conexao Conexão com o banco mysqli
 * @return array
 */
function get_lista_de_contatos($conexao) {
    $lista_de_contatos = array();

    $sqlQuery = " SELECT * FROM contatos";

    $resultado = mysqli_query($conexao, $sqlQuery);

    while ($contato = mysqli_fetch_assoc($resultado)) {
        $lista_de_contatos = $contato;
    }
    
    return $lista_de_contatos;
}