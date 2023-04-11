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
        $sql = <<<SQL
        INSERT INTO "users"
            ("id","name","domain","date")
        VALUES (
            NULL,"{$data['name']}","{$data['domain']}","{$data['date']}"
        )
        SQL;

        $info = HtmlTemplate::ConsoleAccoutInfo($data);
        HtmlTemplate::ConsoleLog($info);

        $this->conn->query($sql);
    }

    public function getUserById($id): object
    {
        $sql = <<<SQL
        SELECT * FROM "users" WHERE id=$id
        SQL;
        return $this->conn->query($sql);

    }

    public function deleteUser($id): void
    {
        $sql = <<<SQL
        DELETE FROM "users" WHERE ("rowid" = $id)
        SQL;
        $this->conn->query($sql);

    }

    public static function displayUsers(): void
    {
        $query = new DbQuery;
        $result = $query->getUsers();
        while ($row = $result->fetchArray()) {
            echo HtmlTemplate::userList($row);
        }
    }
}