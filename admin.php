<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crudArticles.php";
require_once "api/crudUser.php";
require_once "api/admin.php";

// Vérifier si l'utilisateur est admin
if (!isAdmin()) {
    header('Location: index.php');
    exit();
}

$articles = getAllArticles();
$users = getAllUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="admin-container">
        <h1>Administration</h1>
        
        <section class="admin-section">
            <h2>Articles</h2>
            <div class="admin-list">
                <?php foreach ($articles as $article): ?>
                <div class="admin-item">
                    <div class="admin-item-image">
                        <img src="<?= htmlspecialchars($article['Image_link'] ?: 'images/test_image.jpg') ?>" 
                             alt="<?= htmlspecialchars($article['Name']) ?>">
                    </div>
                    <div class="admin-item-info">
                        <h3><?= htmlspecialchars($article['Name']) ?></h3>
                        <p>Prix: <?= htmlspecialchars($article['Price']) ?> €</p>
                    </div>
                    <div class="admin-item-actions">
                        <a href="edit_article.php?id=<?= $article['Id'] ?>" class="admin-btn edit-btn">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <button class="admin-btn delete-btn" onclick="deleteArticle(<?= $article['Id'] ?>)">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        
        <section class="admin-section">
            <h2>Utilisateurs</h2>
            <div class="admin-list">
                <?php foreach ($users as $user): ?>
                <div class="admin-item">
                    <div class="admin-item-image user-avatar">
                        <?= strtoupper(substr($user['Username'], 0, 1)) ?>
                    </div>
                    <div class="admin-item-info">
                        <h3><?= htmlspecialchars($user['Username']) ?></h3>
                        <p>Rôle: <?= htmlspecialchars($user['Role']) ?></p>
                    </div>
                    <div class="admin-item-actions">
                        <form action="edit_profile.php" method="post" class="admin-btn edit-btn" onclick="this.submit()">
                              <input type="hidden" name="id" value="<?= $user['Id'] ?>">
                              <i class="fas fa-edit"></i> Modifier
                        </form>
                        <button class="admin-btn delete-btn" onclick="deleteUser(<?= $user['Id'] ?>)">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/admin_actions.js"></script>
</body>
</html>
