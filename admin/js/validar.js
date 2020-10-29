window.addEventListener("load", function(){
    formulario.codigo.addEventListener("keypress", function(){
        return soloNumero(event);
    }, false);
});

//solo permite introducir numeros
function soloNumero(e){
    var key = window.event ? e.which : e.keyCode;
    if(key < 48 || key > 57){
        e.preventDefault();
    }
}

function validarTel(){
    document.getElementsByName("tel").className="";
    var valor = document.getElementsByName("tel").value;
    var patron = /^\d{10}$/;
    if(patron.test(document.getElementsByName("tel").value) && (!isNaN(valor))){
        return true;
    }else{
        alert("El telefono debe tener 10 numeros.\n");
        document.getElementsByName("tel").focus();
        return false;
    }
}