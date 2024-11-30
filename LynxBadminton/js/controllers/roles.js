function roles(action) {
    
    switch (action) {
        case 'formEdit':
            id_role = arguments[1];
            rol = arguments[2];

            $.dialog({
                title: 'Editar Rol',
                data: {'id_rol': 1, 'rol': rol},
                type: 'blue',
                content: `url: ../classes/class_role.php?action=formEdit&role=${rol}&id_rol=${id_role}`,
                onContentReady: function () {
                    console.log(window);
                    window.ventFrame = this;
                },
            });
            break;
        case 'formNew':
            $.dialog({
                title: 'Agregar Rol',
                type: 'blue',
                content: 'url: ../classes/class_role.php?action=formNew',
                onContentReady: function () {
                    console.log(window);
                    window.ventFrame = this;
                },
            });
            break;
        case 'create':
            dataSerailized = $('#formRole').serialize()+`action=create`;

            $.ajax({
                url: "../classes/class_role.php",
                type: "post",
                dataType: "html",
                data: dataSerailized,
                beforeSend: function () {
                    $('#tableRoleData').html('<div class="w-100 d-flex justify-content-center"><span class="loader"></span></div>');
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function (htmlResponse) {
                    ventFrame.close();
                },
            });
            break;
        case 'update':
            dataSerailized = $('#formRole').serialize()+`action=update`;

            $.ajax({
                url: "../classes/class_role.php",
                type: "post",
                dataType: "html",
                data: dataSerailized,
                beforeSend: function () {
                    $('#tableRoleData').html('<div class="w-100 d-flex justify-content-center"><span class="loader"></span></div>');
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function (htmlResponse) {
                    ventFrame.close();
                },
            });
            break;
        case 'read':
            break;
        case 'delete':
            const id_to_delete = arguments[1];

            $.confirm({
                'title': 'Eliminar rol',
                'content': `¿Deseas eliminar el rol ${ id_to_delete }?`,
                'type': 'red',
                'buttons': {
                    confirmar: function () {
                        $.ajax({
                            url: '../classes/class_role.php',
                            type: 'post',
                            data: { 'action': 'delete', 'id_rol': id_to_delete },
                            success: function (htmlResponse) {
                                console.log(htmlResponse);
                                RolesTableContainer.innerHTML = htmlResponse;
                            },
                            error: function () {
                                console.log('NO SE PUDO BORRAR EL ROL');
                            }
                        });
                    },
                    cancelar: function () {
                        console.log('Cancelado');
                    }
                },
            });

            break;
        default:
            break;
    }
}