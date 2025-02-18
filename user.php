<?php
session_start();
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

                <div>
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
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/user_actions.js"></script>
</body>
</html>
