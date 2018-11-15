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