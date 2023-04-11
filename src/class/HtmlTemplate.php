<?php
class HtmlTemplate
{
    public static function addForm(): void
    {
        $DOMAIN = PRIMARY_DOMAIN;

        echo <<<HTML

        <h2>Add SFTP+WEBSITE</h2>

        <section class="form">
            <form action="?action=add" class="add_form" method="POST">

                <label for="user">User</label>
                <input type="user" name="user" id="name" pattern="[a-zA-Z0-9]+" pattern="[\p{L}\p{N}ąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+"  required>

                <label for="password">Password</label>
                <input type="text" name="password" id="password"  required>

                <label for="domain">Domain</label>
                <input type="text" name="domain" id="domain" value="{$DOMAIN}">

                <div class="add_form__checkbox">
                    <input type="checkbox" name="randomPassword" id="randomPassword" onclick="generatePassword()">
                    <label for="randomPassword">Random Password</label>
                    <br>
                    <input type="checkbox" name="defult_domain" id="defultDomain" checked>
                    <label for="defultDomain">Defult Domain</label>
                </div>
                    <button class="btn btn__add">
                        <i class="fa-solid fa-user-plus"></i>
                        Add
                    </button>
                </form>
        </section>

        <script>
            function generatePassword() {
                var passwordLength = 25;
                var characterSet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-={}[]|;:,.<>?";
                var password = "";

                for (var i = 0; i < passwordLength; i++) {
                    var randomIndex = Math.floor(Math.random() * characterSet.length);
                    password += characterSet[randomIndex];
                }

                document.getElementById("password").value = password;
            }
            </script>

        HTML;
    }


    public static function userList($row): void
    {
        $DOMAIN = "http://{$row['domain']}";




        echo <<<HTML
        <tr class="userList__item">
            <td>{$row['id']}</td>
            <td><a href="?action=user&id={$row['id']}">{$row['name']}</a></td>
            <td><a href="$DOMAIN" target="_blank" >{$row['domain']}</a></td>

            <td>
                <a href="?action=delete&id={$row['id']}">
                    <button class="btn btn__delete">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>
                </a>
            </td>
            <td>
                <button  class="btn btn__change_password">
                    <i class="fa-solid fa-lock"></i>
                    Change Password
                </button>
            </td>
        </tr>
        HTML;
    }

    public static function tableList($userListBack): void
    {

        echo <<<HTML
        <h2>User list</h2>
        <table>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Domain</th>
                </tr>
        HTML;

        $userListBack();

        echo <<<HTML
        </table>
        HTML;
    }

    public static function confirmDelete($id,$name,$domain): void
    {
        echo <<<HTML
            <h2>DELETE #$id</h2>
            <p>
                Are you sure? Can you delete user <b class="gold">$name</b> and domain <b class="gold">$domain</b>?

            </p>
            <p>ATTENTION! All data from www folder will be delete!</p>
            <a href='?action=delete&id=$id&confirm=true'>
                <button class='btn btn__change_password'>
                    <i class="fa-solid fa-check"></i>
                    Confirm
                </button>
            </a>

            <a href='?home'>
                <button class='btn btn__delete'>
                    <i class="fa-solid fa-xmark"></i>
                    Cancel
                </button>
            </a>



            HTML;
    }


    public static function Console($contents): void
    {
        echo "<pre>";
        echo "<h3>SERVER LOGS</h3>";
        echo shell_exec($contents);
        echo "</pre>";

    }

    public static function ConsoleLog($message)
    {
        echo "<h2>Console</h2>";
        echo "<pre>$message</pre>";
    }

    public static function ConsoleAccoutInfo($data)
    {
        $HOST = SERVER_HOST;
        $PORT = SERVER_PORT;

        return <<<HTML
        <h3 class="center-text">New user was added!</h3>
        <button onclick="copyToClipboard()" class="btn btn__copy">
            <span>
                <i class="fa-solid fa-copy"></i> Copy
            </span>
        </button>
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
    }

    public static function JSsetTitle($id,$title): void
    {
        echo <<<HTML
        <script>
            document.querySelector("#$id").style.color="gold";
            document.title=document.title + " - $title";
        </script>
        HTML;

    }


}
