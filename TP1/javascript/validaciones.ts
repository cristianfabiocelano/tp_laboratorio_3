/// <reference path = "validacionesLogin.ts"/>
namespace Validar{
    export class Validaciones {

        public static AdministrarValidaciones() {
            var dni: string = (<HTMLInputElement>document.getElementById("txtDni")).value;
            var apellido: string = (<HTMLInputElement>document.getElementById("txtApellido")).value;
            var nombre: string = (<HTMLInputElement>document.getElementById("txtNombre")).value;
            var sexo: string = (<HTMLInputElement>document.getElementById("txtSexo")).value;
            var legajo: string = (<HTMLInputElement>document.getElementById("txtLegajo")).value;
            var sueldo: string = (<HTMLInputElement>document.getElementById("txtSueldo")).value;
            var turno: string = this.ObtenerTurnoSeleccionado();

            let flagDni:boolean=false;
            if(this.ValidarCamposVacios(dni))
            {
                var numeroDni:number = parseInt(dni);
                if(this.ValidarRangoNumerico(numeroDni,1000000,55000000))
                {
                    flagDni=true;
                }
            }
            ValidacionesLogin.AdministarSpanError("spanDni",flagDni);
            
            let flagApellido:boolean=false;
            if(this.ValidarCamposVacios(apellido))
            flagApellido=true;
            ValidacionesLogin.AdministarSpanError("spanApellido",flagApellido);

            let flagNombre:boolean=false;
            if(this.ValidarCamposVacios(nombre))
            flagNombre=true;
            ValidacionesLogin.AdministarSpanError("spanNombre",flagNombre);

            let flagSexo:boolean=false;
            if(this.ValidarCombo(sexo,"---"))
            flagSexo=true;
            ValidacionesLogin.AdministarSpanError("spanSexo",flagSexo);

            let flagLegajo:boolean=false;
            if(this.ValidarCamposVacios(legajo))
            {
                var numeroLegajo:number = parseInt(legajo);
                if(this.ValidarRangoNumerico(numeroLegajo,100,550))
                {
                    flagLegajo=true;
                }
            }
            ValidacionesLogin.AdministarSpanError("spanLegajo",flagLegajo);
            
            
            let flagSueldo:boolean=false;
            if(this.ValidarCamposVacios(sueldo))
            {
                var numeroSueldo:number = parseInt(sueldo);
                if(this.ValidarRangoNumerico(numeroSueldo,8000,this.ObtenerSueldoMaximo(turno)))
                {
                    flagSueldo=true;
                }
            }
            ValidacionesLogin.AdministarSpanError("spanSueldo",flagSueldo);
            

            //---------------------------------------------------

            if(ValidacionesLogin.VerificarValidacionesLogin())
            {
               let xhttp : XMLHttpRequest = new XMLHttpRequest();
            xhttp.open("POST","./backend/Administracion.php",true);
            xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            let data:string="dni="+dni+"&apellido="+apellido+"&nombre="+nombre+"&sexo="+sexo+"&legajo="+legajo+"&sueldo="+sueldo+"&turno="+turno;
            xhttp.send(data);

            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                        if(xhttp.responseText){
                            (<HTMLDivElement>document.getElementById("divEmpty")).innerHTML ="<a href='backend/Mostrar.php'> Mostrar </a>";
                        }else{
                            alert("Algo salio mal.");
                        }
                    }
                }; 
            }
            
        }


        public static ValidarCamposVacios(valor: string): boolean {
            var retorno: boolean = true;

            if (valor == "" || valor == null)
                retorno = false;

            return retorno;
        }

        public static ValidarRangoNumerico(valor: number, min: number, max: number): boolean {
            var retorno: boolean = true;

            if (valor < min || valor > max)
                retorno = false;

            return retorno;
        }

        public static ValidarCombo(valor: string, valorErroneo: string): boolean {
            var retorno: boolean = true;

            if (valor === valorErroneo)
                retorno = false;

            return retorno;
        }

        public static ObtenerTurnoSeleccionado(): string {
            var retorno: string = "";
            var mañana: boolean = (<HTMLInputElement>document.getElementById("RBtnTurnoMañana")).checked;
            var tarde: boolean = (<HTMLInputElement>document.getElementById("RBtnTurnoTarde")).checked;
            var noche: boolean = (<HTMLInputElement>document.getElementById("RBtnTurnoNoche")).checked;

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
        }

        public static ObtenerSueldoMaximo(turno: string): number {
            var retorno: number = 0;

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
        }




    }

}
