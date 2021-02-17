function registrase(){
    var resultado = true;
    var dni = document.loginForm.dni.value;
    var usuario = document.loginForm.cuenta.value;
    var contra = document.loginForm.clave.value;
    var confirmar = document.loginForm.confirmarclave.value;
    var correo = document.loginForm.correo.value;
    var patron = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    var patron_dni = /[0-9]{8}[A-Z]/;
    if(dni.length === 0 && usuario.length === 0 && contra.length === 0 && confirmar.length === 0 && correo.length === 0){
        alert('Algún campo esta vacio');
        resultado = false;
    }
    if(contra !== confirmar){
        console.log('No son iguales');
        alert('Las contraseña puestas son distintas');
        resultado = false;
    }
    if(!patron.exec(correo)){
	alert('email no es válido');
        resultado = false;
    }
    var datosRegistro = {
        "dni"        : dni,
        "usuario"    : usuario,
        "contraseña" : contra,
        "correo"     : correo
    };
    return resultado;
}

function iniciarsesion(){
    usuario=document.loginForm.cuenta.value;
    contra=document.loginForm.clave.value;
    
    var datosRegistro = {
        "usuario"        : usuario,
        "contraseña"    : contra
    };
    return true;
}