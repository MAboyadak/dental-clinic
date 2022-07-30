var allTeeth = document.querySelectorAll('.tooth-container');
var sectors = document.getElementById('sectors');
var conditionBtns = document.getElementsByName('condition');
var detailBtns = document.getElementsByName('detail');


var pickedTeeth = new Array();
var teethObjects = new Array();
var description = null;
// var selectedPatient = null;

function backAllToDefautlt(){
  allTeeth.forEach(element =>{
    element.style.opacity = 1;
  })
  Array.from(sectors.children).forEach(item => {
    item.style.opacity = 1;
  })

  conditionBtns.forEach(item => {
    item.checked = false;
    if(item.getAttribute('value') == 'normal') item.checked = true;
  })

  detailBtns.forEach(item => {
    item.checked = false;
    item.disabled = true;
  })

  if(document.getElementById('description').value != ''){document.getElementById('description').value =''}
}



//// ADD Tooth To List
function addTooth(){
    var tooth = new Object(); // tooth that will be sent in ajax
  
    allTeeth.forEach(toothContainer =>{
  
      if(window.getComputedStyle(toothContainer).getPropertyValue('opacity') != 1){ // tooth container if picked opacity will be less than 1
  
        if(! pickedTeeth.includes(toothContainer)){ // check if it picked before
          pickedTeeth.push(toothContainer); // push tooth container to teeth list
          tooth.tooth_id = toothContainer.id; // tooth id <<String>>
  
          //// Set tooth deirections
          Array.from(sectors.children).forEach(sector => {
            if(window.getComputedStyle(sector).getPropertyValue('opacity') != 1){
              var sectorName = sector.getAttribute('name'); // name of sector
              switch(sectorName){
                case 'left'   :
                  tooth.left = true;
                  break;
                case 'top'    :
                  tooth.top = true;
                  break;
                case 'right'  :
                  tooth.right = true;
                  break;
                case 'bottom' :
                  tooth.bottom = true;
                  break;
                case 'center' :
                  tooth.center = true;
                  break;
              }
            }
          })
          ///// ######
  
          //// Set tooth condition and detail
          conditionBtns.forEach(condition => {
            if (condition.checked == true){
              tooth.condition = condition.getAttribute('value');
  
              detailBtns.forEach(detail => {
                if (detail.checked == true){
                  tooth.details = detail.getAttribute('value');
                }
              })
            }
          })
          ///// ######

          //// set Description for tooth
          tooth.description = document.getElementById('description').value;
          ///// ######

          //// ADD tooth To LIST
          var picked_list = document.getElementById('picked_list');
          var listItems = '';
          pickedTeeth.forEach(g => {
            toothId = g.getAttribute('id');
            // toothId[0].toUpperCase();
            var li = '<li class="bg-success">'+ toothId +'</li>';
            listItems += li;
          });
          picked_list.innerHTML = listItems;
          ////
          teethObjects.push(tooth); // push tooth to array
  
        }
      }
    })
    backAllToDefautlt();
  
  }
  /// END function ###

  


//// VIEW Deatils (radio buttons) of bad tooth
function viewDetails(){
    var badBtn = document.getElementsByName('condition')[2];
    // console.log(detailRadioBtns[0].disabled);
    // console.log(badBtn);
    
    if(badBtn.checked == true){
      detailBtns.forEach(item =>{
        item.disabled = false;
      });
    }else{
      detailBtns.forEach(item =>{
        item.disabled = true;
        
      })
    }
  }
  /// END function ###
  
function submitData(ev){
  ev.preventDefault();
  // return console.log(ev);
    // description = document.getElementById('description').value;
    // problem = document.getElementById('problem').value;
    // work = document.getElementById('work').value;
    // selectedPatient = document.getElementById('selectedPatient').value;
  
    // console.log(description);
    // console.log(teethObjects);

    var work = $('#work').val();
    var cost = $('#cost').val();
    var notes = $('#notes').val();
    
    var file = $('#file').prop('files')[0];
    // console.log(file);
    var nextDay = $('#day').val();
    var nextHour = $('#hour').val();
    var medicines = $("input[name='medicines[]']").map(function(){return $(this).val(); }).get();
    var days = $("input[name='days[]']").map(function(){return $(this).val(); }).get();
    var repeats = $("input[name='repeats[]']").map(function(){return $(this).val(); }).get();
    var instructions = $("input[name='instructions[]']").map(function(){return $(this).val(); }).get();
    var program_id = $("#program_id").val();
    var form = $('form')[0];
    var formData = new FormData(form);

    // formData.append('file',file);
    // formData.append('work',work);
    // formData.append('notes',notes);
    // console.log(formData);
    // formData = JSON.stringify(formData);
    teethObjects = JSON.stringify(teethObjects);
    formData.append("teethObjects",teethObjects);
    // console.log(...formData);
    // console.log(teethObjects);
    
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: formData,
      type:'POST',
      contentType:false,
      processData:false,
      url: storeUrl,
      cache:false,
      success:function(resp){
        var nextUrl = "/prescription/"+resp;
        // console.log(resp);
        // nextUrl = nextUrl.replace(':id',resp);
        // console.log(nextUrl);
        window.location.href = '/home';
        window.open(nextUrl, '_blank', 'location=no,height=740,width=1000,scrollbars=yes,status=yes');
        
        return;
        // window.print();
      }

      // patientId:patientId,
      // work:work,
      // notes:notes,
      // cost:cost,
      // file:file,
      // medicines:medicines,
      // days:days,
      // repeats:repeats,
      // instructions:instructions,

      // day:nextDay,
      // hour:nextHour,
      // programId:program_id
     });
    // console.log(xhr);
}

  
  
/// ADD CLICK Listner for Teeth
allTeeth.forEach(element => {
    element.addEventListener('click', function(){
      // var c = element.querySelector('circle');
      // console.log(window.getComputedStyle(element).getPropertyValue('opacity'));
      if(window.getComputedStyle(element).getPropertyValue('opacity') != 1){
        element.style.opacity = 1;
      }else{
        backAllToDefautlt();
        element.style.opacity = .3;
      }
    });
  });
  
/// ADD CLICK Listner for Sectors
Array.from(sectors.children).forEach(element => {
    element.addEventListener('click', function(){
    if(window.getComputedStyle(element).getPropertyValue('opacity') != 1){
        element.style.opacity = 1;
    }else{
        // backAllToDefautlt();
        element.style.opacity = .3;
    }
    });
});
  
  