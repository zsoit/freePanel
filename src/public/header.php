<header>
    <a href="?home">
        <h1><i class="fa-brands fa-php"></i> <?PHP echo TITLE_APP; ?></h1>
    </a>
    <a href="?action=about">
        <p>ver. <?php echo VERSION_APP ?></p>
    </a>
    <a href="https://demo.filestash.app/login" target="_blank">
        <p>SFTP Login</p>
    </a>
</header>
<nav>
    <ul class="menu">
        <a href="?action=home">
            <li class="menu__item" id="page__home">
                <i class="fa-solid fa-house-chimney"></i>
                <span class="label_for_icon">Home</span>
            </li>
        </a>

        <a href="?action=users">
            <li class="menu__item" id="page__users">
                <i class="fa-solid fa-users"></i>
                <span class="label_for_icon">Users</span>
            </li>
        </a>

        <a href="?action=add_form">
            <li class="menu__item" id="page__add">
                <i class="fa-solid fa-user-plus"></i>
                <span class="label_for_icon">Add  +</span>
            </li>
        </a>

        <a href="?action=backup">
            <li class="menu__item" id="page__backup">
                <i class="fa-solid fa-database"></i>
                <span class="label_for_icon">Backup</span>
            </li>
        </a>


        <a href="?action=proxy">
            <li class="menu__item" id="page__proxy">
                <i class="fa-solid fa-server"></i>
                <span class="label_for_icon">Proxy</span>
            </li>
        </a>


    </ul>
</nav>