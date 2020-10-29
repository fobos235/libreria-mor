var expresion = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i; //formato de email
var expresiontel=/^([0-9]+){9}$/;//<--- con esto vamos a validar el numero
var expresionesp=/\s/;//<--- con esto vamos a validar que no tenga espacios en blanco

function validar(){
    var mail = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;
    

    if(mail === "" || pass === ""){
        window.alert("No puede dejar campos vacíos");
        return false;
    }
}

function validarRegistro(){
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellidos").value;
    var email = document.getElementById("email").value;
    var tel = document.getElementById("tel").value;
    var pass = document.getElementById("pass").value;
    var re_pass = document.getElementById("re_pass").value;

    if(nombre === "" || apellido === "" || email === "" || tel === "" || pass === "" || re_pass === "" ){
        window.alert("No puede dejar campos vacíos");
        console.log("No puede dejar campos vacíos");
        return false;
    }else if(tel.length != 10){
        window.alert("El numero de teléfono debe de tener 10 dígitos.");
        return false;
    }else if(!expresiontel.test(tel)){
        window.alert("El teléfono sólo debe contener números.");
        return false;
    }else if(expresionesp.test(tel)){
        window.alert("El teléfono no debe tener espacios.");
        return false;
    }else if(pass.length < 8){
        window.alert("La contraseña debe tener al menos 8 carácteres.");
        return false;
    }if(pass != re_pass){
        window.alert("Las contraseñas no coinciden");
        return false;
    }if(!expresion.test(email)){
        window.alert("El correo electrónico debe tener el siguiente formato: \n ejemplo@correo.com");
        return false;
    }
}

function valComentario(){
    var long = document.getElementById("textarea1").value;
   
    if(long.length <= 140){
        var res = 140-long.length;
        document.getElementById("lblTxtAr1").value = "Comentario: - Restantes: " + res;
    }else if(long.length == 140){
        document.getElementById("lblTxtAr1").value = "Comentario (Max: 140)";
    }
}

function valRecuperacion(){
    var email = document.getElementById("email").value;
    if(!expresion.test(email)){
        window.alert("El correo electrónico debe tener el siguiente formato: \n ejemplo@correo.com");
        return false;
    }else if(email == ""){
        window.alert("El correo no puede estar vacío");
        return false;
    }
}