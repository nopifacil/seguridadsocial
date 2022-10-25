let tableAsociados;
let rowTable = "";
document.addEventListener('DOMContentLoaded', function() {

    tableAsociados = $('#tableAsociados').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Asociados/getAsociados",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_asociado" },
            { "data": "primer_nombre" },
            { "data": "segundo_nombre" },
            { "data": "primer_apellido" },
            { "data": "segundo_apellido" },
            { "data": "email_user" },
            { "data": "celular" },
            { "data": "nombrerol" },
            { "data": "status" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [{
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr": "Copiar",
            "className": "btn btn-secondary"
        }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr": "Exportar a Excel",
            "className": "btn btn-success"
        }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Exportar a PDF",
            "className": "btn btn-danger"
        }, {
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr": "Exportar a CSV",
            "className": "btn btn-info"
        }],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });

    if (document.querySelector("#formAsociado")) {
        let formAsociado = document.querySelector("#formAsociado");
        formAsociado.onsubmit = function(e) {
            e.preventDefault();            
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strPrimerNombre = document.querySelector('#PrimerNombre').value;
            let strPrimerApellido = document.querySelector('#txtPrimerApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let intTipoAsociado = document.querySelector('#listRolid').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let intStatus = document.querySelector('#listStatus').value;

            if ( strIdentificacion == '' || strPrimerApellido == '' || strPrimerNombre == '' || strEmail == '' || intTelefono == '' || intTipoAsociado == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Asociados/setAsociado';
            let formData = new FormData(formAsociado);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableAsociados.api().ajax.reload();
                        } else {
                            htmlStatus = intStatus == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strPrimerNombre;
                            rowTable.cells[2].textContent = strPrimerApellido;
                            rowTable.cells[3].textContent = strEmail;
                            rowTable.cells[4].textContent = intTelefono;
                            rowTable.cells[5].textContent = document.querySelector("#listRolid").selectedOptions[0].text;
                            rowTable.cells[6].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#modalFormAsociado').modal("hide");
                        formAsociado.reset();
                        swal("Asociados", objData.msg, "success");
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                return false;
            }
        }
    }
   
    //Actualizar Perfil
    if (document.querySelector("#formPerfil")) {
        let formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function(e) {
            e.preventDefault();
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;

            if (strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            if (strPassword != "" || strPasswordConfirm != "") {
                if (strPassword != strPasswordConfirm) {
                    swal("Atención", "Las contraseñas no son iguales.", "info");
                    return false;
                }
                if (strPassword.length < 5) {
                    swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
                    return false;
                }
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Usuarios/putPerfil';
            let formData = new FormData(formPerfil);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                return false;
            }
        }
    }
}, false);

function fntViewAsociado(id_asociado) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Asociados/getAsociado/' + id_asociado;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                let estadoAsociado = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                
                document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                document.querySelector("#celPrimerNombre").innerHTML = objData.data.primer_nombre;
                document.querySelector("#celPrimerApellido").innerHTML = objData.data.primer_apellido;
                document.querySelector("#celTelefono").innerHTML = objData.data.celular;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTipoAsociado").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoAsociado;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                $('#modalViewUser').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditAsociado(element, id_asociado) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Asociado";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Asociados/getAsociado/' + id_asociado;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);

            if (objData.status) {
                document.querySelector("#idAsociado").value = objData.data.id_asociado;
                document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
                document.querySelector("#txtPrimerNombre").value = objData.data.primer_nombre;
                document.querySelector("#txtPrimerApellido").value = objData.data.primer_apellido;
                document.querySelector("#txtTelefono").value = objData.data.celular;
                document.querySelector("#txtEmail").value = objData.data.email_user;
                document.querySelector("#listRolid").value = objData.data.idrol;
                $('#listRolid').selectpicker('render');

                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
        }

        $('#modalFormAsociado').modal('show');
    }
}

function fntDelAsociado(id_asociado) {

    let idAsociado = id_asociado;
    swal({
        title: "Eliminar Asociado",
        text: "¿Realmente quiere eliminar el Asociado?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Asociados/delAsociado';
            let strData = "idAsociado=" + idAsociado;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableAsociados.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }

    });

}


function openModal() {

    document.querySelector('#idAsociado').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Asociado";
    document.querySelector("#formAsociado").reset();
    $('#modalFormAsociado').modal('show');
}

