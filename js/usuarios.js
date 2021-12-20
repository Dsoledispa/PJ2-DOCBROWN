document.getElementById('usuarios').onsubmit = validar1;

function validar1() {
    let nombre_u = document.getElementById("nombre_u").value;
    let apellido_u = document.getElementById("apellido_u").value;
    let correo_u = document.getElementById("correo_u").value;
    let contraseña_u = document.getElementById("contraseña_u").value;
    let tipo_u = document.getElementById("tipo_u").value;
    let disponibilidad_u = document.getElementById("disponibilidad_u").value;
    if (nombre_u == "" || apellido_u == "" || correo_u == "" || contraseña_u == "" || tipo_u == "" || disponibilidad_u == "") {
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