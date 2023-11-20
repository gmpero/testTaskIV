<?php

require_once 'app/models/Comment.php';

class CommentsController
{
    protected $_token;


    public function __construct()
    {
        $this->_token = !empty($_SESSION['token']) ? $_SESSION['token'] : $this->createToken();
    }


    public function createToken($length = 32): string
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($chars) - 1;
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= $chars[rand(0, $max)];
        }

        $token = md5($token . session_name());

        $_SESSION['token'] = $token;

        return $token;
    }


    /**
     * @param int $page
     * @return int
     */
    public function index(int $page = 1): int
    {
        /*if ($page < 0) {
            return 0;
        }*/

        $commentModel = new Comment();
//        $commentModel::ITEMS_LIMIT;
        $limit = 5;
        $offset = $limit * ($page - 1);
        $totalRow = $commentModel->getCountRow();
        $countPage = ceil($totalRow / $limit);

        if ($countPage == 0) {
            include 'app/views/index.php';
            return $countPage;
        }

        if ($page < 0 || $page > $countPage) {
            http_response_code(404);
            echo "Page not found";
            return $countPage;
        } else {
            $comments = $commentModel->readPagination($limit, $offset);
        }

        include 'app/views/index.php';
        return $countPage;
    }

    /**
     * @return void
     */
    public function record(): void
    {
        $commentModel = new Comment();
        $commentModel->create($_POST);
        unset($_POST);
        header("Location: index.php" );
    }
}