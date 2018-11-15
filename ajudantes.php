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



/**
 * Imprime uma estrela caso a variável
 * seja "sim"
 *
 * @param string $favorito
 * @return void
 */
function checa_favorito($favorito) {
    if ($favorito == 1) {
        echo '<span class="p-1 mr-2 bg-warning text-white text-center">★</span>';
    }
}


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
        isset($_GET['descricao']) && $_GET['descricao'] != ""
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
 * Remove os parênteses e espaços do telefone para
 * inserir no banco de dados.
 *  
 * @param string $telefone
 * @return int
 */
function traduz_telefone_banco($telefone) {
    $numero_telefone = preg_replace(
        "/[^0-9]/", // Deixe apenas os números
        "",         // Substitua os outros char por isso
        $telefone   // String base
    );

    return (int)$numero_telefone;
}

/**
 * Adiciona os espaços, hífens e parênteses
 * ao telefone na tela de exibição
 *
 * @param [type] $telefone
 * @return void
 */
function traduz_telefone_exibicao($telefone) {
    $telefone_cru = (string)$telefone;

    $tamanho_num = strlen($telefone_cru);
    // [1] Resto inicial: Tudo que sobra antes do número
    // [2] Quatro Centrais: Os quatro números antes do 4 últimos
    // [3] Quatro Ultimos: os quatro últimos números.
    //
    // Leia a legenda:
    // ------------------
    //  [1]   [2]  [3]
    // 44 9822-1231
    $digitos = array(
        "quatro_ultimos" => substr(
            $telefone_cru,
            -4
        ),
        "quatro_centrais" => substr(
            $telefone_cru,
            -8,
            4
        ),
        "resto_inicial" => substr(
            $telefone_cru,
            0,
            ($tamanho_num - 8)
        )
    );
    //
    $telefone_formatado = "{$digitos['resto_inicial']} ". 
        "{$digitos['quatro_centrais']}-". 
        "{$digitos['quatro_ultimos']}";

    return $telefone_formatado;
}