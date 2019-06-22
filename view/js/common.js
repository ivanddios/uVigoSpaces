/*
 * File: common.js
 *
 * Description: Library of functions used in many views
 * 
 * Author: ivanddios <ivanddf1994@gmail.com>
 */


/**
* Views: All views
* 
* Limit the time of success alerts
*
* @return void
*/
$(document).ready(function() {
    setTimeout(function() {
        $(".alert-success").alert('close');
    }, 4000);
});


/**
* View: FLOOR_SHOWALL_View
*
* Show the animation while the floor's plane is loading 
* When the image finishes loading, the animation disappears
*
* @return void
*/
function loadImage(id){
     $("#loading-"+id).css("display", "none");
     $("#div-plane-"+id).css("display", "block");
 };



/**
* View: All views that contain tables
*
* Filter the rows of table by some field
*
* @return void
*/
function searchInTable() {
    let filter = document.getElementById("searchBox").value.toUpperCase(),
        tr = document.getElementById("dataTable").getElementsByTagName("tr"); 

    for (let i = 0; i < tr.length; i++) {
        let isFound = true, j=0;
        while(isFound && j < tr[i].childElementCount-1){  /* childElementCount - 1 because the last tr's child is a td where are the actions buttons */
                let td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                if (td.innerText.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                    isFound = false;
                } else {
                    tr[i].style.display = 'none';
                }
            } 
            j++;
        }
    }
}



/**
* View: All views that contain tables
*
* Filter the rows of table by some field
*
* @return void
*/
function searchInTableTest() {
    let filter = document.getElementById("searchBox").value.toUpperCase(),
        tr = document.getElementById("dataTable").getElementsByTagName("tr"); 

    for (let i = 0; i < tr.length; i++) {
        let isFound = true, j=0;
        while(isFound && j < tr[i].childElementCount){ 
                let td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                if (td.innerText.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                    isFound = false;
                } else {
                    tr[i].style.display = 'none';
                }
            } 
            j++;
        }
    }
}





/**
* View: USER_ADD_View, USER_EDIT_View, USER_EDITPROFILE_View
*
* When the user clicks on the image, this function call the previewProfilePhoto()
*
* @return void
*/
function uploadProfilePhoto(){
    $("#imageUpload").click();
}


/**
* View: USER_ADD_View, USER_EDIT_View, USER_EDITPROFILE_View
*
* Open a windows allowing a user select a image and view it.
*
* @return void
*/
function previewProfilePhoto(uploader) {
    var preview = document.getElementById('profilePhoto');
    
    if (uploader.files && uploader.files[0] ){
        var url = URL.createObjectURL(uploader.files[0]);  
        preview.setAttribute('src', url);
        document.getElementById('profilePhoto-container').style.border = 0;
    };
}


/**
* View: SPACE_SHOWALL_View
*
* Highlights the space's fields numberInventory and surface when
* the numberInventory is '######' and the surface is '0.00'
*
* @return void
*/
function highlightNumberInventoryAndSurface(){
    tdInventory = document.getElementsByClassName('numberInventory');
    tdSurface = document.getElementsByClassName('surface');

    for(var i=0; i<tdInventory.length; i++){
        if(tdInventory[i].innerText == "######"){
            document.getElementById(tdInventory[i].id).setAttribute("class", "numberInventory table-warning");
        }
    }
    
    for(var i=0; i<tdSurface.length; i++){
        if(tdSurface[i].innerText == "0.00 m²"){
            document.getElementById(tdSurface[i].id).setAttribute("class", "surface table-danger");
        }
    }
}
