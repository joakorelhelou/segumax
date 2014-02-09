/**
 * @author joaquin
 */

//---------Cerrar un div
function closeDiv(divId){
		div=document.getElementById(divId);
		if(div.style.display!='none')
			div.style.display='none';
		else div.style.display='inline';
	}
	
////----------Validar Formulario
function validateForm(form,role){
	var returnValue = true;
	if(form.userName.value.length<3){
		returnValue=false;
		closeDiv(document.getElementById("nameError"));
	}
	if(form.userLastName.value.length<3){
		returnValue=false;
		closeDiv(document.getElementById("lastNameError"));
	}
	if(form.userDni.value.length<1){
		returnValue=false;
		closeDiv(document.getElementById("DniError"));
	}
}



    