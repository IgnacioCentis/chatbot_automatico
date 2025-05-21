<?php
require 'db.php';
$convo_id = "web_convo";
$stmt = $conn->prepare("UPDATE ia_conversaciones SET activo = 0 WHERE conversacion_id = ?");
$stmt->execute([$convo_id]);
var_dump($stmt);
?>
