document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    console.log(csrfToken); // <--- Добавьте эту строку

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;

            if (productId) {
                fetch('/cart/add/' + productId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            // ...
                        } else {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Ошибка при добавлении в корзину:', error);
                        alert('Произошла ошибка при добавлении товара в корзину.');
                    });
            } else {
                console.error('ID товара не найден.');
            }
        });
    });
});