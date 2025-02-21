<?php
session_start();
require_once 'includes/auth_check.php';
require_once "api/crud/crud_article.php";
require_once "api/crud/crud_command.php";
require_once "api/crud/crud_user.php";

require_once "api/utils/admin_utils.php";

if (!isset($_POST['id'])) {
    header('Location: profile.php');
    exit();
}

$targetUser = getUserById($_POST['id']);

// Vérifier que l'utilisateur peut éditer ce profil
if (!$targetUser || ($targetUser['id'] !== $_SESSION['user'] && !isAdmin($_SESSION["user"]))) {
    header('Location: profile.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="user-profile-container">
        <div class="user-profile-card">
            <div class="user-header">
                <div class="user-avatar">
                    <?= strtoupper(substr($targetUser["username"], 0, 1)) ?>
                </div>
                <div class="user-info-header">
                    <h1>Modifier le profil</h1>
                </div>
            </div>

            <form class="profile-form" onsubmit="event.preventDefault(); updateProfile(<?=$_POST['id']?>, this.username.value)">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($targetUser['username']) ?>" class="form-input">
                </div>
                <button type="submit" class="user-action-btn update-profile-btn">
                    Mettre à jour le profil
                </button>
            </form>

            <div class="password-section">
                <h2>Changer le mot de passe</h2>
                <form class="password-form" onsubmit="event.preventDefault(); updatePassword(<?=$_POST['id']?>, this.currentPassword.value, this.newPassword.value)">
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
                <button type="submit" class="user-action-btn add-balance-btn" onclick="updateBalance(<?=$_POST['id']?>, document.getElementById('amount').value)">
                    Ajouter au solde
                </button>
            </div>

            <button onclick="deleteUser(<?=$_POST['id']?>)" class="user-action-btn danger-btn">
                Supprimer le compte
            </button>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    <script src="javascript/user_actions.js"></script>
    <script src="javascript/admin_actions.js"></script>
</body>
</html>
