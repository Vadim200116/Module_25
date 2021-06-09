<?php
function register(array $data)
{
    if (isUserAlreadyExists($data['login'])) {
        return false;
    }
    $values = [
        $data['login'],
        password_hash($data['password'], PASSWORD_ARGON2ID)
    ];
    return insert($values);
}

function login(string $login)
{
}



function isUserAlreadyExists(string $login)
{
    if (getUserByLogin($login)) {
        return true;
    }
    return false;
}
