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
                <input type="user" name="user" id="name" required>

                <label for="password">Password</label>
                <input type="text" name="password" id="password" required>

                <label for="domain">Domain</label>
                <input type="text" name="domain" id="domain" value="{$DOMAIN}">

                <div class="add_form__checkbox">
                    <input type="checkbox" name="randomPassword" id="randomPassword">
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

        HTML;
    }


    public static function userList($row): void
    {
        $DOMAIN = "http://{$row['domain']}";
        echo <<<HTML
        <tr class="userList__item">
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td><a href="$DOMAIN" target="_blank" >$DOMAIN</a></td>
            <td>
                <button class="btn btn__delete">
                    <i class="fa-solid fa-trash"></i>
                    Delete
                </button>
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

    public static function Console($contents): void
    {
        echo "<pre>";
        echo shell_exec($contents);
        echo "</pre>";

    }

    public static function ConsoleLog($message)
    {
        echo "<h2>Console</h2>";
        echo "<pre>$message</pre>";
    }

}
