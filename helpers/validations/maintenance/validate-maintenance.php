<?php

function validatedMaintenance($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['dt_inicio'])) {
        $errors['dt_inicio'] = 'A matricula é um campo obrigatorio e deve ter entre 6 a 20 caracteres';
    }

    if (empty($req['dt_fim'])) {
        $errors['dt_fim'] = 'A marca é um campo obrigatorio.';
    }

    if (empty($req['descricao']) && strlen($req['descricao']) > 255) {
        $errors['descricao'] = 'O modelo é um campo obrigatorio.';
    }

    if (empty($req['preco'])) {
        $errors['preco'] = 'A cor é um campo obrigatorio.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }
    return $req;
}
?>