<?php

/**
 * Exibe um erro com uma mensagem para o usuário
 *
 * @param string $mensgem Mensagem de erro
 * @return HTML
 */
function exibe_erro($mensgem) {
    ?>
    <div class="container mt-5 bg-danger p-4 rounded text-white text-center">
        <h1 class="py-4 mb-3 text-danger bg-white rounded"><strong><?php echo $mensgem; ?></strong></h1>
        <h4 class="mt-4">Tente novamente mais tarde.</h4>
    </div>
    <?php
}


/**
 * Traduz a data do banco de dados para o padão 
 * português/brasil
 * 
 *  yyyy/mm/dd => dd/mm/yyyy
 *
 * @param string $data Data no formato americano do banco de dados
 * @return string
 */
function traduz_data_exibir($data) {
    $dados = explode("-", $data);

    // Data no formato => dd/mm/yyyy
    $data_exibicao = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

    return $data_exibicao;
}