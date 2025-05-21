<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Charla IA controlada</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .chat-box { width: 90%%; max-width: 800px; margin: 20px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        .mensaje { margin: 10px 0; }
        .profesor { color: blue; }
        .alumno { color: green; }
        .controles { margin-top: 20px; }
        button { padding: 10px 20px; margin-right: 10px; }
    </style>
</head>
<body>
<div class="chat-box">
    <h2>Conversación entre Profesor y Alumno (IA)</h2>
    <div id="chat" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;"></div>
    <div class="controles">
        <button id="iniciar">Iniciar</button>
        <button id="detener">Detener</button>
    </div>
</div>
<script src="assets/script.js"></script>
</body>
</html>
