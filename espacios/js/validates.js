
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
    
     var expr = /[A-Za-z0-9ñÑ-áéíóúÁÉÍÓÚ]*$/;
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






function checkUser(usernameID){
    
   var expr = /[A-Za-z0-9]*$/;
   var username = document.getElementById(usernameID).value;
   
   if (expr.test(username) && username.length > 0 && username.length < 225){
       document.getElementById(usernameID).nextElementSibling.style.backgroundColor = "green"; 
       document.getElementById(usernameID).style.borderColor = "green";
       return true;
   }
   else{
       document.getElementById(usernameID).nextElementSibling.style.backgroundColor = "red";  
       document.getElementById(usernameID).style.borderColor = "red";
       return false;
   }
}




function checkPassword(passwordID){

    var expr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;
    var password = document.getElementById(passwordID).value;
    var passwordBox =  document.getElementById("passwordAlert");
    var lowercase = document.getElementById("lowercase");
    var uppercase = document.getElementById("uppercase");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    

    if(password.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
      } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
      }

   
    if(lowerCaseLetters.test(password)) {  
        lowercase.classList.remove("invalid");
        lowercase.classList.add("valid");
    } else {
        lowercase.classList.remove("valid");
        lowercase.classList.add("invalid");
    }

   
    if(upperCaseLetters.test(password)) {  
        uppercase.classList.remove("invalid");
        uppercase.classList.add("valid");
    } else {
        uppercase.classList.remove("valid");
        uppercase.classList.add("invalid");
    }

   
    if(numbers.test(password)) { 
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }
    

    if (expr.test(password) && password.length >= 8 && password.length < 225){
        passwordBox.style.display = 'none';
        document.getElementById(passwordID).nextElementSibling.style.backgroundColor = "green"; 
        document.getElementById(passwordID).style.borderColor = "green";
        return true;
    }
    else{
        passwordBox.style.display = 'block';
        document.getElementById(passwordID).nextElementSibling.style.backgroundColor = "red";  
        document.getElementById(passwordID).style.borderColor = "red";
        return false;
    }
}



function checkConfirmPassword(confirmPasswordID){
    
    var confirmPassword = document.getElementById(confirmPasswordID).value;
    var password = document.getElementById("password").value;

    
    if (password == confirmPassword){
        document.getElementById(confirmPasswordID).nextElementSibling.style.backgroundColor = "green"; 
        document.getElementById(confirmPasswordID).style.borderColor = "green";
        return true;
    }
    else{
        document.getElementById(confirmPasswordID).nextElementSibling.style.backgroundColor = "red";  
        document.getElementById(confirmPasswordID).style.borderColor = "red";
        return false;
    }
 }


function checkDNI(dniID) {
    var dni = document.getElementById(dniID).value;
    var numberDNI, letterDNI, validLetter, expr;
   
    expr = /^\d{8}[a-zA-Z]$/;
   
    if(expr.test(dni)){
        numberDNI = dni.substr(0, dni.length - 1);
        letterDNI = dni.substr(dni.length - 1, 1);
        numberDNI = numberDNI % 23;
        validLetter = 'TRWAGMYFPDXBNJZSQVHLCKET';
        validLetter = validLetter.substring(numberDNI, numberDNI + 1);
        if (letterDNI.toUpperCase() != validLetter.toUpperCase()) {
            document.getElementById(dniID).nextElementSibling.style.backgroundColor = "red";  
            document.getElementById(dniID).style.borderColor = "red";
            return false;
        }else{
            document.getElementById(dniID).nextElementSibling.style.backgroundColor = "green"; 
            document.getElementById(dniID).style.borderColor = "green";
            return true;
        }
    }else{
        document.getElementById(dniID).nextElementSibling.style.backgroundColor = "red";  
        document.getElementById(dniID).style.borderColor = "red";
        return false;
    }
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
        document.getElementsByName("submit")[0].disabled = false;
    }else{
        document.getElementsByName("submit")[0].disabled = true;
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





