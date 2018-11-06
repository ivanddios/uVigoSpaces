
function checkBuildingId(buildingId){
    
    var expr = /^[A-Z]{4}[0-9]$/; 
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

function checkFloorId(floorId){
    
    var expr = /^[0-9A-Z]{2}$/; 
    var idFloor = document.getElementById(floorId).value;
    
    if (expr.test(idFloor) && idFloor.length > 0 && idFloor.length < 3){ 
        document.getElementById(floorId).style.borderColor="green";
        return true;
    }
    else{ 
        document.getElementById(floorId).style.borderColor="red";
        return false;
    }
}

function checkSpaceId(spaceId){
    
    var expr = /^[0-9]{5}$/; 
    var idSpace = document.getElementById(spaceId).value;
    
    if (expr.test(idSpace) && idSpace.length > 0 && idSpace.length < 7){ 
        document.getElementById(spaceId).style.borderColor="green";
        return true;
    }
    else{ 
        document.getElementById(spaceId).style.borderColor="red";
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


function checkSurface(surfaceId){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;
    var surface = document.getElementById(surfaceId).value;
    
    if (expr.test(surface) && surface.length < 12 && surface <= 99999999.99){ 
        document.getElementById(surfaceId).style.borderColor="green";
        return true;
    }
    else{ 
        document.getElementById(surfaceId).style.borderColor="red";
        return false;
    }
}


function checkNumberInventory(numInventoryId){
    
    var expr =/^([0-9]{6}|[#]{6})$/;
    var numInventory = document.getElementById(numInventoryId).value;
    
    if(numInventory.length > 0){
        if (expr.test(numInventory) && numInventory.length < 7){ 
            document.getElementById(numInventoryId).style.borderColor="green";
            return true;
        }
        else{ 
            document.getElementById(numInventoryId).style.borderColor="red";
            return false;
        }
    }
}


function checkSurfaceSpace(surfaceId){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;
    var surface = document.getElementById(surfaceId).value;
    
    if(surface.length > 0){
        if (expr.test(surface) && surface.length < 12 && surface <= 99999999.99){ 
            document.getElementById(surfaceId).style.borderColor="green";
            return true;
        }
        else{ 
            document.getElementById(surfaceId).style.borderColor="red";
            return false;
        }
    }
}






function validateBuilding() {
    
    if(checkBuildingId("idBuilding") && checkText("nameBuilding") && checkText("addressBuilding") && checkNumPhone("phoneBuilding") && checkText("responsibleBuilding")) {
        document.getElementsByName("submit")[0].disabled = false;
        // document.getElementById("error").style.display = "none";
    }else{
        document.getElementsByName("submit")[0].disabled = true;
        // document.getElementsByName("error")[0].style.display = "block";
        return false;
    }
             
}


function validateFloor() {
    
    if(checkBuildingId("idBuilding") && checkFloorId("idFloor") && checkText("nameFloor") && checkSurface("surfaceBuildingFloor") && checkSurface("surfaceUsefulFloor")) { 
        document.getElementsByName("submit")[0].disabled = false;
        // document.getElementById("error").style.display = "none";
    }else{
        document.getElementsByName("submit")[0].disabled = true;
        // document.getElementsByName("error")[0].style.display = "block";
        return false;
    }
             
}


function validateSpace() {
    
    if(checkSpaceId("idSpace") && checkText("nameSpace")) { 
        //var surface = document.getElementById("surfaceSpace").value;
        //var numInventory = document.getElementById("numberInventorySpace").value;
        //document.getElementsByName("submit")[0].disabled = false;
        
        // if(surface.length > 0){
        //     if(checkSurfaceSpace("surfaceSpace")){
        //         document.getElementsByName("submit")[0].disabled = false;
        //     }
        // }

        // if(numInventory.length > 0){
        //     if(checkNumberInventory("numberInventorySpace")){
        //         document.getElementsByName("submit")[0].disabled = false;
        //     }
        // }

        document.getElementsByName("submit")[0].disabled = false;
        // document.getElementById("error").style.display = "none";
    }else{
        document.getElementsByName("submit")[0].disabled = true;
        // document.getElementsByName("error")[0].style.display = "block";
        return false;
    }
             
}

