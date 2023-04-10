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
         <br>
            <div>
                New user was added!
        </div>
        <br>
        <button onclick="copyToClipboard()" style="float: right;">Copy</button>
        <div id="info">
            == SFTP ACCOUNT ===
            Host: {$HOST}
            User: {$data['name']}
            Password: {$data['password']}
            Port: {$PORT}
            WWW: <a href="https://{$data['domain']}" target="_blank">https://{$data['domain']}</a> <br>
        </div>
        <script>
        function copyToClipboard() {
        var textToCopy = document.getElementById("info").innerText;

        // Tworzenie tymczasowego elementu textarea
        var tempTextarea = document.createElement("textarea");
        tempTextarea.value = textToCopy;

        // Dodanie elementu do DOM
        document.body.appendChild(tempTextarea);

        // Zaznaczenie tekstu w elemencie
        tempTextarea.select();

        // Kopiowanie tekstu do schowka
        document.execCommand("copy");

        // Usunięcie tymczasowego elementu z DOM
        document.body.removeChild(tempTextarea);
        }
        </script>

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