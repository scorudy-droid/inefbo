const express = require('express');
const fs = require('fs');
const path = require('path');
const app = express();
const PORT = 3000;

const filePath = path.join(__dirname, 'contador.txt');

// Servir archivos estáticos (HTML, JS frontend)
app.use(express.static(__dirname));

// Endpoint para obtener e incrementar el contador
app.get('/api/contador', (req, res) => {
    // 1. Leer el archivo txt
    fs.readFile(filePath, 'utf8', (err, data) => {
        let visitas = 0;
        
        if (!err && data) {
            visitas = parseInt(data, 10) || 0;
        }

        // 2. Incrementar la visita
        visitas++;

        // 3. Guardar el nuevo valor en el archivo txt
        fs.writeFile(filePath, visitas.toString(), (writeErr) => {
            if (writeErr) {
                return res.status(500).json({ error: 'Error al escribir el archivo' });
            }
            // 4. Responder al frontend con el número actualizado
            res.json({ visitas });
        });
    });
});

app.listen(PORT, () => {
    console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
