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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página de Categorías</title>
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <style>
          body {
            background-color: rgb(245, 245, 245);
            color: black;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el contenido ocupe al menos toda la pantalla */
        }
        .categoria {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease;
        }

        .categoria:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #007bff;
            padding: 20px 0;
            text-align: center;
            color: white;
            margin-top: auto; /* Esto hace que el footer se quede al final */
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
                        <li class="nav-item">
                            <a class="nav-link active" href="inicio.php">Inicio</a>
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
        <section class="categorias">
            <h1 class="text-center mb-4">Explora nuestras categorías</h1>

            <div class="row">
                <?php
                // Consulta para obtener todas las categorías
                $query = "SELECT * FROM categorias";
                $categoriasResult = mysqli_query($conexion, $query);
                if (!$categoriasResult) {
                    die("Error en la consulta: " . mysqli_error($conexion));
                }

                // Mostrar todas las categorías
                while ($categoria = mysqli_fetch_assoc($categoriasResult)) {
                    $categoriaId = $categoria['id'];
                    echo "<div class='col-md-4'>";
                    echo "<div class='categoria'>";
                    echo "<h2><a href='productos.php?id=$categoriaId'>{$categoria['nombre']}</a></h2>";
                    echo "<h5>{$categoria['nombre']}</h5>";
                    echo "<p>{$categoria['descripcion']}</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="text-center">
        <p>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</p>
    </footer>

    <script src="CSS/js/bootstrap.bundle.min.js"></script>
</body>
</html>
