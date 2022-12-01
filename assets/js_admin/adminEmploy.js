$(() => {
	get_notifications();
    get_charges();
	get_publications();
	active_date();
	get_sections();
	

    var dateFormat = "YY-mm-dd",

	from = $( "#from" ).datepicker({
		defaultDate: "+1w",
        dateFormat: 'yy-mm-dd',
		changeMonth: true,
		numberOfMonths: 1
	  }).on( "change", function() {
		to.datepicker( "option", "minDate", getDate( this ) );
	  }),
	
	to = $( "#to" ).datepicker({
	  defaultDate: "+1w",
      dateFormat: 'yy-mm-dd',
	  changeMonth: true,
	  numberOfMonths: 1
	}).on( "change", function() {
	  from.datepicker( "option", "maxDate", getDate( this ) );
	});

    getDate=( element ) =>{
        var date;
        try {
        date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
        date = null;
        }
        return date;
    }


});

let state_publication= "";
let date_to_active;


get_publications = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/employ/get/publication',
		crossOrigin: false,
		async:false,
		dataType: "json",
		success: (result) => {
			active_publication(result);
			}
        ,
       
    })
}


active_publication =(publication)=> { 
	date_to_active=publication[0].date_to;

    $('#from').val(publication[0].date_from);
	$('#to').val(publication[0].date_to);

    if(publication[0].state ==1){
		$("#btn_state").removeClass('btn-danger').addClass('btn-success').text('Activo');
	}else if(publication[0].state ==0){
		$("#btn_state").removeClass('btn-success').addClass('btn-danger').text('Inactivo');
	}
}



active_date= ()=> {

	let date = new Date();
	let date_to= date_to_active;
	let current=date.toISOString().split('T')[0];
  

	if(current>date_to ){ 

		state_change(0);
	}else{
		$("#btn_state").removeClass('btn-danger').addClass('btn-success').text('Activo');
	}
}


state_change =(state)=>{

	$.ajax({
		type: "POST",
		url: host_url + `api/employ/state/publication/${state}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			$("#btn_state").removeClass('btn-success').addClass('btn-danger').text('Inactivo');
			
		},
	});
}




create_employ = () =>{

    let id_publication = 1;
    let date = new Date();
    let data = { date_from : $('#from').val(), date_to : $('#to').val()  }
   
    let current=date.toISOString().split('T')[0];
     
    if(data.date_from == data.date_to ){ 
        swal({
            title: "Atención",
            icon: "info",
            text: 'Asigne fechas diferentes',
        });
    }else if (data.date_to < current ) {
        swal({
            title: "Atención",
            icon: "info",
            text: 'La fecha de termino seleccionada a expirado.Selecciones una mayor a la fecha de hoy.',
        });


    }else if(data.date_from > data.date_to){
		swal({
            title: "Atención",
            icon: "info",
            text: 'La fecha de inicio debe ser menor a la fecha de finalización. Reintente de nuevo.',
        });


	}else{

		if(data.date_from.length != 0 && data.date_to.length !=0 ){
			$.ajax({
				data: { data},
				type: "POST",
				url: host_url + `api/employ/update/publication/${id_publication}`,
				crossOrigin: false,
				dataType: "json",
				success: (result) => {
					swal({
						title: "Exito",
						icon: 'success',
						text: 'La publicación se ha realizado con éxito.'
					}).then(()=>{
						get_publications();
					})
				   
				},
				error: (result) => {
					
					swal({
						title: "Error",
						icon: "error",
						text: result.responseJSON.msg,
					})
				}
						
			});
		}else{
			swal({
				title: "Atención",
				icon: "info",
				text: 'Complete ambos campos de fecha para poder publicar.',
			});
		}
    }
    }



$("#btn_publication").on('click',create_employ);
const tabla = $("#table-notifications").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [1]},
		{className: "text-center", "targets": [2]}
    ],
	columns: [
        { data: "date_send" },
		{ data: "name" },
        { data: "surname" },
        { data: "phone" },
        { data: "email" },
        { data: "charge" },
	],
});



get_notifications = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/employ/notifications',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            
			    datatable_notifications(result);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener los servicios",
			});
        }
    })
}


datatable_notifications = (notification)=>{
    tabla.clear();
	tabla.rows.add(notification);
	tabla.draw();

}


const tabla_charges= $("#table-charges").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [1]},
		{className: "text-center", "targets": [2]}
    ],
	columns: [
        { data: "name" },
		{ data: "state",
		render: (data)=>{
			if(data ==1 ){return 'Habilitado';}else{return 'Deshabilitado';}
		} 
	  },
		{
			defaultContent: `<button type='button' name='show' class='btn btn-primary'>
                                  Deshabilitar/habilitar
                                  <i class="fas fa-eye"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='delete_charge' class='btn btn-danger'>
                                 Eliminar
                                  <i class="fas fa-tash"></i>
                              </button>`,
		},
        
	],
});



$("#table-charges").on("click", "button", function () {
	let data = tabla_charges.row($(this).parents("tr")).data();
	if ($(this)[0].name == "delete_charge") {
		swal({
			title: `Eliminar un cargo`,
			icon: "warning",
			text: `¿Está seguro/a de eliminar el cargo: "${data.name}"?`,
			buttons: {
				confirm: {
					text: "Eliminar",
					value: "exec",
				},
				cancel: {
					text: "Cancelar",
					value: "cancelar",
					visible: true,
				},
			},
		}).then((action) => {
			if (action == "exec") {
				delete_charge(data.id);
			} else {
				swal.close();
			}
		});
	} else {

		swal({
			title: `Deshabilitar/Habilitar`,
			icon: "warning",
			text: `¿Está seguro/a de habilitar/deshabilitar el cargo: "${data.name}"?`,
			buttons: {
				confirm: {
					text: "Habilitar/Deshabilitar",
					value: "exec",
				},
				cancel: {
					text: "Cancelar",
					value: "cancelar",
					visible: true,
				},
			},
		}).then((action) => {
			if (action == "exec") {
				change_state(data.id , data.state);
			} else {
				swal.close();
			}
		});
		
	}
});






get_charges = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/employ/charges',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			    datatable_charges(result);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al cargar los cargos",
			});
        }
    })
}



create_charges = ()=> {

	let data= { name:$("#name_charge").val()};


    $.ajax({
		data: {data},
		type: "POST",
		url: host_url + 'api/employ/create/charges',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito",
				icon: "success",
				text: "Se ha creado el cargo con éxito",
			}).then(()=>{
                 $('#modal_create_charge').modal('hide');
				 $('name_charge').val('');
				 get_charges();
			});
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener los servicios",
			});
        }
    })
}


delete_charge= (id_charge)=> {
     data = {id:id_charge};
    $.ajax({
		data:{data},
		type: "POST",
		url: host_url + `api/employ/charges/delete`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito",
				icon: "success",
				text: "El cargo se ha eliminado con éxito.",
			}).then(()=>{
				 $('name_charge').val('');
				 get_charges();
			});
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener los servicios",
			});
        }
    })
}

change_state= (id_charge,state)=> {
	let new_state;
	state == 1? new_state = 0: new_state=1 ;
	data = {id:id_charge ,state:new_state};
   $.ajax({
	   data:{data},
	   type: "POST",
	   url: host_url + `api/employ/charges/state`,
	   crossOrigin: false,
	   dataType: "json",
	   success: (result) => {
		   swal({
			   title: "Exito",
			   icon: "success",
			   text: "El cargo ha cambiado de estado con éxito.",
		   }).then(()=>{
				$('name_charge').val('');
				get_charges();
		   });
		   }
	   ,
	   error: (msg)=>{
		   swal({
			   title: "Error",
			   icon: "error",
			   text: "Error al obtener los servicios",
		   });
	   }
   })
}


datatable_charges = (charges)=>{
    tabla_charges.clear();
	tabla_charges.rows.add(charges);
	tabla_charges.draw();

}


let desc_boolean=false;
let id_section=0;

const tabla_sections = $("#table-sections").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [2]},
		{className: "text-center", "targets": [3]}
    ],
	columns: [

		{ data: "title" },
        { data: "item" },
        { data: "url",
			render: function(data){

				if(data){
				binary = data;
				return '<img src="'+host_url+"assets/images/sections/"+binary+'" width="200" heigth="200"/>';
				}else{
				return 'No aplica';
				}
		} 
	    },
		
		{
			defaultContent: `<button type='button' name='sections-edit' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		
       
	],
});




$("#table-sections").on("click", "button", function () {
	let data = tabla_sections.row($(this).parents("tr")).data();
	if ($(this)[0].name == "sections-edit") {
        input_sections();
        id_section = data.id;
		if(id_section == 13){
			
			if(data.description){
			
				$('#item_not_image').val(data.item);
				$('.desc_display').show();
                 desc_boolean = true;
				 $('#title-not-image').val(data.title);
				 $('#desc-not-image').val(data.description);
				 $("#not_image_modal").modal('show');

			}else{
			
				desc_boolean = false;
				$('#item_not_image').val(data.item);
				$('#title-not-image').val(data.title);
				$('.desc_display').css('display', 'none');
				$("#not_image_modal").modal('show');

				
			}  

		}else if(id_section == 14){ // cabecera
            
			$("#item_section").val(data.item);
			$("#title-section").val(data.title);
			$(".desc_section").css('display', 'none');
			$("#description-section").val('cabecera');
			$("#section_modal").modal('show');
		 
	
		}else{
		$(".desc_section").show();
        $("#item_section").val(data.item);
        $("#title-section").val(data.title);
        $("#description-section").val(data.description);
        $("#section_modal").modal('show');
		}
    } 
});




get_sections = ()=> {
    
    let data = { 
        section:'employ_hidratec',

    }
    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/get/sections',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
              datatable_sections(result);}
        ,
        error: ()=>{  
              datatable_sections(0); }
        
    })
}




edit_not_image = ()=> {
    let data = {};

	if(desc_boolean){
			data = {
				id: id_section,
				desc_boolean:true,
				title:$('#title-not-image').val().toUpperCase(),
				description:$('#desc-not-image').val(),
			}
	}else{

		data = {
			id: id_section,
			desc_boolean:false,
			title:$('#title-not-image').val().toUpperCase(),
		}

   }

    
    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/section/about/update_not',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			
			swal({
				title: "Éxito",
				icon: "success",
				text: "La sección fue editada con éxito.",
			}).then(() => {
				$("#not_image_modal").modal('hide');
				input_sections();
				get_sections();
			})
        
			
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al actualizar la sección",
			});
        }
    });

}





edit_section = ()=> {

    let files = $("#file-section")[0].files;
    let data = {
        id: id_section,
        title:$('#title-section').val().toUpperCase(),
        description:$('#description-section').val(),
    }

    
    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/section/about/update',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			up_file_section(id_section);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al actualizar la sección",
			});
        }
    });

}


up_file_section= (id_image) => {
 
	$.ajax({
		data: new FormData(document.getElementById('image_section')),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/section/up/image/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha editado la sección con éxito. ",
				button: "OK",
			}).then(() => {
				input_sections();
				get_sections();
				$("#section_modal").modal('hide');
				swal.close();
				
		       // let url = 'adminImages'+'?ot='+ot;
		       // window.open(host_url+url);
			});
		},
		error: () => {
			swal({
				title: "Error",
				icon: "error",
				text: "Ha ocurrido un error",
			});
		},
	});
};



datatable_sections = (sections)=>{
    tabla_sections.clear();
	tabla_sections.rows.add(sections);
	tabla_sections.draw();

}

input_sections=()=>{

    $("#title").val('');
    $("#file_section").val('');
    $("#description").val('');
	$('#title-not-image').val('');
	$('#desc-not-image').val('');

};

$('#save_charge').on('click', create_charges);
$("#update_section_btn").on('click', edit_section);
$("#edit-not-image").on('click', edit_not_image);

