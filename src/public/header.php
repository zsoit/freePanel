<header>
    <a href="?home">
        <h1><i class="fa-brands fa-php"></i> <?PHP echo TITLE_APP; ?></h1>
    </a>
    <p>
        sftp://<span class="header__bold"><?PHP echo SERVER_HOST; ?>:<span  class="header__bold__red"><?PHP echo SERVER_PORT; ?></span></span>
        | domain: <span class="header__bold"><?PHP echo PRIMARY_DOMAIN; ?></span>
    </p>
</header>
<nav>
    <ul class="menu">
        <a href="?action=home">
            <li class="menu__item">
                <i class="fa-solid fa-house-chimney"></i>
                Home
            </li>
        </a>
        <a href="?action=add_form">
            <li class="menu__item">
                <i class="fa-solid fa-user-plus"></i>
                Add
            </li>
        </a>

        <a href="?action=backup_form">
            <li class="menu__item">
                <i class="fa-solid fa-database"></i>
                Backup
            </li>
        </a>

    </ul>
</nav>