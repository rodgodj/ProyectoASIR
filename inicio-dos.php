<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Comparador</title>
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <style>
        /* Fondo azul para toda la página */
        body {
            background-color: #007bff; /* Azul */
            color: white; /* Color blanco para el texto */
        }

        /* Fondo azul en la cabecera */
        header {
            background-color: #007bff;
            padding: 20px 0;
        }

        /* Fondo azul en el pie de página */
        footer {
            background-color: #007bff;
            padding: 20px 0;
            text-align: center;
        }

        /* Personalizar el texto en las secciones */
        h2, h5, p {
            color: white; /* Cambiar color del texto a blanco */
        }

        /* Si quieres un fondo azul más oscuro o diferente para las imágenes del carrusel */
        .carousel-item img {
            background-color: rgba(0, 0, 0, 0.2); /* Fondo oscuro con algo de transparencia */
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="/ProyectoASIR/inicio-dos.php" style="color: white;">Mi Comparador</a>
            </div>
            <nav>
                <ul style="display: flex; justify-content: center; list-style: none; padding: 0;">
                    <li style="margin: 0 15px;"><a href="/ProyectoASIR/inicio-dos.php" style="color: white;">Inicio</a></li>
                    <li style="margin: 0 15px;"><a href="categorias.php" style="color: white;">Categorías</a></li>
                    <li style="margin: 0 15px;"><a href="#" style="color: white;">Ofertas</a></li>
                    <li style="margin: 0 15px;"><a href="#" style="color: white;">Contactar</a></li>
                </ul>
            </nav>
        </div>
    </header>
    

    <!-- Sección carrusel de productos destacados -->
    <section class="featured-products">
        <h2>Productos Destacados</h2>

        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <!-- Agregar botones adicionales si hay más de 3 productos -->
                <!-- Esto puede hacerse dinámicamente también -->
            </div>
            <div class="carousel-inner">
                <?php
                // Realizar la consulta para obtener los productos destacados
                $query = "SELECT * FROM productos WHERE fecha >= CURDATE() - INTERVAL 3 MONTH ORDER BY likes DESC LIMIT 5";
                $productosDestacados = mysqli_query($conexion, $query);

                if (!$productosDestacados) {
                    die("Error en la consulta: " . mysqli_error($conexion));
                } else {
                    $firstItem = true; // Variable para controlar el primer item
                    $counter = 0; // Contador para los indicadores
                    while ($producto = mysqli_fetch_assoc($productosDestacados)) {
                        // Si es el primer producto, asignar la clase "active"
                        $activeClass = $firstItem ? 'active' : '';
                        echo "<div class='carousel-item $activeClass'>";
                        echo "<img src='{$producto['imagen']}' class='d-block mx-auto w-20' alt='{$producto['nombre']}'>";

                        echo "<div class='carousel-caption d-none d-md-block'>";
                        echo "<h5>{$producto['nombre']}</h5>";
                        echo "<p>{$producto['descripcion']}</p>";
                        echo "</div>";
                        echo "</div>";
                        $firstItem = false; // Solo el primer producto tendrá la clase "active"
                        $counter++;
                    }

                    // Ajustar el número de botones de indicadores si hay más de 3 productos
                    if ($counter > 3) {
                        echo "<script>
                            var indicators = document.querySelectorAll('.carousel-indicators button');
                            for (var i = 3; i < $counter; i++) {
                                var newButton = document.createElement('button');
                                newButton.setAttribute('type', 'button');
                                newButton.setAttribute('data-bs-target', '#carouselExampleCaptions');
                                newButton.setAttribute('data-bs-slide-to', i);
                                newButton.setAttribute('aria-label', 'Slide ' + (i + 1));
                                document.querySelector('.carousel-indicators').appendChild(newButton);
                            }
                        </script>";
                    }
                }
                ?>
            </div>

            <!-- Botones de control del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>       
    </section>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="CSS/js/bootstrap.min.js"></script>
</body>
</html>
