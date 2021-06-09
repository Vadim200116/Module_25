<?php
class Controller_Login extends Controller
{
    function __construct()
    {

        $this->model = new Model_Login();
        $this->view = new View();
    }
    function action_default()
    {
        $this->view->generate('login_view.php');
    }
    function action_check()
    {
        if ($_POST["token"] == $_SESSION["CSRF"]) {
            // $link = mysqli_connect('localhost', 'root', '', 'module_25');

            // $result = mysqli_query($link, "SELECT * FROM users WHERE LOGIN='" . $_POST["login"] . "'  AND PASSWORD='" .  . "'");
            if (auth($_POST["login"], $_POST["password"])) {
                $_SESSION["isauth"] = true;
                header("Location:/" . home);
            }
            header("Location:/" . login);
            $_SESSION['userrole']="simple";
        }
    }
    function vk()
    {
        $params = array(
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'code'          => $_GET['code'],
            'redirect_uri'  => $redirectUri
        );

        if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
            $error = error_get_last();
            throw new Exception('HTTP request failed. Error: ' . $error['message']);
        }

        $response = json_decode($content);

        // Если при получении токена произошла ошибка
        if (isset($response->error)) {
            throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
        }
        //А вот здесь выполняем код, если все прошло хорошо
        $token = $response->access_token; // Токен
        $expiresIn = $response->expires_in; // Время жизни токена
        $userId = $response->user_id; // ID авторизовавшегося пользователя
        // Сохраняем токен в сессии
        $_SESSION['token'] = $token;
        $_SESSION['userrole'] = "vk";
    }
}
