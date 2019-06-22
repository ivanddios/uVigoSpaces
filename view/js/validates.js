
/*
 * File: validates.js
 *
 * Description: Library of functions used to validate inputs field and forms
 * 
 * Author: ivanddios <ivanddf1994@gmail.com>
 */


/**
* Changes the input and icon color when its value is valid or invalid
*
* @param input element Input element 
* @param string color Green or Red
*
* @return void
*/
function changeColors(element, color){
    element.style.borderColor = color;  
    element.previousElementSibling.style.backgroundColor = color; //Previous Element in the same div (icon)
}

/**
* Checks if the building's identifier is valid
*
* @param input idBuildingInput 
*
* @return boolean
*/
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

/**
* Checks if the building's floor identifier is valid
*
* @param input idFloorInput 
*
* @return boolean
*/
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

/**
* Checks if the space's identifier is valid
*
* @param input idSpaceInput 
*
* @return boolean
*/
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


/**
* Checks if the text's input value is valid
*
* @param input textInput 
*
* @return boolean
*/
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


/**
* Checks if the format of phone's number is valid
*
* @param input phoneInput 
*
* @return boolean
*/
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


/**
* Checks if the format of surface is valid
*
* @param input surfaceInput 
*
* @return boolean
*/
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


/**
* Checks if the format of inventory number is valid
*
* @param input numInventoryInput 
*
* @return boolean
*/
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


/**
* Checks if the format of space's surface is valid
*
* @param input surfaceInput 
*
* @return boolean
*/
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

/**
* Checks if the extension of image is valid
*
* @param img img 
*
* @return boolean
*/
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


/**
* Checks if user's email is valid
*
* @param input emailInput 
*
* @return boolean
*/
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

/**
* Checks if user's password is valid
*
* @param input passwordInput 
*
* @return boolean
*/
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


/**
* Checks if user's confirm password is valid
*
* @param input confirmPasswordInput 
*
* @return boolean
*/
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


/**
* Checks if user's dni is valid
*
* @param input dniInput 
*
* @return boolean
*/
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


/**
* Checks if user's birthdate is valid
*
* @param input dateInput 
*
* @return boolean
*/
function checkDate(dateInput){
    var expr = /^(0[1-9]|[12][0-9]|3[01])[\- \/.](?:(0[1-9]|1[012])[\- \/.](19|20)[0-9]{2})$/;

        if(dateInput.value.length === 10 && expr.test(dateInput.value)){
        changeColors(dateInput, "green");
        return true;    
    } else {
        changeColors(dateInput, "red");
        return false;
    }

}


/**
* Checks if building's form is valid to submit
*
* @param form form 
*
* @return void
*/
function validateBuilding(form) {
    
    if(checkBuildingId(form.idBuilding) && checkText(form.nameBuilding) && checkText(form.addressBuilding) && checkNumPhone(form.phoneBuilding)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }    
}


/**
* Checks if building's floor's form is valid to submit
*
* @param form form 
*
* @return void
*/
function validateFloor(form) {

    if(checkFloorId(form.idFloor) && checkText(form.nameFloor) && checkSurface(form.builtSurfaceFloor) && checkSurface(form.surfaceUsefulFloor) && validateUpdloadFile(document.getElementById("filestyle-0"))) { 
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }           
}

/**
* Checks if space's form is valid to submit
*
* @param form form 
*
* @return void
*/
function validateSpace(form) {
    
    if(checkSpaceId(form.idSpace) && checkText(form.nameSpace) && checkSurface(form.surfaceSpace) && checkNumberInventory(form.numberInventorySpace)) { 
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
        return false;
    }

}

/**
* Checks if user's add form is valid to submit
*
* @param form form 
*
* @return void
*/
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


/**
* Checks if user's edit form is valid to submit
*
* @param form form 
*
* @return void
*/
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


/**
* Checks if group form is valid to submit
*
* @param form form 
*
* @return void
*/
function validateGroup(form) {
    
    if(checkText(form.nameGroup) && checkText(form.descripGroup)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }    
}

/**
* Checks if action form is valid to submit
*
* @param form form 
*
* @return void
*/
function validateAction(form) {

    if(checkText(form.nameAction) && checkText(form.descripAction)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }   
}


/**
* Checks if function form is valid to submit
*
* @param form form 
*
* @return void
*/
function validateFunction(form) {

    if(checkText(form.nameFunction) && checkText(form.descripFunction)) {
        document.getElementById("saveButton").disabled = false;
    }else{
        document.getElementById("saveButton").disabled = true;
    }   
}


/**
* Manager of buttons delete (visually) actions for a functionality in GROUP_ADD_View and GROUP_EDIT_View
*
* @param string idFunction function's identifier 
* @param string idAction action's identifier 
* @param button button html button
*
* @return void
*/
function actionManage (idFunction, idAction, button){

    checkboxModalId = "" + idFunction + idAction;
    checkboxModal = document.getElementById(checkboxModalId);
    checkboxModal.checked = false;
    button.style.display = "none";
}


/**
* Selects all actions for a functionality
*
* @param string idAction action's identifier 
* @param input toggle checkbox to "SELECT ALL"
*
* @return void
*/
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


/**
* Manager to show/not show actions checkbox like buttons 
*
* @param string idFunction functions's identifier 
* @param string idAction action's identifier 
*
* @return void
*/
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








