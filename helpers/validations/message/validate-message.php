<?php

function validatedMessage($req)
{

    foreach ($req as $key => $value) {
        echo $key . $value;
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['messagem']) && !empty($req['imagem'])) {
        $errors['messagem'] = 'É obrigatorio escrever alguma coisa na mensagem.';
    }

    if (strlen($req['message']) > 255) {
        $errors['descricao'] = 'A mensagem tem um maximo de 255 caracteres.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}