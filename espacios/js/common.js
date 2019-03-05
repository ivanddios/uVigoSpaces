//Function JQuery to limit the time of alerts messages
// $(document).ready(function() {
//     setTimeout(function() {
//         $(".alert").alert('close');
//     }, 4000);
// });


function map(srcImage) {
    
    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d"),
        inputCoords = document.getElementById("coordsSpace"),
        storedLines = [], //Lineas provisionales antes del poligono
        polyLines = [],	//Poligono Final
        radius = 10; //Radio del circle inicial
        loadImage();


    function loadImage() {
        var image = new Image();
        image.src = srcImage;
        image.onload = function(){
            canvas.width = this.width;
            canvas.height = this.height;
            canvas.style.background = "url(" + srcImage + ")";
            //ctx.drawImage(image,0,0);
        };
    };

        //Obtenemos las coordenads del mouse por cada click
    function selectCoords(event) {
        return {
            x: event.offsetX,
            y: event.offsetY
        };
    }

    $("#canvas").mousedown(function (event) {
        var pos = selectCoords(event); //Obtenemos las coordenads del raton cada vez que se clicka
        if (isInitialPoint(pos)) { //Si coincide con las que marcan el punto inicial cerramos el poligono
            polyLines.push(storedLines);
            storedLines = [];
            ctx.clearRect(0, 0, canvas.width, canvas.height); //Eliminamos los puntos de referencia del plano
            for(var i=0; i<polyLines.length; i++){
                fillPolyline(polyLines[i]);
            }
        }
        else
        {
            inputCoords.value = inputCoords.value + ' ' + pos.x + ' ' + pos.y;
            storedLines.push(pos);
            drawPoint();
        }
    });

    function drawPoint() {
            ctx.fillStyle = "rgba(255, 255, 255, 0.5)";
            ctx.strokeStyle = "#4F95EA";
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(storedLines[0].x, storedLines[0].y);
            for(var i=0; i<storedLines.length; ++i) {
                ctx.fillRect(storedLines[i].x - radius/2, storedLines[i].y - radius/2, radius, radius);
                ctx.strokeRect(storedLines[i].x - radius/2, storedLines[i].y - radius/2, radius, radius);
                ctx.lineTo(storedLines[i].x,storedLines[i].y);
            }       
            ctx.stroke();
            ctx.fill();
    };


    function isInitialPoint(position) {

        if(storedLines[0] != null){
            var start = storedLines[0]
        }else {
            var start = {x:0,y:0};
        }
            dx = position.x - start.x,
            dy = position.y - start.y;
        return (dx * dx + dy * dy < radius * radius)
    }


    function fillPolyline(lines) {
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
       // ctx.addHitRegion({'id': 'The First Button', 'cursor': 'pointer'});
        ctx.stroke();
    }




    $("#Clear").click(function () {
         polyLines = [];
         storedLines = [];
         inputCoords.value = "";
         ctx.clearRect(0, 0, canvas.width, canvas.height); //Eliminamos los puntos de referencia del plano
         loadImage();
    });


    // $("#clearLast").click(function () {
    //     storedLines.pop();
    //     ctx.clearRect(0, 0, canvas.width, canvas.height); //Eliminamos los puntos de referencia del plano
    //     drawPoint();
    // });

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

