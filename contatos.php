<?php

/**
 * Checa se houve algum erro no envio do formulário
 *
 * @return bool
 */
function checar_erros() {

    $todasInformacoesPreenchidas = (
        isset($_GET['nome']) && $_GET['nome'] != "" &&
        isset($_GET['telefone']) && $_GET['telefone'] != "" &&
        isset($_GET['email']) && $_GET['email'] != "" &&
        isset($_GET['data_nascimento']) && $_GET['data_nascimento'] != "" &&
        isset($_GET['descricao']) && $_GET['descricao'] != "" &&
        isset($_GET['favorito']) && $_GET['favorito'] != ""
    );

    $nadaPreenchido = (
        !isset($_GET['nome']) &&
        !isset($_GET['telefone']) &&
        !isset($_GET['email']) &&
        !isset($_GET['data_nascimento']) &&
        !isset($_GET['descricao']) &&
        !isset($_GET['favorito'])
    );

    if ($todasInformacoesPreenchidas || $nadaPreenchido) {
        return true;
    } else {
        ?>
        <div class="borders rounded bg-danger pt-3 pb-1 pl-3 pr-3 mb-2 text-light text-center">
            <h3 class="font-weight-bold">Ocorreu um erro no cadastro do contato.</h3>
            <p>Confira as informações e tente novamente.</p>
        </div>
        <?php
    }
}

/**
 * Armazena um contato
 *
 * @param string $nome Nome do contato
 * @param string $telefone Telefone do contato 
 * @param string $email E-mail do contato
 * @param string $data_nascimento Data de nascimento do contato
 * @param string $descricao Descrição do contato
 * @param string $favorito Se ele é favorito ou não
 * @return void
 */
function armazenarContato($nome, $telefone, $email, $data_nascimento, $descricao, $favorito) {
    $lista_de_contatos = json_decode($_COOKIE['lista_de_contatos']);
    
    //  Transforma: 2322-12-01 em 01/12/2322
    $data_nascimento = implode("/",
        array_reverse(
            explode(
                "-", 
                $data_nascimento
            )
        )
    );

    $lista_de_contatos[] = array(
        "nome"              => $nome,
        "telefone"          => $telefone,
        "email"             => $email,
        "data_nascimento"   => $data_nascimento,
        "descricao"         => $descricao,
        "favorito"          => $favorito
    );

    
    setcookie(
        'lista_de_contatos', 
        json_encode($lista_de_contatos, JSON_UNESCAPED_SLASHES)
    );
}

/**
 * Imprime uma estrela caso a variável
 * seja "sim"
 *
 * @param string $favorito
 * @return void
 */
function checa_favorito($favorito) {
    if ($favorito == "sim") {
        echo '<span class="p-1 mr-2 bg-warning text-white text-center">★</span>';
    }
}