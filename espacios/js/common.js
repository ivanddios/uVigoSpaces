//Function JQuery to limit the time of alerts messages
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
});


function loadImage(srcImage, ctx) {
    var image = new Image();
    image.src = srcImage;
       
    image.onload = function(){
        canvas.width = document.body.clientWidth;
        canvas.height = (this.height/this.width)*document.body.clientWidth;
        ctx.drawImage(image, 0, 0, document.body.clientWidth, (this.height/this.width)*document.body.clientWidth); 
    };
};

function loadImageWithSelectSpace(srcImage, spacePoints, ctx) {
    var image = new Image();
    image.src = srcImage;
       
    image.onload = function(){
        canvas.width = document.body.clientWidth;
        canvas.height = (this.height/this.width)*document.body.clientWidth;
        ctx.drawImage(image, 0, 0, document.body.clientWidth, (this.height/this.width)*document.body.clientWidth); 
        drawPolygon(spacePoints, ctx);
    };
};

function resize() {

    var img = document.getElementById('plane');
    img.height = (img.height/img.width)*document.body.clientWidth;
};

function selectCoords(event) {
    return {
        x: event.offsetX,
        y: event.offsetY
    };
};

function convertCoords(coordsSpace){
    var arrayCoords = coordsSpace.split(","),
        arrayXYCoords,
        spacePoints = [];

    for(var i=0; i<arrayCoords.length; i++){
        arrayXYCoords = ("" + arrayCoords[i]).split(" ");
        spacePoints[i] = {x: arrayXYCoords[0], y: arrayXYCoords[1]};
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

function drawPolygon(polyLines, ctx) {
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

function selectSpace(srcImage) {
    
    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d")
        inputCoords = document.getElementById("coordsSpace"),
        savedButton =  document.getElementById("saveButton"),
        clearButton =  document.getElementById("clearButton"),
        storedLines = [],
        polyLines = [],
        isThereSpace = false,
        radius = 10;
    loadImage(srcImage, ctx);


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
                        drawPoint(position, ctx);
                    } //else{
                    //     alert("You can only select a space");
                    // }
                }
            break;
            
            default:
            break;
        }
    });


    $("#clearButton").click(function () {
         polyLines = [];
         storedLines = [];
         inputCoords.value = ' ';
         isThereSpace = false;
         savedButton.disabled = true;
         clearButton.disabled = true;
         ctx.clearRect(0, 0, canvas.width, canvas.height); 
         loadImage(srcImage, ctx);
    });

};

function viewSpace(coordsSpace, srcImage) {

    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d")
        spacePoints = convertCoords(coordsSpace);
    loadImageWithSelectSpace(srcImage, spacePoints, ctx);
};

function editSpace(coordsSpace, srcImage) {

    var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d")
        inputCoords = document.getElementById("coordsSpace"),
        inputCoords.value = coordsSpace;
        savedButton =  document.getElementById("saveButton"),
        clearButton =  document.getElementById("clearButton"),
        storedLines = [],
        spacePoints = convertCoords(coordsSpace),
        isThereSpace = true,
        radius = 10;
    loadImageWithSelectSpace(srcImage, spacePoints, ctx);
        

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
                }
                else
                {
                    if(!isThereSpace){
                        if(inputCoords.value != ' ' && inputCoords.value != null) {
                            inputCoords.value = inputCoords.value + ',' + position.x + ' ' + position.y;
                        } else{
                            inputCoords.value = position.x + ' ' + position.y;
                        }
                        storedLines.push(position);
                        drawPoint(position, ctx);
                    } //else{
                    //     alert("You can only select a space");
                    // }
                }
            break;
            
            default:
            break;
        }
    });

    $("#clearButton").click(function () {
        polyLines = [];
        storedLines = [];
        inputCoords.value = ' ';
        isThereSpace = false;
        savedButton.disabled = true;
        clearButton.disabled = true;
        ctx.clearRect(0, 0, canvas.width, canvas.height); 
        loadImage(srcImage,ctx);
    });

};

function searchInTable() {

    let filter = document.getElementById("searchBox").value.toUpperCase(),
        tr = document.getElementById("dataTable").getElementsByTagName("tr"); 

    for (let i = 0; i < tr.length; i++) {
        let isFound = true, 
            j=0;
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




 

// $(document).ready(function(){

// 	var original_width = 0;
// 	var original_height = 0;


// 	$(".magnify").mousemove(function(e){
// 		if(!original_width && !original_height)
// 		{
// 			var image_obj = new Image();
// 			image_obj.src = $(".small").attr("src");
// 			original_width = image_obj.width;
// 			original_height = image_obj.height;
// 			$("#col1").html("orig width=" + original_width + "<br>" + "orig height=" + original_height );
// 		}
// 		else
// 		{
// 			var magnify_offset = $(this).offset();
// 			var mx = e.pageX - magnify_offset.left;
// 			var my = e.pageY - magnify_offset.top;
// 			$("#col2").html("pagex="+e.pageX +"<br>"+ "pageY="+ e.pageY);
// 			$("#col3").html("offset_L=" + magnify_offset.left +"<br>"+"offset_T=" + magnify_offset.top);
// 			$("#col4").html("mx="+ mx+"<br>"+"my=" +my);
// 			if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
// 			{
// 				$(".large").fadeIn(100);
// 			}
// 			else
// 			{
// 				$(".large").fadeOut(100);
// 			}
// 			if($(".large").is(":visible"))
// 			{
// 				//The background position of .large will be changed according to the position
// 				//of the mouse over the .small image. So we will get the ratio of the pixel
// 				//under the mouse pointer with respect to the image and use that to position the 
// 				//large image inside the magnifying glass
// 				var rx = Math.round(mx/$(".small").width()*original_width - $(".large").width()/2)*-1;
// 				var ry = Math.round(my/$(".small").height()*original_height - $(".large").height()/2)*-1;
// 				var bgp = rx + "px " + ry + "px";
				
// 				//Time to move the magnifying glass with the mouse
// 				var px = mx - $(".large").width()/2;
// 				var py = my - $(".large").height()/2;
// 				//Now the glass moves with the mouse
// 				//The logic is to deduct half of the glass's width and height from the 
// 				//mouse coordinates to place it with its center at the mouse coordinates
				
// 				//If you hover on the image now, you should see the magnifying glass in action
// 				$(".large").css({left: px, top: py, backgroundPosition: bgp});
// 			}
// 		}
// 	})


// })