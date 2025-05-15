document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.getElementById("filter-form");
    const productsTable = document.getElementById("products-table");

    // Фильтр по категории без перезагрузки страницы
    document.getElementById("category").addEventListener("change", function () {
        fetchProducts();
    });

    // Фильтр по поиску
    document.getElementById("search").addEventListener("input", function () {
        fetchProducts();
    });

    function fetchProducts(page = 1) {
        let formData = new FormData(filterForm);
        let url = `${filterForm.action}?${new URLSearchParams(formData).toString()}&page=${page}`;

        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
            .then(response => response.text())
            .then(data => {
                productsTable.innerHTML = data;
                attachPaginationHandlers();
                attachDeleteHandlers();
            });
    }

    // Функция для удаления товара и обновления списка
    function attachDeleteHandlers() {
        document.querySelectorAll(".delete-form").forEach(form => {
            form.addEventListener("submit", function (event) {
                event.preventDefault();
                if (!confirm("Вы уверены, что хотите удалить этот товар?")) return;

                fetch(form.action, {
                    method: "POST",
                    body: new FormData(form),
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }).then(() => {
                    fetchProducts();
                });
            });
        });
    }

    // Функция для работы пагинации без перезагрузки
    function attachPaginationHandlers() {
        document.querySelectorAll(".pagination a").forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                const url = new URL(link.href);
                const page = url.searchParams.get("page");
                fetchProducts(page);
            });
        });
    }

    attachPaginationHandlers();
    attachDeleteHandlers();
});
