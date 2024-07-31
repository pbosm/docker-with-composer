$('.x-loader').fadeOut();

function convertToReal() {
    const number = $('#realNumber').val().trim();

    if (isNaN(number) || !Number.isInteger(parseFloat(number))) {
        $('#msgErrorNumber').text('O valor inserido não é um número inteiro válido');
        return;
    }

    api.post({
        number:   number,
        function: 'NumeroRomanoController/convertToRoman'
    }).then(response => {
        $('#msgErrorNumber').text('');

        if (response.status == 'success') {
            $('#romanNumber').val(response.data);
        } 

        if (response.status == 'error') {
            $('#msgErrorNumber').text(response.data);
        } 
    }).catch(error => {
        showError('Erro interno', error);
    });
}

function convertToRoman() {
    const romanNumber = $('#romanNumber').val().trim();

    if (!isOnlyLetters(romanNumber)) {
        $('#msgErrorNumber').text('O valor inserido deve conter apenas letras');
        return;
    }

    api.post({
        romanNumber:  romanNumber,
        function:    'NumeroRomanoController/convertToReal'
    }).then(response => {
        $('#msgErrorNumber').text('');

        if (response.status == 'success') {
            $('#realNumber').val(response.data);
        } 

        if (response.status == 'error') {
            $('#msgErrorNumber').text(response.data);
        } 
    }).catch(error => {
        showError('Erro interno', error);
    });
}

function isOnlyLetters(value) {
    return /^[a-zA-Z]+$/.test(value);
}