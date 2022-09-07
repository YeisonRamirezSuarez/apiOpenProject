var valuelist = document.getElementById('valuelist');
var text = '<span>Seleccionado: </span>';
var listArray = [];
var index;
var checkboxes = document.querySelectorAll('.valores');
var listarra = null;



for(var checkbox of checkboxes){

    checkbox.addEventListener('click',function(){

        if(this.checked == true){

            listArray.push(this.value);
            valuelist.value = listArray.join("/");
            console.log(listArray);
            
        }
        else if(this.checked == false){
            index = listArray.indexOf(`${this.value}`);
            if(index > -1){
                listArray.splice(index, 1);
                valuelist.value = listArray.join("/");
                
            }
            console.log(listArray);
        }
    })

}


    function javascript_to_php() {
        

        
        $.ajax({

            url: 'recibir.php',
            type: 'post',
            dataType: 'json',
            data:{

                info: listArray

            }
        }
            
        ).done(
            
            function(data){

                valuelist.innerHTML = "Informacion: "+data;

                console.log(data);

            }

        );

    


    }
    



    
   

