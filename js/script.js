document.getElementById('formulario').onsubmit = validar;

function validar() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    if (email == "") {
        alert("Tienes que introducir tu correo");
        return false;
    } else if (password == "") {
        alert("Tienes que introducir la contraseña");
        return false;
    } else {
        return true;
    }
}