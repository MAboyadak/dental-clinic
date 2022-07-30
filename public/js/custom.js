
///// Add & Drop Medicine() function

function addMedicine(e){
  e.preventDefault();
  var firstContainer = document.getElementById('medicine-container');
  var medicineInput = document.getElementById('medicine').value;
  
  if(! medicineInput.trim()){
    return $('#emptyname').removeClass('d-none');
  }

  if(! $('#emptyname').hasClass('d-none')){
    $('#emptyname').addClass('d-none');
  }

  var daysInput = parseInt(document.getElementById('days').value);
  var repeatsInput = parseInt(document.getElementById('repeats').value);
  var instructionsInput = document.getElementById('instructions').value;

  div = '<div class="hr-line-dashed"></div><div class="row"><div class="col-3 col-md-3"><label for="">Medicine</label><input type="text" name="medicines[]" class="form-control" value="'+medicineInput+'" readonly></div><div class="col-3 col-md-2"><label for="">Days</label><input type="number" name="days[]" class="form-control" value='+daysInput+' readonly></div><div class="col-3 col-md-2"><label for="">Repeats</label><input type="number" name="repeats[]" class="form-control" value='+repeatsInput+'  readonly></div><div class="col-3 col-md-3"><label for="">Instructions</label><textarea name="instructions[]" class="form-control" value=""'+instructionsInput+'" readonly>'+instructionsInput+'</textarea></div><div class="col-12 col-md-2 align-self-end"><button class="btn btn-info text-white" type="button" onclick="dropMedicine(event)">Drop</button></div></div>'
  firstContainer.insertAdjacentHTML('afterend',div);
  $('#medicine').val('');
  $('#days').val('');
  $('#repeats').val('');
  $('#instructions').val('');
}

function dropMedicine(e){
  e.preventDefault();
  e.target.parentElement.parentElement.remove();
}

///////// End Medicines 



///// Add & Drop File() function

function addFile(e){
  e.preventDefault();
  var firstContainer = document.getElementById('file-container');
  var fileInput = document.getElementById('file').value;
  var div = '<div id="emptyname" class="bg-danger text-white p-2 mb-2">* File name can\'t be empty.</div>';
  if(! fileInput.trim()){
    return firstContainer.insertAdjacentHTML('beforebegin',div);
  }
  if(document.getElementById('emptyname')){
    document.getElementById('emptyname').remove();
  }


  div = '<div class="hr-line-dashed"></div><div class="row"><div class="col-3 col-md-3"><label for="">Upload File :</label><input type="file" name="files[]" class="form-control" value="'+fileInput+'" readonly multiple></div><div class="col-12 col-md-2 align-self-end"><button class="btn btn-info text-white" type="button" onclick="dropFile(event)">Drop</button></div></div>'
  firstContainer.insertAdjacentHTML('afterend',div);
}

function dropFile(e){
  e.preventDefault();
  e.target.parentElement.parentElement.remove();
}

/// date picker


(function( factory ) {
  if ( typeof define === "function" && define.amd ) {

    // AMD. Register as an anonymous module.
    define([ "../jquery.ui.datepicker" ], factory );
  } else {

    // Browser globals
    factory( jQuery.datepicker );
  }
}(function( datepicker ) {
  datepicker.regional['ar'] = {
    prevText: '',
    nextText: '',
    currentText: 'اليوم',
    monthNames: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو',
    'يوليو', 'اغسطس', 'سبتمبر',	'اكتوبر', 'نوفمبر', 'ديسمبر'],
    monthNamesShort: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو',
    'يوليو', 'اغسطس', 'سبتمبر',	'اكتوبر', 'نوفمبر', 'ديسمبر'],
    dayNames: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    dayNamesShort: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    dayNamesMin: ['حد', 'اتنثن', 'ثلاث', 'اربع', 'خميس', 'جمعه', 'سبت'],
    weekHeader: 'أسبوع',
    dateFormat: 'yy/mm/dd',
    firstDay: 6,
      isRTL: true,
    showMonthAfterYear: false,
    yearSuffix: ''};
  datepicker.setDefaults(datepicker.regional['ar']);

  // var $dialogContent = $("#ui-datepicker-div");       

  // $dialogContent.dialog({
  //   modal: true,
  //   title: "Test",
  //   close: function() {},
  //   buttons: {
  //     save : function() {},
  //     cancel : function() {}
  //   }
  // }).show();
  $("#ui-datepicker-div").css("z-index", "9999");   
  return datepicker.regional['ar'];

}));
// initialize datepicker
$( ".datepicker" ).datepicker({
    isRTL:true,
    changeMonth: true,
    changeYear: true,
    modal: true
});


// Hour picker
$(document).ready(function(){
  $('input[name="hour"]').ptTimeSelect({
      containerWidth:400,
      containerClass: "timeCntr",
      setButtonLabel:"تحديد",
      popupImage:"تحديد الوقت",
      minutesLabel: "الدقيقه",
      zIndex:1100,
      // onBeforeShow:function(){
      //     window.scroll({
      //         top: auto,
      //         behavior: 'smooth'
      //     });
      // },
      hoursLabel: "الساعه"
  });
});
///////// End files