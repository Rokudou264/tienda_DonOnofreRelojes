<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don Onofre - Tienda Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="store.css">
</head>

<body>
    <header class="header">
        <div class="container text-center p-2">
            <h1>Don Onofre Relojes</h1>
        </div>
    </header>
    <div class="container mt-5 store">
        <div class="row">
            <div class="col-md-6">
                <div class="product">
                    <img src="product1.jpg" alt="Reloj inteligente">
                    <div class="product-body">
                        <h2 class="product-title">Reloj inteligente</h2>
                        <p class="product-description">Conquista tu día con tecnología inteligente. Pantalla táctil para control fácil, monitorea tu salud y entrenamientos, la batería...</p>
                        <p class="price">Precio: $150.000</p>
                        <form method="POST" id="form1">
                            <input type="hidden" name="product_id" value="10">
                            <input type="hidden" name="product_name" value="Reloj inteligente">
                            <input type="hidden" name="precio" value="50000">
                            <input type="hidden" name="image" value="product1.jpg">
                            <input type="submit" class="button" value="Comprar">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product">
                    <img src="product2.jpg" alt="Reloj clasico">
                    <div class="product-body">
                        <h2 class="product-title">Reloj clasico</h2>
                        <p class="product-description">Más que un reloj, una declaración. Descubre la historia y el legado detrás de este clásico atemporal...</p>
                        <p class="price">Precio: $50.000</p>
                        <form method="POST" id="form2">
                            <input type="hidden" name="product_id" value="56">
                            <input type="hidden" name="product_name" value="Reloj clasico">
                            <input type="hidden" name="precio" value="150000">
                            <input type="hidden" name="image" value="product2.jpg">
                            <input type="submit" class="button" value="Comprar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center p-3 mt-5">
        <p>&copy; 2024 Don Onofre Relojes. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("form1");
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "adams_api.php", true);

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        var response = JSON.parse(xhr.responseText);

                        if (response.status === 'success') {
                            var payUrl = response.pay;

                            window.location.href = payUrl;
                            form.reset();
                        } else {
                            Swal.fire('Oops...', response.message, 'error');
                        }
                    } else {
                        Swal.fire('¡Error!', 'intente nuevamente');
                    }

                    form.style.opacity = "";
                    var submitBtn = document.querySelector(".submitBtn");
                    submitBtn.removeAttribute("disabled");
                };

                xhr.onerror = function() {
                    Swal.fire('¡Error!', 'intente nuevamente');
                };

                var formData = new FormData(form);
                xhr.send(formData);

                form.style.opacity = ".5";
                var submitBtn = document.querySelector(".submitBtn");
                submitBtn.setAttribute("disabled", "disabled");
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("form2");
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "adams_api.php", true);

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        var response = JSON.parse(xhr.responseText);

                        if (response.status === 'success') {
                            var payUrl = response.pay;
                            window.location.href = payUrl;
                            form.reset();
                        } else {
                            Swal.fire('Oops...', response.message, 'error');
                        }
                    } else {
                        Swal.fire('¡Error!', 'intente nuevamente');
                    }

                    form.style.opacity = "";
                    var submitBtn = document.querySelector(".submitBtn");
                    submitBtn.removeAttribute("disabled");
                };

                xhr.onerror = function() {
                    Swal.fire('¡Error!', 'intente nuevamente');
                };

                var formData = new FormData(form);
                xhr.send(formData);

                form.style.opacity = ".5";
                var submitBtn = document.querySelector(".submitBtn");
                submitBtn.setAttribute("disabled", "disabled");
            });
        });
    </script>
</body>

</html>