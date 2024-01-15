<?php
session_start();

function validatedUserProfile($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['name']) || strlen($req['name']) < 3 || strlen($req['name']) > 255) {
        $errors['name'] = 'The Name field cannot be empty and must be between 3 and 255 characters';
    }

    if (!filter_var($req['telemovel'], FILTER_VALIDATE_INT) || strlen($req['telemovel']) != 9) {
        $errors['telemovel'] = 'O número de telemovel é um campo obrigatorio.';
    }

    if (!filter_var($req['telemovel'], FILTER_VALIDATE_INT) || strlen($req['telemovel']) != 9) {
        $errors['telemovel'] = 'O número de telemovel é um campo obrigatorio.';
    }

    if(strlen($req['telemovel']) < 9){
        $errors['telemovel'] = 'O número de telemovel tem de ter pelo menos 9 digitos.';
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field cannot be empty and must have the email format, for example: nome@example.com.';
    }
    
    $email = getByEmail($req['email']);
    if ($email) {
        if(($_POST['user'] != 'profile' || $_REQUEST['id'] != $email['id'])){
            $errors['email'] = 'Email already registered in our system.';
        }
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }
    return $req;
}
?>