<?php
class MyDB extends SQLite3
{
    public function __construct()
    {
        $this->open('database/db');
    }

}


class DbQuery
{
    private $conn;

    public function __construct()
    {
        $this->conn = new MyDB();
    }

    public function getUsers(): object
    {
        return $this->conn->query("SELECT * FROM USERS");
    }

    public function insertIntoUser($data): void
    {
        $sql = <<<SQL
        INSERT INTO "users"
            ("id","name","domain","date")
        VALUES (
            NULL,"{$data['name']}","{$data['domain']}","{$data['date']}"
        )
        SQL;

        $info = <<<HTML
        Dodano użytkownika {$data['name']} <br>
        Domena WWW https://{$data['domain']} <br>
        HTML;

        HtmlTemplate::ConsoleLog($info);

        $query = $this->conn->query($sql);
    }

    public static function displayUsers()
    {
        $query = new DbQuery;
        $result = $query->getUsers();
        while ($row = $result->fetchArray()) {
            echo HtmlTemplate::userList($row);
        }
    }
}