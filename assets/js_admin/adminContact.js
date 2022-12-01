$(() => {
    get_contact();
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


let id_contact=0;
const tabla_contact = $("#table-contact").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [2]},
		{className: "text-center", "targets": [3]}
    ],
	columns: [
        { data: "city" },
        { data: "email" },
        { data: "phone" },
        { data: "url",
        render: function(data){
            binary = data;
            return '<img src="'+host_url+"assets/images/contact/"+binary+'" width="200" heigth="200"/>';
         } 
        },

		
		{
			defaultContent: `<button type='button' name='show-contact' class='btn btn-success'>
                                  Ver
                                  <i class="fas fa-eye"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='edit-contact' class='btn btn-primary'>
                                Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
        {
			defaultContent: `<button type='button' name='delete-contact' class='btn btn-danger'>
                                   Eliminar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});

$("#table-contact").on("click", "button", function () {
	let data = tabla_contact.row($(this).parents("tr")).data();
	if ($(this)[0].name == "delete-contact") {
		swal({
			title: `Eliminar noticia`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar la sucursal: "${data.city}"? `,
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
				delete_contact(data.id);
			} else {
				swal.close();
			}
		});
	} if ($(this)[0].name == "edit-contact") {
        $("#edit_contact_modal").modal("show");
        $("#city-edit").val(data.city);
		$("#region-edit").val(data.region);
		$("#adress-edit").val(data.adress);
        $("#name-edit").val(data.name);
        $("#email-edit").val(data.email);
        $("#phone-edit").val(data.phone);
		id_contact=data.id;
       
		
	} if ($(this)[0].name == "show-contact") {
		url = `${host_url}assets/images/contact/${data.url}`;
	    $('.imagepreview').attr('src',url);
		$('#show_image').modal('show');   
	} 
});



get_contact = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/get/contacts',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			    datatable_contact(result);
			}
        ,
        error: ()=>{
            datatable_contact(0);
        }
    })
}


create_contact= () => {
	event.preventDefault();
	let files = $("#file")[0].files;

	let data = {
		city: $("#city").val(),
		region: $("#region").val(),
        phone: $("#phone").val(),
        email: $("#email").val(),
        name: $("#name").val(),
	};

	if(files.length > 0){

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/contact/create",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			
			let id_image = result.id;
			up_file(id_image);
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
}


edit_contact= () => {
	event.preventDefault();
	let files = $("#file")[0].files;

	let data = {
		id:id_contact,
		city: $("#city-edit").val(),
		region: $("#region-edit").val(),
        phone: $("#phone-edit").val(),
        email: $("#email-edit").val(),
        name: $("#name-edit").val(),
		adress: $("#adress-edit").val(),
	};



//	if(files.length > 0){

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/contact/update",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			let id_image = result.id;
			up_file_edit(id_image);
		
		},
		error: (result) => {
		    
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			})
		}
				
	});
/*
}else{

	swal({
		title: "Error",
		icon: "error",
		text: "Cargue una imagen por favor."
	})

}*/
}



up_file = (id_image) => {
  
	$.ajax({
		data: new FormData(document.getElementById("image")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/contact/up/image/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado el contacto con éxito ",
				button: "OK",
			}).then(() => {
                clear_input();
				get_contact();
				$('#file').val('');
				$('#create_contact_modal').modal('hide');
		
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





up_file_edit = (id_image) => {
  
	$.ajax({
		data: new FormData(document.getElementById("image-edit")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/contact/up/image/edit/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha editado el contacto con éxito ",
				button: "OK",
			}).then(() => {
				$("#edit_contact_modal").modal('hide');
				swal.close();
				clear_input();
				get_contact();
		
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




delete_contact= (id_new)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/contact/delete/${id_new}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                clear_input();
                get_contact();
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

datatable_contact = (contact)=>{
    tabla_contact.clear();
	tabla_contact.rows.add(contact);
	tabla_contact.draw();

}


clear_input=()=>{
    $("#city-edit").val('');
	$("#region-edit").val('');
    $("#name-edit").val('');
    $("#email-edit").val('');
    $("#phone-edit").val('');
    $("#city").val('');
    $("#name").val('');
	$("#region").val('');
    $("#email").val('');
    $("#phone").val('');
    $("#file").val('');
	$("#file-edit").val('');

}



let desc_boolean=false;
let id_section= 0;

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
		if(id_section == 16 ){
			
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

		}else if(id_section == 15){ // cabecera
              
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
        section:'contact_hidratec',

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

    
    if(files.length > 0){

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
}else{
    swal({
        title: "Atención",
        icon: "warning",
        text: "Cargue el archivo de imagen por favor.",
    });

}
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


$("#create_contact_btn").on('click',create_contact);
$("#edit_contact_btn").on('click',edit_contact);
$("#update_section_btn").on('click', edit_section);
$("#edit-not-image").on('click', edit_not_image);