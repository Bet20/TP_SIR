<?php

function validatedUser($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['name']) || strlen($req['name']) < 3 || strlen($req['name']) > 255) {
        $errors['name'] = 'The Name field cannot be empty and must be between 3 and 255 characters';
    }

    if (!filter_var($req['telemovel'], FILTER_VALIDATE_INT) || strlen($req['telemovel']) != 9) {
        $errors['telemovel'] = 'The Mobile phone field cannot be empty and must have 9 numbers.';
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field cannot be empty and must have the email format, for example: nome@example.com.';
    }

    if (getByEmail($req['email'])) {
        if(!($_POST['user'] == 'update' && $_REQUEST['id'] == $_POST['id'])){
            $errors['email'] = 'Email already registered in our system.';
            return ['invalid' => $errors];
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