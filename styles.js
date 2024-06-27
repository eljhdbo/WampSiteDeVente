document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.add-to-cart');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            addToCart(productId);
        });
    });

    function addToCart(productId) {
        const formData = new FormData();
        formData.append('product_id', productId);

        fetch('ajout_panier.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateCartDisplay(data.cart);
                updateStockDisplay(data.stock);
            } else {
                console.error('Failed to add product to cart');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateCartDisplay(cart) {
        const cartElement = document.getElementById('cart');
        const cartItemsContainer = cartElement.querySelector('.cart-items');
        cartItemsContainer.innerHTML = '';

        for (const productId in cart) {
            if (cart.hasOwnProperty(productId)) {
                const quantity = cart[productId];
                const productElement = document.getElementById('product-' + productId);
                const productName = productElement.querySelector('.product-info h3').textContent;
                const productPrice = parseFloat(productElement.querySelector('.product-info p').textContent.replace('Prix: ', '').replace(' €', ''));

                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = `<p>${productName} x ${quantity}</p><p>${(productPrice * quantity).toFixed(2)} €</p>`;
                cartItemsContainer.appendChild(cartItem);
            }
        }
    }

    function updateStockDisplay(stock) {
        for (const productId in stock) {
            if (stock.hasOwnProperty(productId)) {
                const productElement = document.getElementById('product-' + productId);
                const stockElement = productElement.querySelector('.product-info p:nth-child(3)');
                stockElement.textContent = 'Stock: ' + stock[productId] + ' unités';
                const buttonElement = productElement.querySelector('.add-to-cart');
                if (stock[productId] <= 0) {
                    buttonElement.disabled = true;
                }
            }
        }
    }

    function clearCart() {
        fetch('panier.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'clear' })
        })
        .then(response => location.reload())
        .catch(error => console.error('Error:', error));
    }

    const clearCartButton = document.querySelector('.clear-cart');
    if (clearCartButton) {
        clearCartButton.addEventListener('click', function () {
            clearCart();
        });
    }
});
