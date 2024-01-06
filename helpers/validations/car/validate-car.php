<?php

function validatedCar($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['matricula']) || strlen($req['matricula']) < 6 || strlen($req['matricula']) > 20 ) {
        $errors['matricula'] = 'A matricula é um campo obrigatorio e deve ter entre 6 a 20 caracteres';
    }

    if (empty($req['marca'])) {
        $errors['marca'] = 'A marca é um campo obrigatorio.';
    }

    if (empty($req['modelo'])) {
        $errors['modelo'] = 'O modelo é um campo obrigatorio.';
    }

    if (empty($req['cor'])) {
        $errors['cor'] = 'A cor é um campo obrigatorio.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }
    return $req;
}
?>