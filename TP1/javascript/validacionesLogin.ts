/// <reference path ="validaciones.ts"/>
//import {Validaciones} from "./validaciones";
namespace Validar {
    
    export class ValidacionesLogin {

        public static AdministrarValidacionesLogin() :boolean{

            var dni: string = (<HTMLInputElement>document.getElementById("txtDni")).value;
            var apellido: string = (<HTMLInputElement>document.getElementById("txtApellido")).value;


            let flagDni:boolean=false;
            if(Validaciones.ValidarCamposVacios(dni))
            {
                var numeroDni:number = parseInt(dni);
                if(Validaciones.ValidarRangoNumerico(numeroDni,1000000,55000000))
                {
                    flagDni=true;
                    
                }
                
            }
            this.AdministarSpanError("spanDni",flagDni);
            

            let flagApellido:boolean=false;
            if(Validaciones.ValidarCamposVacios(apellido))
            flagApellido=true;

            this.AdministarSpanError("spanApellido",flagApellido);

           /* if(this.VerificarValidacionesLogin())
            {
                let xhttp : XMLHttpRequest = new XMLHttpRequest();
                xhttp.open("POST","./backend/verificarUsuario.php",true);
                xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                let data:string="dni="+dni+"&apellido="+apellido;
                xhttp.send(data);

                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                            if(xhttp.responseText){
                                alert(dni);
                                
                            }else{
                                alert("Algo salio mal.");
                            }
                        }
                    };
            }*/
            return this.VerificarValidacionesLogin();

        }

        public static AdministarSpanError(id:string,ocultar:boolean)
        {
            if(ocultar)
            {
                (<HTMLSpanElement>document.getElementById(id)).style.display='none';
            }
            else
            {
                (<HTMLSpanElement>document.getElementById(id)).style.display='block';
            }
        }

        public static VerificarValidacionesLogin():boolean
        {
            var retorno:boolean =true;

            var lista = document.getElementsByTagName("span");

            for (let i = 0; i < lista.length; i++) {
                 if(lista[i].style.display=="block")
                 {
                     retorno=false;
                     break;
                 }
                
            }
            return retorno;
        }
    }
}