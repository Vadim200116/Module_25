<?php

/**

 * @return PDO

 */

function get_connection()
{
    return new PDO('mysql:host=localhost;dbname=module_25', 'root', '');
}

function insert(array $data)
{
    $query = 'INSERT INTO users (login, password) VALUES( ?, ?)';
    $db = get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}

function getUserByLogin(string $login)
{
    $query = 'SELECT * FROM users WHERE login = ?';
    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$login]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}

function auth(string $login, string $password)
{
    $query = 'SELECT password FROM users WHERE login = ?';
    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$login]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        return false;
    }
    return password_verify($password, $result['password']);
}
