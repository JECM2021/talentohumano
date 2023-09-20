$(document).ready(function() {
    listadoVencidos = [];
    visulizarReferenciaVencidas();
    visulizarPedidosVencidas();
    visulizarOrdenesVencidas();
    contratosvencer();
});

function visulizarReferenciaVencidas() {
    var ur = CONTROLLERPUBLIC;
    var op = 51;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            listadoVencidos = [];
            try {
                if (ret.length > 0) {
                    $("#spanAlertas").text(ret.length);

                    $("li.header").text("Tiene " + ret.length + " Alerta.");
                    var option = $("<li class='header' value=''>Tiene " + ret.length + " notificaciones.</li>");
                    for (var i = 0; i < ret.length; i++) {
                        if (ret[i].DIAS <= 0) {
                            $("#menuAlertas>li").append("<a href='/clinicasv/Vistas/Referencia/Referencias?page=8&pageMenu=2&pageSub=3&refId=" + ret[i].ID + "' style='color: #a94442 !important;'><i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i>la Ref: " + ret[i].CODIGO + " Esta Vencida</a>")
                        } else {
                            $("#menuAlertas>li").append("<a href='/clinicasv/Vistas/Referencia/Referencias?page=8&pageMenu=2&pageSub=3&refId=" + ret[i].ID + "'><i class='fa fa-calendar-plus-o text-warning' aria-hidden='true'></i>la Ref: " + ret[i].CODIGO + " Se Vence en (" + ret[i].DIAS + ")Dias</a>")
                        }
                    }
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function visulizarPedidosVencidas() {
    var ur = CONTROLLERPUBLIC;
    var op = 52;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            listadoVencidos = [];
            try {
                if (ret.length > 0) {
                    console.log(ret);

                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function visulizarOrdenesVencidas() {
    var ur = CONTROLLERPUBLIC;
    var op = 58;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            listadoVencidos = [];
            try {
                if (ret.length > 0) {
                    $("#spanTareas").text(ret.length);

                    $("li.header.tasks").text("Tiene " + ret.length + " Ordenes Pendientes.");
                    var option = $("<li class='header tasks' value=''>Tiene " + ret.length + " Ordenes.</li>");
                    for (var i = 0; i < ret.length; i++) {

                        $("#menutareas>li").append("<a href='/clinicasv/Vistas/Referencia/Referencias?page=8&pageMenu=2&pageSub=3&evento" + ret[i].EVENTO + "' style=''><i class='fa fa-pencil-square-o text-danger' aria-hidden='true'></i> La orden Laboratorio: " + ret[i].ORDEN + " Esta pendiente </a>")

                    }
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function contratosvencer() {
    var ur = CONTROLLERPUBLIC;
    var op = 60;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            try {
                listarCombo = $("#contvencer1");
                listarCombo.html('');

                for (var i = 0; i < ret.length; i++) {
                    if (ret[i].DIAS_RESTANTES <= 30) {
                        $("#pokeList ul").append("<li>" + ret[i].EMPLEADO + " - " + ret[i].CARGO + " - " + ret[i].FECHA_CULMINACION + " </li>");
                    }
                }
                setTimeout(function() {
                    $(".adbn-wrap").fadeOut(1500);
                }, 5000);
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}