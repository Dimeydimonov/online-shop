document.addEventListener('DOMContentLoaded', function() {
    // Слайдер автоматического прокручивания
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;

    function showNextSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    setInterval(showNextSlide, 3000); // Прокрутка каждые 3 секунды

    // Обработка клика по карточке товара
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('click', function() {
            alert('Вы кликнули по карточке товара: ' + this.querySelector('h3').textContent);
        });
    });

    // Функция поиска
    const searchInput = document.querySelector('.search input');
    const searchButton = document.querySelector('.search button');

    searchButton.addEventListener('click', function() {
        const searchTerm = searchInput.value.toLowerCase();
        const products = document.querySelectorAll('.product-card');

        products.forEach(product => {
            const productName = product.querySelector('h3').textContent.toLowerCase();
            if (productName.includes(searchTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
});
