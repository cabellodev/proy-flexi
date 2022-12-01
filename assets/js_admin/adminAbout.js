$(() => {
    get_personal();
    get_sections();
});




$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});


const tabla_personal = $("#table-personal").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [2]},
		{className: "text-center", "targets": [3]}
    ],
	columns: [

		{ data: "name" },
        { data: "area" },
        { data: "url",
			render: function(data){
				
		        
				binary=data;
				console.log(binary);
				return '<img src="'+host_url+"assets/images/personal/"+binary+'" width="200" heigth="200"/>';
			
		} 
	    },
		
		{
			defaultContent: `<button type='button' name='personal-edit' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		
        {
			defaultContent: `<button type='button' name='personal-delete' class='btn btn-danger'>
                                    Eliminar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});


let id_personal = 0;
let id_section=0;
$("#table-personal").on("click", "button", function () {
	let data = tabla_personal.row($(this).parents("tr")).data();
	if ($(this)[0].name == "personal-delete") {
		swal({
			title: `Eliminar personal`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar el personal: "${data.name}"? `,
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
				delete_personal(data.id,data.url);
			} else {
				swal.close();
			}
		});
	}else if($(this)[0].name == "personal-edit"){
        input_personal();
        id_personal = data.id;
        $("#name-personal-edit").val(data.name);
        $("#area-edit").val(data.area);
        $("#phrase-edit").val(data.phrase);
        $("#edit_personal_modal").modal('show');

    } 
});


datatable_personal = (personal)=>{
    tabla_personal.clear();
	tabla_personal.rows.add(personal);
	tabla_personal.draw();

}


get_personal = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/about/get/personal',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
              datatable_personal(result);}
        ,
        error: ()=>{  
              datatable_personal(0); }
        
    })
}


create_personal = ()=> {
    let files = $("#file")[0].files;
    let data = {
        name:$('#name-personal').val(),
        area:$('#area').val(),
        phrase:$('#phrase').val(),
    }

    if(files.length > 0){

    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/about/create/personal',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            let id_image = result.id;
			up_file(id_image);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener el personal",
			});
        }
    });
}else{
    swal({
        title: "Atención",
        icon: "warning",
        text: "Cargue el archivo de imagen por favor.",
    });

}
}


edit_personal = ()=> {
  
    let data = {
        id:id_personal,
        name:$('#name-personal-edit').val(),
        area:$('#area-edit').val(),
        phrase:$('#phrase-edit').val(),
    }

    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/about/update/personal',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Exito",
				icon: "success",
				text: "El personal fue editado con éxito",
			}).then(()=>{
                input_personal();
                $("#edit_personal_modal").modal('hide');
                get_personal();

            });
            
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al editar el personal",
			});
        }
    });

}



up_file = (id_image) => {
  
	$.ajax({
		data: new FormData(document.getElementById("image")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/about/up/image/personal/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado el personal con éxito ",
				button: "OK",
			}).then(() => {
				input_personal();
				get_personal();
				$("#create_personal_modal").modal('hide');
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


delete_personal =(id,url)=> { 
    let  data = {
        url:url
    }
	$.ajax({
		type: "POST",
        data: {data},
		url: `${host_url}api/about/delete/personal/${id}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Éxito",
				icon: "success",
				text: "El personal se ha eliminado correctamente.",
			}).then(() => {
				get_personal();
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



input_personal=()=>{

    $('#name-personal').val('');
    $('#area').val('');
    $('#phrase').val('');
    $('#file').val('');
    $('#name-personal-edit').val('');
    $('#area-edit').val('');
    $('#phrase-edit').val('');
    $('#file-edit').val('');
       
}

let desc_boolean=false;

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
		if(id_section ==7|| id_section ==6){
			
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

		}else if(id_section == 8){ // cabecera
            
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
        section:'about_hidratec',

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




$("#modal_create_personal").on('click', ()=>{ $("#create_personal_modal").modal('show'); input_personal(); });
$("#create_personal_btn").on('click', create_personal);
$("#edit_personal_btn").on('click', edit_personal);
$("#update_section_btn").on('click', edit_section);
$("#edit-not-image").on('click', edit_not_image);






