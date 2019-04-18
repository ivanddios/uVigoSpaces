//Function JQuery to limit the time of alerts messages
$(document).ready(function() {
    setTimeout(function() {
        $(".alert-success").alert('close');
    }, 4000);
});



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



function uploadProfilePhoto(){
    $("#imageUpload").click();
}

function previewProfilePhoto(uploader) {
    var preview = document.getElementById('profilePhoto');
    
    if (uploader.files && uploader.files[0] ){
        var url = URL.createObjectURL(uploader.files[0]);  
        preview.setAttribute('src', url);
        document.getElementById('profilePhoto-container').style.border = 0;
    };
}



function showActions(idFunction){
    divFunction = document.getElementsByClassName('id-'.concat(idFunction));
    for(i=0; i<divFunction.length; i++){
        if(divFunction[i].style.display == 'block'){
            divFunction[i].style.display = 'none';
        }else{
            divFunction[i].style.display = 'block';
        }      
    }
}



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
