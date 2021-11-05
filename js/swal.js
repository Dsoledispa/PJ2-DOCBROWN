document.getElementById('formulario').onsubmit = validar;

function validar() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    if (email == "") {
        swal({
            title: "Error",
            text: "Tienes que introducir tu correo",
            icon: "warning",
        });
        return false;
    } else if (password == "") {
        swal({
            title: "Error",
            text: "Tienes que introducir tu contraseña",
            icon: "warning",
        });
        return false;
    } else {
        return true;
    }
}