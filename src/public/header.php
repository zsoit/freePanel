<header>
    <a href="?home">
        <h1><i class="fa-brands fa-php"></i> <?PHP echo TITLE_APP; ?></h1>
    </a>
    <p>
       sftp: <?PHP echo SERVER_HOST; ?>:<?PHP echo SERVER_PORT; ?>
        | domain:<?PHP echo PRIMARY_DOMAIN; ?>
    </p>
</header>
<nav>
    <ul class="menu">
        <a href="?action=home">
            <li class="menu__item" id="page__home">
                <i class="fa-solid fa-house-chimney"></i>
                Home
            </li>
        </a>
        <a href="?action=add_form">
            <li class="menu__item" id="page__add">
                <i class="fa-solid fa-user-plus"></i>
                Add
            </li>
        </a>

        <a href="?action=backup_form" id="page__backup">
            <li class="menu__item">
                <i class="fa-solid fa-database"></i>
                Backup
            </li>
        </a>

    </ul>
</nav>