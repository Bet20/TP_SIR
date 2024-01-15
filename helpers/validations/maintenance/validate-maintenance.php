<?php

function validatedMaintenance($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['dt_inicio'])) {
        $errors['dt_inicio'] = 'A data de inicio é um campo obrigatorio e deve ser uma data valida';
    }

    if (empty($req['descricao'])) {
        $errors['descricao'] = 'A descricao é um campo obrigatorio.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }
    return $req;
}
?>