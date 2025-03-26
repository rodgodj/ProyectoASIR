<?php
include 'conexion.php';

// Obtenemos el id de la categoría desde la URL
$id_categoria = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id_categoria) {
    // Realizamos la consulta para obtener los productos de la categoría seleccionada
    $query = "SELECT * FROM productos WHERE categoria_id = $id_categoria";
    $productos = mysqli_query($conexion, $query);
    // Comprobamos si hay algún error en la consulta
    if (!$productos) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
} else {
    echo "No se ha seleccionado una categoría.";
    exit;
}
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos de la Categoría</title>
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .card img {
            max-width: 100%; /* Para que la imagen no sobrepase el ancho del contenedor */
            height: auto;    /* Mantiene la proporción original de la imagen */
            object-fit: cover; /* Cubre el contenedor sin deformar la imagen */
            border-radius: 8px; /* Sirve para redondear los bordes de la imagen */
            max-height: 10%; /* Aquí se establece una altura máxima*/
        }

        footer {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="inicio.php">Mi Comparador</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li>
                            <a class="nav-link active" href="categorias.php">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nosotros.php">Sobre nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>

                        <!-- Menú de usuario, movido al lado derecho -->
                        <li class="nav-item dropdown ms-auto">
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

    <!-- Contenedor principal -->
    <main class="container mt-5">
        <h1 class="text-center mb-4">Productos de esta Categoría</h1>

        <div class="row">
            <?php
            // Mostrar los productos de la categoría
            while ($producto = mysqli_fetch_assoc($productos)) {
                echo "<div class='col-md-4'>";
                echo "<div class='card'>";

                // Mostramos la imagen del producto
                echo "<img src='{$producto['imagen']}' class='card-img-top' alt='{$producto['nombre']}'>";

                // Mostramos nombre y descripción del producto
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$producto['nombre']}</h5>";
                echo "<p class='card-text'>{$producto['descripcion']}</p>";

                // Cambiar para redirigir a producto_detalle.php con el ID o nombre del producto
                // Aquí pasamos el ID del producto en la URL
                $id_producto = $producto['id'];  // Asumimos que 'id' es el campo de la base de datos para el ID del producto
                echo "<a href='producto_detalle.php?id_producto={$id_producto}' class='btn btn-primary'>Ver producto</a>"; // Enlace a producto_detalle.php con el ID del producto

                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="text-center">
        <p>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</p>
    </footer>

    <script src="CSS/js/bootstrap.bundle.min.js"></script>
</body>
</html>
