document.getElementById('form1').onsubmit = validar1;

function validar1() {
    let nombre_r = document.getElementById("nombre_r").value;
    let apellido_r = document.getElementById("apellido_r").value;
    let telefono_r = document.getElementById("telefono_r").value;
    let num_personas_r = document.getElementById("num_personas_r").value;
    let fecha_r = document.getElementById("fecha_r").value;
    if (nombre_r == "" || apellido_r == "" || telefono_r == "" || num_personas_r == "" || fecha_r == "") {
        swal({
            title: "Error",
            text: "Tienes que introducir datos en el formulario",
            icon: "error",
        });
        return false;
    } else {
        return true;
    }
}