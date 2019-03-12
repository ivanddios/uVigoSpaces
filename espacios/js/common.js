//Function JQuery to limit the time of alerts messages
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
});


function selectSpace(srcImage) {
    
    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d"),
        inputCoords = document.getElementById("coordsSpace"),
        storedLines = [],
        polyLines = [],
        isThereSpace = false,
        radius = 10;
        loadImage();


    function loadImage() {
        var image = new Image();
        image.src = srcImage;
       
        image.onload = function(){
            canvas.width = document.body.clientWidth;
            canvas.height = (this.height/this.width)*document.body.clientWidth;
            ctx.drawImage(image, 0, 0, document.body.clientWidth, (this.height/this.width)*document.body.clientWidth); 
        };
    };

    function selectCoords(event) {
        return {
            x: event.offsetX,
            y: event.offsetY
        };
    };


    $("#canvas").mousedown(function (event) {
        switch (event.which) {
            case 1:
                var position = selectCoords(event);
                if (isInitialPoint(position)) { 
                    polyLines.push(storedLines);
                    storedLines = [];
                    for(var i=0; i<polyLines.length; i++){
                        drawPolygon(polyLines[i]);
                    }
                    isThereSpace = true;
                    document.getElementById("saveButton").disabled = false;
                }
                else
                {
                    if(!isThereSpace){
                        if(inputCoords.value != ' ' && inputCoords.value != null) {
                            inputCoords.value = inputCoords.value + ', ' + position.x + ' ' + position.y;
                        } else{
                            inputCoords.value = position.x + ' ' + position.y;
                        }
                        storedLines.push(position);
                        drawPoint(position);
                    } //else{
                    //     alert("You can only select a space");
                    // }
                }
            break;
            
            default:
            break;
        }
    });

    function isInitialPoint(position) {

        if(storedLines[0] != null){
            var start = storedLines[0]
        }else {
            var start = {x:0,y:0};
        }
            dx = position.x - start.x,
            dy = position.y - start.y;
        return (dx * dx + dy * dy < radius * radius)
    };

    function drawPoint(position) {
        ctx.fillStyle = "rgba(255, 255, 255, 0.5)";
        ctx.strokeStyle = "#4F95EA";
        ctx.lineWidth = 1;
        ctx.beginPath();
        if(storedLines.length == 1){
            ctx.moveTo(position.x, position.y);
            ctx.strokeRect(position.x - radius/2, position.y - radius/2, radius, radius);
            ctx.fillRect(position.x - radius/2, position.y - radius/2, radius, radius);
            document.getElementById("clearButton").disabled = false;
        } else {
            ctx.moveTo(storedLines[storedLines.length - 2].x, storedLines[storedLines.length - 2].y);
            ctx.strokeRect(position.x - radius/2, position.y - radius/2, radius, radius);
            ctx.fillRect(position.x - radius/2, position.y - radius/2, radius, radius);
            ctx.lineTo(position.x,position.y);
        }
        ctx.stroke();
        ctx.fill();
    };


    function drawPolygon(lines) {
        ctx.fillStyle = "rgba(143, 143, 143, 0.5)";
        ctx.strokeStyle = "#4F95EA";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(lines[0].x, lines[0].y);
        for (var i = 0; i < lines.length; i++) {
            ctx.lineTo(lines[i].x, lines[i].y);
        }
        ctx.closePath();
        ctx.fill();
        ctx.stroke();
    };


    // function showCenter(lines) {
    //     var auxXMax = 0, auxXMin=Number.MAX_VALUE, auxYMax= 0, auxYMin=Number.MAX_VALUE, X=0, Y=0;
    //     console.log(lines);
    //     for (var i = 0; i < (lines.length-1); i++) {
    //         auxXMax = Math.max(auxXMax, lines[i].x);
    //         auxXMin = Math.min(auxXMin, lines[i].x);

    //         auxYMax = Math.max(auxYMax, lines[i].y);
    //         auxYMin = Math.min(auxYMin, lines[i].y);
            
    //     }
    //     X = auxXMax - (auxXMax - auxXMin)/2;
    //     Y = auxYMax - (auxYMax - auxYMin)/2;
    //     // return {
    //     //     x: X,
    //     //     y: Y
    //     // };
    // }


    $("#clearButton").click(function () {
         polyLines = [];
         storedLines = [];
         inputCoords.value = "";
         isThereSpace = false;
         document.getElementById("saveButton").disabled = true;
         document.getElementById("clearButton").disabled = true;
         ctx.clearRect(0, 0, canvas.width, canvas.height); 
         loadImage();
    });

};



function viewSpace(coordsPlane, srcImage) {

    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d")
        spacePoints = convertCoords(coordsPlane);
        loadImage();


    function loadImage() {
        var image = new Image();
        image.src = srcImage;
           
        image.onload = function(){
            canvas.width = document.body.clientWidth;
            canvas.height = (this.height/this.width)*document.body.clientWidth;
            ctx.drawImage(image, 0, 0, document.body.clientWidth, (this.height/this.width)*document.body.clientWidth); 
            drawPolygon(spacePoints);
        };
    };

    function convertCoords(coordsPlane){
        let arrayCoords = coordsPlane.split(" "),
        spacePointsAux= [],
        spacePoints;

        for(let i=0; i<arrayCoords.length; i++){
            if(i%2) {
                spacePointsAux[i]={x: arrayCoords[i-1], y: arrayCoords[i]};
            }
        }

        spacePoints = spacePointsAux.filter(function (x) {
            return (x !== (undefined || null || ''));
        });

        return spacePoints;
    };

    function drawPolygon(polyLines) {
        ctx.fillStyle = "rgba(143, 143, 143, 0.5)";
        ctx.strokeStyle = "#4F95EA";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(polyLines[0].x, polyLines[0].y);
        for (var i = 0; i < polyLines.length; i++) {
            ctx.lineTo(polyLines[i].x, polyLines[i].y);
        }
        ctx.closePath();
        ctx.fill();
        ctx.stroke();
    };

};




// $(function () {

//         var canvas = document.getElementById("canvas"),
//         inputCoords = document.getElementById("coordsText"),
//         ctx = canvas.getContext("2d"),
//         storedLines = [], //Lineas provisionales antes del poligono
//         polyLines = [],	//Poligono Final
//         radius = 10; //Radio del circle inicial
// function fillPolyline(lines) {
//     ctx.fillStyle = "rgba(143, 143, 143, 0.5)";
//     ctx.strokeStyle = "#4F95EA";
//     ctx.lineWidth = 1;
//     ctx.beginPath();
//     ctx.moveTo(lines[0].x, lines[0].y);
//     for (var i = 0; i < lines.length; i++) {
//         ctx.lineTo(lines[i].x, lines[i].y);
//     }
//     ctx.closePath();
//     ctx.fill();
//     //ctx.addHitRegion({'id': 'The First Button'});
//     ctx.stroke();
// }

// // canvas.onclick = function (event)
// // {
// //     if (event.region) {
// //         //window.location.href = "http://stackoverflow.com";
        
// //     }
// // }

// // canvas.addEventListener('mousemove', function(event) {
// //     if(event.region) {
// //       alert('ouch, my eye :(');
// //     }
// //   });


// $("#clearAll").click(function () {

//     var coords  = "555 1907 761 1906 759 1975 553 1977",
//         res = coords.split(" "),
//         result = [];

//     for(var i=0; i<res.length; i=i+2){
//         result[i/2] = {
//                         x: res[i],
//                         y: res[i+1]
//         };
//     }
//     fillPolyline(result);

//     // polyLines = [];
//     // storedLines = [];
//     // ctx.clearRect(0, 0, canvas.width, canvas.height); //Eliminamos los puntos de referencia del plano
// });
// });

