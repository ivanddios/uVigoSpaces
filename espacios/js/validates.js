
function checkBuildingId(buildingId){
    
    var expr = /^[A-Z]{4}[0-9]$/; 
    var idBuilding = document.getElementById(buildingId).value;

    if (expr.test(idBuilding) && idBuilding.length > 0 && idBuilding.length < 6){ 
        document.getElementById(buildingId).nextElementSibling.style.backgroundColor = "green";
        document.getElementById(buildingId).style.borderColor = "green";
        return true;
    }
    else{ 
        document.getElementById(buildingId).nextElementSibling.style.backgroundColor = "red";
        document.getElementById(buildingId).style.borderColor = "red";
        return false;
    }
}

function checkFloorId(floorId){
    
    var expr = /^[0-9A-Z]{2}$/; 
    var idFloor = document.getElementById(floorId).value;
    
    if (expr.test(idFloor) && idFloor.length > 0 && idFloor.length < 3){ 
        document.getElementById(floorId).nextElementSibling.style.backgroundColor = "green";
        document.getElementById(floorId).style.borderColor = "green";
        return true;
    }
    else{ 
        document.getElementById(floorId).nextElementSibling.style.backgroundColor = "red";
        document.getElementById(floorId).style.borderColor = "red";
        return false;
    }
}

function checkSpaceId(spaceId){
    
    var expr = /^[0-9]{5}$/; 
    var idSpace = document.getElementById(spaceId).value;
    
    if (expr.test(idSpace) && idSpace.length > 0 && idSpace.length < 7){ 
        document.getElementById(spaceId).nextElementSibling.style.backgroundColor = "green";
        document.getElementById(spaceId).style.borderColor = "green";
        return true;
    }
    else{ 
        document.getElementById(spaceId).nextElementSibling.style.backgroundColor = "red";
        document.getElementById(spaceId).style.borderColor = "red";
        return false;
    }
}


function checkText(textId){
    
    var expr = /[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/;
    var text = document.getElementById(textId).value;
    
    if (expr.test(text) && text.length > 0 && text.length < 225){
        document.getElementById(textId).nextElementSibling.style.backgroundColor = "green"; 
        document.getElementById(textId).style.borderColor = "green";
        return true;
    }
    else{
        document.getElementById(textId).nextElementSibling.style.backgroundColor = "red";  
        document.getElementById(textId).style.borderColor = "red";
        return false;
    }
}

function checkNumPhone(phoneId){
    
    var expr = /^[9|6|7][0-9]{8}$/;
    var phone = document.getElementById(phoneId).value;
    
    if (expr.test(phone) && phone.length == 9){
        document.getElementById(phoneId).nextElementSibling.style.backgroundColor = "green";  
        document.getElementById(phoneId).style.borderColor = "green";
        return true;
    }
    else{ 
        document.getElementById(phoneId).nextElementSibling.style.backgroundColor = "red";  
        document.getElementById(phoneId).style.borderColor = "red";
        return false;
    }
}


function checkSurface(surfaceId){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;
    var surface = document.getElementById(surfaceId).value;

    if(surface.length == 0){
        document.getElementById(surfaceId).nextElementSibling.style.backgroundColor = "grey"; 
        document.getElementById(surfaceId).style.borderColor = "grey";
        return true;
    }
    
    if (expr.test(surface) && surface.length < 12 && surface <= 99999999.99){ 
        document.getElementById(surfaceId).nextElementSibling.style.backgroundColor = "green";  
        document.getElementById(surfaceId).style.borderColor = "green";
        return true;
    }
    else{ 
        document.getElementById(surfaceId).nextElementSibling.style.backgroundColor = "red";  
        document.getElementById(surfaceId).style.borderColor = "red";
        return false;
    }
}


function checkNumberInventory(numInventoryId){
    
    var expr =/^([0-9]{6}|[#]{6})$/;
    var numInventory = document.getElementById(numInventoryId).value;

    if(numInventory.length == 0){
        document.getElementById(numInventoryId).nextElementSibling.style.backgroundColor = "grey"; 
        document.getElementById(numInventoryId).style.borderColor = "grey";
        return true;
    }
    
    if(numInventory.length > 0){
        if (expr.test(numInventory) && numInventory.length < 7){
            document.getElementById(numInventoryId).nextElementSibling.style.backgroundColor = "green"; 
            document.getElementById(numInventoryId).style.borderColor = "green";
            return true;
        }
        else{ 
            document.getElementById(numInventoryId).nextElementSibling.style.backgroundColor = "red";
            document.getElementById(numInventoryId).style.borderColor = "red";
            return false;
        }
    }
}


function checkSurfaceSpace(surfaceId){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;
    var surface = document.getElementById(surfaceId).value;
    
    if(surface.length > 0){
        if (expr.test(surface) && surface.length < 12 && surface <= 99999999.99){
            document.getElementById(surfaceId).nextElementSibling.style.backgroundColor = "green"; 
            document.getElementById(surfaceId).style.borderColor="green";
            return true;
        }
        else{ 
            document.getElementById(surfaceId).nextElementSibling.style.backgroundColor = "red";
            document.getElementById(surfaceId).style.borderColor = "red";
            return false;
        }
    }
}


function validateUpdloadFile(planeFloorID) {
    var validFileExtensions = [".jpg", ".jpeg",".png"], 
        planeFloor = document.getElementById(planeFloorID);

    if (planeFloor.type == "file") {
        var fileName = planeFloor.value;
            if (fileName.length > 0) {
                for (var i = 0; i < validFileExtensions.length; i++) {
                    var validExtension = validFileExtensions[i];
                    if (fileName.substr(fileName.length - validExtension.length, validExtension.length).toLowerCase() == validExtension.toLowerCase()) {
                       return true;
                    }
                }
            }
        }
    return false;
}




function validateBuilding() {
    
    if(checkBuildingId("idBuilding") && checkText("nameBuilding") && checkText("addressBuilding") && checkNumPhone("phoneBuilding")) {
        document.getElementsByName("submit")[0].disabled = false;
    }else{
        document.getElementsByName("submit")[0].disabled = true;
    }    
}


function validateFloor() {
    
    if(checkFloorId("idFloor") && checkText("nameFloor") && checkSurface("surfaceBuildingFloor") && checkSurface("surfaceUsefulFloor")) { 
        document.getElementsByName("submit")[0].disabled = false;
    }else{
        document.getElementsByName("submit")[0].disabled = true;
    }           
}

function validateSpace() {
    
    if(checkSpaceId("idSpace") && checkText("nameSpace") && checkSurface("surfaceSpace") && checkNumberInventory("numberInventorySpace")) { 
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



function highlightNumberInventoryAndSurface(){
    tdInventory = document.getElementsByClassName('numberInventory');
    tdSurface = document.getElementsByClassName('surface');

    for(var i=0; i<tdInventory.length; i++){
        if(tdInventory[i].innerText == "######"){
            document.getElementById(tdInventory[i].id).setAttribute("class", "numberInventory table-warning"); //Modified the class of div
        }
    }
    
    for(var i=0; i<tdSurface.length; i++){
        if(tdSurface[i].innerText == "0.00 m²"){
            document.getElementById(tdSurface[i].id).setAttribute("class", "surface table-danger"); //Modified the class of div
        }
    }
}



// function validateSpace() {
    
//     if(checkSpaceId("idSpace") && checkText("nameSpace")) { 
//         //var surface = document.getElementById("surfaceSpace").value;
//         //var numInventory = document.getElementById("numberInventorySpace").value;
//         //document.getElementsByName("submit")[0].disabled = false;
        
//         // if(surface.length > 0){
//         //     if(checkSurfaceSpace("surfaceSpace")){
//         //         document.getElementsByName("submit")[0].disabled = false;
//         //     }
//         // }

//         // if(numInventory.length > 0){
//         //     if(checkNumberInventory("numberInventorySpace")){
//         //         document.getElementsByName("submit")[0].disabled = false;
//         //     }
//         // }

//         document.getElementsByName("submit")[0].disabled = false;
//         // document.getElementById("error").style.display = "none";
//     }else{
//         document.getElementsByName("submit")[0].disabled = true;
//         // document.getElementsByName("error")[0].style.display = "block";
//         return false;
//     }
             
// }

