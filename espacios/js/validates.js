
function checkBuildingId(buildingId){
    
    var expr = /[A-Z0-9]/; 
    var idBuilding = document.getElementById(buildingId).value;
    
    if (expr.test(idBuilding) && idBuilding.length > 0 && idBuilding.length < 6){ 
        document.getElementById(buildingId).style.borderColor="green";
        return true;
    }
    else{ 
        document.getElementById(buildingId).style.borderColor="red";
        return false;
    }
}

function checkText(textId){
    
    var expr = /[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/;
    var text = document.getElementById(textId).value;
    
    if (expr.test(text) && text.length > 0 && text.length < 225){ 
        document.getElementById(textId).style.borderColor="green";
        return true;
    }
    else{ 
        document.getElementById(textId).style.borderColor="red";
        return false;
    }
}

function checkNumPhone(phoneId){
    
    var expr = /^[9|6|7][0-9]{8}$/;
    var phone = document.getElementById(phoneId).value;
    
    if (expr.test(phone) && phone.length == 9){ 
        document.getElementById(phoneId).style.borderColor="green";
        return true;
    }
    else{ 
        document.getElementById(phoneId).style.borderColor="red";
        return false;
    }
}


function addBuilding() {
    
    if(checkBuildingId("idBuilding") && checkText("nameBuilding") && checkText("addressBuilding") && checkNumPhone("phoneBuilding") && checkText("responsibleBuilding")){ //Comprueba que todos los campos del formulario han sido rellenados correctamente
       return true;
    }else{
        document.getElementById("error").style.display = "block";
        return false;
    }
             
}

