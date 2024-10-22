let label1= document.getElementById('label-1');
let label2= document.getElementById('label-2');
let label3= document.getElementById('label-3');
let label4= document.getElementById('label-4');
let label5= document.getElementById('label-5');
let label= document.querySelector('.label');
let count_rate= document.querySelector('#count_rate').value;
let count= Number(count_rate);


switch (count) {
    case 1:
        label1.style.color= 'orange';
    break;
    case 2:
        label1.style.color= 'orange';
        label2.style.color= 'orange';
    break;
    case 3:
        label1.style.color= 'orange';
        label2.style.color= 'orange';
        label3.style.color= 'orange';
    break;
    case 4:
        label1.style.color= 'orange';
        label2.style.color= 'orange';
        label3.style.color= 'orange';
        label4.style.color= 'orange';
    break;
    case 5:
        label1.style.color= 'orange';
        label2.style.color= 'orange';
        label3.style.color= 'orange';
        label4.style.color= 'orange';
        label5.style.color= 'orange';
        break;
}



label1.addEventListener('click', function(){
    if(this.style.color!== 'orange'){
        this.style.color= 'orange';
    }
    else{
        this.style.color= 'gray';
    }
})
label2.addEventListener('click', function(){
    if(this.style.color!== 'orange'){
        this.style.color= 'orange';
    }
    else{
        this.style.color= 'gray';
    }
})
label3.addEventListener('click', function(){
    if(this.style.color!== 'orange'){
        this.style.color= 'orange';
    }
    else{
        this.style.color= 'gray';
    }
})
label4.addEventListener('click', function(){
    if(this.style.color!== 'orange'){
        this.style.color= 'orange';
    }
    else{
        this.style.color= 'gray';
    }
})
label5.addEventListener('click', function(){
    if(this.style.color!== 'orange'){
        this.style.color= 'orange';
    }
    else{
        this.style.color= 'gray';
    }
})



