// Obtener el valor actual del contador desde el almacenamiento local
let visitas = localStorage.getItem('contadorVisitas');

// Si no existe, lo inicializamos en 0
if (!visitas) {
    visitas = 0;
}

// Incrementamos el contador en 1 por cada recarga
visitas++;

// Guardamos el nuevo valor
localStorage.setItem('contadorVisitas', visitas);

// Mostramos el valor en el elemento HTML
document.getElementById('contador').textContent = visitas;
