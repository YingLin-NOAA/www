
<!DOCTYPE html
<html>
<head>
<meta charset="UTF-8">
<title>GFS vs. FV3GFS</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-3.1.1.min.js"></script>
<!--<script type="text/javascript" src="functions.js"></script>-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="jquery-ui-month-picker/demo/MonthPicker.min.css" rel="stylesheet" type="text/css" />
<link href="jQuery-ui-Slider-Pips/jQuery-ui-Slider-Pips/dist/jquery-ui-slider-pips.css" rel="stylesheet" type="text/css" />
<style>
  #custom-handle {
    width: 3em;
    height: 1.6em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }
  #slider{
   width: 50%;
   position: relative;
   left: 30%;
   margin-left: -50px;
  }
  .month-year-input{
   padding: 5px;
   font-size: 16px;
   max-height: 300px;
  }
  .month-picker-open-button{
   padding: 5px;
   font-size: 16px;
   max-height: 300px;
   height: 33px;
   width: 25px;
  }
  .page-middle{height: 65px; padding: 10px;}
  #forecastText{padding: 5px;}
</style>
</head>

<body>



<!-- Head element -->
<div class="page-top">
	<span><a style="color:#ffffff">DAILY PLOTS CONUS/OCONUS</a></span>
</div>

<!-- Top menu -->
<div class="page-menu"><div class="table">
	
<!--        <div class="element">
                <span class="bold">Valid:</span>
                <select id="validtime" onchange="changeValidtime(this.value);"></select>
            </div> 
-->
	<div class="element">
           <span class="bold">Year/Month:</span>
	   <input id="datePicker" class="Default month-year-input" type="text">
	   <span id="MonthPicker_Button_IconDemo" class="month-picker-open-button ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only" role="button" title="Open Month Chooser">
		<span class="ui-button-icon-primary ui-icon ui-icon-calculator"></span>
		<span class="ui-button-text">Open Month Chooser</span>
	   </span>
	</div>
        <div class="element">
                <span class="bold">Day:</span>
                <select id="day"></select>
        </div> 
 <!--       <div class="element">
                <span class="bold">Season:</span>
                <select id="season" onchange="changeSeason(this.value)"></select>
        </div>

        <div class="element">
                <span class="bold">Year:</span>
                <select id="season" onchange="changeYear(this.value)"></select>
        </div> -->
        <div class="element">
                <span class="bold">Conus Level:</span>
                <select id="cognuslevel"></select>
        </div>
        <div class="element">
                <span class="bold">Region:</span>
                <select id="region"></select>
        </div>


        <div class="element">
                <span class="bold">Model:</span>
                <select id="model1"></select>
        </div>
        <!--<div class="element">
                <span class="bold">Statistic:</span>
                <select id="variable" onchange="changeVariable(this.value)"></select>
        </div>-->

<!-- /Top menu -->
</div></div>

<!-- Middle menu -->
<div class="page-middle" id="page-middle">
<div id="forecastText"> Click on the forecast meter from left/right<br></div>
<div id="slider">
    <div id="custom-handle" class="ui-slider-handle"></div>
</div>
<!-- /Middle menu -->
</div>

<div id="loading"><img style="width:100%" src="loading.png"></div>

<!-- Image -->
<div id="page-map">
<table id="tbl-map" style='width:950px;margin-left:-100px;'>
     <tbody>
       <tr>
         <td id ="td-map">
	   <img name="map" style="width:100%">
        </td>
        <td id="td-stage-map">
           <img name="map" style="width:100%">
        </td>
      </tr>
    </tbody>
</table>
</div>

<!-- /Footer -->
<div class="page-footer">
        <span></div>


<!--<script src="https://code.jquery.com/jquery-2.1.1.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<!--<script src="jquery-ui-month-picker/demo/MonthPicker.min.js"></script>-->
<script src="jquery.mtz.monthpicker/jquery.mtz.monthpicker.js"></script>
<script src="jQuery-ui-Slider-Pips/jQuery-ui-Slider-Pips/dist/jquery-ui-slider-pips.js"></script>
<script src="custom.js"></script>
</body></html>
