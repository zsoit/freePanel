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
        $sql = <<<SQL
        SELECT * FROM "users" ORDER BY "id" DESC
        SQL;
        return $this->conn->query($sql);
    }

    public function insertIntoUser($data): void
    {
        $HOST = SERVER_HOST;
        $PORT = SERVER_PORT;
        $sql = <<<SQL
        INSERT INTO "users"
            ("id","name","domain","date")
        VALUES (
            NULL,"{$data['name']}","{$data['domain']}","{$data['date']}"
        )
        SQL;

        $info = <<<HTML
        New user was added!
        <br>
        Host: {$HOST}
        User: {$data['name']}
        Password: {$data['password']}
        Port: {$PORT}
        <br>
        WWW: https://{$data['domain']} <br>
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