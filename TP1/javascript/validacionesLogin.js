"use strict";
/// <reference path ="validaciones.ts"/>
//import {Validaciones} from "./validaciones";
var Validar;
(function (Validar) {
    var ValidacionesLogin = /** @class */ (function () {
        function ValidacionesLogin() {
        }
        ValidacionesLogin.AdministrarValidacionesLogin = function () {
            var dni = document.getElementById("txtDni").value;
            var apellido = document.getElementById("txtApellido").value;
            var flagDni = false;
            if (Validar.Validaciones.ValidarCamposVacios(dni)) {
                var numeroDni = parseInt(dni);
                if (Validar.Validaciones.ValidarRangoNumerico(numeroDni, 1000000, 55000000)) {
                    flagDni = true;
                }
            }
            this.AdministarSpanError("spanDni", flagDni);
            var flagApellido = false;
            if (Validar.Validaciones.ValidarCamposVacios(apellido))
                flagApellido = true;
            this.AdministarSpanError("spanApellido", flagApellido);
            if (this.VerificarValidacionesLogin()) {
                var xhttp_1 = new XMLHttpRequest();
                xhttp_1.open("POST", "backend/verificarUsuario.php", true);
                xhttp_1.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                var data = "dni=" + dni + "&apellido=" + apellido;
                xhttp_1.send(data);
                xhttp_1.onreadystatechange = function () {
                    if (xhttp_1.readyState == 4 && xhttp_1.status == 200) {
                        if (xhttp_1.responseText) {
                            document.getElementById("divEmpty").innerHTML = "<a href='backend/verificarUsuario.php'> verificar si el usuario existe </a>";
                        }
                        else {
                            alert("Algo salio mal.");
                        }
                    }
                };
            }
        };
        ValidacionesLogin.AdministarSpanError = function (id, ocultar) {
            if (ocultar) {
                document.getElementById(id).style.display = 'none';
            }
            else {
                document.getElementById(id).style.display = 'block';
            }
        };
        ValidacionesLogin.VerificarValidacionesLogin = function () {
            var retorno = true;
            var lista = document.getElementsByTagName("span");
            for (var i = 0; i < lista.length; i++) {
                if (lista[i].style.display == "block") {
                    retorno = false;
                    break;
                }
            }
            return retorno;
        };
        return ValidacionesLogin;
    }());
    Validar.ValidacionesLogin = ValidacionesLogin;
})(Validar || (Validar = {}));
//# sourceMappingURL=validacionesLogin.js.map