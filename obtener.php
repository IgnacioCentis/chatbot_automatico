<?php
require 'db.php';
$convo_id = "web_convo";
$stmt = $conn->prepare("SELECT emisor, mensaje FROM ia_conversaciones WHERE conversacion_id = ? ORDER BY id ASC");
$stmt->execute([$convo_id]);
$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($mensajes as $m) {
    $clase = $m['emisor'] === 'profesor' ? 'profesor' : 'alumno';
    echo "<div class='mensaje $clase'><strong>$m[emisor]:</strong> " . htmlentities($m['mensaje']) . "</div>";
}
?>
