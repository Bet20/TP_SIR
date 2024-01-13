<?php

function validatedMessage($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['message'])) {
        $errors['message'] = 'É obrigatorio escrever alguma coisa na mensagem.';
    }

    if (strlen($req['message']) > 255) {
        $errors['descricao'] = 'A mensagem tem um maximo de 255 caracteres.';
    }

    return $req;
}
?>