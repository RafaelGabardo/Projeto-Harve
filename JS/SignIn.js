let email = document.getElementById('email');
let pass1 = document.getElementById('pass1');
let pass2 = document.getElementById('pass2');
let passValidate = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,36}$/;
let password = pass1.test(passValidate) + pass2.test(passValidate);

if(!password) {
    document.write('A senha deve seguir os parâmetros: <br> -Conter no mínimo 8 caracteres e no máximo 36; <br> -Conter pelo menos 1 letra maiúscula, 1 letra minúscula e pelo menos 1 número; <br> -Conter pelo menos 1 símbolo. <br>');
}