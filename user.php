<?php
session_start();
require_once 'includes/auth_check.php';
require_once 'api/crud.php';

// Vérifier si un ID est fourni dans l'URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$user = getUserById($_GET['id']);
if (!$user) {
    header("Location: index.php");
    exit();
}

// Vérifier si c'est le profil de l'utilisateur connecté
$isOwnProfile = isset($_SESSION['user']) && $_SESSION['user'] == $_GET['id'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?= htmlspecialchars($user['Username']) ?> - y-commerce</title>
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

            <?php if ($isOwnProfile): ?>
                <form class="profile-form" onsubmit="event.preventDefault(); updateProfile(this.username.value)">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['Username']) ?>" class="form-input">
                    </div>
                    <button type="submit" class="user-action-btn update-profile-btn">
                        Mettre à jour le profil
                    </button>
                </form>

                <div class="password-section">
                    <h2>Changer le mot de passe</h2>
                    <form class="password-form" onsubmit="event.preventDefault(); updatePassword(this)">
                        <div class="form-group">
                            <label for="currentPassword">Mot de passe actuel</label>
                            <input type="password" id="currentPassword" name="currentPassword" required class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Nouveau mot de passe</label>
                            <input type="password" id="newPassword" name="newPassword" required class="form-input">
                        </div>
                        <button type="submit" class="user-action-btn update-password-btn">
                            Modifier le mot de passe
                        </button>
                    </form>
                </div>

                <div class="balance-section">
                    <input type="number" id="amount" name="amount" placeholder="Montant à ajouter" class="balance-input" min="1" step="0.01">
                    <div class="user-actions">
                        <button type="submit" class="user-action-btn add-balance-btn" onclick=" updateBalance(document.getElementById('amount').value)">
                            Ajouter au solde
                        </button>
                        <button type="button" onclick="logout()" class="user-action-btn logout-btn">
                            Déconnexion
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php
        $userArticles = getUserArticles($user['Id']);
        if (!empty($userArticles)): ?>
            <div class="user-articles">
                <h2>Articles publiés par <?= htmlspecialchars($user['Username']) ?></h2>
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
