function updateBalance(id, amount) {
    fetch('api/user_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'amount': parseFloat(amount),
            'action': 'update_balance',
            'id' : id
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        window.location.href = 'profile.php';
    })
    .catch(error => console.error('Error:', error));
}

function updateProfile(id, username) {
    fetch('api/user_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'username': username,
            'action': 'update_profile',
            'id' : id
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        window.location.href = 'profile.php';
    })
    .catch(error => console.error('Error:', error));
}

function logout() {
    fetch('api/user_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'action': 'logout'
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        window.location.href = 'index.php';
    })
    .catch(error => console.error('Error:', error));
}

function updatePassword(id, currentPassword, newPassword) {
    fetch('api/user_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include',
        body: new URLSearchParams({
            'action': 'update_password',
            'currentPassword': currentPassword,
            'newPassword': newPassword,
            'id' : id
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        window.location.href = 'profile.php';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la modification du mot de passe');
    });
}

