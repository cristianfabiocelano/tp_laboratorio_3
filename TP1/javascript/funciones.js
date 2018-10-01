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
/// <reference path = "validacionesLogin.ts"/>
var Validar;
(function (Validar) {
    var Validaciones = /** @class */ (function () {
        function Validaciones() {
        }
        Validaciones.AdministrarValidaciones = function () {
            var dni = document.getElementById("txtDni").value;
            var apellido = document.getElementById("txtApellido").value;
            var nombre = document.getElementById("txtNombre").value;
            var sexo = document.getElementById("txtSexo").value;
            var legajo = document.getElementById("txtLegajo").value;
            var sueldo = document.getElementById("txtSueldo").value;
            var turno = this.ObtenerTurnoSeleccionado();
            var flagDni = false;
            if (this.ValidarCamposVacios(dni)) {
                var numeroDni = parseInt(dni);
                if (this.ValidarRangoNumerico(numeroDni, 1000000, 55000000)) {
                    flagDni = true;
                }
            }
            Validar.ValidacionesLogin.AdministarSpanError("spanDni", flagDni);
            var flagApellido = false;
            if (this.ValidarCamposVacios(apellido))
                flagApellido = true;
            Validar.ValidacionesLogin.AdministarSpanError("spanApellido", flagApellido);
            var flagNombre = false;
            if (this.ValidarCamposVacios(nombre))
                flagNombre = true;
            Validar.ValidacionesLogin.AdministarSpanError("spanNombre", flagNombre);
            var flagSexo = false;
            if (this.ValidarCombo(sexo, "---"))
                flagSexo = true;
            Validar.ValidacionesLogin.AdministarSpanError("spanSexo", flagSexo);
            var flagLegajo = false;
            if (this.ValidarCamposVacios(legajo)) {
                var numeroLegajo = parseInt(legajo);
                if (this.ValidarRangoNumerico(numeroLegajo, 100, 550)) {
                    flagLegajo = true;
                }
            }
            Validar.ValidacionesLogin.AdministarSpanError("spanLegajo", flagLegajo);
            var flagSueldo = false;
            if (this.ValidarCamposVacios(sueldo)) {
                var numeroSueldo = parseInt(sueldo);
                if (this.ValidarRangoNumerico(numeroSueldo, 8000, this.ObtenerSueldoMaximo(turno))) {
                    flagSueldo = true;
                }
            }
            Validar.ValidacionesLogin.AdministarSpanError("spanSueldo", flagSueldo);
            //---------------------------------------------------
            if (Validar.ValidacionesLogin.VerificarValidacionesLogin()) {
                var xhttp_2 = new XMLHttpRequest();
                xhttp_2.open("POST", "./backend/Administracion.php", true);
                xhttp_2.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                var data = "dni=" + dni + "&apellido=" + apellido + "&nombre=" + nombre + "&sexo=" + sexo + "&legajo=" + legajo + "&sueldo=" + sueldo + "&turno=" + turno;
                xhttp_2.send(data);
                xhttp_2.onreadystatechange = function () {
                    if (xhttp_2.readyState == 4 && xhttp_2.status == 200) {
                        if (xhttp_2.responseText) {
                            document.getElementById("divEmpty").innerHTML = "<a href='backend/Mostrar.php'> Mostrar </a>";
                        }
                        else {
                            alert("Algo salio mal.");
                        }
                    }
                };
            }
        };
        Validaciones.ValidarCamposVacios = function (valor) {
            var retorno = true;
            if (valor == "" || valor == null)
                retorno = false;
            return retorno;
        };
        Validaciones.ValidarRangoNumerico = function (valor, min, max) {
            var retorno = true;
            if (valor < min || valor > max)
                retorno = false;
            return retorno;
        };
        Validaciones.ValidarCombo = function (valor, valorErroneo) {
            var retorno = true;
            if (valor === valorErroneo)
                retorno = false;
            return retorno;
        };
        Validaciones.ObtenerTurnoSeleccionado = function () {
            var retorno = "";
            var mañana = document.getElementById("RBtnTurnoMañana").checked;
            var tarde = document.getElementById("RBtnTurnoTarde").checked;
            var noche = document.getElementById("RBtnTurnoNoche").checked;
            if (mañana == true) {
                retorno = "Mañana";
            }
            else if (tarde == true) {
                retorno = "Tarde";
            }
            else if (noche == true) {
                retorno = "Noche";
            }
            return retorno;
        };
        Validaciones.ObtenerSueldoMaximo = function (turno) {
            var retorno = 0;
            switch (turno) {
                case "Mañana":
                    retorno = 20000;
                    break;
                case "Tarde":
                    retorno = 18500;
                    break;
                case "Noche":
                    retorno = 25000;
                    break;
                default:
                    retorno = -1;
                    break;
            }
            //(<HTMLInputElement>document.getElementById('txtSueldo')).max=""+retorno;
            return retorno;
        };
        return Validaciones;
    }());
    Validar.Validaciones = Validaciones;
})(Validar || (Validar = {}));
