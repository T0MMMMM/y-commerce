<?php
session_start();
require_once 'api/crud.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = getUserById($_SESSION['user']);

if (isset($_POST['add_balance']) && is_numeric($_POST['amount'])) {
    // Ajoutez ici la logique pour mettre à jour le solde
    // Vous devrez créer une fonction updateUserBalance dans crud.php
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - y-commerce</title>
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

            <form class="balance-form" method="post">
                <input type="number" name="amount" placeholder="Montant à ajouter" class="balance-input" min="1" step="0.01">
                <div class="user-actions">
                    <button type="submit" name="add_balance" class="user-action-btn add-balance-btn">
                        Ajouter au solde
                    </button>
                    <button type="submit" name="logout" class="user-action-btn logout-btn">
                        Déconnexion
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
