<?php
function generateRandomLetters($length = 3) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strtoupper($_POST['nombre'] ?? '');
    $apellido_paterno = strtoupper($_POST['apellido_paterno'] ?? '');
    $apellido_materno = strtoupper($_POST['apellido_materno'] ?? '');
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

    if ($nombre && $apellido_paterno && $apellido_materno && $fecha_nacimiento) {
        $rfc = substr($apellido_paterno, 0, 2);
        $rfc .= substr($apellido_materno, 0, 1);
        $rfc .= substr($nombre, 0, 1);
        $fecha = new DateTime($fecha_nacimiento);
        $rfc .= $fecha->format('y');
        $rfc .= $fecha->format('m');
        $rfc .= $fecha->format('d');
        $rfc .= generateRandomLetters();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado RFC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 40px auto;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        .result {
            margin-top: 50px;
            padding: 30px;
            background-color: #2C3E50;
            color: white;
            border-radius: 10px;
        }

        .result h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .result p {
            font-size: 2em;
            font-weight: bold;
            letter-spacing: 2px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            background: #E74C3C;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        a:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="result">
        <h3>Tu RFC es:</h3>
        <p><?php echo $rfc ?? 'Datos incompletos'; ?></p>
        <a href="index.html">Volver</a>
    </div>
</body>
</html>