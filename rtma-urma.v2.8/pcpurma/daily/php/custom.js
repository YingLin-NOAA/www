// returns the year (four digits)
var currentYear = new Date().getFullYear();
var options = {
    pattern: 'yyyy-mm', // Default is 'mm/yyyy' and separator char is not mandatory
    selectedYear: currentYear,
    startYear: currentYear-2,
    finalYear: currentYear,
    monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
};
var imagesJsonData;
var stage4image;
var cmorphImage;
var selectedModelImage_Files = [];
var handle = $( "#custom-handle" );

//Set which months to be disabled
var todayDate = new Date();
var month = todayDate.getMonth()+1;
var monthIndex = 12 - month;
var disableMonthArr = [];
for (var i = month+1; i <= 12; i++){
   disableMonthArr.push(i);
}
$('#datePicker').monthpicker(options);
//$('#datePicker').monthpicker('disableMonths', disableMonthArr);

//Datepicker icon button
$('#MonthPicker_Button_IconDemo').bind('click', function () {
    $('#datePicker').monthpicker('show');
});

$('#forecastText').hide();

$('#datePicker').click(function(){
  var selectedYear = parseInt($('.mtz-monthpicker-year  option:selected').val());
  if ( selectedYear == parseInt(todayDate.getFullYear())) {
    $('.mtz-monthpicker tr').each(function () {
        $(this).find('td').each(function () {
           if (  $.inArray( parseInt($(this).attr('data-month')), disableMonthArr ) >  -1 ){
              $(this).addClass('ui-state-disabled');
           }
         
         });
      });
  }

});
$('.mtz-monthpicker-year').change(function(){
   var selectedYear = parseInt($('.mtz-monthpicker-year  option:selected').val());
    $('.mtz-monthpicker tr').each(function () {
       $(this).find('td').each(function () {
          if (  $.inArray( parseInt($(this).attr('data-month')), disableMonthArr ) >  -1 && (selectedYear === todayDate.getFullYear()) ){
              $(this).addClass('ui-state-disabled');
           }else{
            $(this).removeClass('ui-state-disabled');
           }
       });
    });

});

// Date Picker function
$('#datePicker').change(function(){
    var level = $('#cognuslevel').val();

  if (level !== null && level !== 'NONE'){
    var selectedModel = $('#model1').val().toLowerCase();
    var region = $('#region').val();
    var yearMonth = $('#datePicker').val();
    var level = $('#cognuslevel').val();
    var day = $('#day').val();

    callAjax(yearMonth, level, day, selectedModel);
    $("#model1").val(selectedModel.toUpperCase()).change();
    //changePageMap(selectedModel, level, day);
   }else{
      var selectedYearMonth = this.value.split('-');
   
      //Get the number of days in a month
      function daysInMonth (month, year) {
       return new Date(year, month, 0).getDate();
      }
      //Apend '0' to a single digit - Note: This is used for the acutally day, see the populate day loop for more details.
      function addZ(n) {
         return (n < 10? '0' : '') + n;
      }
      var days = daysInMonth(selectedYearMonth[1], selectedYearMonth[0]);

      // Populate the #days Drop down select option
      $('#day').append($("<option />").val('None').text('None') );
      $.each(new Array(days), function(n) {
         $('#day').append($("<option />").val(addZ(n+1)).text(n+1) );
      });
   } 
});


//Day Function
$('#day').change(function(){
  var level = $('#cognuslevel').val();
  
  if (level !== null && level !== 'NONE'){
    var selectedModel = $('#model1').val().toLowerCase();
    var region = $('#region').val();
    var yearMonth = $('#datePicker').val();
    var level = $('#cognuslevel').val();
    var day = $('#day').val(); 

    callAjax(yearMonth, level, day, selectedModel);
    $("#model1").val(selectedModel.toUpperCase()).change(); 
    //changePageMap(selectedModel, level, day);
  }else{
    $('#cognuslevel').empty();
    $('#cognuslevel').append($("<option />").val('NONE').text('NONE') );
    $('#cognuslevel').append($("<option />").val("CONUS").text("CONUS") );
    $('#cognuslevel').append($("<option />").val("OCONUS").text("OCONUS") );
  }

});

function callAjax(yearMonth, level, day, model){
  var yearMonth_array = yearMonth.split('-');
  var year = yearMonth_array[0];
  var month = yearMonth_array[1];
 
$.ajax({
        type: 'POST',
        url: 'action.php',
        data: { year:year, month:month, day:day, level:level },
        async: false,
        success: function(data){
           //imagesJsonData = [];
           var jsonData = JSON.parse(data);
           imagesJsonData = Object.keys(imagesJsonData).forEach(function(k) { delete imagesJsonData[k]})
           imagesJsonData = jsonData;
           //console.log(imagesJsonData);
           //empty the Model Select options
           $('#model1').empty();
           // Start to populate the Model Selection HTMl form input
           $('#model1').append($("<option />").val('NONE').text('NONE') );
           for(var key in jsonData.modelNames) {
              var modelName = jsonData.modelNames[key].toUpperCase();
              //echo json_encode(array('files' => $files, 'searchDir' => $path) );
              // Populate the #models Drop down select option
              //Strip the Stage 4 model since they need to appear sidebyside next to the model
              if ( (modelName !== 'ST4' && level == "CONUS") || (modelName !== "CMORPH" && level == "OCONUS" )){
                // $('#model1').append($("<option />").val(modelName).text(modelName) );
                 //console.log("In Ajax if");
                 if (model != undefined || model != null){
                    //console.log("Model : "+model);
                    if (model !== 'none'  && model.toUpperCase() == modelName){
                    //option = '<option selected="selected"/>';
                    $('#model1').append($('<option selected="selected"/>').val(modelName).text(modelName) );
                    }
                 } else{
                    $('#model1').append($('<option />').val(modelName).text(modelName) );
                 }
              }/*else if ( modelName !== "CMORPH" && level == "OCONUS"){
                 $('#model1').append($("<option />").val(modelName).text(modelName) );
              }*/
           }
         },
        error: function(e) {
            //called when there is an error
           console.log(e.message);
        }
     });

}

$('#region').change(function(){
   var region = $(this).val();
   var arr = [];
   //empty the Model Select options
   $('#model1').empty();

   //Update/repopulate the Model Drop down
   for(var key in imagesJsonData.files) {
     //console.log(imagesJsonData.files[key]);
     
     // var modelName = imagesJsonData.modelNames[key].toUpperCase();
      if (imagesJsonData.files[key].toLowerCase().indexOf(region.toLowerCase()) >= 0){ //&&  modelName !== "CMORPH"){
         var str = imagesJsonData.files[key].substring(0,imagesJsonData.files[key].indexOf('.'));
         arr.push(str);
         //$('#model1').append($("<option />").val(modelName).text(modelName) );
      }
   }

   
   var uniqueNames = [];
   $.each(arr, function(i, el){
      if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
   });
   
   $('#model1').append($("<option />").val('NONE').text('NONE') );
   for (var key in uniqueNames){
     var modelName = uniqueNames[key].toUpperCase();
     if (uniqueNames[key] !== "cmorph"){
       $('#model1').append($("<option />").val(modelName).text(modelName) );
     }
   }

});

//CONUS Level Changed
$('#cognuslevel').change(function(){
    // Clear the imagesJsonData
    imagesJsonData = [];
    var region = ["AK","HI","PR"];
    var level = $(this).val();
    var yearMonth = $('#datePicker').val();
    var level = $('#cognuslevel').val();
    var day = $('#day').val();


    //Call the Ajax function that will get all the files based on inputs and conus level.
    callAjax(yearMonth,level,day);
    //Populate the Region
    if (level == "OCONUS"){
      for (var key in region){
         $('#region').append($("<option />").val(region[key]).text(region[key]) );
      }
    }else{
      $('#region').empty();
    }
});

// Model Select function
$('#model1').change(function(){
    var selectedModel = $(this).val().toLowerCase();
    var level = $('#cognuslevel').val();
    //var str = selectedModel.toLowerCase();
    var region = $('#region').val();
    //clear array
    selectedModelImage_Files = [];
    //Remove any other images
    $('#tbl-map tr').empty();
   // console.log(imagesJsonData.files);    
    if ( level == "OCONUS"){
     for(var key in imagesJsonData.files) {
        //console.log("Region: " + region);
        if (imagesJsonData.files[key].toLowerCase().indexOf(region.toLowerCase()) >= 0 ){
               //Grab the comparison file
               if (imagesJsonData.files[key].indexOf("cmorph.") >= 0){
                 cmorphImage =  '<img class="mapImage" src="'+imagesJsonData.searchDir+'/'+imagesJsonData.files[key]+'"  style="width:100%" >';
              }else if(imagesJsonData.files[key].indexOf(selectedModel+".") == 0 || imagesJsonData.files[key].indexOf(selectedModel+"_") == 0 ){
               var image = '<img class="mapImage" src="'+imagesJsonData.searchDir+'/'+imagesJsonData.files[key]+'"  style="width:100%" >';
                //populate array
                selectedModelImage_Files.push(image);
              }
         }
        
 
     }     

    }else if (level == "CONUS"){
       for(var key in imagesJsonData.files) {
           //var image;
           //Get the Stage 4 image file
           if (imagesJsonData.files[key].indexOf("st4.") >= 0){
              stage4image =  '<img class="mapImage" src="'+imagesJsonData.searchDir+'/'+imagesJsonData.files[key]+'"  style="width:100%" >';
           }else if(imagesJsonData.files[key].indexOf(selectedModel+".") == 0 || imagesJsonData.files[key].indexOf(selectedModel+"_") == 0 ){
              var image = '<img class="mapImage" src="'+imagesJsonData.searchDir+'/'+imagesJsonData.files[key]+'"  style="width:100%" >';
              //populate array
              selectedModelImage_Files.push(image);
           }

       } 
    }

     //Assuming that the array is sortted,  get the min and max value
     var min, max;
     if( selectedModelImage_Files[0].indexOf(".024h.") >= 0 ) {
         min = 24;
     }else if (selectedModelImage_Files[0].indexOf(".030h.") >= 0  && level == "OCONUS"){
         min = 30
     }else {
        min = 27;
     }
     //Getting the max forecast value of the array of files.
     var findGif = selectedModelImage_Files[selectedModelImage_Files.length-1].indexOf(".gif");
     if (level != "OCONUS"){ 
        max = selectedModelImage_Files[selectedModelImage_Files.length-1].substring(findGif-4, findGif);
        max = max.slice(0, max.length-1);
     }else{
        max = selectedModelImage_Files[selectedModelImage_Files.length-1].substring(findGif-7, findGif);
        max = max.slice(0, max.length-4);
     }
         
     //Display the first image that is that starts at 24hr or 27hrs. 
     $('#tbl-map').find('tr').append( "<td>"+ selectedModelImage_Files[0] +"</td>");
     if (level == "CONUS"){
       $('#tbl-map').find('tr').append( "<td>"+ stage4image+"</td>");
     }else{
       $('#tbl-map').find('tr').append("<td>"+ cmorphImage+"</td>");
     }
     
     //$(".slider").slider().slider("pips", "destroy");
     //var handle = $( "#custom-handle" );

     $( "#slider" ).slider({
       value: min,
       min: min,
       max: max,
       step: 6,
      /* create: function() {
         handle.text( $( this ).slider( "value" )+"hr" );
       },
       slide: function( event, ui ) {
          handle.text( ui.value+"hr" );
       }*/
     }).slider("pips", {
         rest: "label"
     }).slider("float", {
        /* options go here as an object */
    });
      
     //$(".slider").slider().slider("pips", "refresh");
     $('#forecastText').show();
      //update style if the slider has a larger max number
      if ( max > 84 ){
       $( "#slider" ).css ({width: "80%", marginLeft : "-250px"});
     }

});

// Slider function
$('#slider').on('slide', function(event, ui) {
    var selectedModel = $(this).val();
    var level = $('#cognuslevel').val();
    var region = $('#region').val();
    $('#tbl-map td').remove();
    for(var key in selectedModelImage_Files) {
        var str = selectedModel.toLowerCase();
        var str2 = ui.value+"h.gif";

        if (level == "CONUS"){
          if (selectedModelImage_Files[key].indexOf(str2) >= 0 ){
            $('#tbl-map').find('tr').append( "<td>"+ selectedModelImage_Files[key] +"</td>");
            $('#tbl-map').find('tr').append( "<td>"+ stage4image+"</td>");
          }
        }else{
         var str2 = ui.value+"h."+region+".gif";
         if (selectedModelImage_Files[key].indexOf(str2) >= 0 ){
            $('#tbl-map').find('tr').append( "<td>"+ selectedModelImage_Files[key] +"</td>");
            $('#tbl-map').find('tr').append( "<td>"+ cmorphImage +"</td>");       
         }
        }
         
    }
});


