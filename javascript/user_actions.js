function updateBalance(id, amount) {
    if (amount <= 0) {
        alert("Erreur : " + "Veuillez rentrer un montant positif");
        return;
    }
    fetch('api/actions/user_actions.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            id: id,
            balance_amount: amount,
            action: 'update_balance'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (!data.success) {
            alert("Erreur : " + data.error);
        } else {
            window.location.href = 'profile.php';
        };
    })
    .catch(error => console.error('Error:', error));
}

function updateProfile(id, username) {
    fetch('api/actions/user_actions.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            id: id,
            username: username,
            action: 'update_profile'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert("Erreur : " + data.error);
        } else {
            window.location.href = 'profile.php';
        }
    })
    .catch(error => console.error('Error:', error));
}

function logout() {
    fetch('api/actions/user_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            action: 'logout'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        window.location.href = 'index.php';
    })
    .catch(error => console.error('Error:', error));
}

function updatePassword(id, current_password, new_password) {
    fetch('api/actions/user_actions.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify({
            id: id,
            currentPassword: current_password,
            newPassword: new_password,
            action: 'update_password'
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (!data.success) {
            alert("Erreur : " + data.error);
        } else {
            window.location.href = 'profile.php';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la modification du mot de passe');
    });
}

