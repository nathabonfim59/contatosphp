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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerenciador de contatos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-5 text-center font-weight-bold">Gerenciador de contatos</h1>
        
        <?php 

        $semErros = false;
        $operacaoAdicionarContato = count($_GET) > 0 && isset($_GET['nome']);

        if (isset($_GET)) {
            $semErros = checar_erros();
        }

        if ($semErros && $operacaoAdicionarContato) {
            armazenarContato(
                $_GET['nome'],
                $_GET['telefone'],
                $_GET['email']
            );
        }


        

        ?>

        <form action="" class="border-top rounded-bottom p-4 bg-light border-success" style="border-width: 2spx !important;">
            <h4 class="mt-2 mb-5 font-weight-bold text-muted text-center">Cadastrar contato</h4>
            <div class="form-group row">
                <label for="nome" class="col-form-label col-sm-2">Nome</label>
                <div class="col-sm-10">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Fulano de tal ">
                </div>
            </div>
            <div class="form-group row">
                <label for="telefone" class="col-form-label col-sm-2">Telefone</label>
                <div class="col-sm-10">
                    <input type="text" id="nome" name="telefone" class="form-control" placeholder="(44) 123456-7899">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-form-label col-sm-2">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" class="form-control" placeholder="email@email.com">
                </div>
            </div>
            <div class="col-sm-12 text-center mt-5">
                <button type="submit" class="btn btn-success px-4">Cadastrar contato</button>
            </div>
        </form>
        
        <h3 class="mt-5 mb-3 font-weight-bold text-muted text-center">Contatos cadastrados</h3>
        <div class="border-top p-3 row" style="background-color: #dee0e0;border-color: #3cc3d8 !important;border-width: 5px !important;">
        <?php
        $lista_de_contatos = json_decode($_COOKIE['lista_de_contatos'], true); 
        
        foreach ($lista_de_contatos as $contato):?>
            <div class="card col-sm-4 p-0 mt-2">
                <div class="card-header font-weight-bold"><?php echo $contato['nome']; ?></div>

                <div class="list-group list-flush">
                    <div class="list-group-item">
                        <p class="text-uppercase font-weight-bold text-muted">Telefone</p>
                        <p><?php echo $contato['telefone']; ?></p>
                    </div>
                    <div class="list-group-item">
                        <p class="text-uppercase font-weight-bold text-muted">E-mail</p>
                        <p><?php echo $contato['email']; ?></p>
                    </div> 
                </div>
            </div>
        <?php endforeach; ?>

        </div>
    </div>
</body>
</html>