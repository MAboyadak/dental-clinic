
var left = $('#left')[0];;
var top = $('#top')[0];
var right = $('#right')[0];
var bottom = $('#bottom')[0];
var center = $('#center')[0];
var condition = $('#condition')[0];
var detail = $('#detail')[0];
var description = $('#description')[0];
var myTeethIds = new Array()[0];
// console.log(left);

function showTeeth(){

    // var check = '<i style="color:green;font-size:20px" class="fa fa-check"></i>';
    teeth.forEach(tooth => {
        // console.log(tooth);
        // myTeethIds.push(tooth.tooth_id);
        var toothContainer = $('#'+tooth.name)[0];
        // console.log(toothContainer);
        var circle = toothContainer.firstElementChild;
        // console.log(circle);
        if(tooth.condition == 'bad'){
            circle.setAttribute('fill','#e9e91e'); // bad = yellow
        }else if(tooth.condition == 'extracted'){
            circle.setAttribute('fill','red');
        }else if(tooth.condition == 'normal'){
            circle.setAttribute('fill','white');
        }else{ // treated
            circle.setAttribute('fill','#53df30'); // green
        }
        toothContainer.addEventListener('click', function(){
            // console.log(tooth);
            // console.log(toothContainer);
            if(tooth.left){$('#left')[0].innerHTML= '<i style="color:green;font-size:20px" class="fa fa-check"></i>' }else{$('#left')[0].innerHTML = ''};
            if(tooth.top){$('#top')[0].innerHTML= '<i style="color:green;font-size:20px" class="fa fa-check"></i>'}else{$('#top')[0].innerHTML = ''};
            if(tooth.right){$('#right')[0].innerHTML= '<i style="color:green;font-size:20px" class="fa fa-check"></i>'}else{$('#right')[0].innerHTML = ''};
            if(tooth.bottom){$('#bottom')[0].innerHTML= '<i style="color:green;font-size:20px" class="fa fa-check"></i>'}else{$('#bottom')[0].innerHTML = ''};
            if(tooth.condition){$('#condition')[0].textContent =tooth.condition}else{$('#condition')[0].textContent ='normal'};;
            if(tooth.details){$('#detail')[0].textContent =tooth.details}else{$('#detail')[0].textContent =''};
            if(tooth.description){$('#description')[0].textContent = tooth.description}else{$('#description')[0].textContent =''};
            // console.log(toothContainer.id + 'clicked')
            
        });
    })
}

function showTeethConditions(){

    // var check = '<i style="color:green;font-size:20px" class="fa fa-check"></i>';
    teeth.forEach(tooth => {
        // console.log(tooth);
        // myTeethIds.push(tooth.tooth_id);
        var toothContainer = document.getElementById(tooth.name);
        // console.log(toothContainer);
        var circle = toothContainer.firstElementChild;
        if(tooth.condition == 'bad'){
            circle.setAttribute('fill','#e9e91e'); // bad = yellow
        }else if(tooth.condition == 'extracted'){
            circle.setAttribute('fill','red');
        }else if(tooth.condition == 'normal'){
            circle.setAttribute('fill','black');
        }else{ // treated
            circle.setAttribute('fill','#53df30'); // green
        }
        
    })
}