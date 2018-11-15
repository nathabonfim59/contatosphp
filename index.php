<?php 

include "ajudantes.php";
include "banco.php";

$semErros = false;
$operacaoAdicionarContato = count($_GET) > 0 && isset($_GET['nome']);

if (isset($_GET)) {
    $semErros = checar_erros();
}

if ($semErros && $operacaoAdicionarContato) {
    armazenarContato(
        $conexao,
        htmlspecialchars($_GET['nome']),
        htmlspecialchars($_GET['telefone']),
        htmlspecialchars($_GET['email']),
        htmlspecialchars($_GET['data_nascimento']),
        htmlspecialchars($_GET['descricao']),
        htmlspecialchars($_GET['favorito'])
    );
}

include "template.php";

?>