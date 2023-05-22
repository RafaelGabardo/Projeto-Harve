// Fazendo a funação para validar as senhas
function passwordValidation() {
    let pass1 = document.getElementById('pass1').value;
    let pass2 = document.getElementById('pass2').value;
    let passValidate = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,36}$/;
    let password = passValidate.test(pass1);

    if (pass1 !== pass2) alert('Senha não confere.')

    if(!password) {
        alert(`A senha deve seguir os parâmetros:
        -Conter no mínimo 8 caracteres e no máximo 36; 
        -Conter pelo menos 1 letra maiúscula; 
        -Conter pelo menos 1 letra minúscula;
        -Conter pelo menos 1 número; 
        -Conter pelo menos 1 símbolo. 
        `);
    }
}