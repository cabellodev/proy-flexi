$(() => {
	get_rubros();
    get_services();
	get_sections();
});


let url ="";
let edit = false;
let id_rubro=0;
let id_service=0;

const tabla = $("#table-galleries").DataTable({
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
		{
			defaultContent: `<button type='button' name='description' class='btn btn-primary'>
                                Descripción
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		
		
		
		{
			defaultContent: `<button type='button' name='adminImage' class='btn btn-primary'>
                                 Galería
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		
	],
});

$("#table-galleries").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "adminImage") {
		  let id_service = data.id_service; 
          let url = 'service/admin/gallery'+'?id='+id_service;
          window.location.assign(host_url+url);
		}else if($(this)[0].name == "description"){
		     id_service = data.id_service
			 $("#description").val(data.description);
			$("#modal_description").modal("show");

		}
	} 
);



get_services = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/services',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			    datatable_services(result);
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


delete_service = (id_service)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/home/delete/service/${id_service}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_services();
            });
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al eliminar el servicio.",
			});
        }
    })
}

datatable_services = (services)=>{
    data=[];
	services.forEach( element =>{
         if(element.state ==1){

            data.push(element);

		 }

	});
    tabla.clear();
	tabla.rows.add(data);
	tabla.draw();

}





const tabla_rubros = $("#table-rubros").DataTable({
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
		{ data: "url",
			render: function(data){
				binary = data;
				return '<img src="'+host_url+"assets/images/rubros/"+binary+'" width="200" heigth="200"/>';
		} 
	    },
		{
			defaultContent: `<button type='button' name='show' class='btn btn-success'>
                                  ver
                                  <i class="fas fa-eye"></i>
                              </button>`,
		},
	
		{
			defaultContent: `<button type='button' name='edit_rubro' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
	
		
		{
			defaultContent: `<button type='button' name='delete' class='btn btn-danger'>
                                 Eliminar
                                  <i class="fas fa-tash"></i>
                              </button>`,
		},
		
	],
});




$("#table-rubros").on("click", "button", function () {
	let data = tabla_rubros.row($(this).parents("tr")).data();
	if ($(this)[0].name == "show") {

			url = `${host_url}assets/images/rubros/${data.url}`;
			$('.imagepreview').attr('src',url);
			$('#show_image').modal('show');
			
		}else if($(this)[0].name == "delete"){

			swal({
				title: `Eliminar imagen`,
				icon: "warning",
				text: `¿Está seguro/a de que desea eliminar esta imagen ?`,
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
					deleteRubro(data.id);
				} else {
					swal.close();
				}
			});

		}else if ($(this)[0].name == "edit_rubro"){
			edit=true;
			url = data.url;
			id_rubro =data.id;
			console.log(url);
			$("#name").val(data.name);
			$("#create_image_modal").modal("show");

		}
}
);

datatable_rubros = (rubros)=>{
    tabla_rubros.clear();
	tabla_rubros.rows.add(rubros);
	tabla_rubros.draw();

}



get_rubros = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/service/get/rubros',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			    datatable_rubros(result);
			}
        ,
    })
}

deleteRubro =(id)=> { 

	$.ajax({
		type: "POST",
		url: `${host_url}api/service/delete/rubros/${id}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Éxito",
				icon: "success",
				text: "La imagen se ha eliminado correctamente.",
			}).then(() => {
				get_rubros();
			});
			
		
		},
		error: (result) => {
		
			swal({
				title: "Error",
				icon: "error",
				text: "Error al eliminar la imagen.",
			})
		}
				
	});


}


create_rubro = () => {
	event.preventDefault();
	let files = $("#file")[0].files;
    let data={};
	let path="";
	
	if(edit){
        console.log(id_rubro);
		data = { name: $("#name").val(),  url: url, id_rubro: id_rubro }; 
		path = 'api/service/update/rubros';

	}else{
		
		path = 'api/service/rubro';
		data = { name: $("#name").val(),};
	}
    if(edit == false){
	if(files.length > 0){

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + path,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			if(edit){
			up_file(id_rubro);
			}else{
		    let id_image = result.id;
			up_file(id_image);

			}
			
			
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
		title: "Error",
		icon: "error",
		text: "Cargue una imagen por favor."
	})

}
	}else{
		
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + path,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			if(edit){
			up_file(id_rubro);
			}else{
		    let id_image = result.id;
			up_file(id_image);

			}
			
			
		},
		error: (result) => {
		    
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			})
		}
				
	});
	}
}


up_file = (id_image) => {
  
	$.ajax({
		data: new FormData(document.getElementById("image")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/service/up/image/rubros/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado el rubro con éxito ",
				button: "OK",
			}).then(() => {
				input_clear();
				get_rubros();
				$("#create_image_modal").modal('hide');
				$("#editImage").modal('hide');
		
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





save_description =()=>{
    let description =$("#description").val();
    let data = { description:description , id_service: id_service};
	console.log(data);
	$.ajax({
		type: "POST",
        data: {data},
		url: `${host_url}api/service/update/description`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Éxito",
				icon: "success",
				text: "La descripción se ha editado exitosamente.",
			}).then(() => {
				$("#modal_description").modal("hide");
			    input_clear();
				get_services();
			});
			
		
		},
		error: (result) => {
		
			swal({
				title: "Error",
				icon: "error",
				text: "Error al eliminar la imagen.",
			})
		}
				
	});
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
		if(id_section == 10||id_section == 11){
			
			if(data.description){
				console.log('con desc');
				$('#item_not_image').val(data.item);
				$('.desc_display').show();
                 desc_boolean = true;
				 $('#title-not-image').val(data.title);
				 $('#desc-not-image').val(data.description);
				 $("#not_image_modal").modal('show');

			}else{
			    console.log('sin desc');
				desc_boolean = false;
				$('#item_not_image').val(data.item);
				$('#title-not-image').val(data.title);
				$('.desc_display').css('display', 'none');
				$("#not_image_modal").modal('show');

				
			}  

		}else if(id_section == 12){ // cabecera
              
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
        section:'services_hidratec',

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


input_clear=()=>{
	$("#name").val("");
	$("#file").val("");
	$("#description").val("");
}

$("#modal_create").on('click', ()=>{input_clear(); $("#create_image_modal").modal('show'); edit=false; 	});


$("#create_image_btn").on('click', 
	create_rubro);

$("#save_description").on('click', 
	save_description);

$("#edit_btn").on('click', 
	create_rubro);
	

$("#update_section_btn").on('click', edit_section);
$("#edit-not-image").on('click', edit_not_image);