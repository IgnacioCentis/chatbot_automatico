<?php
require 'db.php';

function enviarAOpenAI($historial) {
    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Authorization: Bearer " . $_ENV['OPENAI_API_KEY']
        ],
        CURLOPT_POSTFIELDS => json_encode([
            "model" => $_ENV['CHAT_MODEL'],
            "messages" => $historial,
            "temperature" => 0.7
        ])
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($res, true);

    if (isset($data['choices'][0]['message']['content'])) {
        return trim($data['choices'][0]['message']['content']);
    } else {//registro la respuesta del error
        file_put_contents("error_respuesta.json", json_encode($data));
        return "[ERROR]";
    }
}

$convo_id = "web_convo"; // única conversación para demo

$stmt = $conn->prepare("SELECT emisor, mensaje FROM ia_conversaciones WHERE conversacion_id = ? ORDER BY id ASC");
$stmt->execute([$convo_id]);
$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$historialA = [["role" => "system", "content" => "Sos un profesor de Matemática I."]];
$historialB = [["role" => "system", "content" => "Sos un alumno curioso que quiere aprender sobre Matemática I."]];

foreach ($mensajes as $m) {
    $historialA[] = ["role" => $m['emisor'] === 'profesor' ? 'assistant' : 'user', "content" => $m['mensaje']];
    $historialB[] = ["role" => $m['emisor'] === 'alumno' ? 'assistant' : 'user', "content" => $m['mensaje']];
}

$turno = count($mensajes) % 2 === 0 ? 'profesor' : 'alumno';
$historial = $turno === 'profesor' ? $historialA : $historialB;

$respuesta = enviarAOpenAI($historial);

if ($respuesta !== "[ERROR]") {
    $stmt = $conn->prepare("INSERT INTO ia_conversaciones (conversacion_id, emisor, mensaje) VALUES (?, ?, ?)");
    $stmt->execute([$convo_id, $turno, $respuesta]);
}
?>
