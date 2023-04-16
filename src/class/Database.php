<?php

namespace freePanel\Model;
use freePanel\View\HtmlTemplate;
use \SQLite3;

class Db extends SQLite3
{
    public function __construct()
    {
        $this->open(DATABASE);
    }

}


class DbQuery
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getUsers(): object
    {
        $sql = <<<SQL
        SELECT * FROM "users" ORDER BY "id" DESC
        SQL;
        return $this->db->query($sql);
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

        $this->db->query($sql);
    }

    public function getUserById($id): array
    {
        $sql = <<<SQL
        SELECT * FROM "users" WHERE id=$id
        SQL;
        $result =  $this->db->query($sql);

        $data = array();
        while ($row = $result->fetchArray()) {
            $data['name'] = $row['name'];
            $data['domain'] = $row['domain'];
        }
        return $data;

    }

    public function deleteUser($id): void
    {
        $sql = <<<SQL
        DELETE FROM "users" WHERE ("rowid" = $id)
        SQL;
        $this->db->query($sql);

    }
}