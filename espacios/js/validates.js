
function checkBuildingId(buildingId){
    
    var expr = /^[A-Z]{4}[0-9]$/; 
    var idBuildingInput = document.getElementById(buildingId);

    if (expr.test(idBuildingInput.value) && idBuildingInput.value.length > 0 && idBuildingInput.value.length < 6){ 
        idBuildingInput.nextElementSibling.style.backgroundColor = "green";
        idBuildingInput.style.borderColor = "green";
        return true;
    }
    else{ 
        idBuildingInput.nextElementSibling.style.backgroundColor = "red";
        idBuildingInput.style.borderColor = "red";
        return false;
    }
}

function checkFloorId(floorId){
    
    var expr = /^[0-9A-Z]{2}$/; 
    var idFloorInput = document.getElementById(floorId);
    
    if (expr.test(idFloorInput.value) && idFloorInput.value.length > 0 && idFloorInput.value.length < 3){ 
        idFloorInput.nextElementSibling.style.backgroundColor = "green";
        idFloorInput.style.borderColor = "green";
        return true;
    }
    else{ 
        idFloorInput.nextElementSibling.style.backgroundColor = "red";
        idFloorInput.style.borderColor = "red";
        return false;
    }
}

function checkSpaceId(spaceId){
    
    var expr = /^[0-9]{5}$/; 
    var idSpaceInput = document.getElementById(spaceId);
    
    if (expr.test(idSpaceInput.value) && idSpaceInput.value.length > 0 && idSpaceInput.value.length < 7){ 
        idSpaceInput.nextElementSibling.style.backgroundColor = "green";
        idSpaceInput.style.borderColor = "green";
        return true;
    }
    else{ 
        idSpaceInput.nextElementSibling.style.backgroundColor = "red";
        idSpaceInput.style.borderColor = "red";
        return false;
    }
}


function checkText(textId){
    
    var expr = /[A-Za-z0-9ñÑ-áéíóúÁÉÍÓÚ]*$/;
    var textInput = document.getElementById(textId);
    
    if (expr.test(textInput.value) && textInput.value.length > 0 && textInput.value.length < 225){
        textInput.nextElementSibling.style.backgroundColor = "green"; 
        textInput.style.borderColor = "green";
        return true;
    }
    else{
        textInput.nextElementSibling.style.backgroundColor = "red";  
        textInput.style.borderColor = "red";
        return false;
    }
}


function checkNumPhone(phoneId){
    
    var expr = /^[9|6|7][0-9]{8}$/;
    var phoneInput = document.getElementById(phoneId);
    
    if (expr.test(phoneInput.value) && phoneInput.value.length == 9){
        phoneInput.nextElementSibling.style.backgroundColor = "green";  
        phoneInput.style.borderColor = "green";
        return true;
    }
    else{ 
        phoneInput.nextElementSibling.style.backgroundColor = "red";  
        phoneInput.style.borderColor = "red";
        return false;
    }
}


function checkSurface(surfaceId){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;
    var surfaceInput = document.getElementById(surfaceId);

    if(surfaceInput.value.length == 0){
        surfaceInput.nextElementSibling.style.backgroundColor = "grey"; 
        surfaceInput.style.borderColor = "grey";
        return true;
    }
    
    if (expr.test(surfaceInput.value) && surfaceInput.value.length < 12 && surfaceInput.value <= 99999999.99){ 
        surfaceInput.nextElementSibling.style.backgroundColor = "green";  
        surfaceInput.style.borderColor = "green";
        return true;
    }
    else{ 
        surfaceInput.nextElementSibling.style.backgroundColor = "red";  
        surfaceInput.style.borderColor = "red";
        return false;
    }
}


function checkNumberInventory(numInventoryId){
    
    var expr =/^([0-9]{6}|[#]{6})$/;
    var numInventoryInput = document.getElementById(numInventoryId);

    if(numInventory.value.length == 0){
        numInventoryInput.nextElementSibling.style.backgroundColor = "grey"; 
        numInventoryInput.style.borderColor = "grey";
        return true;
    }
    
    if(numInventory.value.length > 0){
        if (expr.test(numInventory.value) && numInventory.value.length < 7){
            numInventoryInput.nextElementSibling.style.backgroundColor = "green"; 
            numInventoryInput.style.borderColor = "green";
            return true;
        }
        else{ 
            numInventoryInput.nextElementSibling.style.backgroundColor = "red";
            numInventoryInput.style.borderColor = "red";
            return false;
        }
    }
}


function checkSurfaceSpace(surfaceId){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;
    var surfaceInput = document.getElementById(surfaceId);
    
    if(surfaceInput.value.length > 0){
        if (expr.test(surface) && surface.length < 12 && surface <= 99999999.99){
            surfaceInput.nextElementSibling.style.backgroundColor = "green"; 
            surfaceInput.style.borderColor="green";
            return true;
        }
        else{ 
            surfaceInput.nextElementSibling.style.backgroundColor = "red";
            surfaceInput.style.borderColor = "red";
            return false;
        }
    }
}


function validateUpdloadFile(imgId) {
    var validFileExtensions = [".jpg", ".jpeg",".png"], 
        img = document.getElementById(imgId);

    if (img.type == "file") {
        var fileName = img.value;
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






function checkUser(usernameId){
    
   var expr = /[A-Za-z0-9]*$/;
   var usernameInput = document.getElementById(usernameId);
   
   if (expr.test(username.value) && username.value.length > 0 && username.value.length < 225){
        usernameInput.nextElementSibling.style.backgroundColor = "green"; 
        usernameInput.style.borderColor = "green";
       return true;
   }
   else{
        usernameInput.nextElementSibling.style.backgroundColor = "red";  
        usernameInput.style.borderColor = "red";
       return false;
   }
}




function checkPassword(passwordId){

    var expr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;
    var passwordInput = document.getElementById(passwordId);
    var passwordBox =  document.getElementById("passwordAlert");
    var lowercase = document.getElementById("lowercase");
    var uppercase = document.getElementById("uppercase");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    

    if(passwordInput.value){

        if(passwordInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }

    
        if(lowerCaseLetters.test(passwordInput.value)) {  
            lowercase.classList.remove("invalid");
            lowercase.classList.add("valid");
        } else {
            lowercase.classList.remove("valid");
            lowercase.classList.add("invalid");
        }

    
        if(upperCaseLetters.test(passwordInput.value)) {  
            uppercase.classList.remove("invalid");
            uppercase.classList.add("valid");
        } else {
            uppercase.classList.remove("valid");
            uppercase.classList.add("invalid");
        }

    
        if(numbers.test(passwordInput.value)) { 
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }
        

        if (expr.test(passwordInput.value) && passwordInput.value.length >= 8 && passwordInput.value.length < 225){
            passwordBox.style.display = 'none';
            passwordInput.nextElementSibling.style.backgroundColor = "green"; 
            passwordInput.style.borderColor = "green";
            document.getElementById("passwordConfirm").type = "password";
            return true;
        }
        else{
            passwordBox.style.display = 'block';
            passwordInput.nextElementSibling.style.backgroundColor = "red";  
            passwordInput.style.borderColor = "red";
            return false;
        }

    } else {
        passwordBox.style.display = 'none';
        passwordInput.nextElementSibling.style.backgroundColor = "#aaa"; 
        passwordInput.style.borderColor =  "#aaa";
        document.getElementById("passwordConfirm").type = "hidden";
    }
}




function checkConfirmPassword(confirmPasswordId){
    
    var confirmPasswordInput = document.getElementById(confirmPasswordId);
    var passwordInput = document.getElementById("password");

    if(passwordInput.value.length !== null && confirmPasswordInput){
        if (passwordInput.value == confirmPasswordInput.value){
            confirmPasswordInput.nextElementSibling.style.backgroundColor = "green"; 
            confirmPasswordInput.style.borderColor = "green";
            return true;
        }
        else{
            confirmPasswordInput.nextElementSibling.style.backgroundColor = "red";  
            confirmPasswordInput.style.borderColor = "red";
            return false;
        }
    } 
 }


function checkDNI(dniId) {
    var dniInput = document.getElementById(dniId);
    var numberDNI, letterDNI, validLetter
    var expr = /^\d{8}[a-zA-Z]$/;
   
    if(expr.test(dniInput.value)){
        numberDNI = dniInput.value.substr(0, dniInput.value.length - 1);
        letterDNI = dniInput.value.substr(dniInput.value.length - 1, 1);
        numberDNI = numberDNI % 23;
        validLetter = 'TRWAGMYFPDXBNJZSQVHLCKET';
        validLetter = validLetter.substring(numberDNI, numberDNI + 1);
        if (letterDNI.toUpperCase() != validLetter.toUpperCase()) {
            dniInput.nextElementSibling.style.backgroundColor = "red";  
            dniInput.style.borderColor = "red";
            return false;
        }else{
            dniInput.nextElementSibling.style.backgroundColor = "green"; 
            dniInput.style.borderColor = "green";
            return true;
        }
    }else{
        dniInput.nextElementSibling.style.backgroundColor = "red";  
        dniInput.style.borderColor = "red";
        return false;
    }
}


function checkDate(dateId){
    var dateInput = document.getElementById(dateId);
    var expr2 = /^(0[1-9]|[12][0-9]|3[01])[\- \/.](?:(0[1-9]|1[012])[\- \/.](19|20)[0-9]{2})$/;
    var dateFormat = new Date(dateInput.value);
    var CurrentDate = new Date();

    if(expr2.test(dateInput.value) && (CurrentDate.getFullYear() - dateFormat.getFullYear()) > 18){
        dateInput.nextElementSibling.style.backgroundColor = "green";  
        dateInput.style.borderColor = "green";
        return true;    
    } else {
        dateInput.nextElementSibling.style.backgroundColor = "red";  
        dateInput.style.borderColor = "red";
        return false;
    }

}

function checkDate(dateInput){
    // var dateInput = document.getElementById(dateId);
    var expr = /^(0[1-9]|[12][0-9]|3[01])[\- \/.](?:(0[1-9]|1[012])[\- \/.](19|20)[0-9]{2})$/;
    var dateArray = dateInput.value.split("/");
    var dateConvert = dateArray[1] + '/' + dateArray[0] + '/' + dateArray[2];
    var dateFormat = new Date(dateConvert);
    var CurrentDate = new Date();

    if(dateInput.value.length === 10 && expr.test(dateInput.value) && (CurrentDate.getFullYear() - dateFormat.getFullYear()) > 18){
        dateInput.nextElementSibling.style.backgroundColor = "green";  
        dateInput.style.borderColor = "green";
        return true;    
    } else {
        dateInput.nextElementSibling.style.backgroundColor = "red";  
        dateInput.style.borderColor = "red";
        return false;
    }

}


function checkEmail(emailId){
    var emailInput = document.getElementById(emailId);
    var expr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(emailInput.value.length > 0 && expr.test(emailInput.value)){
        emailInput.nextElementSibling.style.backgroundColor = "green";  
        emailInput.style.borderColor = "green";
        return true;    
    } else {
        emailInput.nextElementSibling.style.backgroundColor = "red";  
        emailInput.style.borderColor = "red";
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


function validateAddUser() {

    if(checkUser("username") && checkPassword("password") && checkConfirmPassword("passwordConfirm") && checkText("name") && checkText("surname") && checkDNI("dni") 
     && checkDate(document.getElementsByClassName("date")[0]) && checkEmail("email") && checkNumPhone("phone")) { 
        document.getElementsByName("submit")[0].disabled = false;
        return true;
    }else{
        document.getElementsByName("submit")[0].disabled = true;
        return false;
    }

}



function validateEditUser() {

    if(checkUser("username") && checkText("name") && checkText("surname") && checkDNI("dni") 
     && checkDate(document.getElementsByClassName("date")[0]) && checkEmail("email") && checkNumPhone("phone")) {
        if(document.getElementsByName("password")[0].value) {
            if(checkPassword("password") && checkConfirmPassword("passwordConfirm")){
                document.getElementsByName("submit")[0].disabled = false;
                return true;
            } else {
                document.getElementsByName("submit")[0].disabled = true;
                return false;
            }
        }
        document.getElementsByName("submit")[0].disabled = false;
        return true;
    }else{
        document.getElementsByName("submit")[0].disabled = true;
        return false;
    }

}


function validateCheckboxes() {

    var checkboxChecked = [];
    var checkbox = document.getElementsByName('action');

    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i].checked) {
            checkboxChecked.push({"id":checkbox[i].value});
        }
    }
    document.getElementById("actions").value = JSON.stringify(checkboxChecked);

    console.log(document.getElementById("actions").value);
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





