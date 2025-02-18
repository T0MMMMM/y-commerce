function updateBalance(amount) {
    fetch('api/user_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'amount': parseFloat(amount),
            'action': 'update_balance'
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}

function updateProfile(username) {
    fetch('api/user_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        credentials: 'include', // Include cookies in the request
        body: new URLSearchParams({
            'username': username,
            'action': 'update_profile'
        })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        location.reload();
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

function updatePassword(form) {
    const formData = new FormData();
    formData.append('action', 'update_password');
    formData.append('currentPassword', form.currentPassword.value);
    formData.append('newPassword', form.newPassword.value);

    fetch('api/user_actions.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Mot de passe modifié avec succès');
            form.reset();
        } else {
            alert(data.error || 'Erreur lors de la modification du mot de passe');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la modification du mot de passe');
    });
}

