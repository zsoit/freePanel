<header>
    <a href="index.php">
        <h1><i class="fa-brands fa-php"></i> <?PHP echo TITLE_APP; ?></h1>
    </a>
    <p>
        <?PHP echo SERVER_HOST; ?>
        <?PHP echo SERVER_PORT; ?>
        <?PHP echo PRIMARY_DOMAIN; ?>
    </p>
</header>
<nav>
    <ul class="menu">
        <a href="index.php?action=home">
            <li class="menu__item">
                <i class="fa-solid fa-house-chimney"></i>
                Home
            </li>
        </a>
        <a href="index.php?action=add_form">
            <li class="menu__item">
                <i class="fa-solid fa-user-plus"></i>
                Add
            </li>
        </a>
    </ul>
</nav>