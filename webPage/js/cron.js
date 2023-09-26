$(document).ready(function() {
    contratosvencer();
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
                // debugger;
                if (ret != 0) {
                    listarCombo = $("#contvencer1");
                    listarCombo.html('');
                    for (var i = 0; i < ret.length; i++) {
                        if (ret[i].DIAS_RESTANTES <= 40) {
                            $("#pokeList ul").append("<li>" + ret[i].EMPLEADO + " - " + ret[i].CARGO + " - " + ret[i].FECHA_CULMINACION + " </li>");
                        }
                    }
                    setTimeout(function() {
                        $(".adbn-wrap").fadeOut(1500);
                    }, 5000);

                } else {
                    $(".adbn-wrap").fadeOut(0);
                }
            } catch (e) {}
        },
        error: function(objeto, error, error2) {
            alertify.alert(error);
        }
    });
}