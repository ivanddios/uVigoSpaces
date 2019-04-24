
function loadImageOriginal(srcImage, ctx) {
    var image = new Image();    
    image.onload = function(){
        canvas.width = this.width;
        canvas.height = this.height;
        ratioResize = 1;
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height); 
    };
    image.src = srcImage;
};

function loadImageOriginalWithSelectSpace(srcImage, coordsSpace, ctx) {
    var image = new Image();  
    image.onload = function(){
        canvas.width = this.width;
        canvas.height = this.height;
        ratioResize = 1; 
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        spacePoints = convertCoordsToImageSize(coordsSpace, ratioResize, false); 
        drawPolygon(spacePoints, ctx);
    };
    image.src = srcImage;
};

function loadImageResize(srcImage, ctx) {
    var image = new Image();
    image.onload = function(){
        canvas.width = document.body.clientWidth;
        canvas.height = (this.height/this.width)*document.body.clientWidth;
        ratioResize = this.height/canvas.height;
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height); 
    };
    image.src = srcImage;
};

function loadImageResizeWithSelectSpace(srcImage, coordsSpace, ctx) {
    var image = new Image();
    image.onload = function(){
        canvas.width = document.body.clientWidth;
        canvas.height = (this.height/this.width) * document.body.clientWidth;
        ratioResize = this.height/canvas.height;
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        spacePoints = convertCoordsToImageSize(coordsSpace, ratioResize, true); 
        drawPolygon(spacePoints, ctx);
    }; 
    image.src = srcImage;
};

function resizeCoordsToDB(position, ratioResize){

    return{
        x: Math.round(position.x * ratioResize),
        y: Math.round(position.y * ratioResize),
    };
}

function btnsFull_Resize(btnActive, btnNoActive){
    btnActive.disabled = true;
    btnActive.style.display = "none";
    btnNoActive.disabled = false;
    btnNoActive.style.display = "block";
}

function selectCoords(event) {
    return {
        x: event.offsetX,
        y: event.offsetY
    };
};

function convertCoordsToImageSize(coordsSpace, ratioResize, resizeMode){
    var arrayCoords = coordsSpace.split(", "),
        arrayXYCoords,
        spacePoints = [];

    for(var i=0; i<arrayCoords.length; i++){
        arrayXYCoords = (arrayCoords[i]).split(" ");
        if(resizeMode){
            spacePoints[i] = {x: Math.round(arrayXYCoords[0]/ratioResize), y: Math.round(arrayXYCoords[1]/ratioResize)};
        }else{
            spacePoints[i] = {x: Math.round(arrayXYCoords[0] * ratioResize), y: Math.round(arrayXYCoords[1] * ratioResize)};
        }
    }
    return spacePoints;
};

function isInitialPoint(position) {

    let start = {x:0,y:0};

    if(storedLines[0] != null){
        start = storedLines[0]
    }
    dx = position.x - start.x,
    dy = position.y - start.y;

    return (dx * dx + dy * dy < radius * radius)
};

function drawPoint(position, ctx) {
    ctx.fillStyle = "rgba(255, 255, 255, 0.5)";
    ctx.strokeStyle = 'rgb(255,20,20)';
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

function drawPolygon(polyLines, ctx) {
    ctx.fillStyle = "rgb(255,20,20,0.3)";
    ctx.strokeStyle = 'rgb(255,20,20)';
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



function viewSpace(coordsSpace, srcImage) {

    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d")
        resizeMode = true,
        fullButton =  document.getElementById("fullButton"),
        resizeButton =  document.getElementById("resizeButton");
    loadImageResizeWithSelectSpace(srcImage,coordsSpace, ctx);


    $("#fullButton").click(function () {
        resizeMode = false;
        btnsFull_Resize(fullButton, resizeButton);
        ctx.clearRect(0, 0, canvas.width, canvas.height); 
        loadImageOriginalWithSelectSpace(srcImage, coordsSpace, ctx);  
    });
    
    
    $("#resizeButton").click(function () {
        resizeMode = true;
        btnsFull_Resize(resizeButton, fullButton);
        ctx.clearRect(0, 0, canvas.width, canvas.height); 
        loadImageResizeWithSelectSpace(srcImage, coordsSpace, ctx);
    });
};

function selectSpace(coordsSpace, srcImage) {

    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d")
        inputCoords = document.getElementById("coordsSpace"),
        inputCoords.value = coordsSpace;
        savedButton = document.getElementById("saveButton"),
        clearButton = document.getElementById("clearButton"),
        fullButton = document.getElementById("fullButton"),
        resizeButton = document.getElementById("resizeButton"),
        storedLines = [],
        polyLines = [],
        isThereSpace = false,
        resizeMode = true;
        ratioResize = 1,
        radius = 10;

        
    if(!coordsSpace){
        savedButton.disabled = true;
        clearButton.disabled = true;
        fullButton.disabled = false;
        loadImageResize(srcImage, ctx);
    } else{
        isThereSpace = true;
        fullButton.disabled = false;
        resizeButton.disabled = true;
        loadImageResizeWithSelectSpace(srcImage, coordsSpace, ctx);
    }

    $("#canvas").mousedown(function (event) {
        switch (event.which) {
            case 1:
                var position = selectCoords(event);
                if (isInitialPoint(position)) { 
                    polyLines.push(storedLines);
                    storedLines = [];
                    for(var i=0; i<polyLines.length; i++){
                        drawPolygon(polyLines[i], ctx);
                    }
                    isThereSpace = true;
                    savedButton.disabled = false;
                    if(resizeMode){
                        fullButton.disabled = false;
                        resizeButton.disabled = true;
                    }else{
                        fullButton.disabled = true;
                        resizeButton.disabled = false;
                    }
                }else{
                    if(!isThereSpace){
                        fullButton.disabled = true;
                        resizeButton.disabled = true;
                        if(inputCoords.value.length === 0) {
                            coords = resizeCoordsToDB(position, ratioResize);
                            inputCoords.value = coords.x + ' ' + coords.y;
                        } else{
                            coords = resizeCoordsToDB(position, ratioResize);
                            inputCoords.value = inputCoords.value + ', ' + coords.x + ' ' + coords.y;
                        }
                        storedLines.push(position);
                        drawPoint(position, ctx);
                    } 
                }
            break;
            
            default:
            break;
        }
    });


    $("#clearButton").click(function () {
        polyLines = [];
        storedLines = [];
        inputCoords.value = "";
        isThereSpace = false;
        savedButton.disabled = true;
        clearButton.disabled = true;
        ctx.clearRect(0, 0, canvas.width, canvas.height); 
        if(resizeMode){
            fullButton.disabled = false;
            resizeButton.disabled = true;
            loadImageResize(srcImage, ctx);
         }else{
            fullButton.disabled = true;
            resizeButton.disabled = false;
            loadImageOriginal(srcImage, ctx);
         }
    });
    
    $("#fullButton").click(function () {
        resizeMode = false;
        btnsFull_Resize(fullButton,resizeButton);
        ctx.clearRect(0, 0, canvas.width, canvas.height); 
        if(isThereSpace){
            savedButton.disabled = false;
            clearButton.disabled = false;
            loadImageOriginalWithSelectSpace(srcImage, inputCoords.value, ctx);
        }else{
            savedButton.disabled = true;
            clearButton.disabled = true;
            polyLines = [];
            storedLines = [];
            inputCoords.value = "";
            loadImageOriginal(srcImage, ctx);
        }
    });
    
    
    $("#resizeButton").click(function () {
        resizeMode = true;
        btnsFull_Resize(resizeButton, fullButton);
        ctx.clearRect(0, 0, canvas.width, canvas.height); 
        if(isThereSpace){
            savedButton.disabled = false;
            clearButton.disabled = false;
           

            loadImageResizeWithSelectSpace(srcImage, inputCoords.value, ctx);
        }else{
            savedButton.disabled = true;
            clearButton.disabled = true;
            polyLines = [];
            storedLines = [];
            inputCoords.value = "";
            loadImageResize(srcImage, ctx);
        }
    });

};

function resizeImgMap(resizeMode) {

    var img = document.getElementById("plan");
        areas = document.getElementsByClassName("mapArea"),
        fullButton = document.getElementById("fullButton"),
        resizeButton = document.getElementById("resizeButton");
    var arrayCoords, ratio = 1;
    
    if(resizeMode){
        img.height = (img.naturalHeight/img.naturalWidth) * document.body.clientWidth;
        ratio = img.naturalHeight/img.height;
        btnsFull_Resize(resizeButton, fullButton);
    }else{
        ratio = img.naturalHeight/img.height;
        img.height = img.naturalHeight;
        btnsFull_Resize(fullButton, resizeButton);
    }

    for(var i=0; i<areas.length; i++){
        arrayCoords = convertCoordsToImageSize(areas[i].coords, ratio, resizeMode);
        var newCoords ="";
        for(var j=0; j<arrayCoords.length; j++){
            newCoords = newCoords + arrayCoords[j].x + ' ' + arrayCoords[j].y + ', ';
        }
        newCoords = newCoords.substring(0, newCoords.length-2);
        areas[i].coords = newCoords;
    }
    
    $('.map').maphilight();
}




