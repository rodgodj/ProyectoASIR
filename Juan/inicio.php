<?php
include 'conexion.php';
?>


<head>
    <link rel="stylesheet" href="CSS/estilos-css.css">
</head>


    <header>
        <div class="container">
            <div class="logo">
                <a href="#">Mi Comparador</a>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Categorías</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Contactar</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Sección de búsqueda -->
    <section class="search">
        <div class="container">
            <input type="text" placeholder="Buscar productos...">
            <button>Buscar</button>
        </div>
    </section>

    <section class="featured-products">
    <h2>Productos Destacados</h2>
    <div id="carouselFeatured" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="featuredCarouselItems">
            <!-- Aquí se cargarán los productos desde la base de datos (por ejemplo, usando PHP o JavaScript) -->
        <?php
            // Suponiendo que tenemos una conexión a la base de datos
            $query = "SELECT * FROM productos WHERE fecha >= CURDATE() - INTERVAL 3 MONTH ORDER BY likes DESC LIMIT 5";
    $productosDestacados = mysqli_query($conexion, $query);
    if (!$productosDestacados) {
        // Si hubo un error en la consulta, muestra el error de MySQL
        die("Error en la consulta: " . mysqli_error($conexion));
    }
    else{
        while ($producto = mysqli_fetch_assoc($productosDestacados)) {
            echo "<div class='carousel-item active'>";
            echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}'>";
            echo "<div class='carousel-caption d-none d-md-block'>";
            echo "<h5>{$producto['nombre']}</h5>";
            echo "<p>{$producto['descripcion']}</p>";
            echo "</div></div>";
        }
    }
?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeatured" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselFeatured" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

    <!-- Sección de productos TOP -->

<section class="daily-top-products">
    <h2>Los 6 Productos Más Vistos del Día</h2>
    <div class="product-grid" id="topDailyProducts">
        <!-- Aquí se cargarán los 6 productos más vistos del día -->
         <?php
            $query = "SELECT p.* FROM productos p JOIN vistas v ON p.id = v.producto_id WHERE v.fecha > NOW() - INTERVAL 1 DAY GROUP BY p.id ORDER BY COUNT(v.id) DESC LIMIT 6";
            $productosMasVistos = mysqli_query($conexion, $query);
            while ($producto = mysqli_fetch_assoc($productosMasVistos)) {
                echo "<div class='product'>";
                echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}'>";
                echo "<h3>{$producto['nombre']}</h3>";
                echo "<p>{$producto['descripcion']}</p>";
                echo "</div>";
            }
            ?>

    </div>
</section>



    <!-- Sección de COMENTARIOS -->
<section class="recent-comments">
    <h2>Últimos 10 Comentarios</h2>
    <ul id="recentCommentsList">
        <!-- Aquí se cargarán los últimos 10 comentarios -->
<?php
$query = "SELECT c.comentario, c.usuario, c.fecha, p.nombre FROM comentarios c JOIN productos p ON c.producto_id = p.id ORDER BY c.fecha DESC LIMIT 10";
$comentariosRecientes = mysqli_query($conexion, $query);
while ($comentario = mysqli_fetch_assoc($comentariosRecientes)) {
    echo "<li><strong>{$comentario['usuario']}</strong> en <em>{$comentario['nombre']}</em>: {$comentario['comentario']}</li>";
}

?>


    </ul>
</section>


    <!-- Sección de productos -->
    <section class="products">
        <div class="container">
            <h2>Productos recomendados</h2>
            <div class="product-grid">
                <!-- Producto 1 -->
                <div class="product">
                    <img src="https://via.placeholder.com/200x150" alt="Producto 1">
                    <h3>Producto 1</h3>
                    <p class="price">€100</p>
                    <button>Ver detalles</button>
                </div>
                <!-- Producto 2 -->
                <div class="product">
                    <img src="https://via.placeholder.com/200x150" alt="Producto 2">
                    <h3>Producto 2</h3>
                    <p class="price">€150</p>
                    <button>Ver detalles</button>
                </div>
                <!-- Producto 3 -->
                <div class="product">
                    <img src="https://via.placeholder.com/200x150" alt="Producto 3">
                    <h3>Producto 3</h3>
                    <p class="price">€200</p>
                    <button>Ver detalles</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>