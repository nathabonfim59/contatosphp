<?php

// Configuração do banco de dados
$dbHost = '127.0.0.1'; // Endereço do servidor MySQL
$dbUsername = 'sistemacontatos'; // Nome de usuário do banco de dados
$dbPassword = 'sistema123contatos'; // Senha do usuário
$dbName = 'contatos'; // Nome da tabela

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

    $sqlQuery = "SELECT * FROM contatos";

    $resultado = mysqli_query($conexao, $sqlQuery);

    while ($contato = mysqli_fetch_assoc($resultado)) {
        $lista_de_contatos[] = $contato;
    }
    
    return $lista_de_contatos;
}


/**
 * Armazena um contato
 *
 * @param mysqli $conexao Conexão com o banco de dados mysqli
 * 
 * @param string $nome Nome do contato
 * @param string $telefone Telefone do contato 
 * @param string $email E-mail do contato
 * @param string $data_nascimento Data de nascimento do contato
 * @param string $descricao Descrição do contato
 * @param int $favorito Se ele é favorito ou não (0 ou 1)
 * @return void
 */
function armazenarContato($conexao, $nome, $telefone, $email, $data_nascimento, $descricao, $favorito) {
    
    $dadosContato = array(
        "nome"              => $nome,
        "telefone"          => traduz_telefone_banco($telefone),
        "email"             => $email,
        "data_nascimento"   => $data_nascimento,
        "descricao"         => $descricao,
        "favorito"          => $favorito
    );

    $sqlQuery = "INSERT INTO contatos (
        nome,
        telefone,
        email,
        data_nascimento,
        descricao,
        favorito
    ) VALUES (
        '{$dadosContato['nome']}',
        {$dadosContato['telefone']},
        '{$dadosContato['email']}',
        '{$dadosContato['data_nascimento']}',
        '{$dadosContato['descricao']}',
        {$dadosContato['favorito']}
    )";

    var_dump($sqlQuery);
    mysqli_query($conexao, $sqlQuery);
}
