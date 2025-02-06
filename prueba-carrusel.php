<section class="featured-products">
    <h2>Productos Destacados</h2>
    <div id="carouselFeatured" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="featuredCarouselItems">
            <?php
            // Conexión a la base de datos (asegúrate de haber establecido la conexión)
            $conexion = mysqli_connect('localhost', 'usuario', 'contraseña', 'basededatos');
            if (!$conexion) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            // Realizar la consulta para obtener los productos destacados
            $query = "SELECT * FROM productos WHERE fecha >= CURDATE() - INTERVAL 3 MONTH ORDER BY likes DESC LIMIT 5";
            $productosDestacados = mysqli_query($conexion, $query);

            // Verificamos si la consulta fue exitosa
            if (!$productosDestacados) {
                die("Error en la consulta: " . mysqli_error($conexion));
            }

            // Variable para asegurarnos de que solo el primer item tenga la clase 'active'
            $firstItem = true;

            // Iterar sobre los productos y crear el carrusel
            while ($producto = mysqli_fetch_assoc($productosDestacados)) {
                // Solo el primer producto tendrá la clase 'active'
                $activeClass = $firstItem ? 'active' : '';
                echo "<div class='carousel-item $activeClass'>";
                echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}'>";
                echo "<div class='carousel-caption d-none d-md-block'>";
                echo "<h5>{$producto['nombre']}</h5>";
                echo "<p>{$producto['descripcion']}</p>";
                echo "</div></div>";

                // Después del primer producto, cambia la variable
                $firstItem = false;
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>
        </div>

        <!-- Botón para navegar al producto anterior -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeatured" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <!-- Botón para navegar al siguiente producto -->
        <button class="carousel-control-next" type="button" data-bs-target="#carouselFeatured" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
