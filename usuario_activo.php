<?php
include 'conexion.php';
session_start(); // Iniciar sesión para verificar el estado del usuario

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    // Si no está logueado, redirigir al login
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$nombre_usuario = $_SESSION['usuario_nombre'];

// Consulta para obtener los productos comentados por el usuario
$query = "
    SELECT p.id AS producto_id, p.nombre AS producto_nombre, p.descripcion AS producto_descripcion, 
           c.comentario AS comentario, c.fecha AS comentario_fecha
    FROM productos p
    JOIN comentarios c ON p.id = c.id_producto
    WHERE c.id_usuario = $usuario_id
    ORDER BY c.fecha DESC
";

$resultado_comentarios = mysqli_query($conexion, $query);

// Verificar si hay comentarios
if (!$resultado_comentarios || mysqli_num_rows($resultado_comentarios) == 0) {
    $mensaje = "No has comentado ningún producto aún.";
} else {
    $mensaje = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Comparador - Usuario Activo</title>
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <style>
        /* Estilo general de la página */
        body {
            background-color: rgb(245, 245, 245);
            color: black;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el contenido ocupe al menos toda la pantalla */
        }
        
        /* Encabezado */
        header {
            background-color: #007bff;
        }

        /* Estilo personalizado para la página */
        .comentario-card {
            margin-bottom: 20px;
            padding: 15px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .comentario-card h5 {
            color: #007bff;
        }

        .comentario-card p {
            font-size: 14px;
        }

        /* Estilo del pie de página */
        footer {
            background-color: #007bff;
            padding: 20px 0;
            text-align: center;
            color: white;
            margin-top: auto; /* Esto hace que el footer se quede al final */
        }

        h2 {
            margin-top: 20px;
            color: #0056b3;
        }

        .alert {
            margin-top: 20px;
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
                        <li class="nav-item">
                            <a class="nav-link" href="usuario_activo.php">Usuario Activo: <?php echo $nombre_usuario; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sección de comentarios de usuario -->
    <section class="comentarios">
        <div class="container">
            <h2>Productos que has comentado</h2>

            <?php if ($mensaje): ?>
                <div class="alert alert-info"><?php echo $mensaje; ?></div>
            <?php else: ?>
                <?php while ($comentario = mysqli_fetch_assoc($resultado_comentarios)): ?>
                    <div class="comentario-card">
                        <h5><a href="producto_detalle.php?id_producto=<?php echo $comentario['producto_id']; ?>"><?php echo $comentario['producto_nombre']; ?></a></h5>
                        <p><strong>Comentario:</strong> <?php echo $comentario['comentario']; ?></p>
                        <p><small><strong>Fecha del comentario:</strong> <?php echo date('d/m/Y H:i', strtotime($comentario['comentario_fecha'])); ?></small></p>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
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
