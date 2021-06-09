<?php
class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }
    function action_default()
    {
        $data = $this->model->get_data();
        $this->view->generate('main_view.php', $data);
    }
}
