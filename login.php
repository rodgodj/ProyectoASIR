<?php
session_start(); // Iniciar sesión

// Conexión a la base de datos
include 'conexion.php';

// Verificar si el usuario ya está logueado, si es así redirigirlo al dashboard
if (isset($_SESSION['usuario_id'])) {
    header('Location: inicio.php'); // Redirigir al dashboard si ya está logueado
    exit;
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['contraseña'];

    // Consultar la base de datos para verificar las credenciales del usuario
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexion, $query);

    // Si el usuario existe
    if (mysqli_num_rows($result) > 0) {
        // Obtener los datos del usuario
        $usuario = mysqli_fetch_assoc($result);

        // Verificar la contraseña usando password_verify
        if (password_verify($password, $usuario['contraseña'])) {
            // Si la contraseña es correcta, guardar la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            
            // Redirigir al dashboard o página de inicio
            header('Location: inicio.php');
            exit;
        } else {
            $error = "La contraseña es incorrecta.";
        }
    } else {
        $error = "No se encuentra un usuario con ese correo electrónico.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin-top: 100px;
        }
        .login-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-form">
        <h2>Iniciar Sesión</h2>

        <!-- Mostrar el mensaje de error si existe -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario de inicio de sesión -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" id="contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
        </form>

        <p class="mt-3 text-center">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</div>

<script src="CSS/js/bootstrap.bundle.min.js"></script>

</body>
</html>
