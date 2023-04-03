<header>
    <nav class="topMenu">
        <?php

        if (isset($_SESSION['user'])) {
            echo '<a href="index.php?action=logout">Logout</a>';
        }

        if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin')  {
            echo '<a href="index.php?action=profile">Profile</a>';
        } else {
            echo '<a href="index.php?action=login">Login</a>';
        }

        ?>
    </nav>

    <nav class="close">

    </nav>
</header>
