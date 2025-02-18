<?php require_once 'api/crud.php'; ?>
<nav class="navbar" id="navbar">
    <a class="brand" href="/y-commerce">y-commerce.</a>
    <form action="/y-commerce" method="get" class="search-bar">
        <input type="text" class="search-input" placeholder="Rechercher un produit..." name="search-bar">
        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="document.querySelector('.search-bar').submit();">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </form>
    <div class="nav-icons">
        <?php if (isset($_SESSION['user'])): ?>
            <a href="user.php" class="user-info">
                <div class="user-avatar" >
                    <?php 
                        $user_session = getUserById($_SESSION["user"]);
                        echo strtoupper(substr($user_session["Username"], 0, 1));
                    ?>
                </div>
                <span class="user-name"><?= htmlspecialchars($user_session["Username"]) ?></span>
            </a>
        <?php else: ?>
            <a href="login.php" class="nav-icon">
                <i class="fas fa-user"></i>
            </a>
        <?php endif; ?>
        <a href="cart.php" class="nav-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-badge"><?= count($_SESSION["cart"] ?? []) ?></span>
        </a>
    </div>
</nav>