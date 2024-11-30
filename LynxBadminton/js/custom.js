function custom_alert(title = 'Title', content = 'Content default.', type = 'blue', columnClass = 'large') {
    $.alert({
        'title': title,
        'content': content,
        'type': type,
        'columnClass': columnClass,
    });
}

function custom_confirm(title = 'Title', content = 'Content default.', type = 'red', columnClass = 'large') {
    bandera = false;

    $.confirm({
        'title': title,
        'content': content,
        'type': type,
        'buttons': {
            confirmar: function () {
                form_delete.submit();
                console.log('Confirmación');
                bandera = true;
            },
            cancelar: function () {
                console.log('Cancelado');
            }
        },
    });

    return bandera;
}