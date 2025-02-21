<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion / Inscription - y-commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation bar -->
    <?php include 'includes/navbar.php'; ?>
    
    <!-- Main content -->
    <div class="auth-container">
        <div class="auth-card" id="login-card">
            <h2 class="auth-title">Connexion</h2>

            <form class="auth-form" onsubmit="handleAuth(event, 'login')">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="auth-button">Se connecter</button>
                <p class="auth-link">Vous n'avez pas de compte? <a href="#" onclick="toggleCards()">S'inscrire</a></p>
                <p class="forgot-password"><a href="#">Mot de passe oublié?</a></p>
            </form>

        </div>
        
        <div class="auth-card" id="register-card" style="display: none;">
            <h2 class="auth-title">Inscription</h2>

            <form class="auth-form" onsubmit="handleAuth(event, 'register')">

                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="email" id="mail" name="mail" required>
                </div>
                <div class="form-group">
                    <label for="reg-email">Username</label>
                    <input type="text" id="reg-email" name="username" required>
                </div>
                <div class="form-group">
                    <label for="reg-password">Mot de passe</label>
                    <input type="password" id="reg-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmer le mot de passe</label>
                    <input type="password" id="confirm-password" name="confirm_password" required>
                </div>
                <div class="form-group terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">J'accepte les <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley">conditions d'utilisation</a> et la <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley">politique de confidentialité</a></label>
                </div>
                <button type="submit" class="auth-button">S'inscrire</button>
                <p class="auth-link">Vous avez déjà un compte? <a href="#" onclick="toggleCards()">Se connecter</a></p>
            </form>

        </div>
    </div>
    
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    
    <script>
        function toggleCards() {
            const loginCard = document.getElementById('login-card');
            const registerCard = document.getElementById('register-card');
            
            if (loginCard.style.display === 'none') {
                loginCard.style.display = 'block';
                registerCard.style.display = 'none';
            } else {
                loginCard.style.display = 'none';
                registerCard.style.display = 'block';
            }
        }
    </script>
    <script src="javascript/actions.js"></script>
</body>
</html>