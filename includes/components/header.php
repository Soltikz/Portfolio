<header class="navbar">
    <a class="logo" href="index.php">
        <svg width="67" height="53" viewBox="0 0 102 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80V0H14.8444V66.9333H39.8222V80H0Z" fill="#FEFEFE" />
            <path
                d="M26.3099 62L26.3099 0L64.0877 46.7097L101.243 0V80H87.1099V54.3656C87.1099 51.8996 87.1395 49.147 87.1988 46.1075C87.2581 43.0107 87.5247 39.5125 87.9988 35.6129C86.1618 38.595 84.384 41.2043 82.6655 43.4409C80.9469 45.6774 79.3766 47.7419 77.9544 49.6344L63.821 68.3011L49.1544 49.6344C47.7321 47.8566 46.1025 45.7634 44.2655 43.3548C42.4877 40.8889 40.7099 38.2222 38.9321 35.3548C39.4062 39.4265 39.6729 42.9821 39.7321 46.0215C39.7914 49.0609 39.821 51.8423 39.821 54.3656V56L39.821 62H26.3099Z"
                fill="#FEFEFE" />
        </svg>
    </a>
    <div class="header-link">
        <a class="logo" href="index.php">
            <svg width="39" height="31" viewBox="0 0 102 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 80V0H14.8444V66.9333H39.8222V80H0Z" fill="#FEFEFE" />
                <path
                    d="M26.3099 62L26.3099 0L64.0877 46.7097L101.243 0V80H87.1099V54.3656C87.1099 51.8996 87.1395 49.147 87.1988 46.1075C87.2581 43.0107 87.5247 39.5125 87.9988 35.6129C86.1618 38.595 84.384 41.2043 82.6655 43.4409C80.9469 45.6774 79.3766 47.7419 77.9544 49.6344L63.821 68.3011L49.1544 49.6344C47.7321 47.8566 46.1025 45.7634 44.2655 43.3548C42.4877 40.8889 40.7099 38.2222 38.9321 35.3548C39.4062 39.4265 39.6729 42.9821 39.7321 46.0215C39.7914 49.0609 39.821 51.8423 39.821 54.3656V56L39.821 62H26.3099Z"
                    fill="#FEFEFE" />
            </svg>
        </a>
        <div class="header-menu">
            <span></span>
            <span></span>
            <span><?=$translations['menu']??'menu'?></span>
        </div>
        <div class="link hidden" id="menu-link">
            <?php if (isset($_SESSION['statue']) && $_SESSION['statue'] === 'admin'): ?>
            <a href="dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a href="index.php"><?=$translations['home']??'accueil'?></a>
            <a href="about.php"><?=$translations['about']??'a propos'?></a>

        </div>
    </div>
</header>