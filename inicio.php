<?php
include 'conexion.php';
session_start(); // Iniciar sesión para verificar el estado del usuario

// Verificar si el usuario está logueado
$usuario_logueado = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
$nombre_usuario = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : '';

// Si el usuario está logueado, mostrará "Usuario activo" y "Cerrar sesión"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion'])) {
    // Cerrar la sesión y redirigir a la página de inicio
    session_unset();
    session_destroy();
    header('Location: inicio.php');
    exit();
}
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
            background-color: rgb(255, 255, 255); /* Blanco */
            color: black; /* Color del texto */
        }

        /* Fondo azul en la cabecera */
        header {
            background-color: rgb(5, 113, 254);
            padding: 20px 0;
        }

        /* Fondo azul en el pie de página y letras blancas */
        footer {
            background-color: #007bff;
            padding: 20px 0;
            text-align: center;
            color: white;
        }

        /* Personalizar el texto en las secciones */
        h2, h5, p {
            color: black;
        }

        /* Estilo para las imágenes dentro del carrusel */
        .carousel-item img {
            background-color: rgba(0, 0, 0, 0.2);
            width: 25%;
        }

        /* Estilo para las descripciones debajo de la imagen */
        .product-description {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            color: white;
            margin-top: 10px;
            border-radius: 5px;
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 15px;
        }

        /* Estilo al pasar el mouse sobre los botones del carrusel */
        .carousel-control-prev-icon:hover, .carousel-control-next-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <!-- Encabezado con la barra de navegación -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="inicio.php">Mi Comparador</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="categorias.php">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>

                        <!-- Menú de usuario -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> Usuario
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (!$usuario_logueado): ?>
                                    <li><a class="dropdown-item" href="login.php">Iniciar sesión</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="usuario_activo.php">Usuario activo: <?php echo $nombre_usuario; ?></a></li>
                                    <li>
                                        <form action="" method="POST">
                                            <button type="submit" name="cerrar_sesion" class="dropdown-item">Cerrar sesión</button>
                                        </form>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Carrusel de productos destacados -->
    <section class="featured-products">
        <h2>Productos Destacados</h2>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                <?php
                $query = "SELECT * FROM productos WHERE fecha >= CURDATE() - INTERVAL 3 MONTH ORDER BY likes DESC LIMIT 5";
                $productosDestacados = mysqli_query($conexion, $query);
                if ($productosDestacados) {
                    $firstItem = true;
                    while ($producto = mysqli_fetch_assoc($productosDestacados)) {
                        $activeClass = $firstItem ? 'active' : '';
                        echo "<div class='carousel-item $activeClass'>";
                        echo "<img src='{$producto['imagen']}' class='d-block mx-auto' alt='{$producto['nombre']}'>";
                        echo "<div class='product-description'>";
                        echo "<h5><a href='producto_detalle.php?id_producto={$producto['id']}'>{$producto['nombre']}</a></h5>";
                        echo "<p>{$producto['descripcion']}</p>";
                        echo "</div>";
                        echo "</div>";
                        $firstItem = false;
                    }
                }
                ?>
            </div>

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

    <!-- Carrusel de Categorías Destacadas -->
    <section class="featured-categories">
        <h2>Categorías Destacadas</h2>
        <div id="carouselExampleCaptionsCategori" class="carousel slide">
            <div class="carousel-indicators">
                <?php
                $query = "SELECT * FROM categorias ORDER BY nombre LIMIT 5";
                $categoriasDestacadas = mysqli_query($conexion, $query);
                if ($categoriasDestacadas) {
                    $counter = 0;
                    while ($categoria = mysqli_fetch_assoc($categoriasDestacadas)) {
                        $activeClass = ($counter == 0) ? 'active' : '';
                        echo "<button type='button' data-bs-target='#carouselExampleCaptionsCategori' data-bs-slide-to='$counter' class='$activeClass' aria-label='Slide " . ($counter + 1) . "'></button>";
                        $counter++;
                    }
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                $categoriasDestacadas = mysqli_query($conexion, $query);
                if ($categoriasDestacadas) {
                    $firstItem = true;
                    while ($categoria = mysqli_fetch_assoc($categoriasDestacadas)) {
                        $activeClass = $firstItem ? 'active' : '';
                        echo "<div class='carousel-item $activeClass'>";
                        echo "<img src='{$categoria['imagen_categoria']}' class='d-block mx-auto' alt='{$categoria['nombre']}'>";
                        echo "<div class='product-description'>";
                        echo "<h5><a href='productos.php?id={$categoria['id']}'>{$categoria['nombre']}</a></h5>";
                        echo "<p>{$categoria['descripcion']}</p>";
                        echo "</div>";
                        echo "</div>";
                        $firstItem = false;
                    }
                }
                ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptionsCategori" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptionsCategori" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <h7>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</h7>
        </div>
    </footer>

    <script src="CSS/js/bootstrap.bundle.min.js"></script>
</body>
</html>

