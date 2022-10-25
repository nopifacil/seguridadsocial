function openModal() {

    document.querySelector('#idEmpresa').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Empresa";
    document.querySelector("#formEmpresa").reset();
    $('#modalFormEmpresa').modal('show');
}