<?php
/**
 * Simple example of extending the SQLite3 class and changing the __construct
 * parameters, then using the open method to initialize the DB.
 */
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('database/db');
    }
}

$db = new MyDB();

// $db->exec('CREATE TABLE foo (bar STRING)');
// $db->exec("INSERT INTO foo (bar) VALUES ('This is a test')");


// ECHO "SERVER_HOST";
$HOST = "Host: " . SERVER_HOST;
$PORT = "Port: " . SERVER_PORT;

echo "<h2>Console: </h2><pre>";
$contents = "sh sh/add.sh";
echo shell_exec($contents);
echo "</pre>";

echo <<<HTML

<div>
    <p>$HOST</p>
    <p>$PORT</p>
</div>


<h2>Add Website</h2>

<div>
    <form action="">
        <label for="user">User</label>
        <input type="user" name="name" id="name">

        <label for="password">Password</label>
        <input type="text" name="name" id="password">

    </form>
    <button>+ Add website stp</button>
</div>

<h2>User list</h2>
<table>
    <tr>
        <th>User</th>
        <th>Domain</th>
    </tr>

HTML;

$result = $db->query('SELECT * FROM users');

while($row = $result->fetchArray()){
    echo <<<HTML
    <tr>
        <td>{$row['name']}</td>
        <td>http://{$row['domain']}</td>
        <!-- <td>{$row['date']}</td> -->
        <td><button>Remove</button></td>
        <td><button>Change Password</button></td>

        <!-- <td><button>E</button></td> -->
    </tr>
    HTML;
}

echo "</table>";

// var_dump($result->fetchArray());
?>
