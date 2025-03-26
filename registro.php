<?php
session_start(); // Iniciar sesión

// Conexión a la base de datos
include 'conexion.php';

// Verificar si el usuario ya está logueado, si es así redirigirlo a la página de inicio
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php'); // Redirigir al dashboard si ya está logueado
    exit;
}

// Verificamos si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario y proteger contra inyecciones SQL
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = $_POST['contraseña'];
    $confirm_password = $_POST['confirmar_contraseña'];

    // Validar que la contraseña y la confirmación coincidan
    if ($password !== $confirm_password) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el correo electrónico ya existe
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conexion, $query);

        if (mysqli_num_rows($result) > 0) {
            // Si el correo ya existe, mostrar error
            $error = "Ya existe una cuenta con ese correo electrónico.";
        } else {
            // Si el correo no existe, hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario en la base de datos
            $query_insert = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$hashed_password')";
            $result_insert = mysqli_query($conexion, $query_insert);

            if ($result_insert) {
                // Si la inserción es exitosa, redirigir al login
                header('Location: login.php');
                exit;
            } else {
                $error = "Hubo un error al registrar tu cuenta. Intenta nuevamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
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
        .register-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .register-form h2 {
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-form">
        <h2>Registrarse</h2>

        <!-- Mostrar el mensaje de error si existe -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario de registro -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" name="nombre" class="form-control" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" id="contraseña" required>
            </div>
            <div class="form-group">
                <label for="confirmar_contraseña">Confirmar Contraseña</label>
                <input type="password" name="confirmar_contraseña" class="form-control" id="confirmar_contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
        </form>

        <p class="mt-3 text-center">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</div>

<script src="CSS/js/bootstrap.bundle.min.js"></script>

</body>
</html>
