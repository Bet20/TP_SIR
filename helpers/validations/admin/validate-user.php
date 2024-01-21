<?php

function validatedUser($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['name']) || strlen($req['name']) < 3 || strlen($req['name']) > 255) {
        $errors['name'] = 'The Name field cannot be empty and must be between 3 and 255 characters';
    }

    if (!empty($req['telemovel']) && strlen($req['telemovel']) != 9) {
        $errors['telemovel'] = 'O número de telemóvel tem de ter pelo menos 9 digitos.O número de telemovel tem de ter pelo menos 9 digitos.';
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field cannot be empty and must have the email format, for example: nome@example.com.';
    }
    
    $email = getByEmail($req['email']);
    if ($email) {
        if(($_POST['user'] != 'update' || $_REQUEST['id'] != $email['id'])){
            $errors['email'] = 'Email already registered in our system.';
        }
    }

    if (!empty($req['password']) && strlen($req['password']) < 6) {
        $errors['password'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if (!empty($req['confirm_password']) && ($req['confirm_password']) != $req['password']) {
        $errors['confirm_password'] = 'The Confirm Password field must not be empty and must be the same as the Password field.';
    }

    $req['admin'] = !empty($req['admin']) == 'on' ? true : false;

    if (isset($errors)) {
        return ['invalid' => $errors];
    }
    return $req;
}
?>