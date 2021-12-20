document.getElementById('recursos').onsubmit = validar1;

function validar1() {
    let silla_m = document.getElementById("silla_m").value;
    let disponibilidad_m = document.getElementById("disponibilidad_m").value;
    let id_s = document.getElementById("id_s").value;
    if (silla_m == "" || disponibilidad_m == "" || id_s == "") {
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