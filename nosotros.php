<?php
include 'conexion.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Mi Comparador</title>
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

        .image-container {
            text-align: center;
            margin-top: 30px;
        }

        .image-container img {
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
        }

        .team-section {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }

        .team-member {
            text-align: center;
            margin: 10px;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
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
    <h2>Nosotros</h2>
    <p>En <strong>Mi Comparador</strong>, nuestra misión es ayudarte a tomar decisiones informadas al momento de comprar productos en línea. Sabemos que el mercado está lleno de opciones y que encontrar el mejor precio puede ser una tarea desafiante. Por eso, hemos creado una plataforma fácil de usar que te permite comparar precios de los productos que deseas en diferentes tiendas y encontrar las mejores ofertas.</p>

    <div class="image-container">
        <img src="https://kinsta.com/es/wp-content/uploads/sites/8/2021/12/about-us-page-1024x512.png" alt="Imagen de Nosotros" class="img-fluid">
    </div>

    <h3>Nuestra Misión</h3>
    <p>Nuestra misión es ofrecer una herramienta confiable y sencilla para que los consumidores puedan comparar productos y precios de manera rápida y eficiente. Queremos que nuestros usuarios encuentren siempre la mejor oferta, ahorren tiempo y dinero, y hagan compras con confianza.</p>

    <h3>Cómo Funciona Nuestro Comparador</h3>
    <p>El comparador de precios de Mi Comparador trabaja con un sistema avanzado que recopila información de diferentes tiendas online. Nuestro algoritmo procesa esta información y te presenta los productos junto con sus precios, permitiéndote comparar las opciones de manera rápida y sencilla. Además, nuestro sistema se actualiza constantemente para ofrecerte los datos más precisos y actuales.</p>

    <h3>Conoce a Nuestro Equipo</h3>
    <p>Mi Comparador está formado por un equipo de profesionales apasionados por la tecnología, el comercio electrónico y la optimización de las compras. Estamos comprometidos en ofrecerte la mejor experiencia de usuario y ayudarte a realizar compras inteligentes.</p>

    <div class="team-section">
        <div class="team-member">
            <img src="imagenes/equipo1.jpg" alt="Miembro 1">
            <h5>Juan Pérez</h5>
            <p>Fundador y CEO</p>
        </div>
        <div class="team-member">
            <img src="imagenes/equipo2.jpg" alt="Miembro 2">
            <h5>Ana Gómez</h5>
            <p>Desarrolladora Web</p>
        </div>
        <div class="team-member">
            <img src="imagenes/equipo3.jpg" alt="Miembro 3">
            <h5>Carlos Díaz</h5>
            <p>Especialista en Marketing</p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 Mi Comparador de Precios. Todos los derechos reservados.</p>
</footer>

<script src="CSS/js/bootstrap.min.js"></script>

</body>
</html>
