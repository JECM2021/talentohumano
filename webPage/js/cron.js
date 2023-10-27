$(document).ready(function() {
    listadoCaducado = [];
    contratosvencer();
    documentosVencidos();
});

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
                console.log(ret, ret.length);
                if (ret != 0) {
                    listarCombo = $("#contvencer1");
                    listarCombo.html('');
                    for (var i = 0; i < ret.length; i++) {
                        if (ret[i].DIAS_RESTANTES <= 40 && ret[i].DIAS_RESTANTES >= 1) {
                            $("#mensajes").text("Contratos Proximos a Vencer")
                            $("#pokeList ul").append("<li>" + ret[i].EMPLEADO + " - " + ret[i].CARGO + " - " + ret[i].FECHA_CULMINACION + " </li>");
                        } else if (ret[i].DIAS_RESTANTES <= 0) {
                            $("#mensajes").text("Contratos Vencidos")
                            $("#pokeList ul").append("<li>" + ret[i].EMPLEADO + " - " + ret[i].CARGO + " - " + ret[i].FECHA_CULMINACION + " </li>");
                        }
                    }
                    setTimeout(function() {
                        $(".adbn-wrap").fadeOut(1500);
                    }, 5000);

                } else {
                    $(".adbn-wrap").fadeOut(0);
                }
            } catch (e) {
                alertify.error(" El erro es:" + e);
            }
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}

function documentosVencidos() {
    var ur = CONTROLLERPUBLIC;
    var op = 61;
    $.ajax({
        type: "POST",
        url: ur,
        data: ({
            op: op
        }),
        success: function(data) {
            var ret = eval('(' + data + ')');
            listadoCaducado = [];
            try {
                if (ret.length > 0) {
                    $("#spanAlertas").text(ret.length);

                    $("li.header").text("Tiene " + ret.length + " Alerta.");
                    var option = $("<li class='header' value=''>Tiene " + ret.length + " notificaciones.</li>");
                    for (var i = 0; i < ret.length; i++) {
                        if (ret[i].DIAS <= 0) {
                            $("#menuAlertas>li").append("<a' style='color: #a94442 !important;'><i class='fa fa-exclamation-triangle text-danger' aria-hidden='true'></i> El Doc: " + ret[i].DESCRIPCION + " Esta Vencida</a>")
                        } else {
                            $("#menuAlertas>li").append("<a><i class='fa fa-calendar-plus-o text-warning' aria-hidden='true'></i>la Ref: " + ret[i].DESCRIPCION + " Se Vence en (" + ret[i].DIAS + ") Dias</a>")
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