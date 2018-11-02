//Function JQuery to limit the time of alerts messages
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
});


function validateNumberInventoryAndSurface(){
    tdInventory = document.getElementsByClassName('numberInventory');
    tdSurface = document.getElementsByClassName('surface');

    for(var i=0; i<tdInventory.length; i++){
        if(tdInventory[i].innerText == "######	"){
           // document.getElementById(tdInventory[i].id).parentNode.setAttribute("class", "numberInventory table-warning"); //Modified the class of div
            document.getElementById(tdInventory[i].id).setAttribute("class", "numberInventory table-warning"); //Modified the class of div
        }
    }

    console.log(tdSurface[0].innerText);
    for(var i=0; i<tdSurface.length; i++){
        if(tdSurface[i].innerText == "0.00 m²	"){
            //document.getElementById(tdSurface[i].id).parentNode.setAttribute("class", "numberInventory table-danger"); //Modified the class of div
            document.getElementById(tdSurface[i].id).setAttribute("class", "surface table-danger"); //Modified the class of div
        }
    }
}