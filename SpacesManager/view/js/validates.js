

function changeColors(element, color){
    element.style.borderColor = color; // Input 
    element.previousElementSibling.style.backgroundColor = color; //Previous Element in the same div (icon)
}


function checkBuildingId(idBuildingInput){
    
    var expr = /^[A-Z]{3}[A-Z0-9]{2}$/;

    if (expr.test(idBuildingInput.value) && idBuildingInput.value.length > 0 && idBuildingInput.value.length < 6){ 
        changeColors(idBuildingInput, "green");
        return true;
    }
    else{ 
        changeColors(idBuildingInput, "red");
        return false;
    }
}

function checkFloorId(idFloorInput){
    
    var expr = /^[0-9A-Z]{2}$/;
    
    if (expr.test(idFloorInput.value) && idFloorInput.value.length > 0 && idFloorInput.value.length < 3){ 
        changeColors(idFloorInput, "green");
        return true;
    }
    else{ 
        changeColors(idFloorInput, "red");
        return false;
    }
}

function checkSpaceId(idSpaceInput){
    
    var expr = /^[0-9]{5}$/;
    
    if (expr.test(idSpaceInput.value) && idSpaceInput.value.length > 0 && idSpaceInput.value.length < 7){ 
        changeColors(idSpaceInput, "green");
        return true;
    }
    else{ 
        changeColors(idSpaceInput, "red");
        return false;
    }
}


function checkText(textInput){
    
    var expr = /([A-Za-z0-9ñÑ-áéíóúÁÉÍÓÚ]+[\s]*)+$/;
    
    if (expr.test(textInput.value) && textInput.value.length > 0 && textInput.value.length < 225){
        changeColors(textInput, "green");
        return true;
    }
    else{ 
        changeColors(textInput, "red");
        return false;
    }
}


function checkNumPhone(phoneInput){
    
    var expr = /^[9|6|7][0-9]{8}$/;
    
    if (expr.test(phoneInput.value) && phoneInput.value.length == 9){
        changeColors(phoneInput, "green");
        return true;
    }
    else{ 
        changeColors(phoneInput, "red");
        return false;
    }
}


function checkSurface(surfaceInput){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;

    if(surfaceInput.value.length == 0){
        changeColors(surfaceInput, "grey");
        return true;
    }
    
    if (expr.test(surfaceInput.value) && surfaceInput.value.length < 12 && surfaceInput.value <= 99999999.99){ 
        changeColors(surfaceInput, "green");
        return true;
    }
    else{ 
        changeColors(surfaceInput, "red");
        return false;
    }
}


function checkNumberInventory(numInventoryInput){
    
    var expr =/^([0-9]{6}|[#]{6})$/;

    if(numInventoryInput.value.length == 0){
        changeColors(numInventoryInput, "grey");
        return true;
    }
    
    if(numInventoryInput.value.length > 0){
        if (expr.test(numInventoryInput.value) && numInventoryInput.value.length < 7){
            changeColors(numInventoryInput, "green");
            return true;
        }
        else{ 
            changeColors(numInventoryInput, "red");
            return false;
        }
    }
}


function checkSurfaceSpace(surfaceInput){
    
    var expr =/^[0-9]{1,8}([.][0-9]{1,2}){0,1}?$/;
    
    if(surfaceInput.value.length > 0){
        if (expr.test(surface) && surface.length < 12 && surface <= 99999999.99){
            changeColors(surfaceInput, "green");
            return true;
        }
        else{ 
            changeColors(surfaceInput, "red");
            return false;
        }
    }
}


function validateUpdloadFile(img) {
    var validFileExtensions = [".jpg", ".jpeg",".png"];

    
    if(img.value !== ""){
        if (img.type == "file") {
            var fileName = img.value;
                if (fileName.length > 0) {
                    for (var i = 0; i < validFileExtensions.length; i++) {
                        var validExtension = validFileExtensions[i];
                        if (fileName.substr(fileName.length - validExtension.length, validExtension.length).toLowerCase() == validExtension.toLowerCase()) {
                            img.previousElementSibling.previousElementSibling.style.backgroundColor = "green";
                            return true;
                        }
                    }
                    img.previousElementSibling.previousElementSibling.style.backgroundColor = "red";
                    return false;
                }
            }
       
    } else{
        img.previousElementSibling.previousElementSibling.style.backgroundColor = "green";
        return true;
    }
}


function checkEmail(emailInput){
    var expr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(emailInput.value.length > 0 && expr.test(emailInput.value)){
        changeColors(emailInput, "green");
            return true;
        }
        else{ 
            changeColors(emailInput, "red");
            return false;
        }

}

function checkPassword(passwordInput){

    var expr = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;
    var passwordBox =  document.getElementById("passwordAlert");
    var lowercase = document.getElementById("lowercase");
    var uppercase = document.getElementById("uppercase");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var divChangePasswd = document.getElementById("divChangePasswd");
    

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
            changeColors(passwordInput, "green");
            if(divChangePasswd){
                divChangePasswd.style.display = "block";
            }
            return true;
        }
        else{
            passwordBox.style.display = 'block';
            changeColors(passwordInput, "red");
            return false;
        }

    } else {
        passwordBox.style.display = 'none';
        changeColors(passwordInput, "#aaa");
        if(divChangePasswd){
            divChangePasswd.style.display = "none";
        }
        document.getElementById("passwordConfirm").value = "";
    }
}

function checkConfirmPassword(confirmPasswordInput){

    var passwordInput = document.getElementById("password");

    if(passwordInput.value.length !== null && confirmPasswordInput){
        if (passwordInput.value == confirmPasswordInput.value){
            changeColors(confirmPasswordInput, "green");
            return true;
        }
        else{ 
            changeColors(confirmPasswordInput, "red");
            return false;
        }
    } 
}

function checkDNI(dniInput) {
    var numberDNI, letterDNI, validLetter
    var expr = /^\d{8}[a-zA-Z]$/;
   
    if(expr.test(dniInput.value)){
        numberDNI = dniInput.value.substr(0, dniInput.value.length - 1);
        letterDNI = dniInput.value.substr(dniInput.value.length - 1, 1);
        numberDNI = numberDNI % 23;
        validLetter = 'TRWAGMYFPDXBNJZSQVHLCKET';
        validLetter = validLetter.substring(numberDNI, numberDNI + 1);
        if (letterDNI.toUpperCase() != validLetter.toUpperCase()) {
            changeColors(dniInput, "red");
            return false;
        }else{
            changeColors(dniInput, "green");
            return true;
        }
    }else{
        changeColors(dniInput, "red");
        return false;
    }
}


function checkDate(dateInput){
    var expr = /^(0[1-9]|[12][0-9]|3[01])[\- \/.](?:(0[1-9]|1[012])[\- \/.](19|20)[0-9]{2})$/;
    var dateArray = dateInput.value.split("/");
    var dateConvert = dateArray[1] + '/' + dateArray[0] + '/' + dateArray[2];
    var dateFormat = new Date(dateConvert);
    var currentDate = new Date();

    if(dateInput.value.length === 10 && expr.test(dateInput.value) && (currentDate.getFullYear() - dateFormat.getFullYear()) > 18){
        changeColors(dateInput, "green");
        return true;    
    } else {
        changeColors(dateInput, "red");
        return false;
    }

}



function validateBuilding(form) {
    
    if(checkBuildingId(form.idBuilding) && checkText(form.nameBuilding) && checkText(form.addressBuilding) && checkNumPhone(form.phoneBuilding)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }    
}


function validateFloor(form) {

    if(checkFloorId(form.idFloor) && checkText(form.nameFloor) && checkSurface(form.surfaceBuildingFloor) && checkSurface(form.surfaceUsefulFloor) && validateUpdloadFile(document.getElementById("filestyle-0"))) { 
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }           
}

function validateSpace(form) {
    
    if(checkSpaceId(form.idSpace) && checkText(form.nameSpace) && checkSurface(form.surfaceSpace) && checkNumberInventory(form.numberInventorySpace)) { 
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
        return false;
    }

}


function validateAddUser(form) {

    if(checkEmail(form.email) && checkPassword(form.password) && checkConfirmPassword(form.passwordConfirm) && checkText(form.name) && checkText(form.surname) && checkDNI(form.dni) 
     && checkDate(document.getElementsByClassName("date")[0]) && checkNumPhone(form.phone)) { 
        document.getElementById("saveButton").disabled = false;
        return true;
    }else{
        document.getElementById("saveButton").disabled = true;
        return false;
    }

}



function validateEditUser(form) {

    if(checkEmail(form.email) && checkText(form.name) && checkText(form.surname) && checkDNI(form.dni) 
     && checkDate(document.getElementsByClassName("date")[0]) && checkNumPhone(form.phone)) { 
        if(document.getElementsByName("password")[0].value) {
            if(checkPassword(form.password) && checkConfirmPassword(form.passwordConfirm)){
                document.getElementById("saveButton").disabled = false;
                return true;
            } else {
                document.getElementById("saveButton").disabled = true;
                return false;
            }
        }
        document.getElementById("saveButton").disabled = false;
        return true;
    }else{
        document.getElementById("saveButton").disabled = true;
        return false;
    }

}



function validateGroup(form) {
    
    if(checkText(form.nameGroup) && checkText(form.descripGroup)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }    
}

function validateAction(form) {

    if(checkText(form.nameAction) && checkText(form.descripAction)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }   
}

function validateFunction(form) {

    if(checkText(form.nameFunction) && checkText(form.descripFunction)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }   
}



function actionManage (idFunction, idAction, button){

    checkboxModalId = "" + idFunction + idAction;
    checkboxModal = document.getElementById(checkboxModalId);
    checkboxModal.checked = false;
    button.style.display = "none";
}


function selectAll(idFunction, toggle){
    
    checkboxes = document.getElementsByClassName(idFunction);
    for (var i = 0; i < checkboxes.length; i++) {
        actionId = checkboxes[i].value.split(',');
        buttonActionId = 'buttonAction-'+idFunction+actionId[1];
        buttonAction = document.getElementById(buttonActionId);
        if(toggle.checked == true){
            checkboxes[i].checked = true;
            buttonAction.style.display = 'block';
        } else{
            checkboxes[i].checked = false;
            buttonAction.style.display = 'none';
        }
    }
}



function inputManager(idFunction, idAction){
    toggleid = 'toggleAll-'+idFunction;
    toggle = document.getElementById(toggleid);
    checkboxModalId = "" + idFunction + idAction;
    checkboxModal = document.getElementById(checkboxModalId);
    buttonActionId = 'buttonAction-'+idFunction+idAction;
    buttonAction = document.getElementById(buttonActionId);

    if(buttonAction.style.display == 'none'){
        checkboxModal.checked = true;
        buttonAction.style.display = 'block';
    }else{
        buttonAction.style.display = 'none';
        checkboxModal.checked = false;
        toggle.checked = false;
    }
}


// function checkCheckboxes(idFunction){
//     //Evaluamos si todos los checkboxes están seleccionados, entonces checkeamos el SELECT ALL
//     checkboxes = document.getElementsByClassName(idFunction);
//     contChecked = 0;
//     for (var i = 0; i < checkboxes.length; i++) {
//         if(checkboxes[i].checked = true){
//             contChecked += 1;
//         }
//     }

//     toggleid = 'toggleAll-'+idFunction;
//     toggle = document.getElementById(toggleid);
//     if(checkboxes.length == contChecked){
//         toggle.checked = true;
//     }
// }







