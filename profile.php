<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crudArticles.php";
require_once "api/crudCommands.php";
require_once "api/crudUser.php";
require_once "api/command.php";

$user = getUserById($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="user-profile-container">
        <div class="user-profile-card">
            <div class="user-header">
                <div class="user-avatar">
                    <?= strtoupper(substr($user["Username"], 0, 1)) ?>
                </div>
                <div class="user-info-header">
                    <h1><?= htmlspecialchars($user['Username']) ?></h1>
                    <span class="user-role"><?= htmlspecialchars($user['Role']) ?></span>
                </div>
            </div>

            <div class="user-stats">
                <div class="stat-card">
                    <div class="stat-value"><?= htmlspecialchars($user['Balance']) ?> €</div>
                    <div class="stat-label">Solde disponible</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">
                        <?php 
                            $wishlist = json_decode($user['Wishlist'], true);
                            echo count($wishlist['wishlist'] ?? []);
                        ?>
                    </div>
                    <div class="stat-label">Articles en favoris</div>
                </div>
            </div>

            <form action="edit_profile.php" method="post" class="profile-actions">
                <input type="hidden" name="id" value="<?= $user['Id'] ?>">
                <button type="submit" class="user-action-btn update-profile-btn">
                    Modifier le profil
                </button>
            </form>

            <div class="balance-section">
                <button type="button" onclick="logout()" class="user-action-btn logout-btn">
                    Déconnexion
                </button>
            </div>
        </div>

        <?php
        $userArticles = getUserArticles($user['Id']);
        if (!empty($userArticles)): ?>
            <div class="user-articles">
                <h2>Mes articles en vente</h2>
                <div class="articles-grid">
                    <?php foreach ($userArticles as $article): ?>
                        <div class="product-card" onclick="window.location.href='article.php?id=<?= $article['Id'] ?>&slug=<?= $article['Slug'] ?>'">
                            <img src="images/test_image.jpg" alt="<?= htmlspecialchars($article['Name']) ?>" class="product-image">
                            <div class="product-info">
                                <h3 class="product-name"><?= htmlspecialchars($article['Name']) ?></h3>
                                <p class="product-price"><?= htmlspecialchars($article['Price']) ?> €</p>
                                <p class="product-date">Publié le <?= date('d/m/Y', strtotime($article['Publication_date'])) ?></p>
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
