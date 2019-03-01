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



function selectCoords(event) {
    // var x = event.clientX;
    // var y = event.clientY;
    var x = event.offsetX;
    var y = event.offsetY;
    var coords = "X coords: " + x + ", Y coords: " + y + "\n";
    document.getElementById("demo").innerText += coords;
}




// var canvas = document.getElementById("canvas");
// var ctx = canvas.getContext("2d");
// var canvasMouseX;
// var canvasMouseY;
// var canvasOffset = $("#canvas").offset();
// var offsetX = canvasOffset.left;
// var offsetY = canvasOffset.top;
// var storedLines = [];
// var startX = 0;
// var startY = 0;
// var radius = 7;

// ctx.strokeStyle = "orange";
// ctx.font = '12px Arial';

// $("#canvas").mousedown(function (e) {
//     handleMouseDown(e);
// });

// function handleMouseDown(e) {
//     canvasMouseX = parseInt(e.clientX - offsetX);
//     canvasMouseY = parseInt(e.clientY - offsetY);

//     // Put your mousedown stuff here
//     if (hitStartCircle(canvasMouseX, canvasMouseY)) {
//         fillPolyline();
//         return;
//     }
//     storedLines.push({
//         x: canvasMouseX,
//         y: canvasMouseY
//     });
//     if (storedLines.length == 1) {
//         startX = canvasMouseX;
//         startY = canvasMouseY;
//         ctx.fillStyle = "green";
//         ctx.beginPath();
//         ctx.arc(canvasMouseX, canvasMouseY, radius, 0, 2 * Math.PI, false);
//         ctx.fill();
//     } else {
//         var c = storedLines.length - 2;
//         ctx.strokeStyle = "orange";
//         ctx.lineWidth = 3;
//         ctx.beginPath();
//         ctx.moveTo(storedLines[c].x, storedLines[c].y);
//         ctx.lineTo(canvasMouseX, canvasMouseY);
//         ctx.stroke();
//     }
// }

// function hitStartCircle(x, y) {
//     var dx = x - startX;
//     var dy = y - startY;
//     return (dx * dx + dy * dy < radius * radius)
// }

// function fillPolyline() {
//     ctx.strokeStyle = "red";
//     ctx.fillStyle = "blue";
//     ctx.lineWidth = 3;
//     ctx.clearRect(0, 0, canvas.width, canvas.height);
//     ctx.beginPath();
//     ctx.moveTo(storedLines[0].x, storedLines[0].y);
//     for (var i = 0; i < storedLines.length; i++) {
//         ctx.lineTo(storedLines[i].x, storedLines[i].y);
//     }
//     ctx.closePath();
//     ctx.fill();
//     ctx.stroke();
//     storedLines = [];
// }



// $("#clear").click(function () {
//     ctx.clearRect(0, 0, canvas.width, canvas.height);
//     storedLines = [];
// });