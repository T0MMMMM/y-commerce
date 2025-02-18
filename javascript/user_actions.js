async function updateBalance(amount) {
    try {
        const response = await fetch('/y-commerce/api/user_actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update_balance',
                amount: parseFloat(amount)
            })
        });

        const data = await response.json();
        if (data.success) {
            document.querySelector('.stat-value').textContent = `${data.newBalance} €`;
            return true;
        }
        throw new Error(data.error);
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

async function updateProfile(username) {
    try {
        const response = await fetch('/y-commerce/api/user_actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update_profile',
                username: username
            })
        });

        const data = await response.json();
        if (data.success) {
            document.querySelector('.user-info-header h1').textContent = data.newUsername;
            return true;
        }
        throw new Error(data.error);
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

async function logout() {
    try {
        const response = await fetch('/y-commerce/api/user_actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'logout'
            })
        });

        const data = await response.json();
        if (data.success) {
            window.location.href = '/y-commerce/index.php';
            return true;
        }
        throw new Error(data.error);
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}
