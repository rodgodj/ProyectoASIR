<?php
include 'conexion.php'; // Asegúrate de incluir la conexión a la base de datos si es necesario
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Mi Comparador</title>
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgb(245, 245, 245);
            color: #333;
        }
        
        header {
            background-color: rgb(5, 113, 254);
            padding: 20px 0;
        }

        header a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
        }

        .container {
            max-width: 960px;
            margin-top: 30px;
        }

        h2 {
            color: #0056b3;
        }

        h3 {
            margin-top: 20px;
            font-size: 1.8rem;
            color: #007bff;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .form-container {
            margin-top: 30px;
        }

        .form-container form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container .form-group {
            margin-bottom: 15px;
        }

        .form-container .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            color: white;
            cursor: pointer;
        }

        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

<header>
    <div class="container">
        <a href="inicio.php">Mi Comparador</a>
    </div>
</header>

<div class="container">
    <h2>Contacto</h2>
    <p>Si tienes alguna pregunta, duda o comentario, no dudes en ponerte en contacto con nosotros. Estaremos encantados de ayudarte.</p>

    <div class="form-container">
        <form action="procesar_contacto.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </form>
    </div>

    <h3>Información de Contacto</h3>
    <p>También puedes contactarnos a través de los siguientes canales:</p>
    <ul>
        <li><strong>Correo electrónico:</strong> contacto@micomparador.com</li>
        <li><strong>Teléfono:</strong> +34 623-17-98-84</li>
        <li><strong>Dirección:</strong> Calle Ficticia 123, La Montiela, España</li>
    </ul>
</div>

<footer>
    <p>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</p>
</footer>

<script src="CSS/js/bootstrap.min.js"></script>

</body>
</html>
