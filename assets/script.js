let intervalo = null;

function cargarChat() {
    $.get("obtener.php", function(data) {
        $("#chat").html(data);
        $("#chat").scrollTop($("#chat")[0].scrollHeight);
    });
}

function enviarTurno() {
    $.post("conversar.php", function() {
        cargarChat();
    });
}

$(document).ready(function () {
    cargarChat();

    $("#iniciar").click(function () {
        if (!intervalo) {
            intervalo = setInterval(enviarTurno, 3000);
        }
    });

    $("#detener").click(function () {
        clearInterval(intervalo);
        intervalo = null;
    });
});
