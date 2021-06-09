<?php
class Controller_Signup extends Controller
{
    function __construct()
    {
        $this->model = new Model_Signup();
        $this->view = new View();
    }
    function action_default()
    {
        $this->view->generate('signup_view.php');
    }
    function action_check()
    {
        if (register($_POST)) {
            header("Location:/" . login);
        } else {
            print('Не удалось добавить пользователя');
        }
    }
}
