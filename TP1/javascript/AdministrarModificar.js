function AdministrarModificar(dni) {
    var form = document.getElementById("frmModificar");
    var input = document.getElementById("modificar");
    input.value = dni.toString();
    form.submit();
}
