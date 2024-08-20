function formatCurrency(valor) {
    let value = valor.value.replace(/\D/g, '')
    value = value.replace(/(\d)(\d{8})$/, '$1.$2');
    value = value.replace(/(\d)(\d{5})$/, '$1.$2');
    value = value.replace(/(\d)(\d{2})$/, '$1,$2');
    valor.value = value
}

function formatCurrencyBlur(valor) {
    let value = valor.value.replace(/R\$|\./g, '').replace(',', '.')
    valor.value = value
}

function apenasNumeros(valor) {
    let value = valor.value.replace(/\D/g, '');
    valor.value = value
}