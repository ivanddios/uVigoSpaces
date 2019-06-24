
/*
 * File: space-plan.js
 *
 * Description: Library of functions used to manipulate the canvas elements
 * 
 * Author: ivanddios <ivanddf1994@gmail.com>
 */


/**
* Loads in canvas element a image (floor's plane) with the original dimensions
*
* @param string $srcImage The source of the image
* @param ImageData $ctxImage The underlying pixel data for the canvas area for the floor's plane
*
* @return void
*/
function loadImageOriginal(srcImage, ctxImage) {
    var image = new Image();    
    image.onload = function(){
        canvasImage.width = this.width;
        canvasImage.height = this.height;
        canvasSelection.width = canvasImage.width;
        canvasSelection.height = canvasImage.height;
        ratioResize = 1;
        ctxImage.drawImage(image, 0, 0, canvasImage.width, canvasImage.height); 
    };
    image.src = srcImage;
};

/**
* Loads in canvas element a image (floor's plane) with the original dimensions
* and over this canvas element another one with the same dimensions is placed 
* on which draws the location of the space
*
* @param string $srcImage The source of the image
* @param string $coordsSpace The coordinates of the space
* @param ImageData $ctxImage The underlying pixel data for the canvas area for the floor's plane
* @param ImageData $ctxLines The underlying pixel data for the canvas area for the transparent layer in which the space is drawn.
* @param boolean $edges If it is true, draws the points with the squares
*
* @return void
*/
function loadImageOriginalWithSelectSpace(srcImage, coordsSpace, ctxImage, ctxLines, edges) {
    var image = new Image();  
    image.onload = function(){
        canvasImage.width = this.width;
        canvasImage.height = this.height;
        canvasSelection.width = canvasImage.width;
        canvasSelection.height = canvasImage.height;
        ratioResize = 1; 
        ctxImage.drawImage(image, 0, 0, canvasImage.width, canvasImage.height);
        storedLines = convertCoordsToImageSize(coordsSpace, ratioResize, false);
        drawPolygon(storedLines, ctxLines);
        if(edges){
            drawAllPoints(storedLines, ctxLines);
        }
    };
    image.src = srcImage;
};

/**
* Loads in canvas element a image (floor's plane) with its dimensions adapted to the customer's screen.
*
* @param string $srcImage The source of the image
* @param ImageData $ctxImage The underlying pixel data for the canvas area for the floor's plane
*
* @return void
*/
function loadImageResize(srcImage, ctxImage) {
    var image = new Image();
    image.onload = function(){
        canvasImage.width = document.body.clientWidth;
        canvasImage.height = (this.height/this.width)*document.body.clientWidth;
        canvasSelection.width = canvasImage.width;
        canvasSelection.height = canvasImage.height;
        ratioResize = this.height/canvasImage.height;
        ctxImage.drawImage(image, 0, 0, canvasImage.width, canvasImage.height); 
    };
    image.src = srcImage;
};


/**
* Loads in canvas element a image (floor's plane) with its dimensions adapted to the customer's screen
* and over this canvas element another one with the same dimensions is placed 
* on which draws the location of the space resize too.
*
* @param string $srcImage The source of the image
* @param array $coordsSpace The coordinates of the space 
* @param ImageData $ctxImage The underlying pixel data for the canvas area for the floor's plane
* @param ImageData $ctxLines The underlying pixel data for the canvas area for the transparent layer in which the space is drawn.
* @param boolean $edges If it is true, draws the points with the squares
*
* @return void
*/
function loadImageResizeWithSelectSpace(srcImage, coordsSpace, ctxImage, ctxLines, edges) {
    var image = new Image();
    image.onload = function(){
        canvasImage.width = document.body.clientWidth;
        canvasImage.height = (this.height/this.width) * document.body.clientWidth;
        canvasSelection.width = canvasImage.width;
        canvasSelection.height = canvasImage.height;
        ratioResize = this.height/canvasImage.height;
        ctxImage.drawImage(image, 0, 0, canvasImage.width, canvasImage.height);
        storedLines = convertCoordsToImageSize(coordsSpace, ratioResize, true);
        drawPolygon(storedLines, ctxLines);
        if(edges){
            drawAllPoints(storedLines, ctxLines);
        }
    }; 
    image.src = srcImage;
};


/**
* Resizes the space's coordinates that the client select 
* to adapted they for the real dimensions of floor plan
*
* @param array $position The coordinates of a pixel
* @param float $ratioResize The ratio of sizes between the real dimensions of floors plane
* and the real floors plane resize
*
* @return array
*/
function resizeCoordsToDB(position, ratioResize){

    return{
        x: Math.round(position.x * ratioResize),
        y: Math.round(position.y * ratioResize),
    };
}


/**
* Changes the button active, when the user click in resize (for example)
* this button disabled and disappeared and the full button is active and visible
*
* @param html_button $btnActive Button active in this moment (Resize of Full)
* @param html_button $btnNoActive Button not active in this moment (Resize of Full)
*
* @return void
*/
function btnsFull_Resize(btnActive, btnNoActive){
    btnActive.disabled = true;
    btnActive.style.display = "none";
    btnNoActive.disabled = false;
    btnNoActive.style.display = "block";
}


/**
* Catches the coordinates in the screen when a user click
*
* @param event Event on click
*
* @return array with the coordinates x and y of the pixel
*/
function selectCoords(event) {
    return {
        x: event.offsetX,
        y: event.offsetY
    };
};


/**
* Transforms the coordinates that arrive as a string from the database 
* to an array to be able to work with them more easily
*
* @param string $coordsSpace Coordinates of the space's location in format string
* @param float $ratioResize Ratio of resizes
* @param boolean $resizeMode Flag to inform if the floor's plane is in full dimensions or not
*
* @return array with the coordinates x and y of the pixel
*/
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


/**
* Checks if the click is in the first point 
* to inform if it is necessary to create the polygon or not
*
* @param array $position Coordinates of pixel when a user clik on the screen
*
* @return true when the point is a initial point and false when it isn't
*/
function isInitialPoint(position) {

    let start = {x:0,y:0};

    if(storedLines[0] != null){
        start = storedLines[0]
    }
    dx = position.x - start.x,
    dy = position.y - start.y;

    return (dx * dx + dy * dy < radius * radius)
};

/**
* Checks if the click is over a one point drawn 
* to inform if it is possible to apply drag and drop
*
* @param array $position Coordinates of pixel when a user clik on the screen
*
* @return array with the coordinates of a one point when the pixel is a point drawn and false when it isn't
*/
function isAPoint(position) {
    for(var i = 0; i< storedLines.length; i++)   {
        dx = position.x - storedLines[i].x,
        dy = position.y - storedLines[i].y;
        
        if(dx * dx + dy * dy < radius * radius){
            return storedLines[i];
        }
    }
    return false;
};


/**
* Draws a point (square) on the layers that is over the floor's plane.
*
* @param array $position Coordinates of pixel where the square will be drawn
* @param ImageData $ctxLines The underlying pixel data for the canvas area for the transparent layer in which the space is drawn.
*
* @return void
*/
function drawPoint(position, ctxLines) {
    ctxLines.fillStyle = "rgba(255, 255, 255, 0.5)";
    ctxLines.lineWidth = 1;
    ctxLines.beginPath();
    if(storedLines.length == 1){
        ctxLines.strokeStyle = 'rgb(0, 0, 255)';
        ctxLines.moveTo(position.x, position.y);
        ctxLines.strokeRect(position.x - radius/2, position.y - radius/2, radius, radius);
        ctxLines.fillRect(position.x - radius/2, position.y - radius/2, radius, radius);
        document.getElementById("clearButton").disabled = false;
    } else {
        ctxLines.strokeStyle = 'rgb(255,20,20)';
        ctxLines.moveTo(storedLines[storedLines.length - 2].x, storedLines[storedLines.length - 2].y);
        ctxLines.strokeRect(position.x - radius/2, position.y - radius/2, radius, radius);
        ctxLines.fillRect(position.x - radius/2, position.y - radius/2, radius, radius);
        ctxLines.lineTo(position.x,position.y);
    }
    ctxLines.stroke();
    ctxLines.fill();
};


/**
* Draws all points forming a polygon with the coordinates of the space's location
* The points have a square shape
*
* @param array $polyLines Array with all points (coordinates) of the space
* @param ImageData $ctxLines The underlying pixel data for the canvas area for the transparent layer in which the space is drawn.
*
* @return void
*/
function drawAllPoints(polyLines, ctxLines) {
    ctxLines.fillStyle = "rgba(255, 255, 255, 0.5)";
    ctxLines.lineWidth = 1;
    ctxLines.beginPath();
    for (var i = 0; i < polyLines.length; i++) {
        if(i == 0){
            if(!isThereSpace){
                ctxLines.strokeStyle = 'rgb(0, 0, 255)';
            }else{
                ctxLines.strokeStyle = 'rgb(255,20,20)';
            }
            ctxLines.moveTo(polyLines[i].x, polyLines[i].y);
        } else {
            ctxLines.strokeStyle = 'rgb(255,20,20)';
            ctxLines.moveTo(polyLines[i-1].x, polyLines[i-1].y);
        }
        ctxLines.strokeRect(polyLines[i].x - radius/2, polyLines[i].y - radius/2, radius, radius);
        ctxLines.fillRect(polyLines[i].x - radius/2, polyLines[i].y - radius/2, radius, radius);
        ctxLines.lineTo(polyLines[i].x, polyLines[i].y);
        }
    ctxLines.stroke();
    ctxLines.fill();
};


/**
* Draws the polygon with the points of space's location
*
* @param array $polyLines Array with all points (coordinates) of the space
* @param ImageData $ctxLines The underlying pixel data for the canvas area for the transparent layer in which the space is drawn.
*
* @return void
*/
function drawPolygon(polyLines, ctxLines) {
    ctxLines.fillStyle = "rgb(255,20,20,0.3)";
    ctxLines.strokeStyle = 'rgb(255,20,20)';
    ctxLines.lineWidth = 1;
    ctxLines.beginPath();
    ctxLines.moveTo(polyLines[0].x, polyLines[0].y);
    for (var i = 0; i < polyLines.length; i++) {
        ctxLines.lineTo(polyLines[i].x, polyLines[i].y);
    }
    ctxLines.closePath();
    ctxLines.fill();
    ctxLines.stroke();
};


/**
* Loads a floor's plane on a canvas element and loads the space's location on another one canvas element that placed over the floor's plane
* The space's location can't be modified
* Place two listeners on the buttons to expand and reduce the plane on the screen
*
* @param string $coordsSpace Array with all points (coordinates) of the space
* @param string $srcImage The underlying pixel data for the canvas area for the transparent layer in which the space is drawn.
*
* @return void
*/
function viewSpace(coordsSpace, srcImage) {

    var canvasImage = document.getElementById("canvasImage"),
        ctxImage = canvasImage.getContext("2d")
        canvasSelection = document.getElementById("canvasSelection"),
        ctxLines = canvasSelection.getContext("2d")
        resizeMode = true,
        fullButton =  document.getElementById("fullButton"),
        resizeButton =  document.getElementById("resizeButton");
    loadImageResizeWithSelectSpace(srcImage, coordsSpace, ctxImage, ctxLines, false);


    fullButton.addEventListener("click", function() {
        resizeMode = false;
        btnsFull_Resize(fullButton, resizeButton);
        ctxImage.clearRect(0, 0, canvasImage.width, canvasImage.height);
        ctxLines.clearRect(0, 0, canvasSelection.width, canvasSelection.height); 
        loadImageOriginalWithSelectSpace(srcImage, coordsSpace, ctxImage, ctxLines, false);  
    });
    
    
    resizeButton.addEventListener("click", function() {
        resizeMode = true;
        btnsFull_Resize(resizeButton, fullButton);
        ctxImage.clearRect(0, 0, canvasImage.width, canvasImage.height);
        ctxLines.clearRect(0, 0, canvasSelection.width, canvasSelection.height);  
        loadImageResizeWithSelectSpace(srcImage, coordsSpace, ctxImage, ctxLines, false);
    });
};



/**
* Loads a floor's plane on a canvas element and loads the space's location on another one canvas element that placed over the floor's plane
* The space's location can be modified
* Place two listeners on the buttons to expand and reduce the plane on the screen
* Place another listeners over the layer that contains the space's location to allow drag and drop each point
*
* @param string $coordsSpace Array with all points (coordinates) of the space
* @param string $srcImage The underlying pixel data for the canvas area for the transparent layer in which the space is drawn.
*
* @return void
*/
function selectSpace(coordsSpace, srcImage) {

    var canvasImage = document.getElementById("canvasImage"),
        ctxImage = canvasImage.getContext("2d")
        canvasSelection = document.getElementById("canvasSelection"),
        ctxLines = canvasSelection.getContext("2d")
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
        pointMove = null,
        initXPoint = 0,
        initYPoint = 0,
        isDragging = false,
        startingPos = [],
        radius = 10;

    //If there isn't coordinates only loads the floor's plane resize    
    if(!coordsSpace){
        savedButton.disabled = true;
        clearButton.disabled = true;
        fullButton.disabled = false;
        loadImageResize(srcImage, ctxImage);
    } else{
        isThereSpace = true;
        fullButton.disabled = false;
        resizeButton.disabled = true;
        loadImageResizeWithSelectSpace(srcImage, coordsSpace, ctxImage, ctxLines, true);
    }


    /**
     * Listener to detect mousedown event over layer where the polygon is going to be drawn
     * 
     * If the click is on a drawn point, calculates the coordinates to drag  the point on the floor's plane (drag and drop)
     * If the click isn't on a drawn point, draws one point in this coordinates (square)
     * 
     */
    canvasSelection.addEventListener("mousedown", function(event){
        isDragging = false; 
        startingPos = [event.pageX, event.pageY]; 
        switch (event.which) {
            case 1:
                var position = selectCoords(event);
                var selectedPoint = isAPoint(position);
                if(selectedPoint){
                    pointMove = selectedPoint;
                    initYPoint = event.clientY - selectedPoint.y;
                    initXPoint = event.clientX - selectedPoint.x;
                } else{ 
                    if(!isThereSpace){
                        fullButton.disabled = true;
                        resizeButton.disabled = true;
                        storedLines.push(position);
                        drawPoint(position, ctxLines);
                    } 
                 }    
            break;
            
            default:
            break;
        }
    }, false);


    /**
     * Listener to detect mousemove event and do drag and drop of one point
     * 
     * Evaluates if "drag and drop" is activated. In this case, clears the selection's layer,
     * change the value of point that is dragging in global points array and re-draws all points
     * 
     */
    canvasSelection.addEventListener("mousemove", function(event) {
        if(pointMove != null){
            ctxLines.clearRect(0, 0, canvasSelection.width, canvasSelection.height);
            for(var i=0; i<storedLines; i++){
                if(storedLines[i] == pointMove){
                    storedLines[i] = pointMove
                }
            }
            pointMove.x = event.clientX - initXPoint;
            pointMove.y = event.clientY - initYPoint;
            drawAllPoints(storedLines, ctxLines);
            if(isThereSpace){
                drawPolygon(storedLines, ctxLines); 
            }
        }

        if (!(event.pageX === startingPos[0] && event.pageY === startingPos[1])) { 
            isDragging = true;
        }

    }, false);
        

    /**
     * Listener to detect mouseup event
     * 
     * Recalculates the coordinates with the values that will save in database (applying the ratioResize)
     * If the event is over initial point, draws the polygon with the global points array
     * 
     */
    canvasSelection.addEventListener("mouseup", function(event) {
        pointMove = null;
        inputCoords.value = "";
        for(var i=0; i<storedLines.length; i++){
            if(inputCoords.value.length === 0) {
                coords = resizeCoordsToDB(storedLines[i], ratioResize);
                inputCoords.value = coords.x + ' ' + coords.y;
            } else{
                coords = resizeCoordsToDB(storedLines[i], ratioResize);
                inputCoords.value = inputCoords.value + ', ' + coords.x + ' ' + coords.y;
            }
        }
        
        if (!isDragging) { 
            var position = selectCoords(event);
            if (storedLines.length > 1 && isInitialPoint(position) && !isThereSpace) { 
                polyLines.push(storedLines);
                for(var i=0; i<polyLines.length; i++){
                    drawPolygon(polyLines[i], ctxLines);
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
             }
         }
    }, false);


    /** 
    * When the user click in clear's button, resets the parametres 
    * and loads again the layer that contains the space's location
    */
    clearButton.addEventListener("click", function() {
        polyLines = [];
        storedLines = [];
        isThereSpace = false;
        savedButton.disabled = true;
        clearButton.disabled = true;
        ctxLines.clearRect(0, 0, canvasSelection.width, canvasSelection.height); 
        if(resizeMode){
            fullButton.disabled = false;
            resizeButton.disabled = true;
            loadImageResize(srcImage, ctxImage);
         }else{
            fullButton.disabled = true;
            resizeButton.disabled = false;
            loadImageOriginal(srcImage, ctxImage);
         }
    });
    
    /** 
    * When the user click in fulls's button loads the two layers
    */
    fullButton.addEventListener("click", function() {
        resizeMode = false;
        btnsFull_Resize(fullButton,resizeButton);
        ctxImage.clearRect(0, 0, canvasImage.width, canvasImage.height);
        ctxLines.clearRect(0, 0, canvasSelection.width, canvasSelection.height); 
        if(isThereSpace){
            savedButton.disabled = false;
            clearButton.disabled = false;
            loadImageOriginalWithSelectSpace(srcImage, inputCoords.value, ctxImage, ctxLines, true);
            
        }else{
            savedButton.disabled = true;
            clearButton.disabled = true;
            polyLines = [];
            storedLines = [];
            loadImageOriginal(srcImage, ctxImage);
        }
    });
    
    /** 
    * When the user click in resize's button loads the two layers
    */
    resizeButton.addEventListener("click", function() {
        resizeMode = true;
        btnsFull_Resize(resizeButton, fullButton);
        ctxImage.clearRect(0, 0, canvasImage.width, canvasImage.height);
        ctxLines.clearRect(0, 0, canvasSelection.width, canvasSelection.height); 
        if(isThereSpace){
            savedButton.disabled = false;
            clearButton.disabled = false;
            loadImageResizeWithSelectSpace(srcImage, inputCoords.value, ctxImage, ctxLines, true);
            
        }else{
            savedButton.disabled = true;
            clearButton.disabled = true;
            polyLines = [];
            storedLines = [];
            loadImageResize(srcImage, ctxImage);
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




