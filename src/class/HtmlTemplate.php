<?php
namespace freePanel\View;

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
                <input type="text" name="password" id="password" pattern="()" required>

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
                var characterSet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*_+-={}[]|;:,.<>?";
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

    public static function PrimaryHeader($data)
    {
        echo <<<HTML
        <h2>$data</h2>
        HTML;
    }

    public static function userList($row)
    {
        $DOMAIN = "http://{$row['domain']}";




        return <<<HTML
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

    public static function tableList($result): void
    {

        echo <<<HTML
        <h2>Users list</h2>
        <section>
        <table>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Domain</th>
                </tr>
        HTML;


        while ($row = $result->fetchArray()) {
            echo HtmlTemplate::userList($row);
        }

        echo <<<HTML
        </table>
        </section>
        HTML;
    }

    public static function confirmDelete($id,$name,$domain): void
    {
        echo <<<HTML
            <h2>DELETE #$id</h2>
            <section>
                <div class="confirm_message">
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
                </div>
            </section>

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
            var tempTextarea = document.createElement("textarea");

            tempTextarea.value = textToCopy;
            document.body.appendChild(tempTextarea);
            tempTextarea.select();

            document.execCommand("copy");

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

    public static function UserPage($row): void
    {
        echo <<<HTML
        <h2>User #{$row['id']}</h2>
        <section>
            <div class="info__user">
                <p>user_name: {$row['name']}</p>
                <p>domain:<a href="https://{$row['domain']}" target="_blank"> {$row['domain']} </p></a>
                <p>Size WWW: {$row['disk']}</p>
            </div>
        </section>
        HTML;

    }

    public static function ServerInfo($row): void
    {
        $HOST = SERVER_HOST;
        $PORT = SERVER_PORT;
        $DOMAIN = PRIMARY_DOMAIN;
        echo <<<HTML

        <section>
            Users | Add | Backup | Proxy
        </section>
        <section class="home">
            <div class="home__item">
                <fieldset>
                    <legend>Linux Server</legend>
                    <h4>OS: Ubuntu 20.04</h4>
                    <h4>SSD: {$row['disk']}</h4>
                    <h4>RAM: {$row['ram']}</h4>
                    <h4>IPv6: xxxxxxxx:xxxx </h4>
                </fieldset>
            </div>

            <div  class="home__item">
                <fieldset>
                    <legend>WWW + SFTP</legend>
                    <h4>DOMAIN: $DOMAIN</h4>
                    <h4>HOST: $HOST</h4>
                    <h4>PORT: $PORT</h4>
                    <h4> dd</h4>
                </fieldset>
            </div>

        </section>
        HTML;
    }

    public static function BackupList(): void
    {
        echo <<<HTML
        <section>
            </section>
            <table>
                <tr>
                    <th>User</th>
                    <th>Last backup</th>

                </tr>
                <tr>
                    <td>test</td>
                    <td>2002-02-20</td>
                </tr>
            </table>
        </section>
        HTML;
    }

    public static function About(): void
    {
        $ver = VERSION_APP;
        echo <<<HTML
        <section>
            <div class="info">
                <h3>freePanel - ver. $ver</h3>
                <p><b>freePanel</b> is a simple web interface for managment SFTP users, sudomain website on the linux machine.</p>
                <p>Used technology: PHP 7.4+, PHP SQLite3, Apache2 and Bash .sh scripts</p>
                <p>Required: Debian/Ubuntu Server</p>
                <h3>License</h3>
                <p class="license_mit">
                MIT License

                Copyright (c) 2023 JA

                Permission is hereby granted, free of charge, to any person obtaining a copy
                of this software and associated documentation files (the "Software"), to deal
                in the Software without restriction, including without limitation the rights
                to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                copies of the Software, and to permit persons to whom the Software is
                furnished to do so, subject to the following conditions:

                The above copyright notice and this permission notice shall be included in all
                copies or substantial portions of the Software.

                THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
                SOFTWARE.
                </p>
            </div>
        </section>
        HTML;
    }


}
