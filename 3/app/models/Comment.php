<?php

class Comment
{
    private $db;
    public const ITEMS_LIMIT = 5;


    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    protected function tokensMatch ($token): bool
    {
        return hash_equals($token, $_SESSION['token']);
    }

    /**
     * @return array
     */
    public function readAll(): array
    {
        $result = $this->db->query("SELECT * FROM comments");
        $comments = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = $row;
        }

        return $comments;
    }

    /**
     * @param $limit
     * @param $offset
     * @return array
     */
    public function readPagination($limit, $offset): array
    {
        $result = $this->db->query("SELECT * FROM comments LIMIT $limit OFFSET $offset");
        $comments = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = $row;
        }

        return $comments;
    }

    /**
     * @return mixed
     */
    public function getCountRow(): mixed
    {
        $result = $this->db->query("SELECT COUNT(`user_id`) FROM comments");
        return $result->fetchColumn();

    }

    /**
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        if ($this->tokensMatch($_POST['_token'])) {
            $username = htmlspecialchars(trim($data['username']));
            $text = htmlspecialchars(trim($data['comment']));
            $date = date('Y-m-d H:i:s');

            $statement = $this->db->prepare("INSERT INTO comments (username, comment, date) VALUE (?,?,?)");

            $statement->bindParam(1, $username, PDO::PARAM_STR);
            $statement->bindParam(2, $text, PDO::PARAM_STR);
            $statement->bindParam(3, $date, PDO::PARAM_STR);

            return $statement->execute();
        } else {
            return 0;
        }
    }
}