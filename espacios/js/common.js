//Function JQuery to limit the time of alerts messages
// $(document).ready(function() {
//     setTimeout(function() {
//         $(".alert").alert('close');
//     }, 4000);
// });

$(function () {
    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d"),
        storedLines = [], //Lineas provisionales antes del poligono
        polyLines = [],	//Poligono Final
        radius = 10; //Radio del circle inicial


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
            storedLines.push(pos);
            drawPoint(pos);
        }
    });

    function drawPoint(position) {
            ctx.fillStyle = 'white';
            ctx.strokeStyle = "#4F95EA";
            ctx.lineWidth = 1;
            ctx.beginPath();
            for(var i=0; i<storedLines.length; ++i) {
                ctx.fillRect(storedLines[i].x - radius/2, storedLines[i].y - radius/2, radius, radius);
                ctx.strokeRect(storedLines[i].x - radius/2, storedLines[i].y - radius/2, radius, radius);
                //ctx.lineTo(storedLines[i].x,storedLines[i].y);
            }
            ctx.lineTo(position.x, position.y);
            ctx.stroke();
            ctx.fill();
            ctx.beginPath();
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
        ctx.strokeStyle = "#4F95EA";
        ctx.fillStyle = "rgba(143, 143, 143, 0.5)";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(lines[0].x, lines[0].y);
        for (var i = 0; i < lines.length; i++) {
            ctx.lineTo(lines[i].x, lines[i].y);
        }
        ctx.closePath();
        ctx.fill();
        ctx.stroke();
    }

    $("#clearAll").click(function () {
        polyLines = [];
        storedLines = [];
        ctx.clearRect(0, 0, canvas.width, canvas.height); //Eliminamos los puntos de referencia del plano
    });
});


