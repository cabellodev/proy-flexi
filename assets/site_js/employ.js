$(()=>{
	get_publications();
	get_charges();
	get_section();
});




get_section = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/sections',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_sections(result);
			}
        })
}

draw_sections =(section)=>{
   
    section.forEach(element =>{

       
         if(element.item == "Formulario de postulación"){
           
            $(".form-employ").text(element.title);
         }
        
         if(element.item == "Cabecera de módulo Empleo"  ){

			url = host_url + `assets/images/sections/${element.url}`;

            $(".title-employ").text(element.title);

			  $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                         "height": "500px",
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                         "background-size": "cover"});
          }

    })
     
}



create_notification =()=>{

     let data ={
        name: $("#name").val(),
        phone:$("#phone").val(),
        email:$("#email").val(),
        charge:$("#charge").val(),
        surname:$("#surname").val(),
     }

     
    $.ajax({
		type: "POST",
        data: { data },
		url: host_url + 'api/employ/page/notifications',
		crossOrigin: false,
		dataType: "json",

		success: (result) => {
			swal({
				title: "Éxito!",
				icon: "success",
				text: result.msg,
				button: "OK",
			}).then(() => {
			    swal.close();
			});
			},
		error:(result)=>{

			swal({
				title: "Error",
				icon: "warning",
				text:  result.responseJSON.msg,
				button: "OK",
			})

		}
		
        });
}


get_publications=()=>{

	$.ajax({
		type: "GET",
		url: host_url + 'api/publications',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			  publication_draw(result);
			  close_open_postulate(result[0].state);
			}
        });

}

get_charges=()=>{

	$.ajax({
		type: "GET",
		url: host_url + 'api/charges',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			  charges_draw(result);
			},
      
		error: ()=>{

            charges_draw([]);
		}
	});


}


publication_draw =(publication)=>{
    let time_star = `Inicio de postulaciónes: ${publication[0].date_from}`;  
	let time_limit = `Finalización de postulaciónes ${publication[0].date_to}`;
	$("#time_star").text(time_star).addClass('text-danger');
	$("#time_limit").text(time_limit).addClass('text-danger');

}


charges_draw =(charges)=>{
	$("#list_charges").empty();
	console.log(charges.lenght);
    if(charges.length!=0){
	charges.forEach( (element)=>{
          html= `<h5 class="style-p"><i class="bi-check-circle mr-2"></i> ${element.name}</h5>`;
		  $("#list_charges").append(html)
	});
	}else{
		
		html= `<h5 class="style-p"><i class="bi-check-circle mr-2"></i>No se han definido cargos</h5>`;
		  $("#list_charges").append(html)
	}
}

close_open_postulate =(state)=>{

	if(state == 1){
		$("#open_close").text('POSTULACIÓN ABIERTA');
		$(".input").prop('disabled', false);
		$('#btn_send_notification').prop('disabled', false);
	}else{
		html= `<h5 class="style-p"><i class="bi-check-circle mr-2"></i>No se han definido cargos</h5>`;
		$("#list_charges").append(html)
        $("#open_close").text('POSTULACIÓN CERRADA');
		$(".input").prop('disabled', true);
		$('#btn_send_notification').prop('disabled', true);
	}

}


$("#btn_send_notification").on('click',create_notification);



