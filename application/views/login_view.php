<?php
$token = hash('gost-crypto', random_int(0, 999999));
$_SESSION["CSRF"] = $token;
?>

<form method="post" action="login/check">
    <input type="text" name="login" placeholder="Логин"><br />
    <input type="password" name="password"> <br />
    <input type="hidden" name="token" value="<?= $token ?>"> <br />
    <input type="submit" value="Войти">
</form>
<a href="signup">Зарегистрироваться</a>
<?php

// Формируем ссылку для авторизации
$params = array(
    'client_id' => $clientId,
    'redirect_uri' => $redirectUri,
    'response_type' => 'code',
    'v' => '5.126', // (обязательный параметр) версиb API https://vk.com/dev/versions

    // Права доступа приложения https://vk.com/dev/permissions
    // Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
    // Если не указать "offline", то полученный токен будет жить 12 часов.
    'scope' => 'photos,offline',
);

// Выводим на экран ссылку для открытия окна диалога авторизации
echo '<a href="http://oauth.vk.com/authorize?' . http_build_query($params) . '">Авторизация через ВКонтакте</a>';
