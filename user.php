<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crud/crud_article.php";
require_once "api/crud/crud_command.php";
require_once "api/crud/crud_user.php";


if (!isset($_GET['u'])) {
    header("Location: index.php");
    exit();
}

$user = getUserByName($_GET['u']);
if (!$user) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?= htmlspecialchars($user['username']) ?> - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="user-profile-container">
        <div class="user-profile-card">
            <div class="user-header">
                <div class="user-avatar">
                    <?= strtoupper(substr($user["username"], 0, 1)) ?>
                </div>
                <div class="user-info-header">
                    <h1><?= htmlspecialchars($user['username']) ?></h1>
                    <span class="user-role"><?= htmlspecialchars($user['role']) ?></span>
                </div>
            </div>

        </div>

        <?php
        $userArticles = getUserArticles($user['id']);
        if (!empty($userArticles)): ?>
            <div class="user-articles">
                <h2>Articles publiés par <?= htmlspecialchars($user['username']) ?></h2>
                <div class="articles-grid">
                    <?php foreach ($userArticles as $article): ?>
                        <div class="product-card" onclick="window.location.href='article.php?id=<?= $article['id'] ?>&slug=<?= $article['slug'] ?>'">
                            <img src="images/test_image.jpg" alt="<?= htmlspecialchars($article['name']) ?>" class="product-image">
                            <div class="product-info">
                                <h3 class="product-name"><?= htmlspecialchars($article['name']) ?></h3>
                                <p class="product-price"><?= htmlspecialchars($article['price']) ?> €</p>
                                <p class="product-date">Publié le <?= date('d/m/Y', strtotime($article['publication_date'])) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/user_actions.js"></script>
</body>
</html>
