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
        isset($_GET['email']) && $_GET['email'] != ""
    );

    $nadaPreenchido = (
        !isset($_GET['nome']) &&
        !isset($_GET['telefone']) &&
        !isset($_GET['email'])
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
 * @return void
 */
function armazenarContato($nome, $telefone, $email) {
    $lista_de_contatos = json_decode($_COOKIE['lista_de_contatos']);
    
    $lista_de_contatos[] = array(
        "nome"       => $nome,
        "telefone"   => $telefone,
        "email"      => $email
    );

    setcookie(
        'lista_de_contatos', 
        json_encode($lista_de_contatos, JSON_UNESCAPED_SLASHES)
    );
}