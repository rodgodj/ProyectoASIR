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

// Obtener el ID del producto desde la URL
$id_producto = isset($_GET['id_producto']) ? (int)$_GET['id_producto'] : null;

if ($id_producto) {
    // Realizar la consulta para obtener los detalles del producto
    $query = "SELECT * FROM productos WHERE id = $id_producto";
    $producto_result = mysqli_query($conexion, $query);

    if (!$producto_result) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    $producto = mysqli_fetch_assoc($producto_result);
} else {
    echo "Producto no encontrado.";
    exit;
}

// Obtener los comentarios del producto
$query_comentarios = "SELECT c.comentario, c.fecha, u.nombre 
                      FROM comentarios c
                      JOIN usuarios u ON c.id_usuario = u.id
                      WHERE c.id_producto = $id_producto
                      ORDER BY c.fecha DESC";

$comentarios_result = mysqli_query($conexion, $query_comentarios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto - <?php echo $producto['nombre']; ?></title>
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #007bff;
            padding: 20px 0;
            color: white;
        }

        header a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
        }

        .container {
            margin-top: 30px;
        }

        .product-detail {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-detail img {
            max-width: 300px;
            margin-bottom: 20px;
        }

        .comentarios-section {
            margin-top: 30px;
        }

        .comentario {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .comentario h5 {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .comentario p {
            margin-bottom: 10px;
        }

        .comentario .fecha {
            font-size: 0.9rem;
            color: #777;
        }

        footer {
            background-color: #f1f1f1;
            padding: 10px 0;
            text-align: center;
            color: #777;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>

<!-- Barra de navegación -->
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

<!-- Detalles del Producto -->
<div class="container">
    <h2>Detalles del Producto</h2>

    <div class="product-detail">
        <h3><?php echo $producto['nombre']; ?></h3>
        <p><?php echo $producto['descripcion']; ?></p>

        <!-- Mostrar la imagen del producto -->
        <?php if (!empty($producto['imagen'])): ?>
            <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="img-fluid">
        <?php else: ?>
            <p>No hay imagen disponible para este producto.</p>
        <?php endif; ?>
    </div>

    <!-- Comentarios -->
    <div class="comentarios-section">
        <h4>Comentarios:</h4>

        <?php if (mysqli_num_rows($comentarios_result) > 0): ?>
            <?php while ($comentario = mysqli_fetch_assoc($comentarios_result)): ?>
                <div class="comentario">
                    <h5><?php echo $comentario['nombre']; ?></h5>
                    <p><?php echo $comentario['comentario']; ?></p>
                    <p class="fecha"><?php echo date('d/m/Y H:i', strtotime($comentario['fecha'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay comentarios para este producto.</p>
        <?php endif; ?>

        <!-- Si el usuario no está logueado, mostrar un mensaje -->
        <?php if (isset($usuario_no_logueado) && $usuario_no_logueado): ?>
            <p class="text-danger">Necesita estar logueado para comentar sobre este producto.</p>
        <?php else: ?>
            <!-- Formulario para agregar un nuevo comentario -->
            <h5>Deja un comentario:</h5>
            <form method="POST" action="">
                <textarea name="comentario" rows="4" class="form-control" placeholder="Escribe tu comentario aquí..." required></textarea>
                <button type="submit" class="btn btn-primary mt-2">Enviar comentario</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<!-- Pie de página -->
<footer class="text-center">
    <p>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</p>
</footer>

<script src="CSS/js/bootstrap.bundle.min.js"></script>

</body>
</html>
