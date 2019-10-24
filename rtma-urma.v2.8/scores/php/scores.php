<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>GEFS</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="functions.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>



<!-- Head element -->
<div class="page-top">
  <span><a style="color:#ffffff">ConUS pcpRTMA/pcpURMA v2.8 scores</a></span>
</div>

<!-- Top menu -->
<div class="page-menu"><div class="table">
	
        <div class="element">
                <span class="bold">Analysis:</span>
                <select id="season" onchange="changeAnalysis(this.value)"></select>
        </div>
        <div class="element">
                <span class="bold">Statistic:</span>
                <select id="variable" onchange="changeVariable(this.value)"></select>
        </div>
        <div class="element">
                <span class="bold">Month:</span>
                <select id="level" onchange="changeMonth(this.value)"></select>
        </div>

<!-- /Top menu -->
</div></div>

<!-- Middle menu -->
<div class="page-middle" id="page-middle">
Left/Right arrow keys = Change statistic | Up/Down arrow keys = Change month
<br>For additional information on this image, <button class="infobutton" id="myBtn">click here</button>
<div id="myModal" class="modal">
  <div class="modal-content" style="font-size:130%;">
    <span class="close">&times;</span>
    Additional Image Information
    <embed width=100% height=90% src="info.php">
  </div>
</div>
<!-- /Middle menu -->
</div>

<div id="loading"><img style="width:100%" src="loading.png"></div>

<!-- Image -->
<div id="page-map">
	<image name="map" style="width:100%">
</div>

<!-- /Footer -->
<div class="page-footer">
        <span></div>


<script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
//====================================================================================================
//User-defined variables
//====================================================================================================

//Global variables
var minFrame = 0; //Minimum frame for every variable
var maxFrame = 26; //Maximum frame for every variable
var incrementFrame = 1; //Increment for every frame

var startFrame = 0; //Starting frame

var cycle = 2018100600;

/*
When constructing the URL below, DDD = domain, VVV = variable, LLL = level, SSS = season, Y = frame number.
For X and Y, labeling one X or Y represents an integer (e.g. 0, 10, 20). Multiple of these represent a string
format (e.g. XX = 00, 06, 12 --- XXX = 000, 006, 012).
*/

var url = "https://www.emc.ncep.noaa.gov/users/verification/precip/rtma-urma.v2.8/scores/images/SSS_VVV_LLL.png";
/* var url = "https://www.emc.ncep.noaa.gov/mmb/gmanikin/fv3gfs/20180301/fv3_DDD_VVV_2018030100_0Y.png"; */
/*  var url = "https://www.emc.ncep.noaa.gov/users/Alicia.Bentley/fv3gefs/2018030100/images/DDD/mean_diff/VVV_Y.png"; */

//====================================================================================================
//Add variables & domains
//====================================================================================================

var variables = [];
var levels = [];
var seasons = [];
var maptypes = [];

variables.push({
        displayName: "RMS Error",
        name: "rmse",
});
variables.push({
        displayName: "Equitable Threat Score",
        name: "ets",
});

variables.push({
        displayName: "Bias",
        name: "bias",
});

levels.push({
        displayName: "Latest",
        name: "latest",
});
levels.push({
        displayName: "Sep 2019",
        name: "201909",
});

levels.push({
        displayName: "Aug 2019",
        name: "201908",
});

seasons.push({
        displayName: "pcpRTMA",
        name: "RTMA",
});
seasons.push({
        displayName: "pcpURMA",
        name: "URMA",
});

//====================================================================================================
//Initialize the page
//====================================================================================================

//function for keyboard controls
document.onkeydown = keys;

//Decare object containing data about the currently displayed map
imageObj = {};

//Initialize the page
initialize();

//Initialize the page
function initialize(){
	
	//Set image object based on default variables
	imageObj = {
		variable: "rmse",
		level: "latest",
                season: "RTMA",
	};

        //Change variable based on passed argument, if any
        var passed_variable = "";
        if(passed_variable!=""){
                if(searchByName(passed_variable,variables)>=0){
                        imageObj.variable = passed_variable;
                }
        }

	
	//Populate forecast hour and dprog/dt arrays for this run and frame
	populateMenu('variable');
	populateMenu('level');
	populateMenu('season');
	
	//Populate the frames arrays
	frames = [];
	for(i=minFrame;i<=maxFrame;i=i+incrementFrame){frames.push(i);}
	
	//Predefine empty array for preloading images
	for(i=0; i<variables.length; i++){
		variables[i].images = [];
		variables[i].loaded = [];
		variables[i].dprog = [];
	}
	
	//Preload images and display map
	preload(imageObj);
	showImage();
	
	//Update mobile display for swiping
	updateMobile();

}

var xInit = null;                                                        
var yInit = null;                  
var xPos = null;
var yPos = null;


</script>


</body></html>
