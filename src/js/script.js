//Validate cpf, onlyLetters, numbers
jQuery.validator.addMethod("cpf", function (value, element) {
    value = jQuery.trim(value);

    value = value.replace('.', '');
    value = value.replace('.', '');
    cpf = value.replace('-', '');
    while (cpf.length < 11) cpf = "0" + cpf;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;
    for (i = 0; i < 11; i++) {
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11 - x }
    b = 0;
    c = 11;
    for (y = 0; y < 10; y++) b += (a[y] * c--);
    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11 - x; }

    var retorno = true;
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

    return this.optional(element) || retorno;

}, "Informe um CPF válido");

jQuery.validator.addMethod("onlyLetters", function (value, element) {
    let number = /([0-9])/;
    if (value.match(number)) {
        return false;
    } else {
        return true;
    }
}, "Informe um nome válido");

jQuery.validator.addMethod("onlyNumbers", function (value, element) {
    let number = /([a-zA-Z])/;
    if (value.match(number)) {
        return false;
    } else {
        return true;
    }
}, "Informe um valor válido");

//modal de sucesso
function showSuccess(msg = false, url = false) {
    $('.alert-box-success').show();

    if (msg) {
        $('.alert-box .msg').text(msg);
    }

    if (url) {
        $('.btn-no-link').hide();
        $('.btn-link').show().attr('href', url);
    }
}

//modal de error
function showError(msg = false) {
    $('.alert-box-error').show();

    if (msg) {
        $('.msg').text(msg);
    }

    $('.loader').fadeOut();
}

//modal de alert
function closeAlertBox() {
    $('.alert-box').hide();
    $('.alert-box .msg').text('');
    $('.btn-no-link').show();
    $('.btn-link').hide().attr('href', ' ');
}

var classUser   = JSON.parse(localStorage.getItem('classUser'));
var token= localStorage.getItem('token');

$('.name-user').append(classUser?.nome.charAt(0).toUpperCase() + classUser?.nome.slice(1));

function registerUser() {
    $('.x-loader').fadeOut();

    $('#registerForm').validate({
        rules: {
            txtName: {
                required: true,
                onlyLetters: true
            },
            txtEmail: {
                required: true,
                email: true
            },
            txtPassword: {
                required: true,
            },
            txtCPF: {
                required: true,
                cpf: true
            },
        },
        messages: {
            txtName: {
                required: 'Informe um nome',
                onlyLetters: 'Informe um nome válido'
            },
            txtEmail: {
                required: 'Informe um email',
                email: 'Informe um email válido'
            },
            txtPassword: {
                required: 'Informe uma senha'
            },
            txtCPF: {
                required: 'Informe um CPF',
                cpf: 'Informe um CPF válido'
            },
        },
        submitHandler: function (form) {
            api.post({
                name:     $('#txtName').val(),
                email:    $('#txtEmail').val(),
                password: $('#txtPassword').val(),
                cpf:      $('#txtCPF').val(),
                function: 'LoginController/registerUser'
            }).then(response => {
                if (response.status != 'success') {
                    $('.notification').html(response.data);
                } else {
                    document.addEventListener('keydown', function (event) {
                        event.preventDefault();
                    });

                    showSuccess('Cadastrado com sucesso!', 'loginAccess');
                }
            }).catch(error => {
                $('.notification').html('Erro ao interno', error);
            });
        }
    });
}

function loginClient() {
    $('.x-loader').fadeOut();

    $('#formLogin').validate({
        rules: {
            txtEmail: {
                required: true
            },
            txtPassword: {
                required: true,
                // minlength: 8
            },
        },
        messages: {
            txtEmail: {
                required: 'Informe um email'
            },
            txtPassword: {
                required: 'Informe sua senha'
            },
        },
        submitHandler: function (form) {
            api.post({
                email:    $('#txtEmail').val(),
                password: $('#txtPassword').val(),
                function: 'LoginController/loginClient'
            }).then(response => {
                if (response.status === 'success') {
                    $(".notification").empty();

                    let classUser = response.data[1];
                    localStorage.setItem('classUser', JSON.stringify(classUser));

                    let token = response.data[2];
                    localStorage.setItem('token', token);

                    window.location.href = 'adm/home';
                } else if (response.status == 'error') {
                    $('.notification').html(response.data);
                }
            }).catch(error => {
                $('.notification').html('Erro ao interno', error);
            });
        }
    });
}

function logout() {
    api.post({
        function: 'UsuarioService/logout',
    }).then(response => {
        if (response.data) {
            localStorage.removeItem('token');
            localStorage.removeItem('classUser');

            window.location.href = ROOT + 'loginAccess';
        }
    }).catch(error => {
        showError('Erro interno', error);
    });
}
