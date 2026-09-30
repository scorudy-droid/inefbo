<?php
// 1. Definir el nombre del archivo de texto que guardará las visitas
$archivo = "contador.txt";

// 2. Si el archivo no existe en el servidor, lo crea con un cero inicial
if (!file_exists($archivo)) {
    file_put_contents($archivo, "0");
}

// 3. Abrir el archivo en modo lectura/escritura ("r+")
$fp = fopen($archivo, "r+");

// 4. Bloquear el archivo para evitar que dos usuarios escriban al mismo tiempo y corrompan el dato
flock($fp, LOCK_EX);

// 5. Leer el número actual de visitas y sumarle 1
$visitas = (int)fread($fp, filesize($archivo) ? filesize($archivo) : 1);
$visitas++;

// 6. Regresar el puntero al inicio del archivo, truncar el contenido viejo y escribir el nuevo total
rewind($fp);
ftruncate($fp, 0);
fwrite($fp, $visitas);

// 7. Liberar el bloqueo y cerrar el archivo de texto
flock($fp, LOCK_UN);
fclose($fp);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador en PHP Puro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f9;
            margin-top: 100px;
        }
        .caja-contador {
            display: inline-block;
            background: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .numero {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="caja-contador">
        <p>Visitas totales guardadas en el servidor:</p>
        <!-- 8. Mostramos la variable de visitas directamente dentro del HTML -->
        <div class="numero"><?php echo $visitas; ?></div>
    </div>

</body>
</html>
