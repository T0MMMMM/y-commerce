function addToCart(product_id) {
fetch('api/actions/cart_actions.php', {
          method: 'POST',
          headers: {
          'Content-Type': 'application/json',
          },
          credentials: 'include',
          body: JSON.stringify({
          product_id: product_id,
          action: 'add_to_cart'
          })
})
.then(response => response.json())
.then(data => {
          console.log(data);
          location.reload();
})
.catch(error => console.error('Error:', error));
}

function updateCart(product_id, quantity_change) {
fetch('api/actions/cart_actions.php', {
          method: 'POST',
          headers: {
          'Content-Type': 'application/json',
          },
          credentials: 'include',
          body: JSON.stringify({
          product_id: product_id,
          quantity_change: quantity_change,
          action: 'update_cart'
          })
})
.then(response => response.json())
.then(data => {
          console.log(data);
          location.reload();
})
.catch(error => console.error('Error:', error));
}

function removeFromCart(product_id) {
fetch('api/actions/cart_actions.php', {
          method: 'POST',
          headers: {
          'Content-Type': 'application/json',
          },
          credentials: 'include',
          body: JSON.stringify({
          product_id: product_id,
          action: 'remove_from_cart'
          })
})
.then(response => response.json())
.then(data => {
          console.log(data);
          location.reload();
})
.catch(error => console.error('Error:', error));
}