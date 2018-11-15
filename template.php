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
            <div class="form-group row">
                <label for="email" class="col-form-label col-sm-2">Data de nascimento</label>
                <div class="col-sm-10">
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" placeholder="16/10/1998" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-form-label col-sm-2">Descrição</label>
                <div class="col-sm-10">
                    <textarea type="text" id="descrivao" name="descricao" class="form-control" placeholder="Descrição do contato" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 ml-3"></div>
                <div class="custom-control custom-checkbox col-sm-9">
                    <input type="checkbox" class="custom-control-input" id="favoritoCheckbox" value="1" name="favorito">
                    <label class="custom-control-label" for="favoritoCheckbox">Favorito</label>
                </div>
            </div>
            <div class="col-sm-12 text-center mt-5">
                <button type="submit" class="btn btn-success px-4">Cadastrar contato</button>
            </div>
        </form>
        
        <h3 class="mt-5 mb-3 font-weight-bold text-muted text-center">Contatos cadastrados</h3>
        <div class="border-top p-3 row mb-3" style="background-color: #dee0e0;border-color: #3cc3d8 !important;border-width: 5px !important;">
        <?php
        
        $lista_de_contatos = get_lista_de_contatos($conexao); 
        // var_dump($lista_de_contatos);
        foreach ($lista_de_contatos as $contato):?>
            <div class="card col-sm-4 p-0 mt-2">
                <div class="card-header font-weight-bold"><?php 
                
                    checa_favorito($contato['favorito']);
                    echo $contato['nome']; 

                ?></div>

                <div class="list-group list-flush">
                    <div class="list-group-item">
                        <p class="text-uppercase font-weight-bold text-muted">Telefone</p>
                        <p><?php echo traduz_telefone_exibicao($contato['telefone']); ?></p>
                    </div>
                    <div class="list-group-item">
                        <p class="text-uppercase font-weight-bold text-muted">E-mail</p>
                        <p><?php echo $contato['email']; ?></p>
                    </div>
                    <div class="list-group-item">
                        <p class="text-uppercase font-weight-bold text-muted">Data de nascimento</p>
                        <p><?php echo traduz_data_exibir($contato['data_nascimento']); ?></p>
                    </div>
                    <div class="list-group-item">
                        <p class="text-uppercase font-weight-bold text-muted">Descrição</p>
                        <p class="p-2 bg-light border"><?php echo $contato['descricao']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        </div>
    </div>
</body>
</html>