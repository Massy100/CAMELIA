<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URL_PROJECT ?>\public\css\homepage-style.css">
</head>
<body>

<header>
    <h1>Tracker de Horas de Estudio</h1>
    <nav>
        <ul>
            <li><a href="">Inicio</a></li>
            <li><a href="#registro">Registro</a></li>
            <li><a href="#estadisticas">Estadísticas</a></li>
            <li><a href="<?php echo URL_PROJECT?>/home/logout">Salir</a></li>
        </ul>
    </nav>
</header>

<section class="hero">
    <h2>CAMELIA te ayudara a registar tus horas de estudio</h2>
    <p>Registra y analiza tu tiempo de estudio para mejorar tu productividad.</p>
    <div id="cronometro">00:00:00</div>

<!-- Botón para iniciar el cronómetro -->
<button onclick="iniciarCronometro()">Iniciar Cronómetro</button>

<!-- Script para el cronómetro -->
<script>
    let tiempoInicio;
    let intervaloCronometro;
    let totalTiempoEstudio = 0;
    let cantidadSesiones = 0;

    function iniciarCronometro() {
        tiempoInicio = new Date().getTime();
        intervaloCronometro = setInterval(actualizarCronometro, 1000);
    }

    function actualizarCronometro() {
        const tiempoActual = new Date().getTime();
        const tiempoTranscurrido = tiempoActual - tiempoInicio;

        const segundos = Math.floor(tiempoTranscurrido / 1000);
        const minutos = Math.floor(segundos / 60);
        const horas = Math.floor(minutos / 60);

        const tiempoFormateado = pad(horas) + ":" + pad(minutos % 60) + ":" + pad(segundos % 60);

        document.getElementById("cronometro").innerHTML = tiempoFormateado;
    }

    function pad(valor) {
        return valor < 10 ? "0" + valor : valor;
    }

    // Función para actualizar las estadísticas
    function actualizarEstadisticas() {
        totalTiempoEstudio += tiempoInicio ? new Date().getTime() - tiempoInicio : 0;
        cantidadSesiones++;

        const tiempoTotalFormateado = formatTiempo(totalTiempoEstudio);
        const promedioDiarioFormateado = cantidadSesiones ? formatTiempo(totalTiempoEstudio / cantidadSesiones) : "00:00:00";

        document.getElementById("totalEstudio").innerHTML = tiempoTotalFormateado;
        document.getElementById("promedioDiario").innerHTML = promedioDiarioFormateado;
    }

    // Llama a actualizarEstadisticas  
    setInterval(actualizarEstadisticas, 5000);

    // Formatea el tiempo en segundos a HH:mm:ss
    function formatTiempo(tiempoEnMilisegundos) {
        const segundos = Math.floor(tiempoEnMilisegundos / 1000);
        const minutos = Math.floor(segundos / 60);
        const horas = Math.floor(minutos / 60);

        return pad(horas) + ":" + pad(minutos % 60) + ":" + pad(segundos % 60);
    }
</script>

</section>

<section id="registro" class="registro-section">
    <h2>Registro de Horas de Estudio</h2>
    <form action="<?php echo URL_PROJECT; ?>/home/registar_info" method="POST">
        <label for="materia">Materia:</label>
        <input type="text" id="materia" name="materia" required>

        <label for="horas">Horas de Estudio:</label>
        <input type="number" id="horas" name="horas" required>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
    </form>
</section>
<div id="estadisticas">
    <h2>Estadísticas</h2>
    <p>Total de tiempo de estudio: <span id="totalEstudio">00:00:00</span></p>
    <p>Promedio diario de estudio: <span id="promedioDiario">00:00:00</span></p>
</div>

</body>
</html>
