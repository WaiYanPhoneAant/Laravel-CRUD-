
let input_range=document.querySelector('.range');
input_range.addEventListener('change',()=>{
    let range=input_range.value;
    let active_star=(range=[],arr=[1,2,3,4,5])=>{
        for(i=0;i<range.length;i++){
            let value=range[i];
            document.querySelector(`.st-${value}`).classList.add('text-warning');
        }


        for(i=0;i<arr.length;i++){
            let value1=arr[i];
            document.querySelector(`.st-${value1}`).classList.remove('text-warning');
        }
    }
    switch (range) {
        case '1':
            active_star([1],[2,3,4,5]);
        break;
        case '2':
            active_star([1,2],[3,4,5]);
        break;
        case '3':
            active_star([1,2,3],[4,5]);
        break;
        case '4':
            active_star([1,2,3,4],[5]);
        break;
        case '5':
            active_star([1,2,3,4,5],[]);
        break;
        case '0':
            active_star();
        break;
        default:
            active_star();
            console.log('not access value');
        break;
    }
    

});

                        
