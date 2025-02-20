<?php
// Datos de la base de datos
$servidor = "localhost";     // El servidor de la base de datos, generalmente localhost
$usuario = "root";           // Tu nombre de usuario de MySQL (por defecto en XAMPP es "root")
$contraseña = "";            // Tu contraseña de MySQL (por defecto está vacía en XAMPP)
$baseDeDatos = "proyectoasir";  // El nombre de la base de datos

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $contraseña, $baseDeDatos);

// Comprobar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    // Si la conexión es exitosa, puedes realizar consultas aquí
    // echo "Conexión exitosa";
}
?>
