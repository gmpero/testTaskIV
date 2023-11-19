<?php

class Router
{
    public function run()
    {
        $controller = new CommentsController();

        $page = isset($_GET['page']) ?? 'home';
        switch ($page) {
            case '':
            case 'home':
                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $controller->index($_GET['page']);
                } else {
                    if (array_key_exists('username', $_POST) and mb_strlen($_POST['username']) and mb_strlen($_POST['comment'])) {
                        $controller->record();
                    }

                    $controller->index();
                }

                break;
            default:
                http_response_code(404);
                echo "Page not found";
                break;
        }
    }
}